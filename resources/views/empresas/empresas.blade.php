@extends('admin.main')

@section('content')
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-select2/select2.css')}}"  type="text/css" media="screen"/>
<link rel="stylesheet" href="{{ asset('plugins/jquery-datatable/css/jquery.dataTables.css')}}"  type="text/css" media="screen"/>
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
</style>
<div class="text-center" style="margin: 20px;">

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="titulo_form_empresa" id="formulario_empresa">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="titulo_form_empresa">Nuevo empresa</h4>
                </div>
                <form id="form_empresa" action="" enctype="multipart/form-data" method="POST" autocomplete="off">
                    <input type="hidden" name="_token" id="token" value="{!! csrf_token() !!}" base-url="<?php echo url();?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6 col-xs-12 hidden">
                                <div class="form-group">
                                    <label for="id">ID</label>
                                    <input type="text" class="form-control" id="id" name="id">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="telefono">Teléfono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="direccion">Dirección</label>
                                    <textarea class="form-control" id="direccion" name="direccion" placeholder="Dirección"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label for="numero_ext">Número exterior</label>
                                    <input type="text" class="form-control" id="numero_ext" name="numero_ext" placeholder="Número exterior">
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label for="numero_int">Número interior</label>
                                    <input type="text" class="form-control" id="numero_int" name="numero_int" placeholder="Número interior">
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label for="codigo_postal">Código postal</label>
                                    <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" placeholder="Código postal">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="alert alert-info alert-dismissible text-left" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                    <strong>Nota: </strong>
                                    Solo se permiten subir imágenes con formato jpg, png, jpeg y gif con un tamaño menor a 5mb. 
                                    Procure que su resolución sea de 460x460 px o su equivalente a escala.
                                </div>
                            </div>
                            <div id="input_logo_empresa" class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="logo_empresa">Foto empresa</label>
                                    <input type="file" class="form-control" id="logo" name="logo">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row" id="logo_empresa">
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Foto actual</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="guardar_empresa">
                            <i class="fa fa-spinner fa-spin" style="display: none;"></i>
                            Guardar
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <h2>Lista de empresas</h2>

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="importar-excel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Importar empresas desde Excel</h4>
                </div>
                <form method="POST" onsubmit="return false" action="{{url('empresas/importar_empresas')}}" enctype="multipart/form-data" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                 <div class="alert alert-info alert-dismissible text-justify" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                    <strong>Instrucciones de uso: </strong><br>
                                    Para importar empresas a través de Excel, los datos deben estar acomodados como se describe a continuación: <br>
                                    Los campos de la primera fila de la hoja de excel deben de ir los campos llamados 
                                    <strong>"nombre, descripcion, precio, cantidad_porcion, precio_porcion, categoria, foto"</strong>, posteriormente, debajo de cada uno de estos campos deberán de ir los datos correspondientes de los empresas.
                                    <br><strong>Nota: </strong>
                                    <br>- Solo se aceptan archivos con extensión <kbd>xls y xlsx</kbd> y los empresas repetidos en el excel no serán creados.
                                    <br>- Esta acción puede llevar hasta 1 minuto, porfavor espere y permanezca en esta ventana hasta que un mensaje sea mostrado en su pantalla.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <input class="form-control" type="file" id="archivo-excel" name="archivo-excel">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="enviar-excel">
                            Importar
                            <i class="fa fa-spinner fa-spin" style="display: none;"></i>
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="row-fluid">
        <div class="span12">
            <div class="grid simple ">
                <div class="grid-title">
                    <h4>Opciones <span class="semi-bold">adicionales</span></h4>
                    <div>
                        {{-- <button type="button" class="btn btn-info {{count($empresas) ? '' : 'hide'}}" id="exportar_empresas_excel"><i class="fa fa-download" aria-hidden="true"></i> Exportar empresas</button> --}}
                        <button type="button" class="btn btn-danger {{count($empresas) ? '' : 'hide'}}" id="eliminar_multiples_empresas"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar empresas</button>
                        
                        {{-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#importar-excel"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Importar empresas</button> --}}
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formulario_empresa" id="nuevo_empresa"><i class="fa fa-plus" aria-hidden="true"></i> Nueva empresa</button>
                    </div>
                    <div class="grid-body">
                        <div class="table-responsive" id="div_tabla_empresas">
                            @include('empresas.tabla')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('plugins/jquery-datatable/js/jquery.dataTables.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/datatables-responsive/js/datatables.responsive.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/datatables-responsive/js/lodash.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/tabs_accordian.js') }}"></script>
