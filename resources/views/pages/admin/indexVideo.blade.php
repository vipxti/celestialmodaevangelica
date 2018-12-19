@extends('layouts.admin.app')

@section('content')
    <!-- ESTILO DO BOTÃO TRANSPARENTE NA TABLE -->
    <style type="text/css">
        /*deixar botão transparente*/
        button {
            background-color: Transparent;
            background-repeat:no-repeat;
            border: none;
            cursor:pointer;
            overflow: hidden;
            outline:none;
        }

        /*deixar setas do input do tipo number invisivel*/
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            cursor:pointer;
            display:block;
            width:8px;
            color: #333;
            text-align:center;
            position:relative;
        }
        input[type=number] {
            -moz-appearance: textfield;
            appearance: textfield;
            margin: 0;
        }
    </style>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1><i class="fa fa-picture-o"></i>&nbsp;&nbsp;Vídeo Principal</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Configuração Home</a></li>
                <li class="active">Vídeo</li>
            </ol>
        </section>

        <!-- BANNER 1 -->
        <section class="content">
            @include('partials.admin._alerts')
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Vídeo</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="box-body">
                    <form action="{{ route('save.video') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Titulo</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                                        <input type="text" maxlength="40" class="form-control" name="titulo_video">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-7">
                                <div class="form-group">
                                    <label>URL</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-link"></i></span>
                                        <input type="text" maxlength="100" class="form-control" name="url_video">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>


        <!-- LISTA DE BANNERS -->

        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Lista de Vídeos</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="box-body">

                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table id="table" class="table table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Titulo</th>
                                    <th>Url</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($video as $v)
                                    <tr>
                                        <td>{{$v->id_video}}</td>
                                        <td>{{$v->titulo_video}}</td>
                                        <td>{{$v->url_video}}</td>
                                        <td class="pull-right">
                                            <button id="btn_editar" title="Editar Vídeo"
                                                    class="fa fa-pencil btn btn-outline-warning"
                                                    data-toggle="modal" data-target="#modal-default" style="color: #367fa9">
                                            </button>
                                            <button id="btn_excluir"
                                                    value="{{$v->id_video}}"
                                                    title="Deletar Vídeo"
                                                    class="btn btn-outline-warning"
                                                    style="color: #cc0000">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- MODAL ATUALIZA VIDEO -->
        <form action="{{route('update.video')}}" method="post" enctype="multipart/form-data">

            <div class="modal fade" id="modal-default">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Atualizar Vídeo</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-md-12">

                                    {{ csrf_field() }}

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>ID Vídeo:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                    <input id="id_modal" type="text" class="form-control" name="id_video" readonly required maxlength="45">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Titulo Vídeo:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                                                    <input id="titulo_modal" type="text" class="form-control" name="titulo_video" required maxlength="40">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Url Vídeo:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-link"></i></span>
                                                    <input id="url_modal" type="text" class="form-control" name="url_video" maxlength="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="btnSairModal" type="button" class="btn btn-default pull-left" data-dismiss="modal">Sair</button>
                            <button id="btnUpdateProd" type="submit" class="btn btn-primary">Salvar Alterações</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        </form>
        <!-- FIM MODAL BANNER -->

    </div>
    <script>
        $(function(){
            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $('button#btn_editar').click(function(){
                let campoTR = $(this).parent().parent();
                let id = campoTR.find('td:first').text();
                let titulo = campoTR.find('td:eq(1)').text();
                let url = campoTR.find('td:eq(2)').text();

                if(url === "-")
                    url = "";

                $('#id_modal').val(id);
                $('#titulo_modal').val(titulo);
                $('#url_modal').val(url);
            });

            $('button#btn_excluir').click(function(){
                let id_banner = $(this).val();
                let campoTR = $(this).parent().parent();

                swal({
                    title: "Você tem certeza que deseja deletar ?",
                    text: "Uma vez deletada, você não terá mais acesso a esse vídeo.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((vaiApagar) => {
                        if(vaiApagar){

                            $.ajax({
                                url: '{{url('admin/delete/video/')}}/' + id_banner,
                                type: 'post',
                                data: {_token: CSRF_TOKEN},
                                success: function(data){
                                    if(data.deuErro == false){
                                        campoTR.fadeOut(500, function () {
                                            $(this).remove();

                                            swal("Vídeo deletado com sucesso!", {
                                                icon: "success",
                                            });
                                        });
                                    }
                                    else{
                                        swal("Erro ao deletar o vídeo.", {
                                            icon: "error",
                                        });
                                    }
                                }
                            });
                        }
                    });
            });
        });
    </script>
@stop
