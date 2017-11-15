<table class="table table-hover" id="example3">
    <thead class="centered">    
        <th>ID</th>
        <th>Nombre</th>
        <th class="hide">Apellido</th>
        <th>Correo</th>
        <th>Celular</th>
        <th class="hide">Foto perfil</th>
        <th>Status</th>
        <th>Acciones</th>
    </thead>
    <tbody id="tabla-usuarios-app" class="">
        @if($usuarios)
            @foreach($usuarios as $usuario)
                <tr class="" id="{{$usuario->id}}" idUsuario="{{$usuario->id}}">
                    <td>{{$usuario->id}}</td>
                    <td>{{$usuario->nombre}}</td>
                    <td class="hide">{{$usuario->apellido}}</td>
                    <td>{{$usuario->correo}}</td>
                    <td>{{$usuario->celular}}</td>
                    <td class="hide">{{$usuario->foto_perfil}}</td>
                    <td><?php echo $usuario->status == '2' ? '<span class="label label-warning">Bloqueado</span>' : ($usuario->status == '1' ? '<span class="label label-success">Activo</span>' : '<span class="label label-info">Desconocido</span>')?></td>
                    <td>
                        @if($usuario->status == '1')
                            <button type="button" class="btn btn-info editar-usuario" change-to="">Editar</button>
                            <button type="button" class="btn btn-warning bloquear-usuario" change-to="2">Bloquear</button>
                            <button type="button" class="btn btn-danger eliminar-usuario" change-to="0">Borrar</button>
                        @endif
                        
                        @if($usuario->status == '2')
                            <button type="button" class="btn btn-primary reactivar-usuario" change-to="1">Reactivar</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        @endif  
    </tbody>
</table>