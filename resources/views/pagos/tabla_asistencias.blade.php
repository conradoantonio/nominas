<table class="table table-bordered table-responsive" id="nomina">
	<thead>
		<th></th>
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
				<td class="small-cell v-align-middle">
                    <div class="checkbox check-success">
                        <input id="checkbox{{$trabajador->id}}" type="checkbox" class="checkDelete" value="1">
                        <label for="checkbox{{$trabajador->id}}"></label>
                    </div>
                </td>
				<td>{{$trabajador->usuarios->id}}</td>
				<td data-user={{$trabajador->usuarios->id}} data-realid={{$pago->id}} data-pago={{$trabajador->id}}>{{$trabajador->usuarios->nombre}}</td>
				@if( count($asistencias) == 0 )
    				@foreach( $dias as $day )
						<td class="cell" data-dia="{{$day['num']}}"></td>
					@endforeach
				@else
					@foreach( $asistencias as $asistencia )
						@if( $asistencia->pago->id == $trabajador->id)
							<td class="cell" data-dia="{{$asistencia->dia}}">{{$asistencia->status}}</td>
						@endif
					@endforeach
				@endif
				<td data-notes="1"><input type="text" name="notas" value="{{$trabajador->notas?$trabajador->notas:''}}"></td>
			</tr>
		@endforeach
	</tbody>
</table>