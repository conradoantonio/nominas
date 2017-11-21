@extends('admin.main')

@section('content')
<style type="text/css">
    textarea {
        resize: none;
    }
</style>
<div class="text-center" style="margin: 20px;">
    <h2>{{$empleado ? 'Editar' : 'Nuevo'}} Empleado</h2>
    <div class="row-fluid">
        <div class="span12">
            <div class="grid simple ">
                <div class="grid-title">
                    <div class="grid-body">
                    	<div class="container-fluid content-body">
                            <form id="form_empleado" action="{{url('empleados')}}/{{ $empleado ? 'actualizar' : 'guardar' }}" enctype="multipart/form-data" method="POST" autocomplete="off">
                                <input type="hidden" name="_token" id="token" value="{!! csrf_token() !!}" base-url="<?php echo url();?>">
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12 hidden">
                                        <div class="form-group">
                                            <label for="id">ID</label>
                                            <input type="text" class="form-control" value="{{$empleado ? $empleado->id : ''}}" id="id" name="id">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" class="form-control" value="{{$empleado ? $empleado->nombre : ''}}" id="nombre" name="nombre" placeholder="Nombre">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <label for="apellido">Apellido</label>
                                            <input type="text" class="form-control" value="{{$empleado ? $empleado->apellido : ''}}" id="apellido" name="apellido" placeholder="Apellido">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <label for="num_empleado">No. empleado</label>
                                            <input type="text" class="form-control" value="{{$empleado ? $empleado->num_empleado : ''}}" id="num_empleado" name="num_empleado" placeholder="No. empleado">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="domicilio">Domicilio</label>
                                            <textarea class="form-control" id="domicilio" name="domicilio" placeholder="Domicilio">{{$empleado ? $empleado->domicilio : ''}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="ciudad">Ciudad</label>
                                            <input type="text" class="form-control" value="{{$empleado ? $empleado->ciudad : ''}}" id="ciudad" name="ciudad" placeholder="Ciudad">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="telefono">Teléfono</label>
                                            <input type="text" class="form-control" value="{{$empleado ? $empleado->telefono : ''}}" id="telefono" name="telefono" placeholder="Teléfono">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="rfc">RFC</label>
                                            <input type="text" class="form-control" value="{{$empleado ? $empleado->rfc : ''}}" id="rfc" name="rfc" placeholder="RFC">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="curp">CURP</label>
                                            <input type="text" class="form-control" value="{{$empleado ? $empleado->curp : ''}}" id="curp" name="curp" placeholder="CURP">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="nss">NSS</label>
                                            <input type="text" class="form-control" value="{{$empleado ? $empleado->nss : ''}}" id="nss" name="nss" placeholder="NSS">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="telefono_emergencia">Télefono de emergencia</label>
                                            <input type="text" class="form-control" value="{{$empleado ? $empleado->telefono_emergencia : ''}}" id="telefono_emergencia" name="telefono_emergencia" placeholder="Télefono de emergencia">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" id="guardar_empleado">
                                    <i class="fa fa-spinner fa-spin" style="display: none;"></i>
                                    Guardar
                                </button>
                                <a href="{{url('empleados')}}"><button type="button" class="btn btn-default" data-dismiss="modal">Regresar</button></a>
                            </form>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/empleadosAjax.js') }}"></script>
<script src="{{ asset('js/validacionesEmpleados.js') }}"></script>
@endsection