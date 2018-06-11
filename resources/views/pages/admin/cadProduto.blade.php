@extends('layouts.admin.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Produto</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
                <li class="active">Produto</li>
                <li><a href="#">Cadastro de produto</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Cadastro de Produto</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>

                </div>
                <div class="box-body">
                    {{--<form action="{{ route('product.save') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="col-md-12">

                            <div class="col-md-9">
                                <div class="form-group">
                                    <label>Nome do Produto</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                                        <input type="text" class="form-control campo_nome" name="nm_produto" maxlength="50">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Código (SKU)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                        <input id="campo_sku" type="text" class="form-control campo_sku" name="cd_sku" maxlength="20" style="text-transform: uppercase">

                                    </div>
                                    <p class="msg_sku"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Código (Ean)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                        <input id="campo_ean" type="text" class="form-control campo_ean" name="cd_ean" maxlength="13">
                                    </div>
                                    <p class="msg_ean"></p>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Descrição do Produto</label>
                                    <div class="input-group">
                                    <textarea id="bold" class="campo_desc" name="ds_produto" rows="5" cols="107%" style="font-size: 14px; line-height: 40px; border: 1px solid #dddddd; padding: 2px; resize: none" maxlength="1500">
                                    </textarea>
                                        <p><span class="qtd_palavras">1500</span> caracteres</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Preço</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">R$</span>
                                        <input type="number" class="form-control campo_preco" name="vl_produto" min="0">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Categoria</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                    <select id="categorias" class="form-control select2 campo_cat" style="width: 100%;" name="cd_categoria">
                                        <option value=""></option>

                                        @foreach($categorias as $categoria)
                                            <option value="{{ $categoria->cd_categoria }}">{{ $categoria->nm_categoria }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Sub-Categoria</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                        <select id="subcategorias" class="form-control select2 campo_subcat" style="width: 100%;" name="cd_subcategoria" >
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>&nbsp;</div>

                        <div class="col-md-12">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Largura</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-arrows-h"></i></span>
                                        <input type="number" class="form-control" name="ds_largura">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Altura</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-arrows-v"></i></span>
                                        <input type="number" class="form-control" name="ds_altura">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Peso</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
                                        <input type="number" class="form-control" name="ds_peso">
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-md-12">
                          <div>&nbsp;</div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Imagens</label>
                                    <div class="input-group">
                                        <div class="file-loading">
                                            <input id="input-41" class="campo_img" name="images[]" type="file" accept="image/*" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="box-header"><h3 class="box-title">Ativa/Desativar Produto</h3></div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <input type="checkbox" class="flat-red campo_status" name="status" checked>
                                        <label class="">Status</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                      <div class="col-md-12">
                        <div>
                           <button type="submit" id="btn_salvar" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                         </div>

                          <div style="padding-right: 90px">
                              <button type="submit" id="btn_atributos" class="btn btn-primary pull-right"><i class="fa fa-sort-amount-desc"></i>&nbsp;&nbsp;Atributos</button>

                          </div>
                      </div>

                    </form>--}}
                        <form action="{{ route('product.save') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <!-- Nome do Produto  -->
                            <table style="width: 65%">
                                <tr>
                                    <td>
                                        <div>
                                            <div class="form-group">
                                                <label>Nome do Produto</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                                                    <input type="text" class="form-control campo_nome" name="nm_produto" maxlength="50">
                                                </div>
                                                <i class="msg_nome_prod"></i>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <!-- Códigos SKU e Ean  -->
                            <table style="width: 65%">
                                <tr>
                                    <td style="width: 50%">
                                        <div>
                                            <div class="form-group">
                                                <label>Código (SKU)</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                                    <input id="campo_sku" type="text" class="form-control campo_sku" name="cd_sku" maxlength="20" style="text-transform: uppercase">

                                                </div>
                                                    <i class="msg_sku"></i>
                                            </div>
                                        </div>
                                    </td>

                                    <td>&nbsp;&nbsp;&nbsp;</td>

                                    <td style="width: 50%">
                                        <div>
                                            <div class="form-group">
                                                <label>Código (EAN)</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                                    <input id="campo_ean" type="text" class="form-control campo_ean" name="cd_ean" maxlength="13">
                                                </div>
                                                <i class="msg_ean"></i>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <!-- Categorias -->
                            <table style="width: 65%">
                                <tr>
                                    <td style="width: 50%">
                                        <div>
                                            <label>Categoria</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                                <select id="categorias" class="form-control select2 campo_cat" style="width: 100%;" name="cd_categoria">
                                                    <option value=""></option>

                                                    @foreach($categorias as $categoria)
                                                        <option value="{{ $categoria->cd_categoria }}">{{ $categoria->nm_categoria }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <i class="msg_cat"></i>
                                        </div>
                                    </td>

                                    <td>&nbsp;&nbsp;&nbsp;</td>

                                    <td style="width: 50%">
                                        <div>
                                            <label>Sub-Categoria</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                                <select id="subcategorias" class="form-control select2 campo_subcat_modal" style="width: 100%;" name="cd_sub_categoria" >
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <br>

                            <!-- Preço e quantidade  -->
                            <table style="width: 32%">
                                    <tr>
                                        <td style="width: 50%">
                                            <div>
                                                <label>Preço</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">R$</span>
                                                    <input type="number" class="form-control campo_preco" name="vl_produto" min="0">
                                                </div>
                                                <i class="msg_preco"></i>
                                            </div>
                                        </td>

                                        <td>&nbsp;&nbsp;&nbsp;</td>

                                        <td style="width: 50%">
                                            <div>
                                                <label>Quantidade</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">0-9</span>
                                                    <input type="number" class="form-control" name="qt_produto" min="0">
                                                </div>
                                                <i class="msg_qtd"></i>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            <br>

                            <!-- Laegura, Altura e Peso -->
                            <table style="width: 65%">
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label>Largura</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-arrows-h"></i></span>
                                                <input type="number" class="form-control" name="ds_largura" min="0">
                                            </div>
                                            <i class="msg_largura"></i>
                                        </div>
                                    </td>
                                    <td>&nbsp;&nbsp;&nbsp;</td>

                                    <td>
                                        <div class="form-group">
                                            <label>Altura</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-arrows-v"></i></span>
                                                <input type="number" class="form-control" name="ds_altura" min="0">
                                            </div>
                                            <i class="msg_altura"></i>
                                        </div>
                                    </td>
                                    <td>&nbsp;&nbsp;&nbsp;</td>

                                    <td>
                                        <div class="form-group">
                                            <label>Peso (g)</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
                                                <input type="number" class="form-control" name="ds_peso" min="0">
                                            </div>
                                            <i class="msg_preco"></i>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <!-- Descrição  -->
                            <table style="width: 100%">
                               <tr>
                                  <td>
                                    <div>
                                      <div class="form-group">
                                       <label>Descrição do Produto</label>
                                        <div class="input-group">
                                          <textarea id="bold" class="campo_desc" name="ds_produto" rows="5" cols="112%" style="line-height: 40px; border: 1px solid #dddddd; padding: 2px; resize: none"  maxlength="1500">
                                          </textarea>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td><p class="msg_desc"></p></td>
                                </tr>
                                <tr>
                                   <td><p><span class="qtd_palavras">1500</span> caracteres</p></td>
                                </tr>
                                </table>

                            <!-- Imagens e Status -->
                            <table style="width: 100%">
                                <tr>
                                    <td>
                                        <div>
                                            <div>
                                                <div class="form-group">
                                                    <label>Imagens</label>
                                                    <div class="input-group">
                                                        <div class="file-loading">
                                                            <input id="input-41" name="images[]" type="file" accept="image/*" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div>
                                            <div class="box-header"><h3 class="box-title">Ativa/Desativar Produto</h3></div>
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <input type="checkbox" class="flat-red campo_status" name="status" checked>
                                                    <label class="">Status</label>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <!-- Botões Salvar e Atributo -->
                            <div class="col-md-12">
                                <div>
                                    <button type="submit" id="btn_salvar" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                                </div>

                                <div style="padding-right: 90px">
                                    <button type="submit" id="btn_atributos" class="btn btn-primary pull-right"><i class="fa fa-sort-amount-desc"></i>&nbsp;&nbsp;Variações</button>

                                </div>
                            </div>
                        </form>

                        <form action="#" method="post" enctype="multipart/form-data">
                        <div class='modal fade' id='myModal'>
                            <div class='modal-dialog'>
                                <div class='modal-content' style="width: 130%">
                                    <div class='modal-header'>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class='modal-title'>
                                            <strong><i class="fa fa-sort-amount-desc"></i>&nbsp;&nbsp;Cadastrar Variações</strong>
                                        </h4>
                                    </div>

                                    <div class='modal-body'>

                                        <!-- Nome do Produto (Modal) -->
                                        <table style="width: 100%">
                                            <tr>
                                                <td>
                                                    <div>
                                                        <div class="form-group">
                                                            <label>Nome do Produto</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                                                                <input type="text" class="form-control campo_nome" name="nm_produto" maxlength="50">
                                                            </div>
                                                            <i class="msg_nome_prod"></i>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>

                                        <!-- Códigos SKU e Ean (Modal) -->
                                        <table style="width: 100%">
                                            <tr>
                                                <td style="width: 50%">
                                                    <div>
                                                        <div class="form-group">
                                                            <label>Código (SKU)</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                                                <input id="campo_sku" type="text" class="form-control campo_sku" name="cd_sku" maxlength="20" style="text-transform: uppercase">

                                                            </div>
                                                            <i class="msg_sku"></i>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>&nbsp;&nbsp;&nbsp;</td>

                                                <td style="width: 50%">
                                                    <div>
                                                        <div class="form-group">
                                                            <label>Código (EAN)</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                                                <input id="campo_ean" type="text" class="form-control campo_ean" name="cd_ean" maxlength="13">
                                                            </div>
                                                            <i class="msg_ean"></i>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>

                                        <!-- Categorias (Modal) -->
                                        <table style="width: 100%">
                                            <tr>
                                                <td style="width: 50%">
                                                    <div>
                                                        <label>Categoria</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                                            <select id="categorias" class="form-control select2 campo_cat" style="width: 100%;" name="cd_categoria">
                                                                <option value=""></option>

                                                                @foreach($categorias as $categoria)
                                                                    <option value="{{ $categoria->cd_categoria }}">{{ $categoria->nm_categoria }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <i class="msg_cat"></i>
                                                    </div>
                                                </td>

                                                <td>&nbsp;&nbsp;&nbsp;</td>

                                                <td style="width: 50%">
                                                    <div>
                                                        <label>Sub-Categoria</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                                            <select id="subcategorias" class="form-control select2 campo_subcat_modal" style="width: 100%;" name="cd_sub_categoria" >
                                                                <option value=""></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <br>

                                        <!-- Tamanhos (Modal) -->
                                        <table style="width: 100%">
                                            <tr>
                                                <td style="width: 50%">
                                                    <label>Tamanho (Letra)</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                                        <select id="sl_tamanho_letra" class="form-control select2" style="width: 100%;" name="cd_tamanho_letra">
                                                            <option value=""></option>
                                                            @foreach($tamanhosLetras as $tamanhoLetra)
                                                                <option value="{{ $tamanhoLetra->cd_tamanho_letra }}">{{ $tamanhoLetra->nm_tamanho_letra }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <i class="msg_tam_letra"></i>
                                                </td>

                                                <td>&nbsp;&nbsp;&nbsp;</td>

                                                <td style="width: 50%">
                                                    <label>Tamanho (Número)</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                                        <select id="sl_tamanho_num" class="form-control select2" style="width: 100%;" name="cd_tamanho_num">
                                                            <option value=""></option>
                                                            @foreach($tamanhosNumeros as $tamanhoNumero)
                                                                <option value="{{ $tamanhoNumero->cd_tamanho_num }}">{{ $tamanhoNumero->nm_tamanho_num }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <i class="msg_tam_num"></i>
                                                </td>
                                            </tr>
                                        </table>
                                        <br>

                                        <!-- Cor (Modal) -->
                                        <table style="width: 100%">
                                            <tr>
                                                <td style="width: 51%">
                                                    <label>Cor</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-paint-brush"></i></span>
                                                        <select class="form-control select2" style="width: 100%;" name="cd_cor" >
                                                            <option value=""></option>
                                                            @foreach($cores as $cor)
                                                                <option value="{{ $cor->cd_cor }}">{{ $cor->nm_cor }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <i class="msg_cor"></i>
                                                </td>

                                                <td>&nbsp;&nbsp;&nbsp;</td>

                                                <td style="width: 25%">
                                                    <div>
                                                        <label>Preço</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon">R$</span>
                                                            <input type="number" class="form-control campo_preco" name="vl_produto" min="0">
                                                        </div>
                                                        <i class="msg_preco"></i>
                                                    </div>
                                                </td>

                                                <td>&nbsp;&nbsp;&nbsp;</td>

                                                <td style="width: 25%">
                                                    <div>
                                                        <label>Quantidade</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon">0-9</span>
                                                            <input type="number" class="form-control" name="qt_produto" min="0">
                                                        </div>
                                                        <i class="msg_qtd"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <br>

                                        <!-- Laegura, Altura e Peso (Modal) -->
                                        <table style="width: 100%">
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <label>Largura</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-arrows-h"></i></span>
                                                            <input type="number" class="form-control" name="ds_largura" min="0">
                                                        </div>
                                                        <i class="msg_largura"></i>
                                                    </div>
                                                </td>
                                                <td>&nbsp;&nbsp;&nbsp;</td>

                                                <td>
                                                    <div class="form-group">
                                                        <label>Altura</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-arrows-v"></i></span>
                                                            <input type="number" class="form-control" name="ds_altura" min="0">
                                                        </div>
                                                        <i class="msg_altura"></i>
                                                    </div>
                                                </td>
                                                <td>&nbsp;&nbsp;&nbsp;</td>

                                                <td>
                                                    <div class="form-group">
                                                        <label>Peso (g)</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
                                                            <input type="number" class="form-control" name="ds_peso" min="0">
                                                        </div>
                                                        <i class="msg_preco"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>

                                        <!-- Descrição (Modal)  -->
                                        <table style="width: 100%">
                                            <tr>
                                                <td>
                                                    <div>
                                                        <div class="form-group">
                                                            <label>Descrição do Produto</label>
                                                            <div class="input-group">
                                          <textarea id="bold" class="campo_desc" name="ds_produto" rows="5" cols="112%" style="line-height: 40px; border: 1px solid #dddddd; padding: 2px; resize: none"  maxlength="1500">
                                          </textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><p class="msg_desc"></p></td>
                                            </tr>
                                            <tr>
                                                <td><p><span class="qtd_palavras">1500</span> caracteres</p></td>
                                            </tr>
                                        </table>

                                        <!-- Imagens e Status (Modal) -->
                                        <table style="width: 100%">
                                            <tr>
                                                <td>
                                                    <div>
                                                        <div>
                                                            <div class="form-group">
                                                                <label>Imagens</label>
                                                                <div class="input-group">
                                                                    <div class="file-loading">
                                                                        <input id="input-41" name="images[]" type="file" accept="image/*" multiple>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div>
                                                        <div class="box-header"><h3 class="box-title">Ativa/Desativar Produto</h3></div>
                                                        <div class="box-body">
                                                            <div class="form-group">
                                                                <input type="checkbox" class="flat-red campo_status" name="status" checked>
                                                                <label class="">Status</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>

                                        <!-- Botão Salvar (Modal) -->
                                        <div style="width: 100%" class="text-right">
                                            <button type="submit" id="btn_salvar" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                                        </div>
                                    </div>
                                    <!-- / modal-body -->
                                </div>
                                <!-- / modal-content -->
                            </div>
                            <!--/ modal-dialog -->
                        </div>
                        <!-- / modal -->
                        </form>
                </div>
                <!--<div class="box-footer">
                    Footer
                </div>-->
                <!-- /.box-footer-->
            </div>
        </section>
    </div>

    <script src="{{asset('js/admin/jquery.cookie.js')}}"></script>
    <script src="{{asset('js/admin/nanobar.min.js')}}"></script>
    <script src="{{asset('js/admin/jquery.blockUI.js')}}"></script>
    <script>

        //Chama a função de contagem de palavras ao carregar a página
        $(document).ready(function(){

           contadorPalavras();

           $('#categorias').val("");
           $('#subcategorias').val("");

        });

        $('#categorias').change(function (e) {
            e.preventDefault();

            $cd_categoria = $(this).val();

            $.ajax({

                url: '{{ url('/admin/subcat') }}/' + $cd_categoria,
                type: 'GET',
                success: function (data) {

                    $('#subcategorias').empty().append(`<option value=""></option>`);

                    $.each(data.subcat, function(index, subcategoria) {

                        $('#subcategorias').append(`<option value="` + subcategoria.cd_sub_categoria + `">` + subcategoria.nm_sub_categoria + `</option>`);
                    })

                }

            })

        });

        //Validação do campo NOME DO PRODUTO
        $('.campo_nome').blur(function(){
            var campo = $(this).val();
            $('.msg_nome_prod').html("");

            if(campo.length == 0)
                $('.msg_nome_prod').html("Campo obrigatório.").css("color", "red");
        });

        //Validação do campo EAN
        $('#campo_ean').blur(function(){

            var campo = $('#campo_ean').val();
            var regra = /^[0-9]+$/;

            $('.msg_ean').html("");

            if(!campo.match(regra) && campo.length > 0){
                $('.msg_ean').html("Campo deve ser numérico").css("color", "red");
            }
            else if(campo.length < 13 && campo.length > 0) {
                $('.msg_ean').html("Campo deve conter 0 ou 13 caracteres.").css("color", "red");
            }
        });


        //Validação do campo SKU
        $('#campo_sku').blur(function() {

            var campo = $('#campo_sku').val();
            var regra = /^[a-zA-Z0-9]+$/;

            $('.msg_sku').html("");

            if (campo.length == 0) {
                $('.msg_sku').html("Campo obrigatório.").css("color", "red");
            }
            else if (!regra.exec(campo)) {
                $('.msg_sku').html("Proibido caracteres especiais.").css("color", "red");
            }

        });

        //Validação do campo DESCRIÇÃO
        $('.campo_desc').blur(function() {

            var campo = $('.campo_desc').val();

            $('.msg_desc').html("");

            if (campo.length == 0) {
                $('.msg_desc').html("Campo obrigatório.").css("color", "red");
            }
        });

        //Validação do campo PREÇO
        $('.campo_preco').blur(function() {

            var campo = $('.campo_preco').val();

            $('.msg_preco').html("");

            if (campo.length == 0) {
                $('.msg_preco').html("Campo obrigatório.").css("color", "red");
            }
        });

        //Validação do campo CATEGORIA
        $('.campo_cat').blur(function() {

            var campo = $('.campo_cat').val();

            $('.msg_cat').html("");

            if (campo == "") {
                $('.msg_cat').html("Campo obrigatório.").css("color", "red");
            }
        });


        //Contagem de palavras na TextArea da Descrição
        function contadorPalavras() {

            $('.campo_desc').text("");

            $('.campo_desc').on("input", function () {
                var conteudo = $('.campo_desc').val();
                var qtdCaracter = 1500 - conteudo.length;


                $('.qtd_palavras').html(qtdCaracter);

            });
        };

        $('#sl_tamanho_letra').change(function (e) {

            e.preventDefault();

            $selValue = $(this).val();

            if ($selValue != "") {

                $('#sl_tamanho_num').val("");

            }

        });

        $('#sl_tamanho_num').change(function (e) {

            e.preventDefault();

            $selValue = $(this).val();

            if ($selValue != "") {

                $('#sl_tamanho_letra').val("");

            }

        });

        //Abrir o modal ao clicar no botão alterar
        $('#btn_atributos').click(function(e){
            e.preventDefault();

            var my_cookie = $.cookie($('.modal-check').attr('name'));
            if (my_cookie && my_cookie == "true") {
                $(this).prop('checked', my_cookie);
                console.log('checked checkbox');
            }
            else{
                $('#myModal').modal('show');
                console.log('uncheck checkbox');
            }

            $(".modal-check").change(function() {
                $.cookie($(this).attr("name"), $(this).prop('checked'), {
                    path: '/',
                    expires: 1
                });
            });

            //mostrar os campos já digitados no cadastro de produtos dentro do modal
            $('.campo_nome_modal').val($('.campo_nome').val());
            $('.campo_desc_modal').val($('.campo_desc').val());
            $('.campo_ean_modal').val($('#campo_ean').val());
            $('.campo_sku_modal').val($('#campo_sku').val());
            $('.campo_preco_modal').val($('.campo_preco').val());
            $('.campo_cat_modal').val($('.campo_cat').val());
            $('.campo_subcat_modal').val($('.campo_subcat').val());
            $('.campo_qtd_modal').val($('.campo_qtd').val());
            $('.campo_cor_modal').val($('.campo_cor').val());
            $('.campo_tam_letra_modal').val($('.campo_tam_letra').val());
            $('.campo_tam_num_modal').val($('.campo_tam_num').val());
            $('.campo_largura_modal').val($('.campo_largura').val());
            $('.campo_tamanho_modal').val($('.campo_tamanho').val());
            $('.campo_peso_modal').val($('.campo_peso').val());
            $('.campo_peso_modal').val($('.campo_peso1').val());

        });

        //Efeito da barra de progresso ao salvar os dados
       /* $('#btn_salvar').on("submit", function(){
            $.blockUI({
                fadeIn: 1000,
                timeout:   2000,
                onBlock: function() {
                    var confirmacao = confirm('Deseja acessar o menu de atributos do produto?');
                    if(confirmacao)
                        $('#btn_atributos').removeAttr("hidden");

                }
            });
        });*/


    </script>

@stop


