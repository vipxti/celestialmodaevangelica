@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1><i class="fa fa-tags"></i>&nbsp;&nbsp;Vincular</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Integração</a></li>
                <li><a href="#">Bling</a></li>
                <li class="active">Vincular Categoria</li>
            </ol>
        </section>

        <section class="content">
            @include('partials.admin._alerts')
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Vincular Categoria</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <!-- ROW CATEGORIAS SISTEMA -->
                    <p>&nbsp;</p>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Escolha a categoria:</label>
                                    <select id="categorias" class="form-control">
                                        <option value=""></option>
                                        @foreach($categorias as $categoria)
                                            <option value="{{$categoria->cd_categoria}}">{{$categoria->nm_categoria}}</option>
                                        @endforeach

                                    </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Escolha a sub-categoria:</label>
                                    <select id="subcategorias" class="form-control">
                                    </select>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="form-group" style="padding-top: 25px;">
                                {{--<div class="btn-group">--}}
                                    <button id="busca_cat_bling" class="btn btn-primary">Buscar Categorias Bling</button>
                                {{--</div>--}}
                            </div>
                        </div>
                    </div>
                    <!-- .row -->

                    <!-- ROW SELECTS BLING -->
                    <p>&nbsp;</p>
                    <div class="row">
                        <div id="pai" class="col-md-4" style="display: none;">
                            <div class="form-group">
                                <label>Escolha a categoria do Bling:</label>
                                <select id="categorias_bling" class="form-control">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div id="filho1" class="col-md-4" style="display: none;">
                            <div class="form-group">
                                <label>Escolha a categoria do Bling:</label>
                                <select id="categorias_bling_filho_1" class="form-control">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div id="filho2" class="col-md-4" style="display: none;">
                            <div class="form-group">
                                <label>Escolha a categoria do Bling:</label>
                                <select id="categorias_bling_filho_2" class="form-control">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- .row -->

                    <!-- ROW SELECTS BLING -->
                    <p>&nbsp;</p>
                    <div class="row">
                        <div id="filho3" class="col-md-4" style="display: none;">
                            <div class="form-group">
                                <label>Escolha a categoria do Bling:</label>
                                <select id="categorias_bling_filho_3" class="form-control">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div id="filho4" class="col-md-4" style="display: none;">
                            <div class="form-group">
                                <label>Escolha a categoria do Bling:</label>
                                <select id="categorias_bling_filho_4" class="form-control">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div id="filho5" class="col-md-4" style="display: none;">
                            <div class="form-group">
                                <label>Escolha a categoria do Bling:</label>
                                <select id="categorias_bling_filho_5" class="form-control">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- .row -->

                    <p>&nbsp;</p>
                    <div class="row">
                        <div class="col-md-12">
                            {{--<div class="btn-group">--}}
                                <button id="btn_salvar_ligacao" type="button" class="btn btn-success" style="display: none;"><i class="fa fa-save"></i>&nbsp;&nbsp;Associar Categorias</button>
                            {{--</div>--}}
                        </div>
                    </div>

                </div>
                <!-- .box-body -->
            </div>
            <!-- .box-primary -->
        </section>
    </div>

    <script src="{{asset('js/admin/jquery.blockUI.js')}}"></script>
    <script src="{{asset('js/admin/sweetalert.min.js')}}"></script>
    <script>
        $(function(){
            $('#categorias').change(function(){
                var cdCategoria = $(this).val();
                if(cdCategoria != '')
                    buscaSubCategoria(cdCategoria);
                else
                    $('#subcategorias').empty();
            });

            function buscaSubCategoria(cdCategoria){
                $.ajax({
                    url: '{{ url('/admin/subcat') }}/' + cdCategoria,
                    type: 'GET',
                    success: function (data) {

                        $('#subcategorias').empty();

                        $.each(data.subcat, function(index, subcategoria) {

                            $('#subcategorias').append(`<option value="` + subcategoria.cd_sub_categoria + `">` + subcategoria.nm_sub_categoria + `</option>`);
                        });

                    }
                });
            }

            //======================================================================================================
            //BOTÃO PARA BUSCAR CATEGORIAS NO BLING
            $('#busca_cat_bling').click(function(){

                carregarCategoriasPaiBling();

            });

            //======================================================================================================
            //SELECT PARA BUSCAR CATEGORIAS NO BLING
            $('#categorias_bling').change(function(){
                console.log("categoria bling clicada");
                carregaCategoriasSelect($('#categorias_bling'), $('#categorias_bling_filho_1'), $('#filho1'));
            });

            $('#categorias_bling_filho_1').change(function(){
                carregaCategoriasSelect($('#categorias_bling_filho_1'), $('#categorias_bling_filho_2'), $('#filho2'));
            });

            $('#categorias_bling_filho_2').change(function(){
                carregaCategoriasSelect($('#categorias_bling_filho_2'), $('#categorias_bling_filho_3'), $('#filho3'));
            });

            $('#categorias_bling_filho_3').change(function(){
                carregaCategoriasSelect($('#categorias_bling_filho_3'), $('#categorias_bling_filho_4'), $('#filho4'));
            });

            $('#categorias_bling_filho_4').change(function(){
                carregaCategoriasSelect($('#categorias_bling_filho_4'), $('#categorias_bling_filho_5'), $('#filho5'));
            });

            //======================================================================================================
            //FUNÇÃO PARA CARREGAR OS SELECTS
            function carregaCategoriasSelect(selectpai, select, div){
                let flag = false;
                select.empty();
                var opcao = $('<option></option>');
                opcao.val(-1);
                select.append(opcao);
                console.log(selectpai.val());
                for(let i = 0; i<arrayCat.length; i++){

                    if(arrayCat[i].categoria.idCategoriaPai == selectpai.val()){
                        flag = true;
                        select.append(`<option value="` + arrayCat[i].categoria.id + `">` + arrayCat[i].categoria.descricao + `</option>`);

                    }
                }

                if(flag){
                    div.css("display", "block");
                }
                else{
                    div.css("display", "none");
                    select.val(-1).trigger("change");

                }
            }

            //======================================================================================================
            //FUNÇÃO QUE CARREGA AS CATEGORIAS PAI DO BLING NO PRIMEIRO SELECT
            var existeDadosEmpresa;
            var arrayCat = [];
            var objCategoria;
            function carregarCategoriasPaiBling(){
                console.log("oi");

                try{

                    $.ajax({
                        url: '{{route('verify.company.data')}}',
                        type: 'GET',
                        success: function(data){
                            existeDadosEmpresa = data.message;
                        }
                    }).done(function(){
                        if(existeDadosEmpresa){

                            $.ajax({
                                url: '{{route('category.api.bling')}}',
                                type: 'get',
                                success: function(data){
                                    objCategoria = JSON.parse(data);
                                    console.log(objCategoria);
                                }
                            })
                                .done(function(){
                                    try{
                                        for(var i = 0; i<objCategoria.retorno.categorias.length; i++){
                                            arrayCat.push(objCategoria.retorno.categorias[i]);
                                        }
                                    }
                                    catch(Exception){
                                        $.unblockUI();
                                        swal("Ops", "A Api Key é inválida.", "warning");
                                    }
                                })
                                .done(function(){
                                    console.log("oi bling");
                                    $('#categorias_bling').empty();
                                    var opcao = $('<option></option>');
                                    opcao.val(-1);
                                    $('#categorias_bling').append(opcao);

                                    if(arrayCat.length > 0) {
                                        for (let i = 0; i < arrayCat.length; i++) {
                                            console.log("=========================================================");
                                            console.log("Categorias ID: " + arrayCat[i].categoria.id);
                                            console.log("Categorias Descricao: " + arrayCat[i].categoria.descricao);
                                            console.log("Categorias ID Pai: " + arrayCat[i].categoria.idCategoriaPai);

                                            if (arrayCat[i].categoria.idCategoriaPai == 0) {

                                                $('#categorias_bling').append(`<option value="` + arrayCat[i].categoria.id + `">` + arrayCat[i].categoria.descricao + `</option>`);

                                            }
                                        }

                                        $("#pai").css("display", "block");
                                        $("#btn_salvar_ligacao").css("display", "block");

                                    }
                                    else{
                                        $("#pai").css("display", "none");
                                    }
                                });
                        }
                        //END IF
                        else{
                            swal("Ops", "Cadastre os dados da empresa antes de buscar produtos no Bling.", "warning");
                        }
                    });
                }
                catch(Exception){
                    swal("Erro", "Ocorreu um erro no processo de busca das categorias, tente novamente mais tarde.", "warning");
                }

            }

            //======================================================================================================
            //BOTÃO PARA SALVAR ASSOCIAÇÃO DAS CATEGORIAS DO SISTEMA COM AS DO BLING
            $("#btn_salvar_ligacao").click(function(){
                console.log("evento trigger");

                //console.log($("#subcategorias").val());
                if($('#subcategorias').val() != null && $('#categorias_bling').val() != -1){
                    console.log($("#subcategorias").val());
                    console.log($("#categorias_bling").val());
                }
            });

        });
    </script>
@stop