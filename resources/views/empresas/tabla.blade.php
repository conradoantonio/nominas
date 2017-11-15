<table class="table" id="example3">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Nombre</th>
            <th class="">direccion</th>
            <th class="">Teléfono</th>
            <th class="hide">Número exterior</th>
            <th class="hide">Número interior</th>
            <th class="hide">Código postal</th>
            <th class="hide">Logo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @if(count($empresas) > 0)
            @foreach($empresas as $empresa)
                <tr class="" id="{{$empresa->id}}">
                    <td class="small-cell v-align-middle">
                        <div class="checkbox check-success">
                            <input id="checkbox{{$empresa->id}}" type="checkbox" class="checkDelete" value="1">
                            <label for="checkbox{{$empresa->id}}"></label>
                        </div>
                    </td>
                    <td>{{$empresa->id}}</td>
                    <td>{{$empresa->nombre}}</td>
                    <td class="text">{{$empresa->direccion}}</td>
                    <td class=""><span>{{$empresa->telefono}}</span></td>
                    <td class="hide"><span>{{$empresa->numero_int}}</span></td>
                    <td class="hide"><span>{{$empresa->numero_ext}}</span></td>
                    <td class="hide"><span>{{$empresa->codigo_postal}}</span></td>
                    <td class="hide"><span>{{$empresa->logo}}</span></td>
                    <td>
                        <button type="button" class="btn btn-info editar_empresa">Editar</button>
                        <button type="button" class="btn btn-danger eliminar_empresa">Borrar</button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>