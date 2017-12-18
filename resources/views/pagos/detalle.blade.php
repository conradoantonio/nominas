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
td.cell{
	cursor: pointer;
}
td.cell.selected{
	background: #7db2d2d9;
}
td.cell.disabled{
	background-color: #cacaca91;
	cursor: context-menu;
}
</style>
<div class="text-center" style="margin: 20px;">
     @if(session('msg'))
    <div class="alert {{session('class')}}">
        {{session('msg')}}
    </div>
    @endif
    <h2>Lista de asistencia</h2>
    <div class="row-fluid">
        <div class="span12" id="contenedor-detalles">
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
                            <table class="table table-bordered table-responsive" id="nomina">
                            	<thead>
                            		<th>ID</th>
                            		<th>Nombre</th>
                            		@foreach( $dias as $day )
										@if( $day['dia'] == 0 )
											<th class="{{$day['edit']?'edit':''}}">
												<h6>D</h6>
												<h6>{{$day['num']}}</h6>
											</th>
										@elseif( $day['dia'] == 1 )
											<th class="{{$day['edit']?'edit':''}}">
												<h6>L</h6>
												<h6>{{$day['num']}}</h6>
											</th>
										@elseif( $day['dia'] == 2 )
											<th class="{{$day['edit']?'edit':''}}">
												<h6>M</h6>
												<h6>{{$day['num']}}</h6>
											</th>
										@elseif( $day['dia'] == 3 )
											<th class="{{$day['edit']?'edit':''}}">
												<h6>M</h6>
												<h6>{{$day['num']}}</h6>
											</th>
										@elseif( $day['dia'] == 4 )
											<th class="{{$day['edit']?'edit':''}}">
												<h6>J</h6>
												<h6>{{$day['num']}}</h6>
											</th>
										@elseif( $day['dia'] == 5 )
											<th class="{{$day['edit']?'edit':''}}">
												<h6>V</h6>
												<h6>{{$day['num']}}</h6>
											</th>
										@else
											<th class="{{$day['edit']?'edit':''}}">
												<h6>S</h6>
												<h6>{{$day['num']}}</h6>
											</th>
										@endif
                            		@endforeach
                            		<th>Notas</th>
                            	</thead>
                            	<tbody>
                            		@foreach( $pago->PagoUsuarios as $trabajador )
                            			<tr>
                            				<td>{{$trabajador->usuarios->id}}</td>
                            				<td data-user={{$trabajador->usuarios->id}} data-realid={{$pago->id}} data-pago={{$trabajador->id}}>{{$trabajador->usuarios->nombre}}</td>
                            				@if( count($asistencias) == 0 )
	                            				@foreach( $dias as $day )
													<td class="cell" data-dia="{{$day['num']}}"></td>
												@endforeach
                            				@else
                            					@foreach( $asistencias as $asistencia )
                            						@if( $asistencia->pago->trabajador_id == $trabajador->usuarios->id)
														<td class="cell" data-dia="{{$asistencia->dia}}">{{$asistencia->status}}</td>
                            						@endif
                            					@endforeach
                            				@endif
                            				<td data-notes="1"><input type="text" name="notas" id="notas" value="{{$trabajador->notas?$trabajador->notas:''}}"></td>
                            			</tr>
                            		@endforeach
                            	</tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{$pago->status != 0 ? url('nominas') : url('historial')}}" class="btn btn-default">Regresar</a>
            <button id="guardar" class="btn btn-primary {{$pago->status != 0 ? '' : 'hide'}}">
                <i class="fa fa-spinner fa-spin" style="display: none;"></i>
            	Guardar
            </button>
			<a href="{{url('pagar-nomina/'.$pago->id)}}" class="btn btn-success {{$pago->status != 2 ? 'hide' : ''}}" id="btn-pagar">Pagar</a>
        </div>
    </div>
</div>

