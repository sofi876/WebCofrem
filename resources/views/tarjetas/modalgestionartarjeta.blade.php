<div id="modalgestionartarjetas">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Gestionar tarjeta {{$detalleproducto->numero_tarjeta}}</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <h4 class="m-t-0 header-title"><b>Modificar estado</b></h4>
                {{Form::model($detalleproducto,['route'=>['tarjetas.editarp',$detalleproducto->id], 'class'=>'form-horizontal', 'id'=>'editartarjetas'])}}
                <div class="form-group">
                    <label for="estado">Estado</label>
                    {{Form::select('estado',['A'=>'Activo','I' => 'Inactivo'],null,['class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    <label for="estado">Motivo</label>
                    {{Form::select('motivo',['A'=>'Activo','I' => 'Inactivo'],null,['class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    <label for="estado">Nota</label>
                    {{Form::textarea('nota',null,['class'=>'form-control', "rows"=>"2"])}}
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-custom waves-effect waves-light">Guardar</button>
    </div>
</div>

<script>
    $(function () {
        $("#editartarjetas").parsley();
        $("#editartarjetas").submit(function (e) {
            e.preventDefault();
            var form = $(this);
            $.ajax({
                url: form.attr('action'),
                data: form.serialize(),
                type: 'POST',
                dataType: 'json',
                beforeSend: function () {
                    cargando();
                },
                success: function (result) {
                    if (result.estado) {
                        swal(
                            {
                                title: 'Bien!!',
                                text: result.mensaje,
                                type: 'success',
                                confirmButtonColor: '#4fa7f3'
                            }
                        );
                        modalBs.modal('hide');
                    } else if (result.estado == false) {
                        swal(
                            'Error!!',
                            result.mensaje,
                            'error'
                        );
                        resetInfo(result.data);

                    } else {
                        html = '';
                        for (i = 0; i < result.length; i++) {
                            html += result[i] + '\n\r';
                        }
                        swal(
                            'Error!!',
                            html,
                            'error'
                        )
                    }
                    table.ajax.reload();
                },
                error: function (xhr, status) {
                    var message = "Error de ejecución: " + xhr.status + " " + xhr.statusText;
                    swal(
                        'Error!!',
                        message,
                        'error'
                    )
                },
                // código a ejecutar sin importar si la petición falló o no
                complete: function (xhr, status) {
                    fincarga();
                }
            });
        });

        $('#editarcheck').change(function () {
            if ($(this).is(':checked')) {
                $('#editartarjetas input, #editartarjetas select').attr('disabled', false)
            } else {
                $('#editartarjetas input, #editartarjetas select').attr('disabled', true)
            }
        })
    });

    function resetInfo(data) {
        $('#tipo').val(data.tipo);
        setTimeout(function () {
            if ($('#editarcheck').is(':checked')) {
                $('#editarcheck').trigger('click');
            }
        }, 200);

    }

</script>