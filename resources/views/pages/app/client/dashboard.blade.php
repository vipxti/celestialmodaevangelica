@extends('layouts.app.app')

@section('content')

    <link rel="stylesheet" href="{{asset('css/app/estiloWizard.css')}}">
    <link rel="stylesheet" href="{{asset('css/app/input.css')}}">

    <section class="new_arrivals_area section_padding_100_0 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_heading text-center text-left">
                        <h3><i class="fa fa-sliders"></i>&nbsp; Minha Conta</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    @include('partials.app._alerts')
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="tabbable-panel">
                        <div class="tabbable-line">
                            <ul class="nav nav-tabs ">
                                <li class="active">
                                    <a id="tabPedidos" href="#tab_default_1" data-toggle="tab">Pedidos</a>
                                </li>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <li>
                                    <a id="tabCompras" href="#tab_default_2" data-toggle="tab">Compras</a>
                                </li>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <li>
                                    <a id="tabDados" href="#tab_default_3" data-toggle="tab">Dados Pessoais</a>
                                </li>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <li>
                                    <a id="tabEndereco" href="#tab_default_4" data-toggle="tab">Endereço</a>
                                </li>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <li>
                                    <a id="tabAtendimento" href="#tab_default_5" data-toggle="tab">Atendimento</a>
                                </li>

                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_default_1">
                                    <p>&nbsp;</p>
                                    <div class="row">
                                       <div class="col-md-12">
                                          <div class="p-3" style="background-color: #f5f5f5">Ops! Produto não encontrado.</div>
                                       </div>
                                    </div>
                                    <p>&nbsp;</p>
                                </div>
                                <div class="tab-pane" id="tab_default_2">
                                    <p>&nbsp;</p>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="p-3" style="background-color: #f5f5f5">Ops! Compra não encontrada.</div>
                                        </div>
                                    </div>
                                    <br><br><br>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <a href="{{route('products.page')}}" class="btn btn-danger" style="width: 150px; background-color: #d59431">Compre agora</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_default_3">

                                    <p>&nbsp;</p>

                                    <form action="#" method="post">

                                        <!-- Nome -->
                                        <div class="row">
                                            <!-- Nome do Cliente  -->
                                            <div class="col-md-12">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="nm_cliente" required maxlength="50" value="{{ Auth::user()->nm_cliente }}">
                                                        <label class="form-label">Nome</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- E-mail, Data de Nascimento -->
                                        <div class="row">
                                            <!-- E-mail -->
                                            <div class="col-md-6">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="nm_email" required maxlength="20" value="{{ Auth::user()->email }}">
                                                        <label class="form-label">E-mail</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Data de Nascimento -->
                                            <div class="col-md-6">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="dt_nascimento" required maxlength="20" value="{{ \Carbon\Carbon::parse(Auth::user()->dt_nascimento)->format('d/m/Y') }}">
                                                        <label class="form-label">Data de Nascimento</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Senha,CPF, e CNPJ -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                    <input type="text" class="form-control" name="cd_cpf_cnpj" disabled required maxlength="20" value="{{ Auth::user()->cd_cpf_cnpj }}">
                                                        <label class="form-label">CPF ou CNPJ</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                    <input type="text" class="form-control" name="fk_cd_telefone" required maxlength="20" value="{{ $telCliente[0]->cd_celular1 }}">
                                                        <label class="form-label">Telefone</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Foto Cliente -->
                                        {{-- <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label></label>Foto</label>
                                                    <div class="input-group">
                                                        <div class="file-loading">
                                                            <input id="input-41" name="images[]" type="file" accept="image/*" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <br><br><br>

                                        <!-- Botão Atualizar dados -->
                                        <div class="row">
                                            <div class="col-md-2">
                                                <input type="button" class="btn btn-danger" value="Atualizar dados" style="width: 150px; background-color: #d59431">
                                            </div>
                                        </div>

                                    </form>
                                </div>
                                <div class="tab-pane" id="tab_default_4">

                                    <p>&nbsp;</p>

                                    @if(count($endereco) > 0)
                                        <form action="{{ route('client.address.save') }}" method="post">
                                            {{ csrf_field() }}

                                            <input type="hidden" id="ibge" name="cd_ibge" value="">
                                            <input type="hidden" id="pais" name="nm_pais" value="">

                                            <!-- Nome do destinatário -->
                                            <div class="row">

                                                <div class="col-md-12">

                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input type="text" class="form-control" name="nm_destinatario" readonly required maxlength="50" value="{{$endereco[0]->nm_destinatario}}">
                                                            <label class="form-label">Nome do destinatário</label>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                            <!-- CEP -->
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input type="number" id="campo_cep" value="{{$endereco[0]->cd_cep}}" disabled class="form-control" name="cd_cep" required>
                                                            <label class="form-label">CEP</label>
                                                        </div>
                                                    </div>
                                                    <p class="msg-cpf" style="font-size:14px"></p>
                                                </div>

                                            </div>

                                            <!-- Estado e Cidade -->
                                            <div class="row">

                                                <div class="col-md-6">

                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input type="text" id="uf" class="form-control" value="{{$endereco[0]->sg_uf}}" readonly name="sg_uf" required>
                                                            <label class="form-label">Estado</label>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-md-6">

                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input type="text" id="cidade" value="{{$endereco[0]->nm_cidade}}" readonly class="form-control" name="nm_cidade" required>
                                                            <label class="form-label">Cidade</label>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="row">

                                                <!-- Complemnto -->
                                                <div class="col-md-6">
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input type="text" id="rua" value="{{$endereco[0]->ds_endereco}}" readonly class="form-control" name="ds_endereco" required>
                                                            <label class="form-label">Rua/Avenida</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">

                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input type="numero" class="form-control" value="{{$endereco[0]->cd_numero_endereco}}" readonly name="cd_numero_endereco" required>
                                                            <label class="form-label">Número</label>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="row">

                                                <!-- Complemento -->
                                                <div class="col-md-6">
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input type="text" class="form-control" value="{{$endereco[0]->ds_complemento}}" readonly name="ds_complemento">
                                                            <label class="form-label">Complemento</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Complemento -->
                                                <div class="col-md-6">
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input type="text" class="form-control" value="{{$endereco[0]->ds_ponto_referencia}}" readonly name="ds_ponto_referencia">
                                                            <label class="form-label">Ponto de referência</label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="row">
                                                <!-- Bairro -->
                                                <div class="col-md-12">
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input type="text" id="bairro" value="{{$endereco[0]->nm_bairro}}" readonly class="form-control" name="nm_bairro" required>
                                                            <label class="form-label">Bairro</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br><br>

                                            <!-- Botões Salvar -->
                                            <div class="row" style="padding: 8px">
                                                <div class="col-md-2" style="padding: 10px">
                                                    <button type="submit" disabled class="btn btn-primary" style="background-color: #d59431">Adicionar Endereço</button>
                                                </div>
                                            </div>

                                        </form>
                                    @else
                                    <form action="{{ route('client.address.save') }}" method="post">
                                        {{ csrf_field() }}

                                        <input type="hidden" id="ibge" name="cd_ibge" value="">
                                        <input type="hidden" id="pais" name="nm_pais" value="">

                                        <!-- Nome do destinatário -->
                                        <div class="row">

                                            <div class="col-md-12">

                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="nm_destinatario" required maxlength="50">
                                                        <label class="form-label">Nome do destinatário</label>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <!-- CEP -->
                                        <div class="row">
                                            
                                            <div class="col-md-12">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="number" id="campo_cep" class="form-control" name="cd_cep" required>
                                                        <label class="form-label">CEP</label>
                                                    </div>
                                                </div>
                                                <p class="msg-cpf" style="font-size:14px"></p>
                                            </div>

                                        </div>
                                        
                                        <!-- Estado e Cidade -->
                                        <div class="row">

                                            <div class="col-md-6">

                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" id="uf" class="form-control" name="sg_uf" required>
                                                        <label class="form-label">Estado</label>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-md-6">

                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" id="cidade" class="form-control" name="nm_cidade" required>
                                                        <label class="form-label">Cidade</label>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="row">

                                            <!-- Complemnto -->
                                            <div class="col-md-6">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" id="rua" class="form-control" name="ds_endereco" required>
                                                        <label class="form-label">Rua/Avenida</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">

                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="numero" class="form-control" name="cd_numero_endereco" required>
                                                        <label class="form-label">Número</label>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="row">

                                            <!-- Complemento -->
                                            <div class="col-md-6">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="ds_complemento">
                                                        <label class="form-label">Complemento</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Complemento -->
                                            <div class="col-md-6">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="ds_ponto_referencia">
                                                        <label class="form-label">Ponto de referência</label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="row">
                                            <!-- Bairro -->
                                            <div class="col-md-12">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" id="bairro" class="form-control" name="nm_bairro" required>
                                                        <label class="form-label">Bairro</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br><br>

                                        <!-- Botões Salvar -->
                                        <div class="row" style="padding: 8px">
                                            <div class="col-md-2" style="padding: 10px">
                                                <button type="submit" class="btn btn-primary" style="background-color: #d59431">Adicionar Endereço</button>
                                            </div>
                                        </div>                                        

                                    </form>
                                    @endif

                                </div>
                                <div class="tab-pane" id="tab_default_5">
                                </div>
                                <div class="tab-pane" id="tab_default_6">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br><br><br><br>
        </div>
    </section>

    <script src="{{asset('js/app/jquery.validate.min.js')}}"></script>
    <script src="{{asset('js/app/waves.js')}}"></script>
    <script src="{{asset('js/app/input.js')}}"></script>
    <script src="{{asset('js/app/form-validation.js')}}"></script>

    <script>
        function limpa_formulario_cep() {
            // Limpa valores do formulário de cep.
            $("#rua").val("");
            $("#bairro").val("");
            $("#cidade").val("");
            $("#pais").val("");
            $("#ibge").val("");
            $("#uf").val("");
        }

        //Quando o campo cep perde o foco.
        $("#campo_cep").focusout(function() {

            $(".msg-cpf").html("");
            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');
            //Verifica se campo cep possui valor informado.
            if (cep != "") {
                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;
                //Valida o formato do CEP.
                if(validacep.test(cep)) {
                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#rua").val("...");
                    $("#bairro").val("...");
                    $("#cidade").val("...");
                    $("#pais").val("...");
                    $("#uf").val("...");
                    //Consulta o webservice viacep.com.br/
                    $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#rua").parent().addClass("focused");
                            $("#rua").val(dados.logradouro);
                            //$("#rua").attr("disabled", "disabled");
                            $("#bairro").parent().addClass("focused");
                            $("#bairro").val(dados.bairro);
                            //$("#bairro").attr("disabled", "disabled");
                            $("#cidade").parent().addClass("focused");
                            $("#cidade").val(dados.localidade);
                            //$("#cidade").attr("disabled", "disabled");
                            $("#pais").parent().addClass("focused");
                            $("#pais").val('Brasil');
                            //$("#pais").attr("disabled", "disabled");
                            $("#uf").parent().addClass("focused");
                            $("#uf").val(dados.uf);
                            //$("#uf").attr("disabled", "disabled");
                            $("#ibge").val(dados.ibge);
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulario_cep();
                            $(".msg-cpf").html("CEP não encontrado.").css("color", "red");
                            $("#rua").removeAttr("disabled");
                            $("#bairro").removeAttr("disabled");
                            $("#cidade").removeAttr("disabled");
                            $("#pais").removeAttr("disabled");
                            $("#uf").removeAttr("disabled");
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulario_cep();
                    $(".msg-cpf").html("Formato de CEP inválido.").css("color", "red");
                    $("#rua").removeAttr("disabled");
                    $("#bairro").removeAttr("disabled");
                    $("#cidade").removeAttr("disabled");
                    $("#pais").removeAttr("disabled");
                    $("#uf").removeAttr("disabled");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulario_cep();
                $("#rua").removeAttr("disabled");
                $("#bairro").removeAttr("disabled");
                $("#cidade").removeAttr("disabled");
                $("#pais").removeAttr("disabled");
                $("#uf").removeAttr("disabled");
            }
        });


        $('#quickview').on('show', function (e) {

            var link = e.relatedTarget(),
                $modal = $(this)

            console.log($modal);

        });

        $("#tabPedidos").click(function(){
            $(this).parent().addClass("active");
            $(this).parent().siblings().removeClass("active");
        });

        $("#tabCompras").click(function(){
            $(this).parent().addClass("active");
            $(this).parent().siblings().removeClass("active");
        });

        $("#tabDados").click(function(){
            $(this).parent().addClass("active");
            $(this).parent().siblings().removeClass("active");
        });

        $("#tabEndereco").click(function(){
            $(this).parent().addClass("active");
            $(this).parent().siblings().removeClass("active");
        });

        $("#tabAtendimento").click(function(){
            $(this).parent().addClass("active");
            $(this).parent().siblings().removeClass("active");
        });


    </script>

@stop