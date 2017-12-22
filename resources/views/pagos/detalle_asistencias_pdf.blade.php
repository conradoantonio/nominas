<!DOCTYPE html>
<html>
<head>
	<title>PDF de asistencias</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<style>
	.color{
		background-color: gray;
		font-weight: bold;
	}
	.none{
		background-color:none;
	}
	</style>
</head>

<body>

	  <div class="row">
		<div class="">
			<h2>CERO RIESGOS S.A DE C.V</h2>
			<h3>PLAZA: GUADALAJARA, JAL.</h3>
			<h6>Dirección: CALLE 8 No. 2162 COL ZONA INDUSTRIAL, GUADALAJARA, JALISCO</h6>
			<h6>Contacto: LIC. MARIA DE JESUS CORDOBA (ENCARGADA)</h6>
			<h6>Teléfono: 3811-1116 Ext. 221</h6>
			<h6>Marcación corta: <strong>712</strong></h6>
			<span style="font-weight: bold; background-color: GRAY;">SERVICIO:</span><span> 01 SERVICIO DE 24X24 HRS</span>
			<br>
			<span style="font-weight: bold; background-color: GRAY;">Elementos:</span><span> 2</span>
			<br>
			<span style="font-weight: bold; background-color: GRAY;">Horario:</span><span> 1 SERVICIO DE LUNES A DOMINGO DE 07:00 A 07:00</span>
			<br>
			<span style="font-weight: bold; background-color: GRAY;">Sueldo:</span><span> $2,600 QUINCENAL</span>
			<br>
			<br>
		</div>
		<div class="" style="float: right;">
			<img src="http://nominas.bsmx.tech/img/logo_topali.png" alt="company-logo">
		</div>
		</div>
	<br>
	<table id="" class="table">
		<thead class="thead-light">
			<tr>
				<th style="width: 10px;">ID</th>
				<th style="width: 10px;">Nombre</th>
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
			</tr>
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
					<!--<td data-notes="1">{{$trabajador->notas?$trabajador->notas:''}}</td>-->
				</tr>
			@endforeach
		</tbody>
	</table>
	<br>
	<table id="" class="table">
		<thead class="thead-light">
			<tr>
				<th style="width: 10px;">ID</th>
				<th>Notas</th>
			</tr>
		</thead>
		<tbody>
			@foreach( $pago->PagoUsuarios as $trabajador )
				<tr>
					<td>{{$trabajador->usuarios->id}}</td>
					<td data-notes="1">{{$trabajador->notas?$trabajador->notas:''}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>

	