@extends('layouts.admin.app')

@section('content')



    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Lista de Produtos
                <small>(Celestial Moda Evangélica)</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Produtos</a></li>
                <li class="active">Listar Produtos</li>
            </ol>
        </section>

        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                                title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">

            <!-- Botão pesquisar -->

                    <div class="row">
                        <div class="col-md-6">
                            <input type="search" id="search" value="" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="dataTables_length" id="example1_length">
                            <select name="example1_length" aria-controls="example1" class="form-control form-control-sm">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>

            <!-- lista de produtos -->

                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table" id="table">
                                <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th>SKU</th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Preço</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($produtos as $produto)

                                    <tr>
                                        <td>{{ $produto->cd_produto }} </td>
                                        <td>{{ $produto->nm_produto }} </td>
                                        <td>{{ $produto->nm_produto }} </td>
                                        <td>{{ $produto->ds_produto }} </td>
                                        <td>{{ $produto->vl_produto }} </td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                            <hr>
                        </div>
                    </div>
                </div>
               </div>
                <!-- /.box-body -->
                <div class="box-footer hidden">

                </div>
                <!-- /.box-footer-->

            <!-- /.box -->

        </section>
    </div>

    <script>
        $(function () {
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
            })
        });
    </script>

    <script src="//rawgithub.com/stidges/jquery-searchable/master/dist/jquery.searchable-1.0.0.min.js"></script>
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap4.js"></script>
    <!-- SlimScroll -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- page script -->

    <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>

@stop
