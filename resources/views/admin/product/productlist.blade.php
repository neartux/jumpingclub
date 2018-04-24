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

    <div data-ng-app="AppProduct" data-ng-controller="ProductController as ctrl" data-ng-init="ctrl.init('{{ URL::to('/') }}')">

        <div class="content" data-ng-show="ctrl.showProductList">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">
                                    <i class="ti-dropbox"></i>
                                    Productos
                                    <button class="btn btn-default btn-fill btn-wd" data-ng-click="ctrl.showCreateProduct();"
                                            style="float: right;">
                                        <i class="ti-plus"></i> Nuevo
                                    </button>
                                </h4>
                            </div>
                            <div class="content mt-xl">

                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="form-group">
                                            <label>Tipo Producto</label>
                                            <select class="form-control border-input" data-ng-model="ctrl.productTypeId"
                                                    data-ng-change="ctrl.findProductsByType();">
                                                <option value="0">Selecciona</option>
                                                <option value="@{{ type.id }}" data-ng-repeat="type in ctrl.productTypeList">
                                                    @{{ type.description }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12" data-ng-show="!ctrl.productsList.length">
                                        <div class="alert alert-warning">
                                            <span><b> Info - </b> No se encontraron productos</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12" data-ng-show="ctrl.productsList.length">
                                        <!-- <table class="table table-striped table-bordered"> -->
                                        <table dt-column-defs="ctrl.dtColumnDefs" datatable="ng" dt-instance="ctrl.dtInstance"
                                               dt-options="ctrl.dtOptions" class="table table-bordered table-striped table-condensed">
                                            <thead>
                                            <tr>
                                                <th width="5%" class="bold">#</th>
                                                <th width="25%" class="bold">Nombre</th>
                                                <th class="bold">Descripcion</th>
                                                <th width="8%" class="bold">Precio Compra</th>
                                                <th width="8%" class="bold">Precio Renta</th>
                                                <th width="15%" class="bold">Medidas</th>
                                                <th width="20%" class="bold">Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr data-ng-repeat="product in ctrl.productsList">
                                                    <td>@{{ $index + 1 }}</td>
                                                    <td>@{{ product.name }}</td>
                                                    <td>@{{ product.description }}</td>
                                                    <td>@{{ product.purchase_price | currency }}</td>
                                                    <td>@{{ product.sale_price | currency }}</td>
                                                    <td>@{{ product.area }}</td>
                                                    <td>
                                                        <a href="javascript:;" class="btn btn-simple btn-info btn-icon like"
                                                           title="Editar @{{ product.name }}" data-ng-click="ctrl.showEditProduct(product);">
                                                            <i class="ti-pencil-alt"></i>
                                                        </a>
                                                        <a href="javascript:;" class="btn btn-simple btn-warning btn-icon like"
                                                           title="Publicar @{{ product.name }}"
                                                           data-ng-show="product.public == 0" data-ng-click="ctrl.publicProduct(product, true);">
                                                            <i class="ti-world"></i>
                                                        </a>
                                                        <a href="javascript:;" class="btn btn-simple btn-success btn-icon like"
                                                           title="Despublicar @{{ product.name }}"
                                                           data-ng-show="product.public == 1" data-ng-click="ctrl.publicProduct(product, false);">
                                                            <i class="ti-world"></i>
                                                        </a>
                                                        <a href="javascript:;" class="btn btn-simple btn-danger btn-icon like"
                                                           title="Eliminar @{{ product.name }}"
                                                           data-ng-click="ctrl.deleteProduct($index, product.id);">
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

        <div class="content" data-ng-show="!ctrl.showProductList">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">
                                    Informacion de producto
                                    <button type="button" name="back" class="btn btn-default btn-fill btn-wd mr"
                                            data-ng-click="ctrl.goBackToProductList()" style="float: right;">
                                        <i class="ti-back-left"></i> Regresar</button>
                                </h4>
                            </div>
                            <div class="content mt-xl">

                                @include('admin/product/productform')


                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>


@endsection

@section('script-section')

    <script src="{{ asset('assets/global/plugins/angularjs/angular-file-upload/angular-file-upload.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/angularjs/angular-file-upload/AngularFileUploadController.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/angularjs/angular-file-upload/directives.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/form-jasnyupload/fileinput.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/angular-datatable/angular-datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/scripts/product/ProductProvider.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/scripts/product/ProductController.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/scripts/product/AppProduct.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            initFieldsNumeric();
        });

        function initFieldsNumeric() {
            $(".numeric-field").numeric({
                allowPlus           : false,
                allowMinus          : false,
                allowThouSep        : false,
                allowDecSep         : true,
                allowLeadingSpaces  : false,
                maxDigits           : 10,
                maxDecimalPlaces    : 2,
                maxPreDecimalPlaces : NaN,
                max                 : NaN,
                min                 : NaN
            });
        }
    </script>
@endsection