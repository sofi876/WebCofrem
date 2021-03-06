<div class="row">
    <div class="col-sm-12">
        <h5>Exportar</h5>
        <div class="card-box widget-inline">
            <div class="row">
                <div class="widget-inline-box text-right">
                    <strong>Exportar: </strong>
                    <div class="btn-group">
                        <a href="{{route('pdfdatafonosxestablecimientos',['lista_esta'=>$lista_esta,'resultado'=>$resultado,'resumen'=>$resumen])}}"
                           class="btn btn-sm btn-custom" data-toggle="tooltip" title="PDF">
                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                        </a>
                        <a href="{{route('exceldatafonosxestablecimientos',['lista_esta'=>$lista_esta,'resultado'=>$resultado,'resumen'=>$resumen])}}"
                           class="btn btn-sm btn-custom" data-toggle="tooltip" title="EXCEL">
                            <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <h5>Resultado</h5>
        <div class="card-box widget-inline">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="widget-inline-box" >
                        <div class="table-responsive m-b-20">
                            @if(sizeof($establecimientos)>0)
                                @foreach($establecimientos as $establecimiento)

                                    <h5>Establecimiento: {{$establecimiento->razon_social}}</h5>
                                    @foreach ($resumen as $resum)
                                    @if($resum['establecimiento']== $establecimiento->id)
                                            <table id="datatable" class="table table-striped table-bordered" width="100%">
                                                <tr><td>Terminales Activas: </td><td>{{$resum['tactivas']}}</td><td> Terminales Inactivas: </td><td>{{$resum['tinactivas']}}</td></tr>
                                            </table>
                                        @endif
                                    @endforeach
                                    <?php $haysucursal=0; ?>
                                    @foreach($sucursales as $sucursale)
                                        <?php $cant=0; ?>
                                        @if($sucursale->establecimiento_id==$establecimiento->id)
                                            <?php $haysucursal++; ?>
                                            <h5>{{$sucursale->nombre}}</h5>
                                            @if(sizeof($resultado)>0)
                                                <table id="datatable" class="table table-striped table-bordered" width="100%">
                                                    <thead>
                                                    <tr>
                                                        <th>Código</th>
                                                        <th>Activo</th>
                                                        <th>Estado</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($resultado as $miresul)
                                                        @if($miresul["establecimiento"]==$establecimiento->id && $miresul["sucursal"]==$sucursale->id)
                                                            <?php $cant++; ?>
                                                            <tr>
                                                                <td>{{$miresul["codigo"]}}</td>
                                                                <td>{{$miresul["numero_activo"]}}</td>
                                                                <td>{{$miresul["estado"]}}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                            @endif
                                            @if($cant==0)
                                                <p align="center">No hay registros</p>
                                            @endif
                                        @endif
                                    @endforeach
                                    @if($haysucursal==0)
                                        <p align="center">No existen sucursales</p>
                                    @endif
                                    <br>
                                    <!--</div>-->
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(sizeof($establecimientos)==0)
            <p align="center">Debe seleccionar al menos un establecimiento</p>
        @endif
    </div>
</div>

<script>
    /* $('#datatable').DataTable({
     "language": {
     "url": "{ !!route('datatable_es')!!}"
     },
     });*/
</script>