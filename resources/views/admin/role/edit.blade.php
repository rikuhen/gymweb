@extends('layout.admin')

@section('title','Roles')

@section('content-page')
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2 class="animated fadeIn">Roles</h2> 
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
					<ul class="nav nav-tabs" role="tablist">
					    <li><a href="{{ route('roles.index') }}"> <i class="fa fa-list"></i> Listado</a></li>
					      <li role="presentation" class="active"><a href="#" aria-controls="listRoles" role="tab" data-toggle="tab"><i class="fa fa-edit"></i> Editar</a>
	                    </li>
					</ul>
					<div class="tab-content tab-gym-index">
						<div role="tabpanel" class="tab-pane active" id="listUser">
							<form method="post" class="form-label-left animated fadeIn" action="{{ route('roles.update',$role->id) }}">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="_method" value="PUT">
								<input type="hidden" name="key" value="{{$role->id}}">
								<div class="form-group col-md-3 col-sm-3 col-xs-4 @if($errors->has('name')) has-error @endif">
									<label class="control-label">Nombre: <span class="text-danger">*</span></label>
							     	<input type="text" class="form-control" placeholder="Nombre" name="name" value="{{ $role->name }}" autofocus>
							     	 @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
								     
								</div>
								<div class="form-group col-md-3 col-sm-3 col-xs-4 @if($errors->has('display_name')) has-error @endif">
									<label class="control-label">Nombre a mostrar: <span class="text-danger">*</span></label>
								    <input type="text" class="form-control" placeholder="Nombre a mostrar" name="display_name" value="{{ $role->display_name }}">
								     	@if ($errors->has('display_name')) <p class="help-block">{{ $errors->first('display_name') }}</p> @endif 
								</div>
								<div class="form-group col-md-6 col-sm-6 col-xs-6 @if($errors->has('description')) has-error @endif">
									<label class="control-label">Descripción </label>
							     	<input type="text" class="form-control" placeholder="Descripción" name="description" value="{{ $role->description }}">
							     	@if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
								</div>
								<div class="clearfix"></div>
								<h4 class="animated fadeIn">Permisos <span class="text-danger">*</span></h4>
								<div class="clearfix"></div>
								<div class="form-group col-md-12 col-sm-12 col-xs-12 @if($errors->has('permissions')) has-error @endif">
									@if ($errors->has('permissions')) <p class="help-block">{{ $errors->first('permissions') }}</p> @endif
									<ul class="list-inline">
										@foreach ($permissions as $permission)
											<li><div class="checkbox-inline">
												<label><input type="checkbox" value="{{$permission->id}}" name="permissions[]"  @if($permission->checked) checked="checked" @endif>
			    									{{$permission->display_name}}
			  									</label>
											</div>
											</li>
										@endforeach
									</ul>
								</div>
								<div class="clearfix"></div>
								<div class="ln_solid"></div>
								<div class="form-group">
			                      	<div class="col-md-6 col-sm-6 col-xs-12">
			                        	<a href="{{ route('roles.index') }}" class="btn btn-primary"><i class="fa fa-ban"></i> Cancelar</a>
			                        	<button type="submit" class="btn btn-submit"><i class="fa fa-save"></i> Guardar</button>
			                      	</div>
		                    	</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection

