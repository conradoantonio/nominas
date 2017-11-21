@extends('admin.main')

@section('content')
<link rel="stylesheet" href="{{ asset('plugins/jquery-datatable/css/jquery.dataTables.css')}}"  type="text/css" media="screen"/>
<style>
textarea {
    resize: none;
}
th {
    text-align: center!important;
}
/* Change the white to any color ;) */
input:-webkit-autofill {
    -webkit-box-shadow: 0 0 0px 1000px white inset !important;
}
.table td.text {
    max-width: 177px;
}
.table td.text span {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    display: inline-block;
    max-width: 100%;
}
</style>
<div class="text-center" style="margin: 20px;">
    <h2>Alta pago</h2>
    <div class="row-fluid">
        <div class="span12">
            <div class="grid simple ">
                <div class="grid-title">
                    <div class="grid-body">
                        <form action="{{url('guardarPago')}}" method="post">
                        	{!! csrf_field() !!}
							<div class="form-group col-md-12">
								<label for="empresa_id">Empresa</label>
								<select name="empresa_id" id="empresa_id" class="select2 col-md-12">
									<option value="0">Seleccionar empresa</option>
									@foreach($empresas as $empresa)
									<option value="{{$empresa->id}}">{{$empresa->nombre}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col-md-12">
								<label for="servicio_id">Servicio</label>
								<select name="servicio_id" id="servicio_id" class="select2 col-md-12">
									<option value="0">Seleccionar servicio</option>
								</select>
							</div>
							<div class="form-group col-md-12">
								<label for="intervalo">Intervalo</label>
								<select name="intervalo" id="intervalo" class="col-md-12">
									<option value="0">Seleccionar interavlo</option>
									<option value="1/15">1 - 15</option>
									<option value="16/31">16 - 30/31</option>
								</select>
							</div>
							<div class="form-group col-md-12">
								<label for="trabajadores_id">Trabajadores</label>
								<select name="trabajadores[]" id="trabajadores_id" class="select2 col-md-12" multiple="multiple">
									<option value="0">Seleccionar trabajadores</option>
									@foreach($trabajadores as $trabajador)
									<option value="{{$trabajador->id}}">{{$trabajador->nombre}}</option>
									@endforeach
								</select>
							</div>
							<div class="botonera">
								<a href="{{url('nominas')}}" class="btn btn-default">Regresar</a>
								<button type="submit" class="btn btn-primary">Generar</button>
							</div>
						</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('plugins/jquery-datatable/js/jquery.dataTables.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/datatables-responsive/js/datatables.responsive.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/datatables-responsive/js/lodash.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/tabs_accordian.js') }}"></script>
<script src="{{ asset('js/datatables.js') }}"></script>
<script src="{{ asset('js/empresasAjax.js') }}"></script>
<script src="{{ asset('js/validacionesEmpresas.js') }}"></script>
<script>
	$(function(){
		$(".select2").select2();
	})
</script>
@endsection