@extends('layout.master')

@section('title','Miembros')

@section('title-page')
	<h3 class="animated fadeInDown">Miembros</h3>
@endsection

@section('content-page')
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel animated fadeInUp">
				<div class="x_title">
					<h2>Listado</h2> 
					<ul class="nav navbar-right panel_toolbox">
	                    <a class="btn btn-info" href="{{ route('members.create') }}"><i class="fa fa-plus"></i> Crear Miembro</a>
	                  </ul>
					<div class="clearfix"></div>
					@if (Session::has('mensaje'))
						<div class="alert alert-dismissible @if(Session::get('tipo_mensaje') == 'success') alert-info  @endif @if(Session::get('tipo_mensaje') == 'error') alert-danger  @endif" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
							{{session('mensaje')}}
					    </div>
						<div class="clearfix"></div>
					@endif
				</div>
				<div class="x_content">
					<table id="client-datatable" class="table table-striped table-bordered dt-responsive nowrap table-gym" cellspacing="0">
						<thead>
							<tr>
								<th class="text-center">Nombre</th>
								<th class="text-center">Cédula</th>
								<th class="text-center">Teléfono</th>
								<th class="text-center">Fecha de ingreso</th>
								<th class="text-center col-md-2 col-sm-2 col-xs-6">Acción</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($members as $client)
								<tr>
									<td>{{$client->name .' '. $client->last_name}} </td>
									<td>{{$client->identity_number}}</td>
									<td>{{$client->phone}} @if($client->mobile) / {{$client->mobile}} @endif</td>
									<td>{{$client->admission_date}}</td>
									<td class="text-center">
										<div class="btn-group">
										  <button type="button" class="btn btn-submit dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										    <i class="fa fa-cog"></i> <span class="caret"></span>
										  </button>
										  <ul class="dropdown-menu">
										    <li><a href="{{ route('members.show',$client->id) }}" title="Ver"><i class="fa fa-eye"></i> Ver</a></li>
										    <li>
												<a href="{{ route('members.edit',$client->id) }}" title="Editar"><i class="fa fa-pencil"></i> Editar</a>
											</li>
										    <li role="separator" class="divider"></li>
										    <li>
												<form action="{{ route('members.destroy',$client->id) }}" method="POST">
													<input type="hidden" name="_token" value="{{ csrf_token() }}">
													<input type="hidden" name="_method" value="DELETE">
													<button type="submit" title="Eliminar" class="btn btn-link" ><i class="fa fa-trash"></i> Eliminar</button>
												</form>
											</li>
										  </ul>
										</div>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					
				</div>
			</div>
		</div>
	</div>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('public/js/datatables/jquery.dataTables.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('public/js/datatables/buttons.bootstrap.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('public/js/datatables/fixedHeader.bootstrap.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('public/js/datatables/responsive.bootstrap.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('public/js/datatables/scroller.bootstrap.min.css') }}" />
@endsection

@section('js')
 <script src="{{ asset('public/js/datatables/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('public/js/datatables/dataTables.bootstrap.js') }}"></script>
 <script src="{{ asset('public/js/datatables/dataTables.buttons.min.js') }}"></script>
 <script src="{{ asset('public/js/datatables/buttons.bootstrap.min.js') }}"></script>
 <script src="{{ asset('public/js/datatables/jszip.min.js') }}"></script>
 <script src="{{ asset('public/js/datatables/pdfmake.min.js') }}"></script>
 <script src="{{ asset('public/js/datatables/vfs_fonts.js') }}"></script>
 <script src="{{ asset('public/js/datatables/buttons.html5.min.js') }}"></script>
 <script src="{{ asset('public/js/datatables/buttons.print.min.js') }}"></script>
 <script src="{{ asset('public/js/datatables/dataTables.fixedHeader.min.js') }}"></script>
 <script src="{{ asset('public/js/datatables/dataTables.keyTable.min.js') }}"></script>
 <script src="{{ asset('public/js/datatables/dataTables.responsive.min.js') }}"></script>
 <script src="{{ asset('public/js/datatables/responsive.bootstrap.min.js') }}"></script>
 <script src="{{ asset('public/js/datatables/dataTables.scroller.min.js') }}"></script>

 <script type="text/javascript">
 	$(document).ready(function(){
    	$('#client-datatable').DataTable({
    		"language": {
          		"url": '{{ asset("public/js/datatables/json/es.json") }}'
        	}
    	});
	});
 </script>
@endsection