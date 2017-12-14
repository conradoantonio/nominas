<table class="table" id="example3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <td>Estado</td>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @if(count($pagos) > 0)
            @foreach($pagos as $pago)
                <tr class="" id="{{$pago->id}}">
                    <td>{{$pago->id}}</td>
                    <td>{{$pago->empresa->nombre}}</td>
                    <td>
                        @if( $pago->status == 1 )
                            Asistencia
                        @elseif( $pago->status == 2 )
                            Pendiente a pagar
                        @else
                            Pagado
                        @endif
                    </td>
                    <td>
                        <a href="{{url('detalle-nomina/'.$pago->id)}}" class="btn btn-info editar_pago">Detalle</a>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>