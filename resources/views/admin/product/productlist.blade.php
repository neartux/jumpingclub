@extends('admin.layouts.app')

@section('content')

    <div data-ng-app="AppProduct" data-ng-controller="ProductController as ctrl" data-ng-init="ctrl.init('{{ URL::to('/') }}')">

        <div class="content" data-ng-show="ctrl.showProductList">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">
                                    Productos
                                    <button class="btn btn-default btn-fill btn-wd" data-ng-click="ctrl.showProductForm();"
                                            style="float: right;">
                                        <i class="ti-plus"></i> Nuevo
                                    </button>
                                </h4>
                            </div>
                            <div class="content mt-xl">

                                <div class="row">
                                    <div class="col-md-12">

                                        <table class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre</th>
                                                <th>Descripcion</th>
                                                <th>Precio</th>
                                                <th>Medidas</th>
                                                <th>Acciones</th>
                                            </tr>
                                            </thead>
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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">
                                    Informacion de producto
                                    <button class="btn btn-info btn-fill btn-wd" style="float: right;">
                                        <i class="ti-save"></i> Guardar</button>
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
    <script src="{{ asset('assets/scripts/product/ProductProvider.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/scripts/product/ProductController.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/scripts/product/AppProduct.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function () {


        });
    </script>
@endsection