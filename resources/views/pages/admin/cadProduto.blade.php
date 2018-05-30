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
                    <form>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Ean</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                    <input type="text" class="form-control" name="eanProduto">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Produto</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                                    <input type="text" class="form-control" name="nProduto">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Descrição</label>
                                <div class="input-group">
                                    <textarea id="bold" name="descProduto" rows="2" cols="138%" style="font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 2px;">
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Preço</label>
                                <div class="input-group">
                                    <span class="input-group-addon">R$</span>
                                    <input type="number" class="form-control"  name="precoProduto">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Categoria</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <select class="form-control select2" style="width: 100%;" name="catProduto" >
                                    <option selected="selected">Alabama</option>
                                    <option>Alaska</option>
                                    <option>California</option>
                                    <option>Delaware</option>
                                    <option>Tennessee</option>
                                    <option>Texas</option>
                                    <option>Washington</option>
                                </select>
                            </div>

                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Multiple</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-outdent"></i></span>
                                    <select class="form-control select2" multiple="multiple" style="width: 100%;" name="subcatProduto">
                                        <option>Alabama</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                    </select>
                                </div>
                            </div>
                    </div>
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <label>Cor</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-paint-brush"></i></span>
                                    <select class="form-control select2" style="width: 100%;" name="catProduto" >
                                        <option selected="selected"></option>
                                        <option>Azul</option>
                                        <option>Branco</option>
                                        <option>Preto</option>
                                        <option>Nude</option>
                                        <option>Rosa</option>
                                        <option>Vinho</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <label>Tamanho</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                    <select class="form-control select2" style="width: 100%;" name="catProduto" >
                                        <option selected="selected"></option>
                                        <option>PP</option>
                                        <option>P</option>
                                        <option>M</option>
                                        <option>G</option>
                                        <option>GG</option>
                                        <option>XG</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Imagens</label>
                                    <div class="input-group">
                                        <div class="file-loading">
                                            <input id="input-41" name="input41[]" type="file" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="box-header"><h3 class="box-title">Ativa/Desativar Produto</h3></div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <input type="checkbox" class="flat-red" checked>
                                        <label class="">Status</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                    </form>
                </div>
                <!--<div class="box-footer">
                    Footer
                </div>-->
                <!-- /.box-footer-->
            </div>
        </section>
    </div>
@stop