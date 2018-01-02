 <table class="table table-hover" id="example3">
    <thead class="centered">    
        <th>ID</th>
        <th>Nombre</th>
        <th class="hide">Apellido</th>
        <th>Descripcion</th>
        <th class="hide">Foto perfil</th>
        <th>Status</th>
        <th>Correo</th>
        <th class="hide">Usuario_id</th>
        <th>Acciones</th>
    </thead>
    <tbody id="tabla-estilistas" class="">
        @if(count($estilistas) > 0)
            @foreach($estilistas as $estilista)
                <tr class="" id="{{$estilista->id}}" idUsuario="{{$estilista->id}}">
                    <td>{{$estilista->id}}</td>
                    <td>{{$estilista->nombre}}</td>
                    <td class="hide">{{$estilista->apellido}}</td>
                    <td class="text"><span>{{$estilista->descripcion}}</span></td>
                    <td class="hide">{{$estilista->imagen}}</td>
                    <td><?php echo $estilista->status == '2' ? '<span class="label label-warning">Bloqueado</span>' : ($estilista->status == '1' ? '<span class="label label-success">Activo</span>' : '<span class="label label-info">Desconocido</span>')?></td>
                    <td>{{$estilista->correo}}</td>
                    <td class="hide">{{$estilista->usuario_id}}</td>
                    <td>
                        @if($estilista->status == '1')
                            <button type="button" class="btn btn-info editar-estilista" change-to="">Editar</button>
                            <button type="button" class="btn btn-warning bloquear-estilista" change-to="2">Bloquear</button>
                            <button type="button" class="btn btn-danger eliminar-estilista" change-to="0">Borrar</button>
                        @endif
                        
                        @if($estilista->status == '2')
                            <button type="button" class="btn btn-primary reactivar-estilista" change-to="1">Reactivar</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        @endif  
    </tbody>
</table>