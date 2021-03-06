@extends('layouts.admin.app')

@section('content')

    <style>
        /* Estilo iOS */

        .switch {
            visibility: hidden;
            position: absolute;
            margin-left: -9999px;

        }

        .switch + label {
            display: block;
            position: relative;
            cursor: pointer;
            outline: none;
            user-select: none;
        }

        .switch--shadow + label {
            padding: 2px;
            width: 45px;
            height: 20px;
            background-color: #dddddd;
            border-radius: 60px;
        }
        .switch--shadow + label:before,
        .switch--shadow + label:after {
            display: block;
            position: absolute;
            top: 1px;
            left: 1px;
            bottom: 1px;
            content: "";
        }
        .switch--shadow + label:before {
            right: 1px;
            background-color: #f1f1f1;
            border-radius: 60px;
            transition: background 0.4s;
        }
        .switch--shadow + label:after {
            width: 18px;
            background-color: #fff;
            border-radius: 100%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            transition: all 0.4s;
        }
        .switch--shadow:checked + label:before {
            background-color: #8ce196;
        }
        .switch--shadow:checked + label:after {
            transform: translateX(26px);
        }

        /* Estilo Flat */
        .switch--flat + label {
            padding: 2px;
            width: 120px;
            height: 60px;
            background-color: #dddddd;
            border-radius: 60px;
            transition: background 0.4s;
        }
        .switch--flat + label:before,
        .switch--flat + label:after {
            display: block;
            position: absolute;
            content: "";
        }
        .switch--flat + label:before {
            top: 2px;
            left: 2px;
            bottom: 2px;
            right: 2px;
            background-color: #fff;
            border-radius: 60px;
            transition: background 0.4s;
        }
        .switch--flat + label:after {
            top: 4px;
            left: 4px;
            bottom: 4px;
            width: 56px;
            background-color: #dddddd;
            border-radius: 52px;
            transition: margin 0.4s, background 0.4s;
        }
        .switch--flat:checked + label {
            background-color: #8ce196;
        }
        .switch--flat:checked + label:after {
            margin-left: 60px;
            background-color: #8ce196;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/admin/btInterativo.css') }}">

    <div class="content-wrapper">
        <section class="content-header">
            <h1><i class="fa fa-search"></i>&nbsp;&nbsp;Buscar Produtos Bling</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Integração</a></li>
                <li class="active">Buscar Produtos</li>
            </ol>
        </section>

        <section class="content">

        @include('partials.admin._alerts')

        <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Produtos Bling</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <!-- <p>Da página</p>
                    <input type="text" id="pagInicial" required>
                    <p>Até a página</p>
                    <input type="text" id="pagFinal" required>
                    <p></p> -->

                    <p></p>
                    <div id="botoesBling">
                        <button id="btnBuscaProd" type="button" class="btn btn-primary">Buscar Produtos</button>
                        {{--<button id="btnEstoque" type="button" class="btn btn-primary">ESTOQUE</button>--}}

                        <!-- <button id="btnCategoria" type="button" class="btn btn-info">Buscar Categorias</button> -->
                        {{--<button id="btnTeste" type="button" class="btn btn-info">Buscar Sku</button>--}}

                    </div>
                    {{--<button id="btn_teste" type="button" class="btn btn-warning">CATEGORIAS BLING</button>--}}
                    <p></p>


                    <div class="row">
                        <div class="col-md-4 pull-left paragrafoPag" hidden>
                            <label>Pesquise produto por SKU:</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <input id="inputPesqSku" type="text" class="form-control">
                                    <span class="input-group-addon" title="Pesquisar SKU">
                                        <a id="btnPesqSku" href="javascript:void(0)">
                                            <i class="fa fa-search"></i>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 pull-right paragrafoPag" hidden>
                            <label>Escolha a página que você deseja:</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <input id="inputEscolhaPag" type="text" class="form-control">
                                    <span class="input-group-addon" title="Pesquisar Página">
                                        <a id="btnEscolhaPag" href="javascript:void(0)">
                                            <i class="fa fa-search"></i>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row paragrafoPag" hidden>
                        <div class="col-md-12">
                            {{--<button id="btnPagAnt" type="button" class="btn btn-success btnPaginacao pull-right" style="display: none;">Página Anterior</button>--}}
                            <p class="paragrafoPag text-center" hidden>
                                <a id="btnPagAnt" href="javascript:void(0)" title="Página Anterior">
                                    <span class="fa fa-chevron-circle-left" style="font-size: 17px;"></span>
                                </a>
                                &nbsp;
                                Página <span id="spanNumPag"></span>
                                &nbsp;
                                {{--<button id="btnProxPag" type="button" class="btn btn-success btnPaginacao" style="display: none;">Próxima Página</button>--}}
                                <a id="btnProxPag" href="javascript:void(0)" title="Próxima Página">
                                    <span class="fa fa-chevron-circle-right" style="font-size: 17px;"></span>
                                </a>
                            </p>
                        </div>
                    </div>

                    <label id="texto_informativo" hidden style="font-size: 12px;"><i style="color: red !important;">*</i>&nbsp;OS PRODUTOS QUE POSSUEM A SITUAÇÃO DESABILITADA É PORQUE UM DOS CAMPOS NECESSÁRIOS PARA SALVAR O PRODUTO NÃO FOI PREENCHIDO CORRETAMENTE NO BLING</label>


                    <!-- Tabelas dos produtos -->

                    <div class="table-responsive">
                        <table class="table" id="table">
                            <thead>
                            <tr id="indexProd">

                            </tr>
                            </thead>
                            <tbody id="resultProd">

                            </tbody>
                        </table>
                    </div>
                    <table id="tabelaEscondida" hidden class="table">
                        <thead class="table-bordered">
                        <tr id="indexProdHidden">

                        </tr>
                        </thead>
                        <tbody id="resultProdHidden" class="table-bordered">

                        </tbody>
                    </table>

                    <p>&nbsp;</p>
                    <div class="row">
                        <div class="col-md-12">
                            <button id="btnSalvarProds"
                                    type="button"
                                    class="btn btn-success pull-right"
                                    style="display: none;">
                                <i class="fa fa-save"></i>
                                &nbsp;&nbsp;Salvar Produtos
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="{{asset('js/admin/jquery.cookie.js')}}"></script>
    <script src="{{asset('js/admin/jquery.blockUI.js')}}"></script>
    <script src="{{asset('js/admin/sweetalert.min.js')}}"></script>
    {{--<script src="{{asset('js/admin/integracaoBling.js')}}"></script>--}}
    <script>

        $(document).ready(function(){
            var arrayCat = [];
            var arrayCatLoja = [];

            $('#btnEstoque').click(function(){
                console.log('oi');
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                let retorno = "{\"retorno\":{\"estoques\":[{\"estoque\":{\"codigo\":\"\",\"nome\":\"MASCARA PARA CILIOS DAILUS MAXXI VOLUME DEFINICAO\",\"estoqueAtual\":17,\"depositos\":[{\"deposito\":{\"id\":2075676542,\"nome\":\"Geral - Central Antigo\",\"saldo\":\"5.0000\",\"desconsiderar\":\"N\"}},{\"deposito\":{\"id\":2669259478,\"nome\":\"Dep\u00f3sito - Seguran\u00e7a - Online\",\"saldo\":\"5.0000\",\"desconsiderar\":\"N\"}},{\"deposito\":{\"id\":2825607178,\"nome\":\"Dep\u00f3sito - Loja F\u00edsica\",\"saldo\":\"7.0000\",\"desconsiderar\":\"N\"}},{\"deposito\":{\"id\":2961874450,\"nome\":\"Dep\u00f3sito - Estrat\u00e9gico\",\"saldo\":0,\"desconsiderar\":\"N\"}},{\"deposito\":{\"id\":3035110690,\"nome\":\"Dep\u00f3sito - Sal\u00e3o\",\"saldo\":0,\"desconsiderar\":\"N\"}},{\"deposito\":{\"id\":3140489452,\"nome\":\"Dep\u00f3sito - Alessandra\",\"saldo\":0,\"desconsiderar\":\"N\"}},{\"deposito\":{\"id\":3418509655,\"nome\":\"Dep\u00f3sito - Cuecas\",\"saldo\":0,\"desconsiderar\":\"N\"}}]}}]}}";

                //retorno = JSON.stringify(retorno);

                $.ajax({
                    url: '{{route("bling.estoque")}}',
                    type: 'post',
                    data: {_token: CSRF_TOKEN, retorno: retorno},
                    success: function(data){
                        console.log(data.deuErro);
                    }
                });
            });

            //=====================================================================================================
            //BOTÃO PARA BUSCAR TODAS AS CATEGORIAS CADASTRADAS NO BLING

            var objCategoria = null;
            var objCatLoja = null;
            var existeDadosEmpresa = false;
            $('#btnCategoria').click(function(){
                try{

                    $.ajax({
                        url: '{{route('verify.company.data')}}',
                        type: 'GET',
                        success: function(data){
                            existeDadosEmpresa = data.message;
                        }
                    }).done(function(){
                        if(existeDadosEmpresa){
                            $(this).attr('disabled', 'disabled');

                            $.blockUI({
                                message: 'Carregando...',
                                css: {
                                    border: 'none',
                                    padding: '15px',
                                    backgroundColor: '#000',
                                    '-webkit-border-radius': '10px',
                                    '-moz-border-radius': '10px',
                                    opacity: .5,
                                    color: '#fff'
                                }
                            });

                            $.ajax({
                                url: '{{route('category.api.bling')}}',
                                type: 'get',
                                //url: 'blingCategoria.php',
                                //type: 'post',
                                success: function(data){
                                    objCategoria = JSON.parse(data);
                                    //console.log(objCategoria);
                                }
                            })
                                .done(function(){

                                    try{
                                        for(var i = 0; i<objCategoria.retorno.categorias.length; i++){
                                            arrayCat.push(objCategoria.retorno.categorias[i]);
                                        }

                                        $('#btnArrayCat').removeAttr('disabled');
                                        ajaxCategoriaLoja();
                                    }
                                    catch(Exception){
                                        $.unblockUI();
                                        swal("Ops", "A Api Key é inválida.", "warning");
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

            });

            //=====================================================================================================
            //FUNÇÃO PARA BUSCAR AS CATEGORIAS DA LOJA

            $('#buscaCategorias').click(function(){

                for(let i = 0; i<arrayCat.length; i++){
                    //console.log("CATEGORIA BLING: " + arrayCat[i].categoria.id);
                    //console.log("DESCRIÇÃO CATEGORIA BLING: " + arrayCat[i].categoria.descricao);
                }

                //console.log('=============================================================');

                for(var i=0; i<arrayCatLoja.length; i++){
                    //console.log("CATEGORIA LOJA: " + arrayCatLoja[i].categoria.idCategoria);
                    //console.log("DESCRIÇÃO CATEGORIA LOJA: " + arrayCatLoja[i].categoria.descricaoVinculo);
                }

            });

            function ajaxCategoriaLoja(){
                $.ajax({
                    url: '{{route('storeCategory.api.bling')}}',
                    type: 'get',
                    success: function(data){
                        objCatLoja = JSON.parse(data);
                    }
                })
                    .done(function(){

                        for(var i = 0; i < objCatLoja.retorno.categoriasLoja.length; i++){
                            arrayCatLoja.push(objCatLoja.retorno.categoriasLoja[i]);
                        }

                        //$('#btnCategoria').removeAttr('disabled');
                        $('#btnBuscaProd').removeAttr('disabled');
                        //$.unblockUI();
                        buscaProdutos(proxPag);
                    });
            }

            function ajaxCategoriaBling(){
                try{

                    $.ajax({
                        url: '{{route('verify.company.data')}}',
                        type: 'GET',
                        success: function(data){
                            existeDadosEmpresa = data.message;
                        }
                    }).done(function(){
                        if(existeDadosEmpresa){
                            $(this).attr('disabled', 'disabled');

                            $.blockUI({
                                message: 'Carregando...',
                                css: {
                                    border: 'none',
                                    padding: '15px',
                                    backgroundColor: '#000',
                                    '-webkit-border-radius': '10px',
                                    '-moz-border-radius': '10px',
                                    opacity: .5,
                                    color: '#fff'
                                }
                            });

                            $.ajax({
                                url: '{{route('category.api.bling')}}',
                                type: 'get',
                                //url: 'blingCategoria.php',
                                //type: 'post',
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

                                        $('#btnArrayCat').removeAttr('disabled');
                                        //ajaxCategoriaLoja();
                                        consultaAssocCatSistBling();
                                    }
                                    catch(Exception){
                                        $.unblockUI();
                                        swal("Ops", "A Api Key é inválida.", "warning");
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

            //=====================================================================================================
            //BOTÃO BUSCAR PRODUTOS DA PAGINA ANTERIOR
            $('#btnPagAnt').click(function(){

                if(proxPag > 1)
                {
                    entrouEach = false;
                    $('#resultProd tr').remove();
                    $('#resultProdHidden tr').remove();
                    $('#indexProd td').remove();
                    $('#indexProdHidden td').remove();

                    $.blockUI({
                        message: 'Carregando...',
                        css: {
                            border: 'none',
                            padding: '15px',
                            backgroundColor: '#000',
                            '-webkit-border-radius': '10px',
                            '-moz-border-radius': '10px',
                            opacity: .5,
                            color: '#fff'
                        }
                    });

                    proxPag--;
                    buscaProdutos(proxPag);
                }
                else{
                    swal("Ops", "Você já está na primeira página.", "info");
                }

            });

            //=====================================================================================================
            //BOTÃO BUSCAR PRODUTOS DA PROXIMA PAGINA
            $('#btnProxPag').click(function(){

                entrouEach = false;
                $('#resultProd tr').remove();
                $('#resultProdHidden tr').remove();
                $('#indexProd td').remove();
                $('#indexProdHidden td').remove();

                $.blockUI({
                    message: 'Carregando...',
                    css: {
                        border: 'none',
                        padding: '15px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .5,
                        color: '#fff'
                    }
                });

                proxPag++;
                buscaProdutos(proxPag);
            });

            //=====================================================================================================
            //BOTÃO BUSCAR PRODUTOS POR PÁGINA ESCOLHIDA
            $('#btnEscolhaPag').click(function(){
                if($('#inputEscolhaPag').val() > 0){
                    entrouEach = false;
                    $('#resultProd tr').remove();
                    $('#resultProdHidden tr').remove();
                    $('#indexProd td').remove();
                    $('#indexProdHidden td').remove();

                    $.blockUI({
                        message: 'Carregando...',
                        css: {
                            border: 'none',
                            padding: '15px',
                            backgroundColor: '#000',
                            '-webkit-border-radius': '10px',
                            '-moz-border-radius': '10px',
                            opacity: .5,
                            color: '#fff'
                        }
                    });

                    proxPag = $('#inputEscolhaPag').val();
                    buscaProdutos(proxPag);
                }
                else{
                    swal("Ops", "Escolha uma página válida", "info");
                }
            });

            //=====================================================================================================
            //BOTÃO BUSCAR PRODUTO POR SKU
            $('#btnPesqSku').click(function(){
                //console.log($('#inputPesqSku').val());
                if($('#inputPesqSku').val().length > 0) {
                    entrouEach = false;
                    $('#resultProd tr').remove();
                    $('#resultProdHidden tr').remove();
                    $('#indexProd td').remove();
                    $('#indexProdHidden td').remove();

                    $.blockUI({
                        message: 'Carregando...',
                        css: {
                            border: 'none',
                            padding: '15px',
                            backgroundColor: '#000',
                            '-webkit-border-radius': '10px',
                            '-moz-border-radius': '10px',
                            opacity: .5,
                            color: '#fff'
                        }
                    });

                    buscaProdutosNome($('#inputPesqSku').val());
                }
                else{
                    swal('Ops', 'Campo vazio.', 'info');
                }
            });

            //=====================================================================================================
            //BOTÃO BUSCAR PRODUTOS
            var proxPag = 1;
            var primeiraBusca = false;
            $('#btnBuscaProd').on("click", function(){
                swal({
                    title: "Você tem certeza?",
                    text: "Este pode ser um processo demorado e durar alguns minutos.",
                    icon: "info",
                    buttons: true,
                })
                    .then((vaiBuscar) => {
                        if (vaiBuscar) {
                            $.blockUI({
                                message: 'Carregando...',
                                css: {
                                    border: 'none',
                                    padding: '15px',
                                    backgroundColor: '#000',
                                    '-webkit-border-radius': '10px',
                                    '-moz-border-radius': '10px',
                                    opacity: .5,
                                    color: '#fff'
                                }
                            });

                            try{
                                $(this).attr('disabled', 'disabled');
                                if(!primeiraBusca){
                                    ajaxCategoriaBling();
                                    //primeiraBusca = true;
                                }else{
                                    buscaProdutos(proxPag);
                                }

                            }
                            catch(Exception){
                                $.unblockUI();
                                swal("Erro", "Ocorreu um erro no processo de busca dos produtos, tente novamente mais tarde.", "warning");
                            }

                        }
                    });
            });

            $('#btnSalvarProds').click(function(){
                //console.log("oi");

                $.blockUI({
                    message: 'Carregando...',
                    css: {
                        border: 'none',
                        padding: '15px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .5,
                        color: '#fff'
                    }
                });

                try{
                    colunaProdutos(0);
                }
                catch(Exception){
                    $.unblockUI();
                    swal("Erro", "Ocorreu um erro no processo de salvamento, tente novamente mais tarde.", "warning");
                }
            });

            //=====================================================================================================
            //FUNÇÃO PARA BUSCAR OS PRODUTOS

            var deuErro = false;
            var entrouEach = false;
            var contador = 0;
            var contadorSituacao = 0;
            var arrayNames = ['cd_sku',
                'nm_produto',
                'vl_produto',
                'ds_produto',
                'marca',
                'ds_peso',
                'cd_ean',
                'ds_largura',
                'ds_altura',
                'ds_profundidade',
                'cd_categoria',
                'nm_categoria',
                'cd_sub_categoria',
                'nm_sub_categoria',
                'qt_produto',
                'ic_ativo'];
            var arrayImagens = [];
            var imagens = [];
            var arrayDesc = [];
            var descricao = [];
            var arraySku = [];
            var tamanhoCategoria = 0;

            function buscaProdutos(pag){
                //if(!deuErro){
                var page = 'page=' + pag;
                arrayImagens = [];
                arrayDesc = [];
                tamanhoCategoria = 0;
                console.log("****************PAGINA " + proxPag + "****************");

                $.ajax({
                    url: '{{url('/admin/api/bling')}}/' + page,
                    type: 'get',
                    success: function(data){
                        try{
                            var objProd = JSON.parse(data);
                            //console.log(objProd);


                            for(var i = 0; i < objProd.retorno.produtos.length; i++){
                                contador++;
                                var arrayHead = [];
                                var arrayBody = [];
                                imagens = [];
                                descricao = [];
                                arrayCategoriasProduto = [];
                                arrayCatAtt = [];
                                var temCategoria = false;
                                var trBody = "<tr id='trProd" + contador + "'></tr>";
                                var trBodyHidden = "<tr id='trProdHidden" + contador + "'></tr>";
                                $('#resultProd').append(trBody);
                                $('#resultProdHidden').append(trBodyHidden);

                                console.log("PAGINA " + proxPag + " - PRODUTO " + i);
                                $.each(objProd.retorno.produtos[i].produto, function(index, resultado){

                                    if(index == "codigo" && resultado == ""){
                                        return false;
                                    }

                                    if(index == "codigo" || index == "descricao" || index == "situacao" ||
                                        index == "preco" || index == "descricaoCurta" || index == "pesoBruto" ||
                                        index == "gtin" || index == "larguraProduto" || index == "alturaProduto" ||
                                        index == "profundidadeProduto" || index == "imagem" || index == "estoqueAtual" ||
                                        index == "produtoLoja" || index == "marca"){

                                        if(index == "produtoLoja"){
                                            var categoriaProd = objProd.retorno.produtos[i].produto.produtoLoja.categoria;
                                            var categoriaBling = null;
                                            var pai = 0;
                                            var paiDesc = null;

                                            /*$.each(categoriaProd[categoriaProd.length - 1], function(categoria, respCat){

                                                if(categoria == "id"){
                                                    console.log(categoria + ": " + respCat);
                                                    categoriaBling = verificaCategoria(respCat);
                                                } else if (categoria == "idCategoriaPai" && respCat != "0"){
                                                    pai = verificaCategoria(respCat);
                                                    //console.log("*" + pai.descricaoVinculo);
                                                    paiDesc = pai.descricaoVinculo;
                                                    pai = pai.idVinculoLoja;
                                                }

                                                if(categoria == "descricao"){
                                                    arrayHead.push(categoria + "Cat");
                                                }else{
                                                    arrayHead.push(categoria);
                                                }

                                                //arrayBody.push(respCat);
                                                temCategoria = true;
                                            });*/

                                            console.log("categoria do produto: ");
                                            console.log(categoriaProd);
                                            for(let i = tamanhoCategoria; i < categoriaProd.length; i++){
                                                comparaCategorias(categoriaProd[i]);
                                            }

                                            //tamanhoCategoria = categoriaProd.length;

                                            console.log(arrayCategoriasSistema);
                                            console.log(arrayCategoriasProduto);
                                            for(let i = 0; i < arrayCategoriasSistema[0].length; i++){
                                                console.log(arrayCategoriasSistema[0][i]);
                                                if(arrayCategoriasProduto.length != 0) {
                                                    if (arrayCategoriasProduto[(arrayCategoriasProduto.length - 1)].id == arrayCategoriasSistema[0][i].id_categoria) {
                                                        arrayCatAtt.push(arrayCategoriasSistema[0][i]);
                                                    }
                                                    temCategoria = true;
                                                }
                                            }



                                            arrayHead.push("id");
                                            arrayHead.push("descricaoCat");
                                            arrayHead.push("idCategoriaPai");
                                            arrayHead.push("descCatPai");
                                            try{
                                                arrayBody.push(arrayCatAtt[0].cd_sub_categoria);
                                                arrayBody.push(arrayCatAtt[0].nm_sub_categoria);
                                                arrayBody.push(arrayCatAtt[0].cd_categoria);
                                                arrayBody.push(arrayCatAtt[0].nm_categoria);
                                            }
                                            catch(ex){

                                                arrayBody.push("não associado");
                                                arrayBody.push("não associado");
                                                arrayBody.push("não associado");
                                                arrayBody.push("não associado");
                                            }

                                            /*arrayBody.push(categoriaBling.idVinculoLoja);
                                            arrayBody.push(categoriaBling.descricaoVinculo);
                                            arrayBody.push(pai);
                                            arrayBody.push(paiDesc);*/
                                        }
                                        else if(index == "imagem"){
                                            arrayHead.push(index);
                                            if(resultado == ""){
                                                arrayBody.push("");
                                            }else{

                                                var linkFinal = null;

                                                for(var j = 0; j < index.length; j++){
                                                    $.each(objProd.retorno.produtos[i].produto.imagem[j], function(img, link){
                                                        if(img == "link"){
                                                            linkFinal = link;
                                                            imagens.push(link);

                                                        }
                                                    });
                                                }

                                                arrayBody.push(linkFinal);
                                            }
                                        }
                                        else if(index == "descricaoCurta"){
                                            arrayHead.push(index);
                                            arrayBody.push(resultado);
                                            //console.log("INDEX RESULTADO: " + resultado);
                                            descricao.push(resultado);
                                        }
                                        else if(index == "pesoBruto"){
                                            arrayHead.push(index);
                                            var pesoEmGramas = resultado * 1000;
                                            arrayBody.push(pesoEmGramas);
                                        }
                                        else{
                                            arrayHead.push(index);
                                            arrayBody.push(resultado);
                                        }

                                    }

                                });

                                //console.log(arrayHead.length);
                                /* for(var j = 0; j < arrayHead.length; j++){

                                    console.log(arrayHead[j] + " : " + arrayBody[j]);

                                } */

                                console.log("============================================");

                                if(temCategoria){

                                    if(!entrouEach){

                                        for(var iH = 0; iH<arrayHead.length; iH++){
                                            if(arrayHead[iH]!="situacao"){
                                                var campoHead = "<td>" + arrayHead[iH] + "</td>";
                                                $('#indexProdHidden').append(campoHead);
                                            }

                                            if(arrayHead[iH]=="codigo" || arrayHead[iH]=="descricao" ||
                                                arrayHead[iH]=="tipo" || arrayHead[iH]=="preco" || arrayHead[iH]=="gtin" ||
                                                arrayHead[iH]=="descricaoCat" || arrayHead[iH]=="descCatPai" ||
                                                arrayHead[iH]=="estoqueAtual"){
                                                var campoHead = "<td>" + arrayHead[iH] + "</td>";
                                                $('#indexProd').append(campoHead);
                                            }
                                        }

                                        var campoHead = "<td>situacao</td>";
                                        $('#indexProd').append(campoHead);
                                        $('#indexProdHidden').append(campoHead);
                                        entrouEach = true;
                                    }

                                    var valor = 0;
                                    var checkado = "";
                                    var semCatPai = false;
                                    var temDisabled = "";
                                    var produto_ativavel = "";
                                    for(var iB = 0; iB<arrayBody.length; iB++){
                                        if(arrayHead[iB]!="situacao"){
                                            if(arrayHead[iB]=="imagem"){
                                                console.log(arrayBody[1] + " : " + arrayBody[iB]);

                                                var urls = "";

                                                for(var img = 0; img < imagens.length; img++){
                                                    urls= urls + " " + imagens[img];
                                                }
                                                arrayImagens.push(urls);
                                                var tBody = "<td>" + urls + "</td>";
                                                $('#trProdHidden' + contador).append(tBody);

                                            }
                                            else if(arrayHead[iB] == "descricaoCurta"){

                                                if(descricao[0] != null){
                                                    /*var novaDesc = descricao[0].replace(/<p>/gi, "");
                                                    novaDesc = novaDesc.replace(/<\/p>/gi, "\n");*/
                                                    /*novaDesc = novaDesc.replace(/<strong>/gi, "");
                                                    novaDesc = novaDesc.replace(/<\/strong>/gi, "");*/

                                                    let novaDesc = "";
                                                    let descAntiga = descricao[0];
                                                    let tag = false;
                                                    for(let sbs = 0; sbs < descAntiga.length; sbs++){
                                                        if(!tag){
                                                            if(descAntiga.substr(sbs, 1) == "<")
                                                                tag = true;
                                                            else
                                                                novaDesc = novaDesc + descAntiga.substr(sbs,1);
                                                        }
                                                        else if(descAntiga.substr(sbs, 1) == ">")
                                                            tag = false;
                                                    }

                                                    arrayDesc.push(novaDesc);
                                                    console.log("DESCRIÇÃO: " + novaDesc);
                                                    //arrayDesc.push(descricao[0]);
                                                }
                                                else{
                                                    arrayDesc.push(descricao[0]);
                                                }

                                                var tBody = "<td>" + arrayBody[iB] + "</td>";
                                                $('#trProdHidden' + contador).append(tBody);
                                            }
                                            else{
                                                var tBody = "<td>" + arrayBody[iB] + "</td>";
                                                $('#trProdHidden' + contador).append(tBody);
                                            }
                                            /*var tBody = "<td>" + arrayBody[iB] + "</td>";
                                            $('#trProdHidden' + contador).append(tBody);
                                            if(arrayHead[iB] == "imagem"){
                                                arrayImagens.push(arrayBody[iB]);
                                            }*/
                                        }

                                        if((arrayHead[iB] == "idCategoriaPai" && arrayBody[iB] == "0") ||
                                            (arrayHead[iB] == "larguraProduto" && arrayBody[iB] == "null") ||
                                            (arrayHead[iB] == "alturaProduto" && arrayBody[iB] == "null") ||
                                            (arrayHead[iB] == "profundidadeProduto" && arrayBody[iB] == "null") ||
                                            (arrayHead[iB] == "imagem" && arrayBody[iB] == "") ||
                                            (arrayHead[iB] == "descricaoCurta" && arrayBody[iB] == "null") ||
                                            (arrayHead[iB] == "descricaoCurta" && arrayBody[iB] == "") ||
                                            (arrayHead[iB] == "estoqueAtual" && arrayBody[iB] <= 0) ||
                                            (arrayHead[iB] == "pesoBruto" && arrayBody[iB] == "0.000") ||
                                            (arrayHead[iB] == "descricaoCat" && arrayBody[iB] == "não associado") ||
                                            (arrayHead[iB] == "marca" && arrayBody[iB] == ""))
                                        {
                                            semCatPai = true;
                                            temDisabled = "disabled";
                                            $('#trProd'+ contador).css('color', 'red');
                                        }


                                        if(arrayHead[iB]=="codigo" || arrayHead[iB]=="descricao" ||
                                            arrayHead[iB]=="tipo" || arrayHead[iB]=="preco" || arrayHead[iB]=="gtin" ||
                                            arrayHead[iB]=="descricaoCat" || arrayHead[iB]=="descCatPai" ||
                                            arrayHead[iB]=="estoqueAtual" || arrayHead[iB]=="situacao" ){
                                            if(arrayHead[iB]=="situacao"){

                                                if(arrayBody[iB] == "Ativo"){
                                                    valor = 1;
                                                    checkado = "checked";
                                                }

                                            }
                                            else{
                                                var tBody = "<td>" + arrayBody[iB] + "</td>";
                                                $('#trProd' + contador).append(tBody);
                                            }

                                        }
                                    }

                                    if(semCatPai){
                                        checkado = "";
                                        valor = 0;
                                    }else{
                                        produto_ativavel = "produto_ativavel";
                                        //$('#trProd'+contador).addClass('checkado');
                                        //$('#trProdHidden'+contador).addClass('checkado');
                                    }

                                    var tBody = "<td><div class='switch__container pull-left'><input " + temDisabled + " id='switch" + contadorSituacao + "' class='switch switch--shadow " + produto_ativavel + " novos_produtos' value='0' type='checkbox' ><label for='switch" + contadorSituacao + "'></label></div></td>";
                                    $('#trProd' + contador).append(tBody);
                                    var tBodyHidden = "<td><div class='switch__container pull-left'><input " + temDisabled + " id='switch" + contadorSituacao + "hidden' class='switch switch--shadow' value='0' type='checkbox'><label for='switch" + contadorSituacao + "'></label></div></td>";
                                    $('#trProdHidden' + contador).append(tBodyHidden);
                                    contadorSituacao++;
                                }
                                else{
                                    $('#trProd'+contador).remove();
                                    $('#trProdHidden'+contador).remove();
                                }
                            }
                        }catch(err){
                            console.log(err);
                            var objProd = JSON.parse(data);

                            if(objProd.retorno.erros[0].erro.cod == 14){
                                swal("Ops", "Esta página não existe.", "info");
                                proxPag--;
                            }

                            deuErro = true;
                        }
                    },
                    error: function(){
                        $.unblockUI();
                        swal("Erro", "Ocorreu um erro no processo de busca dos produtos, tente novamente mais tarde.", "warning");
                    }
                })
                    .done(function(){
                        contador = 0;
                        contadorSituacao = 0;
                        $('#btnBusca').removeAttr('disabled');
                        //cor branco
                        $("table tbody tr:odd").css("background-color", "#fff");
                        //cor cinza
                        $("table tbody tr:even").css("background-color", "#f5f5f5");

                        verificaSkuColunas(0);
                    });
                //}
            }

            function buscaProdutosNome(codigo){
                //if(!deuErro){

                arrayImagens = [];
                arrayDesc = [];
                tamanhoCategoria = 0;
                console.log("****************PAGINA " + proxPag + "****************");

                $.ajax({
                    url: '{{url('/admin/api/bling/codigo')}}/' + codigo,
                    type: 'get',
                    success: function(data){
                        try{
                            var objProd = JSON.parse(data);
                            //console.log(objProd);


                            for(var i = 0; i < objProd.retorno.produtos.length; i++){
                                contador++;
                                var arrayHead = [];
                                var arrayBody = [];
                                imagens = [];
                                descricao = [];
                                arrayCategoriasProduto = [];
                                arrayCatAtt = [];
                                var temCategoria = false;
                                var trBody = "<tr id='trProd" + contador + "'></tr>";
                                var trBodyHidden = "<tr id='trProdHidden" + contador + "'></tr>";
                                $('#resultProd').append(trBody);
                                $('#resultProdHidden').append(trBodyHidden);

                                console.log("PAGINA " + proxPag + " - PRODUTO " + i);
                                $.each(objProd.retorno.produtos[i].produto, function(index, resultado){

                                    if(index == "codigo" && resultado == ""){
                                        return false;
                                    }

                                    if(index == "codigo" || index == "descricao" || index == "situacao" ||
                                        index == "preco" || index == "descricaoCurta" || index == "pesoBruto" ||
                                        index == "gtin" || index == "larguraProduto" || index == "alturaProduto" ||
                                        index == "profundidadeProduto" || index == "imagem" || index == "estoqueAtual" ||
                                        index == "produtoLoja" || index == "marca"){

                                        if(index == "produtoLoja"){
                                            var categoriaProd = objProd.retorno.produtos[i].produto.produtoLoja.categoria;
                                            var categoriaBling = null;
                                            var pai = 0;
                                            var paiDesc = null;

                                            /*$.each(categoriaProd[categoriaProd.length - 1], function(categoria, respCat){

                                                if(categoria == "id"){
                                                    console.log(categoria + ": " + respCat);
                                                    categoriaBling = verificaCategoria(respCat);
                                                } else if (categoria == "idCategoriaPai" && respCat != "0"){
                                                    pai = verificaCategoria(respCat);
                                                    //console.log("*" + pai.descricaoVinculo);
                                                    paiDesc = pai.descricaoVinculo;
                                                    pai = pai.idVinculoLoja;
                                                }

                                                if(categoria == "descricao"){
                                                    arrayHead.push(categoria + "Cat");
                                                }else{
                                                    arrayHead.push(categoria);
                                                }

                                                //arrayBody.push(respCat);
                                                temCategoria = true;
                                            });*/


                                            for(let i = tamanhoCategoria; i < categoriaProd.length; i++){
                                                comparaCategorias(categoriaProd[i]);
                                            }

                                            tamanhoCategoria = categoriaProd.length;

                                            for(let i = 0; i < arrayCategoriasSistema[0].length; i++){
                                                console.log(arrayCategoriasSistema[0][i]);
                                                if(arrayCategoriasProduto[(arrayCategoriasProduto.length - 1)].id == arrayCategoriasSistema[0][i].id_categoria){
                                                    arrayCatAtt.push(arrayCategoriasSistema[0][i]);
                                                }
                                                temCategoria = true;
                                            }



                                            arrayHead.push("id");
                                            arrayHead.push("descricaoCat");
                                            arrayHead.push("idCategoriaPai");
                                            arrayHead.push("descCatPai");
                                            try{
                                                arrayBody.push(arrayCatAtt[0].cd_sub_categoria);
                                                arrayBody.push(arrayCatAtt[0].nm_sub_categoria);
                                                arrayBody.push(arrayCatAtt[0].cd_categoria);
                                                arrayBody.push(arrayCatAtt[0].nm_categoria);
                                            }
                                            catch(ex){

                                                arrayBody.push("não associado");
                                                arrayBody.push("não associado");
                                                arrayBody.push("não associado");
                                                arrayBody.push("não associado");
                                            }

                                            /*arrayBody.push(categoriaBling.idVinculoLoja);
                                            arrayBody.push(categoriaBling.descricaoVinculo);
                                            arrayBody.push(pai);
                                            arrayBody.push(paiDesc);*/
                                        }
                                        else if(index == "imagem"){
                                            arrayHead.push(index);
                                            if(resultado == ""){
                                                arrayBody.push("");
                                            }else{

                                                var linkFinal = null;

                                                for(var j = 0; j < index.length; j++){
                                                    $.each(objProd.retorno.produtos[i].produto.imagem[j], function(img, link){
                                                        if(img == "link"){
                                                            linkFinal = link;
                                                            imagens.push(link);

                                                        }
                                                    });
                                                }

                                                arrayBody.push(linkFinal);
                                            }
                                        }
                                        else if(index == "descricaoCurta"){
                                            arrayHead.push(index);
                                            arrayBody.push(resultado);
                                            //console.log("INDEX RESULTADO: " + resultado);
                                            descricao.push(resultado);
                                        }
                                        else if(index == "pesoBruto"){
                                            arrayHead.push(index);
                                            var pesoEmGramas = resultado * 1000;
                                            arrayBody.push(pesoEmGramas);
                                        }
                                        else{
                                            arrayHead.push(index);
                                            arrayBody.push(resultado);
                                        }

                                    }

                                });

                                //console.log(arrayHead.length);
                                /* for(var j = 0; j < arrayHead.length; j++){

                                    console.log(arrayHead[j] + " : " + arrayBody[j]);

                                } */

                                console.log("============================================");

                                if(temCategoria){

                                    if(!entrouEach){

                                        for(var iH = 0; iH<arrayHead.length; iH++){
                                            if(arrayHead[iH]!="situacao"){
                                                var campoHead = "<td>" + arrayHead[iH] + "</td>";
                                                $('#indexProdHidden').append(campoHead);
                                            }

                                            if(arrayHead[iH]=="codigo" || arrayHead[iH]=="descricao" ||
                                                arrayHead[iH]=="tipo" || arrayHead[iH]=="preco" || arrayHead[iH]=="gtin" ||
                                                arrayHead[iH]=="descricaoCat" || arrayHead[iH]=="descCatPai" ||
                                                arrayHead[iH]=="estoqueAtual"){
                                                var campoHead = "<td>" + arrayHead[iH] + "</td>";
                                                $('#indexProd').append(campoHead);
                                            }
                                        }

                                        var campoHead = "<td>situacao</td>";
                                        $('#indexProd').append(campoHead);
                                        $('#indexProdHidden').append(campoHead);
                                        entrouEach = true;
                                    }

                                    var valor = 0;
                                    var checkado = "";
                                    var semCatPai = false;
                                    var temDisabled = "";
                                    var produto_ativavel = "";
                                    for(var iB = 0; iB<arrayBody.length; iB++){
                                        if(arrayHead[iB]!="situacao"){
                                            if(arrayHead[iB]=="imagem"){
                                                console.log(arrayBody[1] + " : " + arrayBody[iB]);

                                                var urls = "";

                                                for(var img = 0; img < imagens.length; img++){
                                                    urls= urls + " " + imagens[img];
                                                }
                                                arrayImagens.push(urls);
                                                var tBody = "<td>" + urls + "</td>";
                                                $('#trProdHidden' + contador).append(tBody);

                                            }
                                            else if(arrayHead[iB] == "descricaoCurta"){

                                                if(descricao[0] != null){
                                                    /*var novaDesc = descricao[0].replace(/<p>/gi, "");
                                                    novaDesc = novaDesc.replace(/<\/p>/gi, "\n");*/

                                                    let novaDesc = "";
                                                    let descAntiga = descricao[0];
                                                    let tag = false;
                                                    for(let sbs = 0; sbs < descAntiga.length; sbs++){
                                                        if(!tag){
                                                            if(descAntiga.substr(sbs, 1) == "<")
                                                                tag = true;
                                                            else
                                                                novaDesc = novaDesc + descAntiga.substr(sbs,1);
                                                        }
                                                        else if(descAntiga.substr(sbs, 1) == ">")
                                                            tag = false;
                                                    }

                                                    arrayDesc.push(novaDesc);
                                                    console.log("DESCRIÇÃO: " + novaDesc);
                                                    //arrayDesc.push(descricao[0]);
                                                }
                                                else{
                                                    arrayDesc.push(descricao[0]);
                                                }

                                                var tBody = "<td>" + arrayBody[iB] + "</td>";
                                                $('#trProdHidden' + contador).append(tBody);
                                            }
                                            else{
                                                var tBody = "<td>" + arrayBody[iB] + "</td>";
                                                $('#trProdHidden' + contador).append(tBody);
                                            }
                                            /*var tBody = "<td>" + arrayBody[iB] + "</td>";
                                            $('#trProdHidden' + contador).append(tBody);
                                            if(arrayHead[iB] == "imagem"){
                                                arrayImagens.push(arrayBody[iB]);
                                            }*/
                                        }

                                        if((arrayHead[iB] == "idCategoriaPai" && arrayBody[iB] == "0") ||
                                            (arrayHead[iB] == "larguraProduto" && arrayBody[iB] == "null") ||
                                            (arrayHead[iB] == "alturaProduto" && arrayBody[iB] == "null") ||
                                            (arrayHead[iB] == "profundidadeProduto" && arrayBody[iB] == "null") ||
                                            (arrayHead[iB] == "imagem" && arrayBody[iB] == "") ||
                                            (arrayHead[iB] == "descricaoCurta" && arrayBody[iB] == "null") ||
                                            (arrayHead[iB] == "descricaoCurta" && arrayBody[iB] == "") ||
                                            (arrayHead[iB] == "estoqueAtual" && arrayBody[iB] <= 2) ||
                                            (arrayHead[iB] == "pesoBruto" && arrayBody[iB] == "0.000") ||
                                            (arrayHead[iB] == "descricaoCat" && arrayBody[iB] == "não associado") ||
                                            (arrayHead[iB] == "marca" && arrayBody[iB] == ""))
                                        {
                                            semCatPai = true;
                                            temDisabled = "disabled";
                                            $('#trProd'+ contador).css('color', 'red');
                                        }


                                        if(arrayHead[iB]=="codigo" || arrayHead[iB]=="descricao" ||
                                            arrayHead[iB]=="tipo" || arrayHead[iB]=="preco" || arrayHead[iB]=="gtin" ||
                                            arrayHead[iB]=="descricaoCat" || arrayHead[iB]=="descCatPai" ||
                                            arrayHead[iB]=="estoqueAtual" || arrayHead[iB]=="situacao" ){
                                            if(arrayHead[iB]=="situacao"){

                                                if(arrayBody[iB] == "Ativo"){
                                                    valor = 1;
                                                    checkado = "checked";
                                                }

                                            }
                                            else{
                                                var tBody = "<td>" + arrayBody[iB] + "</td>";
                                                $('#trProd' + contador).append(tBody);
                                            }

                                        }
                                    }

                                    if(semCatPai){
                                        checkado = "";
                                        valor = 0;
                                    }else{
                                        produto_ativavel = "produto_ativavel";
                                        //$('#trProd'+contador).addClass('checkado');
                                        //$('#trProdHidden'+contador).addClass('checkado');
                                    }

                                    var tBody = "<td><div class='switch__container pull-left'><input " + temDisabled + " id='switch" + contadorSituacao + "' class='switch switch--shadow " + produto_ativavel + " novos_produtos' value='0' type='checkbox' ><label for='switch" + contadorSituacao + "'></label></div></td>";
                                    $('#trProd' + contador).append(tBody);
                                    var tBodyHidden = "<td><div class='switch__container pull-left'><input " + temDisabled + " id='switch" + contadorSituacao + "hidden' class='switch switch--shadow' value='0' type='checkbox'><label for='switch" + contadorSituacao + "'></label></div></td>";
                                    $('#trProdHidden' + contador).append(tBodyHidden);
                                    contadorSituacao++;
                                }
                                else{
                                    $('#trProd'+contador).remove();
                                    $('#trProdHidden'+contador).remove();
                                }
                            }
                        }catch(err){
                            console.log(err);
                            var objProd = JSON.parse(data);

                            try {
                                if (objProd.retorno.erros[0].erro.cod == 14) {
                                    swal("Ops", "SKU não existe", "info");
                                }
                            }
                            catch(ex){

                            }

                            deuErro = true;
                        }
                    },
                    error: function(){
                        $.unblockUI();
                        swal("Erro", "Ocorreu um erro no processo de busca dos produtos, tente novamente mais tarde.", "warning");
                    }
                })
                    .done(function(){
                        contador = 0;
                        contadorSituacao = 0;
                        $('#btnBusca').removeAttr('disabled');
                        //cor branco
                        $("table tbody tr:odd").css("background-color", "#fff");
                        //cor cinza
                        $("table tbody tr:even").css("background-color", "#f5f5f5");

                        verificaSkuColunas(0);
                    });
                //}
            }

            var arrayCategoriasProduto = [];
            var arrayCatAtt = [];
            function comparaCategorias(categoriaProd){
                //console.log(categoriaProd);

                if(arrayCategoriasProduto.length == 0) {
                    arrayCategoriasProduto.push(categoriaProd);
                }
                else{

                    if(categoriaProd.idCategoriaPai == arrayCategoriasProduto[(arrayCategoriasProduto.length - 1)].id){
                        arrayCategoriasProduto.push(categoriaProd);
                        console.log("é igual");
                    }

                }
                //console.log("arrayCategoriasProduto: ");
                //console.log(arrayCategoriasProduto);

            }

            //=====================================================================================================
            //FUNÇÃO QUE PASSA ATRAVEZ DAS COLUNAS VERIFICANDO O SKU

            function verificaSkuColunas(posColuna){

                if(posColuna < $('#resultProd').children().length){

                    if(!$('#switch' + posColuna).is(':disabled')){
                        var skuProduto = $('#resultProd').find('tr:eq(' + posColuna + ')').find('td:eq(0)').html();
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                        $.ajax({
                            url: '{{route('bling.sku.products')}}',
                            type: 'post',
                            data: {_token: CSRF_TOKEN, cd_sku: skuProduto},
                            dataType: 'JSON',
                            success: function(data){
                                //console.log(skuProduto + ": " + data.message);
                                var temSKU = data.message;
                                if(temSKU == true){
                                    $('#resultProd').find('tr:eq(' + posColuna + ')').css('color', 'rgb(101, 189, 20)');
                                    $('#resultProd').find('tr:eq('+ posColuna + ')').find('td:eq(7)').find('div').find('input').removeClass('novos_produtos');
                                    //console.log($('#resultProd').find('tr:eq(' + posColuna + ')'));
                                    //console.log('existe sku: ' + skuProduto);
                                    //console.log($('#switch' + posColuna).is(':disabled'));
                                }
                            },
                            error: function(){
                                console.log("ERRO VERIFICAÇÃO SKU BLING");
                                $.unblockUI();
                                swal("Ops", "Ocorreu um erro na verificação para ver se SKU já existe!", "info");
                            }
                        }).done(function(){
                            verificaSkuColunas(++posColuna);
                        });
                    }
                    else{
                        verificaSkuColunas(++posColuna);
                    }
                }
                else{
                    //console.log("fim colunas");
                    //console.log($('.btnPaginacao'));
                    //console.log(arrayImagens);
                    $('.btnPaginacao').css('display', 'block');
                    $('#inputEscolhaPag').css('display', 'block');
                    $('.paragrafoPag').removeAttr('hidden');
                    $('#spanNumPag').html(proxPag);

                    if(!primeiraBusca){
                        criarBotaoSalvarProd();
                        primeiraBusca = true;
                    }
                    ativaCheckBox();
                    buscaInterativa();

                    $.unblockUI();
                }

            }

            //=====================================================================================================
            //FUNÇÃO COMPARAR CATEGORIAS

            function verificaCategoria(idCat){
                var retorno = null;
                for(var i=0; i<arrayCatLoja.length; i++){
                    if(idCat == arrayCatLoja[i].categoria.idCategoria){
                        retorno = arrayCatLoja[i].categoria;
                    }
                }

                return retorno;
            }

            //=====================================================================================================
            //FUNÇÃO PARA ATIVAR O CHECKBOX

            function ativaCheckBox(){
                //console.log("ativaCheck");
                //console.log(contadorSituacao);

                $('.switch').click(function(e){
                    var id=e.target.id;
                    if($(this).parent().find('input#' + id).prop("checked")){
                        //console.log("checked");
                        $(this).val("1");
                        $('input#' + id + "hidden").val("1");
                        $(this).parent().find('input#' + id).attr("checked", "checked");
                        $('input#' + id + "hidden").attr("checked", "checked");
                        console.log($(this).parent().parent().parent());
                        $(this).parent().parent().parent().addClass('checkado');
                        $('input#' + id + "hidden").parent().parent().parent().addClass("checkado");
                    }
                    else{
                        $(this).val("0");
                        $('input#' + id + "hidden").val("0");
                        //console.log("unchecked");
                        $(this).parent().find('input#' + id).removeAttr("checked");
                        $('input#' + id + "hidden").removeAttr("checked");
                        $(this).parent().parent().parent().removeClass('checkado');
                        $('input#' + id + "hidden").parent().parent().parent().removeClass("checkado");
                    }
                });

            }

            //=====================================================================================================
            //FUNÇÃO PARA BUSCA DOS DADOS INTERATIVA NA TABELA

            function buscaInterativa(){
                $( '#table' ).searchable({
                    striped: true,
                    oddRow: { 'background-color': '#f5f5f5' },
                    evenRow: { 'background-color': '#fff' },
                    searchType: 'fuzzy'
                });

                $( '#searchable-container' ).searchable({
                    searchField: '#container-search',
                    selector: '.row',
                    childSelector: '.col-xs-4',
                    show: function( elem ) {
                        elem.slideDown(100);
                    },
                    hide: function( elem ) {
                        elem.slideUp( 100 );
                    }
                });
            }

            //=====================================================================================================
            //FUNÇÃO PARA ADICIONAR O BOTÃO DE SALVAR

            function criarBotaoSalvarProd(){
                //<button id="btnCategoria" type="button" class="btn btn-info">Buscar Categorias</button>
               /* var botaoSalvar = "<button id='btnSalvarProds' type='button' class='btn btn-info'>Salvar Produtos</button>";*/
                /*var inputMarcarTodos = "<input type='checkbox' id='selecionar_todos'>" +
                    "<label for='selecionar_todos'>&nbsp;Marcar Todos</label>";
                var inputDesmarcarTodos = "<input type='checkbox' id='desmarcar_todos'>" +
                    "<label for='desmarcar_todos'>&nbsp;Desmarcar Todos</label>";
                var inputNovosProdutos = "<input type='checkbox' id='marcar_novos'>" +
                    "<label for='marcar_novos'>&nbsp;Marcar Novos Produtos</label>";*/

                /*$('#botoesBling').append(botaoSalvar);*/
                /*$('#botoesBling').append(inputMarcarTodos);
                $('#botoesBling').append(inputDesmarcarTodos);
                $('#botoesBling').append(inputNovosProdutos);*/
                /*AtivarBotaoSalvar();*/

                $('#botoesBling').attr('hidden', true);
                $("#btnBuscaProd").css("display", "none");
                $("#btnSalvarProds").css("display", "block");
                $('#texto_informativo').removeAttr('hidden');
            }

            //=====================================================================================================
            //FUNÇÃO PARA ADICIONAR OS EVENTOS BOTÃO DE SALVAR

            $('#btnTeste').click(function(){
                for(var i = 0; i < $('#resultProdHidden').children().length; i++){
                    //console.log($('#resultProdHidden').find('tr:eq(' + i + ')'));
                    if($('#resultProdHidden').find('tr:eq(' + i + ')').find('td:eq(15)').find('div').find('input').val() == 1) {
                        //console.log($('#resultProdHidden').find('tr:eq(' + i + ')').find('td:eq(15)').find('div').find('input').val());
                    }
                }

            });

            var arrayCategoriasSistema = [];
            $('#btn_teste').click(function(){
                consultaAssocCatSistBling();
            });

            function consultaAssocCatSistBling(){
                let categoria_bling = '262508';
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                //console.log('oi');

                //console.log(arrayCat);

                try {
                    $.ajax({
                        url: '{{route('bling.consult.bond.categories')}}',
                        type: 'post',
                        data: {_token: CSRF_TOKEN, categoria: categoria_bling},
                        success: function (data) {
                            //console.log(data);
                            arrayCategoriasSistema.push(data.categoria_sistema);
                            console.log(arrayCategoriasSistema);
                        }
                    })
                        .done(function(){
                            buscaProdutos(proxPag);
                        });
                }
                catch(ex){
                    swal('Erro', 'Ocorreu um erro ao tentar fazer a consulta das categorias do bling.', 'error');
                }
            }

            var arrayProduto = [];
            function AtivarBotaoSalvar(){
                $('#btnSalvarProds').click(function(){
                    //console.log("oi");

                    $.blockUI({
                        message: 'Carregando...',
                        css: {
                            border: 'none',
                            padding: '15px',
                            backgroundColor: '#000',
                            '-webkit-border-radius': '10px',
                            '-moz-border-radius': '10px',
                            opacity: .5,
                            color: '#fff'
                        }
                    });

                    try{
                        colunaProdutos(0);
                    }
                    catch(Exception){
                        $.unblockUI();
                        swal("Erro", "Ocorreu um erro no processo de salvamento, tente novamente mais tarde.", "warning");
                    }
                });

                /*$('#selecionar_todos').click(function(){

                    if($('.produto_ativavel').val() == 0) {
                        $('.produto_ativavel').click();
                        $(this).attr("checked", "checked");

                        $('#desmarcar_todos').removeAttr('checked');

                    }
                });

                $('#desmarcar_todos').click(function(){
                    console.log($('.produto_ativavel').parent().parent().parent());

                    if($('.produto_ativavel').val() == 1){

                        $('.produto_ativavel').click();
                        $(this).attr("checked", "checked");

                        $('#selecionar_todos').removeAttr('checked');

                    }
                });

                $('#marcar_novos').click(function(){
                    if($('.novos_produtos').val() == 0) {
                        $('.novos_produtos').click();
                        $(this).attr("checked", "checked");
                    }
                });*/
            }

            //=====================================================================================================
            //FUNÇÃO QUE PASSA ATRAVEZ DAS COLUNAS DA TABELA PARA SALVAR OS PRODUTOS

            function colunaProdutos(posProd){
                if(posProd < $('#resultProdHidden').children().length){
                    arrayProduto = [];
                    //if($('#resultProdHidden').find('tr:eq(' + i + ')').hasClass('checkado')){
                    if($('#resultProdHidden').find('tr:eq(' + posProd + ')').find('td:eq(16)').find('div').find('input').val() == 1){
                        //console.log('=============================================');
                        for(var j = 0; j<arrayNames.length; j++){
                            if( j == 9 ){
                                arrayProduto.push(arrayImagens[posProd]);
                                console.log(arrayImagens[posProd]);
                            }
                            else if( j == 3){
                                arrayProduto.push(arrayDesc[posProd]);
                                //console.log("Array Desc: " + arrayDesc[posProd]);
                            }
                            else{
                                arrayProduto.push($('#resultProdHidden').find('tr:eq(' + posProd + ')').find('td:eq(' + j + ')').html());
                                //console.log($('#resultProdHidden').find('tr:eq(' + posProd + ')').find('td:eq(' + j + ')').html());
                            }

                        }

                        consultaSku(arrayProduto, posProd);
                        //return false;
                    }
                    else{
                        colunaProdutos(++posProd);
                    }
                }else{
                    //console.log("fechou coluna produtos");
                    $.unblockUI();
                }

            }

            //=====================================================================================================
            //FUNÇÃO PARA CONSULTAR O SKU DOS PRODUTOS

            function consultaSku(array, posProd){
                var existeSku = false;
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{route('bling.sku.products')}}',
                    type: 'post',
                    data: {_token: CSRF_TOKEN, cd_sku: array[0]},
                    dataType: 'JSON',
                    success: function(data){
                        existeSku = data.message;
                    },
                    error: function(){
                        $.unblockUI();
                        //console.log("ERRO NA COSULTA DO SKU")
                        swal("Erro", "Ocorreu um erro no processo de salvamento, tente novamente mais tarde.", "warning");
                    }
                }).done(function(){
                    if(!existeSku){
                        //console.log("nao existe sku");
                        salvarCategoria(array, posProd);
                    }
                    else{
                        //console.log("já existe sku");
                        //colunaProdutos(++posProd);
                        atualizaProduto(array, posProd);
                    }
                    //salvarCategoria(array);

                })
            }

            //=====================================================================================================
            //FUNÇÃO PARA ATUALIZAR OS PRODUTOS

            function atualizaProduto(array, posProd){
                //console.log("entrou atualiza produto");
                //console.log(array);
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: '{{route('bling.product.update')}}',
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, nm_produto: array[1], cd_sku: array[0], cd_ean: array[6], vl_produto: array[2],
                        qt_produto: array[15], ds_largura: array[7], ds_altura: array[8], ds_comprimento: array[9],
                        ds_peso: array[5], ds_produto: array[3], nm_marca: array[4]},
                    success: function(data){
                        //console.log("sucesso: " + data);
                    },
                    error: function(data){
                        //console.log("erro: " + data);
                        swal("Erro", "Ocorreu um erro ao atualizar o produto "+ array[1] +", tente novamente mais tarde.", "warning");
                    }
                }).done(function(){
                    //console.log("atualizou o produto: " + array[1]);
                    colunaProdutos(++posProd);
                });
            }

            //=====================================================================================================
            //FUNÇÃO PARA SALVAR AS CATEGORIAS

            function salvarCategoria(array, posProd){
                //console.log('/*/*/*/*/*/*/*/*');
                //console.log(array[12]);
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var cd_categoria = null;


                $.ajax({
                    url: '{{route('category.bling.save')}}',
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, nm_categoria: array[14]},
                    dataType: 'JSON',
                    success: function(data){
                        //console.log(data[0][0].cd_categoria);
                        cd_categoria = data[0][0].cd_categoria;
                    },
                    error: function(){
                        //console.log("ERRO AO SALVAR A CATEGORIA");
                        $.unblockUI();
                        swal("Erro", "Ocorreu um erro no processo de salvamento, tente novamente mais tarde.", "warning");
                    }
                }).done(function () {
                    salvarSubCat(CSRF_TOKEN, array[12], cd_categoria, array, posProd);
                });

                //console.log('/*/*/*/*/*/*/*/*');
            }


            //=====================================================================================================
            //FUNÇÃO PARA SALVAR AS CATEGORIAS DA LOJA

            function salvarSubCat(CSRF_TOKEN, nm_sub_cat, cd_categoria, array, posProd){
                var cd_sub_categoria = null;
                $.ajax({
                    url: '{{route('subcategory.bling.save')}}',
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, nm_sub_categoria: nm_sub_cat},
                    dataType: 'JSON',
                    success: function (data) {
                        //console.log(data[0][0].cd_sub_categoria);
                        cd_sub_categoria = data[0][0].cd_sub_categoria;
                    },
                    error: function(){
                        $.unblockUI();
                        //console.log("ERRO AO SALVAR A SUB-CATEGORIA");
                        swal("Erro", "Ocorreu um erro no processo de salvamento, tente novamente mais tarde.", "warning");
                    }
                }).done(function(){
                    salvarAssoc(CSRF_TOKEN, cd_categoria, cd_sub_categoria, array, posProd);
                });
            }

            //=====================================================================================================
            //FUNÇÃO PARA SALVAR AS ASSOCIAÇÕES DE CATEGORIAS

            function salvarAssoc(CSRF_TOKEN, cd_categoria, cd_sub_categoria, array, posProd){
                $.ajax({
                    url: '{{route('assoc.bling.save')}}',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {_token: CSRF_TOKEN, cd_categoria: cd_categoria, cd_sub_categoria: cd_sub_categoria},
                    success: function(data){
                        //console.log(data.message);
                    },
                    error: function(){
                        $.unblockUI();
                        //console.log("ERRO AO SALVAR A ASSOCIAÇÃO");
                        swal("Erro", "Ocorreu um erro no processo de salvamento, tente novamente mais tarde.", "warning");
                    }
                }).done(function(){
                    var qt_prod = array[15];

                    if(qt_prod < 0 )
                        qt_prod = 0;

                    salvarProd(CSRF_TOKEN, cd_categoria, cd_sub_categoria, array, qt_prod, posProd);
                });
            }

            //=====================================================================================================
            //FUNÇÃO PARA SALVAR OS PRODUTOS

            function salvarProd(CSRF_TOKEN, cd_categoria, cd_sub_categoria, array, qt_prod, posProd){
                //console.log(array.length);

                for(var i=0; i<array.length; i++){
                    //console.log(array[i]);
                }

                var regInicio = new RegExp("^\\s+");
                var urls = "";
                console.log(array[10] + " : " + array[10].length);
                if(array[9].length > 0){
                    urls = array[9].replace(regInicio, '');
                    urls = urls.split(' ');
                }


                if(array[3] != null){
                    if(array[3].length > 1500){
                        array[3] = array[3].substr(0, 1500);
                    }
                }
                else{
                    array[3] = array[1];
                }


                $.ajax({
                    url: '{{route('bling.save.products')}}',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {_token: CSRF_TOKEN, cd_sku: array[0], nm_produto: array[1],
                        vl_produto: array[2], ds_produto: array[3], nm_marca: array[4], ds_peso: array[5],
                        cd_ean: array[6], ds_largura: array[7], ds_altura: array[8], ds_comprimento: array[9],
                        cd_categoria: cd_categoria, cd_sub_categoria: cd_sub_categoria,
                        qt_produto: qt_prod, status: 'on', images: urls},
                    success: function(data){

                    },
                    error: function(){
                        $.unblockUI();
                        //console.log("ERRO AO SALVAR O PRODUTO");
                        swal("Erro", "Ocorreu um erro no processo de salvamento, tente novamente mais tarde.", "warning");
                    }
                }).done(function(){
                    colunaProdutos(++posProd);
                });
            }

        });

    </script>

    <script src="//rawgithub.com/stidges/jquery-searchable/master/dist/jquery.searchable-1.0.0.min.js"></script>

@stop

