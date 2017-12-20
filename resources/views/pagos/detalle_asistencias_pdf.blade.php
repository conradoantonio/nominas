<!DOCTYPE html>
<html>
<head>
	<title>PDF de asistencias</title>
</head>
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
<body>
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
</body>
</html>

	