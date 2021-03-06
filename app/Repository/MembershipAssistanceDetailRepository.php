<?php
namespace GymWeb\Repository;

use GymWeb\RepositoryInterface\MembershipAssistanceDetailRepositoryInterface;
use GymWeb\Models\MembershipAssistanceDetail;

/**
* 
*/
class MembershipAssistanceDetailRepository implements MembershipAssistanceDetailRepositoryInterface
{

	protected $parent;

	public function setParent($parent){
		$this->parent = $parent;
		return $this;
	}

	public function enum($params = null){
		$assistances = MembershipAssistanceDetail::where('membership_id',$this->parent)->orderBy('date_job','desc')->get();
		return $assistances;
	}

	public function find($field, $returnException = true){

	}

	//TODO
	public function save($data)
	{
		$detail = new MembershipAssistanceDetail();
		$detail->fill($data);
		if ($detail->save()) {
			$key = $detail->getKey();
			return  $detail;
		} 
		return false;
		
	}

	public function edit($id,$data){

	}


	public function remove($id){
		
	}

	public function totalAssistanceToday()
	{
		$query = MembershipAssistanceDetail::selectRaw('IFNULL(count(length_secuence_day),"0") as count')->whereRaw('date_job = date_format(now(),"%Y-%m-%d")')->first();
		return $query->count;
	}

	public function totalCurrentMonth()
	{
		$query = MembershipAssistanceDetail::selectRaw('date_job, count(date_job) as counter')->whereRaw('DATE_FORMAT(date_job, "%Y-%m") = DATE_FORMAT(now(), "%Y-%m")')->groupBy('date_job')->orderBy('date_job')->get();

		$arrayFormated = [];
		$dates = '';
		$counter = '';
		//format for chart.js
		foreach ($query as $key => $value) {
			$coma = $key == (count($query) - 1) ?   ''  :  ','  ;
			$dates.=  $value->date_job . $coma;
			$counter.= $value->counter . $coma;
		}
		$arrayFormated['dates'] = $dates;
		$arrayFormated['counters']= $counter;
		return $arrayFormated;
	}


	public function reportCountAssistances($params)
	{
		$query = MembershipAssistanceDetail::selectRaw("CONCAT(member.`name`,' ',member.`last_name`) as name_member, member.email,IFNULL(count(length_secuence_day) ,0) counter")
		->rightJoin('membership','membership.id','=','membership_assistance_detail.membership_id')
		->rightJoin('member','member.id','=','membership.member_id')
		->whereBetween('membership_assistance_detail.date_job',[$params['date_from'],$params['date_to']]);
		if (array_key_exists('member', $params) && $params['member']) {
			$query->where('member.id',$params['member']);
		}
		$query->groupBy('name_member');
		$query->orderBy('name_member','asc');
		$query->orderBy('counter','desc');
		$result = $query->get();
		return $result;
	}

}