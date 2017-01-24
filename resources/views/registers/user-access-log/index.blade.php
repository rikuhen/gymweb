@extends('layout.master')

@section('title','Registro de acceso de usuarios')

@section('title-page')
	<h3>Registro de acceso de usuarios <small> Un listado de los que han ingresado al sistema.</small></h3>
@endsection


@section('content-page')
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Registro <small> de Usuarios que han ingresado al sistema</small></h2>
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
					<table id="user-access-datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="text-center">Fecha y Hora</th>
								<th class="text-center">Usuario</th>
								<th class="text-center">IP</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($registers as $register)
								<tr>
									<td>{{$register->created_at}} </td>
									<td>{{$register->user->username}}</td>
									<td>{{$register->ip_address}}</td>
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
<link rel="stylesheet" type="text/css" href="{{ asset('js/datatables/jquery.dataTables.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('js/datatables/buttons.bootstrap.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('js/datatables/fixedHeader.bootstrap.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('js/datatables/responsive.bootstrap.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('js/datatables/scroller.bootstrap.min.css') }}" />
@endsection

@section('js')
 <script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('js/datatables/dataTables.bootstrap.js') }}"></script>
 <script src="{{ asset('js/datatables/dataTables.buttons.min.js') }}"></script>
 <script src="{{ asset('js/datatables/buttons.bootstrap.min.js') }}"></script>
 <script src="{{ asset('js/datatables/jszip.min.js') }}"></script>
 <script src="{{ asset('js/datatables/pdfmake.min.js') }}"></script>
 <script src="{{ asset('js/datatables/vfs_fonts.js') }}"></script>
 <script src="{{ asset('js/datatables/buttons.html5.min.js') }}"></script>
 <script src="{{ asset('js/datatables/buttons.print.min.js') }}"></script>
 <script src="{{ asset('js/datatables/dataTables.fixedHeader.min.js') }}"></script>
 <script src="{{ asset('js/datatables/dataTables.keyTable.min.js') }}"></script>
 <script src="{{ asset('js/datatables/dataTables.responsive.min.js') }}"></script>
 <script src="{{ asset('js/datatables/responsive.bootstrap.min.js') }}"></script>
 <script src="{{ asset('js/datatables/dataTables.scroller.min.js') }}"></script>

 <script type="text/javascript">
 	$(document).ready(function(){
    	$('#user-access-datatable').DataTable();
	});
 </script>
@endsection