<script src="{{ asset('plugins/jquery-datatable/js/jquery.dataTables.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/datatables-responsive/js/datatables.responsive.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/datatables-responsive/js/lodash.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/tabs_accordian.js') }}"></script>
<script src="{{ asset('js/datatables.js') }}"></script>
<script type="text/javascript">
	/*$('table').each('td',function(){
		console.log($(this))
		var col = $(this).prevAll().length;
		if (  !$(this).parents('table').find('th').eq(col).hasClass('edit') ){
			$(this).css('background','black')
		}
	})*/

	$(function(){
		$('table#nomina tbody').find('td.cell').each (function() {
			var col = $(this).prevAll().length;
			if (  !$(this).parents('table').find('th').eq(col).hasClass('edit') ){
				$(this).addClass('disabled')
				/*if ( $.inArray($(this).text(), ['D', 'F', 'X', '-']) < 0 ){
					$(this).text('F')
				}*/
			}
		});

		$('td').on('click',function(){
			var col = $(this).prevAll().length;
			if ( $(this).parents('table').find('th').eq(col).hasClass('edit') ){
				if ( !$(this).hasClass('selected') ){
					$(this).addClass('selected')
				} else {
					$(this).removeClass('selected')
				}
			}
		})

		$(document).keypress(function(e){
			if ( e.which == 100 || e.which == 102 || e.which == 120 || e.which == 68 || e.which == 70 || e.which == 88 || e.which == 45 ) {
				$(document).find('.selected').text(e.key.toUpperCase()).removeClass('edit, selected').addClass('done')
			}
		});
	})

	$('#guardar').on('click', function(){
		var button = $(this);
		var empty = 0;

		$('table#nomina tbody').find('td.cell').each (function() {
			var col = $(this).prevAll().length;
			if ( $(this).parents('table').find('th').eq(col).hasClass('edit') ){
				if ( $.inArray($(this).text().trim(), ['D', 'F', 'X', '-']) < 0 ){
					empty++;
				}
			}
		});

		if( empty > 0 ){
			swal('Error', 'Necesita llenar los campos disponibles', 'error')
			return false;
		}

		var collection = [];
		$('table#nomina tbody').find('tr').each (function() {
			var obj = new Object();
			obj.days = [];
			$(this).find('td').each(function(){
				var ele = $(this);
				var array = [];
				if ( $(this).data('user') ){
					obj.user_id = $(this).data('user');
					obj.pago_id = $(this).data('pago');
					obj.real_id_pago = $(this).data('realid');
				} else if( $(this).data('notes') ){
					obj.notas = $(this).find('input').val()
				}else if( $(this).hasClass('cell') ){
					if ( $.inArray(ele.text(), ['D', 'F', 'X', '-']) >= 0 ){
						var txt = ele.text();
					} else {
						var txt = '';
					}
					array = {
						'dia' : ele.data('dia'),
						'status' : txt
					}
					obj.days.push(
						array
					)
				}
			})
			collection.push(obj);
		});

		var json = JSON.stringify(collection);

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		button.children('i').show();
        button.attr('disabled', true);

		$.ajax({
			url:"{{url('guardarNominas')}}",
			type:'POST',
			data: {
				'collection': json
			},
			success: function(response) {
				button.children('i').hide();
            	button.attr('disabled', false);
				console.log(response);
				if (response.status == 2) {
					$('a#btn-pagar').removeClass('hide');
				} /*else if (response.status != 0){
					$('div.contenedor-detalles button#pagar').removeClass('hide');
				}*/
				if( response.save ){
					swal('Éxito', 'Los cambios se han realizado correctamente', 'success')
				}
			},
			error: function(xhr, status, error) {
				button.children('i').hide();
            	button.attr('disabled', false);
	            swal({
	                title: "<small>¡Error!</small>",
	                text: "Se encontró un problema tratando de guardar las asistencias, por favor, trate nuevamente o recargue la página.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
	                html: true
	            });
	        }
		});
	})
</script>
@endsection