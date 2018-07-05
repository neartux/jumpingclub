@extends('admin.layouts.app')

@section('content')

    <style>
        #DataTables_Table_0_length, #DataTables_Table_0_filter {
            display: inline;
        }
        #DataTables_Table_0_filter {
            float: right;
        }
    </style>

    <div data-ng-app="ProductType" data-ng-controller="ProductTypeController as ctrl" data-ng-init="ctrl.init('{{ URL::to('/') }}')">

        <div class="content" data-ng-show="ctrl.showProductTypeList">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">
                                    <i class="ti-tag"></i>
                                    Categorias
                                    <button class="btn btn-default btn-fill btn-wd" data-ng-click="ctrl.showCreateProductType();"
                                            style="float: right;">
                                        <i class="ti-plus"></i> Nuevo
                                    </button>
                                </h4>
                            </div>
                            <div class="content mt-xl">

                                <div class="row">

                                    <div class="col-md-12 col-sm-12 col-xs-12" data-ng-show="!ctrl.productTypeList.length">
                                        <div class="alert alert-warning">
                                            <span><b> Info - </b> No se encontraron categorias</span>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12" data-ng-show="ctrl.productTypeList.length">

                                        <table dt-column-defs="ctrl.dtColumnDefs" datatable="ng" dt-instance="ctrl.dtInstance"
                                               dt-options="ctrl.dtOptions" class="table table-bordered table-striped table-condensed">
                                            <thead>
                                            <tr>
                                                <th width="5%" class="bold">#</th>
                                                <th class="bold">Descripción</th>
                                                <th width="10%" class="bold">Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr data-ng-repeat="productType in ctrl.productTypeList">
                                                <td>@{{ $index + 1 }}</td>
                                                <td>@{{ productType.description }}</td>
                                                <td>
                                                    <a href="javascript:;" class="btn btn-simple btn-info btn-icon like"
                                                       title="Editar @{{ productType.description }}"
                                                       data-ng-click="ctrl.showUpdateProductType(productType, $index);">
                                                        <i class="ti-pencil-alt"></i>
                                                    </a>
                                                    <a href="javascript:;" class="btn btn-simple btn-danger btn-icon like"
                                                       title="Eliminar @{{ productType.description }}"
                                                       data-ng-click="ctrl.deleteProductType(productType.id, $index);">
                                                        <i class="ti-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @include('admin/producttype/producttypeform')

    </div>


@endsection

@section('script-section')

    <script src="{{ asset('assets/global/plugins/angular-datatable/angular-datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/scripts/producttype/ProductTypeProvider.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/scripts/producttype/ProductTypeController.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function () {

        });
    </script>
@endsection