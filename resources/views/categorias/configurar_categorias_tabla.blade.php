<div class="col-md-12">
    <ul class="nav nav-tabs" id="tab-01">
        <li class="active" id="liCortes"><a href="#tabCortes">Cortes</a></li>
        <li id="liPeinados"><a href="#tabPeinados">Peinados</a></li>
        <li id="liPiojos"><a href="#tabPiojos">Piojos</a></li>
    </ul>
    <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
        <div class="tab-content">
        <div class="tab-pane active" id="tabCortes">
            <div class="row">
                <div class="col-md-12">
                    <h3>Tabla de precio y tiempo estimado de cortes </h3>
                    <div class="table-responsive">
                        <table class="table" id="categoria_cortes">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Categoria</th>
                                    <th>Precio</th>
                                    <th>Tiempo mínimo</th>
                                    <th>Tiempo máximo</th>
                                    <th class="hide">Tipo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($categorias) > 0)
                                    @foreach($categorias as $tipo)
                                        <tr class="" id="{{$tipo->id}}">
                                            <td>{{$tipo->id}}</td>
                                            <td>{{$tipo->categoria}}</td>
                                            <td>{{$tipo->precio_cortes}}</td>
                                            <td>{{$tipo->tiempo_minimo_cortes}}</td>
                                            <td>{{$tipo->tiempo_maximo_cortes}}</td>
                                            <td class="hide">cortes</td>
                                            <td>
                                                <button type="button" class="btn btn-info editar_categoria">Editar</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tabPeinados">
            <div class="row">
                <div class="col-md-12">
                    <h3>Tabla de precio y tiempo estimado de peinados </h3>
                    <div class="table-responsive">
                        <table class="table" id="categoria_peinados">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Categoria</th>
                                    <th>Precio</th>
                                    <th>Tiempo mínimo</th>
                                    <th>Tiempo máximo</th>
                                    <th class="hide">Tipo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($categorias) > 0)
                                    @foreach($categorias as $tipo)
                                        <tr class="" id="{{$tipo->id}}">
                                            <td>{{$tipo->id}}</td>
                                            <td>{{$tipo->categoria}}</td>
                                            <td>{{$tipo->precio_peinados}}</td>
                                            <td>{{$tipo->tiempo_minimo_peinados}}</td>
                                            <td>{{$tipo->tiempo_maximo_peinados}}</td>
                                            <td class="hide">peinados</td>
                                            <td>
                                                <button type="button" class="btn btn-info editar_categoria">Editar</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tabPiojos">
            <div class="row">
                <div class="col-md-12">
                    <h3>Tabla de precio y tiempo estimado de piojos </h3>
                    <div class="table-responsive">
                        <table class="table" id="categoria_piojos">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Categoria</th>
                                    <th>Precio</th>
                                    <th>Tiempo mínimo</th>
                                    <th>Tiempo máximo</th>
                                    <th class="hide">Tipo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($categorias) > 0)
                                    @foreach($categorias as $tipo)
                                        <tr class="" id="{{$tipo->id}}">
                                            <td>{{$tipo->id}}</td>
                                            <td>{{$tipo->categoria}}</td>
                                            <td>{{$tipo->precio_piojos}}</td>
                                            <td>{{$tipo->tiempo_minimo_piojos}}</td>
                                            <td>{{$tipo->tiempo_maximo_piojos}}</td>
                                            <td class="hide">piojos</td>
                                            <td>
                                                <button type="button" class="btn btn-info editar_categoria">Editar</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>