<script src="{{ asset('js/datatables.js') }}"></script>
<script src="{{ asset('js/empresasAjax.js') }}"></script>
<script src="{{ asset('js/validacionesEmpresas.js') }}"></script>
<script type="text/javascript">
/**
 *=============================================================================================================================================
 *=                                        Empiezan las funciones relacionadas a la tabla de empresas                                        =
 *=============================================================================================================================================
 */

$('#formulario_empresa').on('hidden.bs.modal', function (e) {
    $('#formulario_empresa div.form-group').removeClass('has-error');
    $('input.form-control, textarea.form-control').val('');
    $("#formulario_empresa input#oferta").prop('checked', false);
});

/*$('body').delegate('button#exportar_empresas_excel','click', function() {
    fecha_inicio = false;
    fecha_fin = false;
    window.location.href = "<?php echo url();?>/empresas/exportar_empresas/"+fecha_inicio+"/"+fecha_fin;
});*/

$('body').delegate('button#nuevo_empresa','click', function() {
    $('select.form-control').val(0);
    $('input.form-control').val('');
    $('div#logo_empresa').hide();
    $("h4#titulo_form_empresa").text('Nuevo empresa');
    $("form#form_empresa").get(0).setAttribute('action', '{{url('empresas/guardar')}}');
});

$('body').delegate('.editar_empresa','click', function() {
    $('input.form-control').val('');
    id = $(this).parent().siblings("td:nth-child(2)").text(),
    nombre = $(this).parent().siblings("td:nth-child(3)").text(),
    direccion = $(this).parent().siblings("td:nth-child(4)").text(),
    telefono = $(this).parent().siblings("td:nth-child(5)").text(),
    numero_int = $(this).parent().siblings("td:nth-child(6)").text(),
    numero_ext = $(this).parent().siblings("td:nth-child(7)").text(),
    codigo_postal = $(this).parent().siblings("td:nth-child(8)").text(),
    logo = $(this).parent().siblings("td:nth-child(9)").text(),
    token = $('#token').val();

    $("h4#titulo_form_empresa").text('Editar empresa');
    $("form#form_empresa").get(0).setAttribute('action', '{{url('empresas/editar')}}');
    $("#formulario_empresa input#id").val(id);
    $("#formulario_empresa input#nombre").val(nombre);
    $("#formulario_empresa textarea#direccion").val(direccion);
    $("#formulario_empresa input#telefono").val(telefono);
    $("#formulario_empresa input#numero_int").val(numero_int);
    $("#formulario_empresa input#numero_ext").val(numero_ext);
    $("#formulario_empresa input#codigo_postal").val(codigo_postal);

    $('div#logo_empresa').children().children().children().remove('img#logo_empresa');
    $('div#logo_empresa').children().children().append(
        "<img src='<?php echo asset('');?>/"+logo+"' class='img-responsive img-thumbnail' alt='Responsive image' id='logo_empresa'>"
    );
    $("div#logo_empresa").show();

    $('#formulario_empresa').modal();
});

$('body').delegate('#eliminar_multiples_empresas','click', function() {
    var checking = [];
    $("input.checkDelete").each(function() {
        if($(this).is(':checked')) {
            checking.push($(this).parent().parent().parent().attr('id'));
        }
    });
    if (checking.length > 0) {
        swal({
            title: "¿Realmente desea eliminar las <span style='color:#F8BB86'>" + checking.length + "</span> empresas seleccionadas?",
            text: "¡Esta acción no podrá deshacerse!",
            html: true,
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, continuar",
            showLoaderOnConfirm: true,
            allowEscapeKey: true,
            allowOutsideClick: true,
            closeOnConfirm: false
        },
        function() {
            var token = $("#token").val();
            eliminarMultiplesEmpresas(checking, token);
        });
    }
});

$('body').delegate('.eliminar_empresa','click', function() {
    var nombre = $(this).parent().siblings("td:nth-child(3)").text();
    var token = $("#token").val();
    var id = $(this).parent().parent().attr('id');

    swal({
        title: "¿Realmente desea eliminar la empresa <span style='color:#F8BB86'>" + nombre + "</span>?",
        text: "¡Cuidado!",
        html: true,
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, continuar",
        showLoaderOnConfirm: true,
        allowEscapeKey: true,
        allowOutsideClick: true,
        closeOnConfirm: false
    },
    function() {
        eliminarEmpresa(id,token);
    });
});

</script>
@endsection