<?php

namespace GymWeb\Http\Controllers\Admin\Membership;

use Illuminate\Http\Request;

use GymWeb\Http\Requests\MembershipRequest;

use GymWeb\RepositoryInterface\MembershipRepositoryInterface; 

use GymWeb\RepositoryInterface\MembershipTypeRepositoryInterface; 

use GymWeb\Http\Controllers\Controller;

use GymWeb\Http\Controllers\MemberController;


class MembershipController extends Controller
{
    
	public $membership;

	public $membershipType;

    public function __construct(MembershipRepositoryInterface $membership,MembershipTypeRepositoryInterface $membershipType)
    {
    	$this->membership = $membership;
    	$this->membershipType = $membershipType;
    }

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($parent)
	{
		$memberships = $this->membership->setParent($parent)->enum();
		$data = [
			'memberships' => $memberships
		];
		return view('admin.memberships.membership.index',$data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($parent)
	{ 
		if (!$parent) return redirect()->back();
		$membershipTypes = $this->membershipType->enum();
		return view('admin.memberships.membership.create',['member_id'=>$parent,'membershipTypes'=>$membershipTypes]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($parent,MembershipRequest $request)
	{
		$data = $request->all();
		$membership = $this->membership->save($data);
		$sessionData = [
			'tipo_mensaje' => 'success',
			'mensaje' => '',
		];
		if ($membership) {
			$sessionData['mensaje'] = 'La membresia se ha creado satisfactoriamente';
		} else {
			$sessionData['tipo_mensaje'] = 'error';
			$sessionData['mensaje'] = 'La membresia del cliente no pudo ser creado, intente nuevamente';
		}
		
		return redirect()->route('members.show',$parent)->with($sessionData);		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$membership = $this->membership->find($id,false);
		if ($membership) {
			return view('membership.show',['membership'=>$membership]);
		}

		$sessionData['tipo_mensaje'] = 'error';
		$sessionData['mensaje'] = 'El Cliente no pudo ser encontrado';
		return redirect()->route('members.index')->with($sessionData);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$membership = $this->membership->find($id);
		return view('membership.edit',['membership'=>$membership]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(MembershipRequest $request, $parent, $id)
	{
		$data = $request->all();
		$membership = $this->membership->edit($id,$data);
		$sessionData = [
			'tipo_mensaje' => 'success',
			'mensaje' => '',
		];
		if ($membership) {
			$sessionData['mensaje'] = 'Cliente Editado Satisfactoriamente';
		} else {
			$sessionData['tipo_mensaje'] = 'error';
			$sessionData['mensaje'] = 'El Cliente no pudo ser creado, intente nuevamente';
		}
		
		return redirect()->route('members.show',$parent)->with($sessionData);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		
		$membership = $this->membership->remove($id);
		
		$sessionData = [
			'tipo_mensaje' => 'success',
			'mensaje' => '',
		];
		
		if ($membership) {
			$sessionData['mensaje'] = 'Cliente Eliminado Satisfactoriamente';
		} else {
			$sessionData['tipo_mensaje'] = 'error';
			$sessionData['mensaje'] = 'El Cliente no pudo ser eliminado, intente nuevamente';
		}
		
		return redirect()->route('members.index')->with($sessionData);	
		
	}
}
