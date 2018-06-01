@extends('layouts.admin.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
              <div class="content-wrapper">
    <!-- Content Header (Page header) -->

                    <section class="content-header">
                       <h1>
                          Categorias/Sub-Categorias
                       </h1>
                         <ol class="breadcrumb">
                              <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                              <li><a class="active">Categoria/Sub-Categoria</a></li>
                        </ol>
                    </section>

                    <section id="content" class="content">

                        <!--CATEGORIA-->

                        <div class="col-md-6">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12">


                                             <div class="col-md-6">
                                                <label>Principal</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-tag"></i>
                                                    </div>
                                                    <input type="text" class="form-control">
                                                </div>
                                             </div>

                                            <form id="fCat" class="form-horizontal" action="#" method="post">
                                                <div class="col-md-6">
                                                    <label>Alterar Categoria</label>
                                                    <input class="form-control" type="hidden" id="catId" name="catId">
                                                    <input type="text" class="form-control" id="catName" name="catName" maxlength="35">
                                                </div>

                                                <p><p><p>
                                                <div class="col-md-6">
                                                    <label>Sub-Categoria</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-tags"></i>
                                                        </div>
                                                        <input type="text" class="form-control">
                                                    </div>

                                                </div>
                                                <button type="submit" class="btn btn-success pull-right" style="margin-top: 5% !important;">Salvar</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer box-info"></div>
                            </div>
                        </div>

                        <!--SUB-CATEGORIA-->

                        <div class="col-md-6">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Sub-Catagoria</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-tags"></i>
                                                        </div>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <form id="fSubCat" class="form-horizontal" action="#" method="post">
                                                <div class="col-md-6">
                                                    <div class="form-group has-success">
                                                        <label><br></label>
                                                        <input class="form-control" type="hidden" id="subCatId" name="subCatId">
                                                        <input type="text" class="form-control" id="subCatName" name="subCatName" maxlength="35">
                                                        <label class="control-label" hidden for="inputSuccess"><i class="fa fa-check"></i></label>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-success pull-right">Salvar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </section>
              </div>



@stop