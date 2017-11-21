@extends('admin.main')

@section('content')
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-select2/select2.css')}}"  type="text/css" media="screen"/>
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
     @if(session('msg'))
    <div class="alert {{session('class')}}">
        {{session('msg')}}
    </div>
    @endif
    <h2>Lista de pagos</h2>
    <div class="row-fluid">
        <div class="span12">
            <div class="grid simple ">
                <div class="grid-title">
					<div class="text-left">
						<div class="row">
							<div class="col-md-6">
								<ul>
									<li><strong>Empresa: </strong>{{$pago->empresa->nombre}}</li>
									<li><strong>Dirección: </strong>{{$pago->empresa->direccion}}</li>
									<li><strong>Teléfono: </strong>{{$pago->empresa->telefono}}</li>
								</ul>
							</div>
							<div class="col-md-6 text-right">

							</div>
						</div>
					</div>
                    <div class="grid-body">
                        <div class="table-responsive" id="div_tabla_empresas">
                            <table class="table table-bordered table-responsive">
                            	<thead>
                            		<th>Nombre</th>
                            		@foreach( $dias as $day )
										@if( $day['dia'] == 0 )
											<th>
												<h6>D</h6>
												<h6>{{$day['num']}}</h6>
											</th>
										@elseif( $day['dia'] == 1 )
											<th>
												<h6>L</h6>
												<h6>{{$day['num']}}</h6>
											</th>
										@elseif( $day['dia'] == 2 )
											<th>
												<h6>M</h6>
												<h6>{{$day['num']}}</h6>
											</th>
										@elseif( $day['dia'] == 3 )
											<th>
												<h6>M</h6>
												<h6>{{$day['num']}}</h6>
											</th>
										@elseif( $day['dia'] == 4 )
											<th>
												<h6>J</h6>
												<h6>{{$day['num']}}</h6>
											</th>
										@elseif( $day['dia'] == 5 )
											<th>
												<h6>V</h6>
												<h6>{{$day['num']}}</h6>
											</th>
										@else
											<th>
												<h6>S</h6>
												<h6>{{$day['num']}}</h6>
											</th>
										@endif
                            		@endforeach
                            	</thead>
                            	<tbody>
                            		@foreach( $pago->PagoUsuarios as $trabajador )
                            			<tr>
                            				<td>{{$trabajador->usuarios->nombre}}</td>
	                            			@for( $i = count($dias); $i > 0 ; $i--)
	                            				<td>

	                            				</td>
	                            			@endfor
                            			</tr>
                            		@endforeach
                            	</tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{url('nominas')}}" class="btn btn-default">Regresar</a>
        </div>
    </div>
</div>

<script src="{{ asset('plugins/jquery-datatable/js/jquery.dataTables.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/datatables-responsive/js/datatables.responsive.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/datatables-responsive/js/lodash.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/tabs_accordian.js') }}"></script>
<script src="{{ asset('js/datatables.js') }}"></script>
@endsection