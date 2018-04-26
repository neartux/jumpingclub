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

    <div data-ng-app="Client" data-ng-controller="ClientController as ctrl" data-ng-init="ctrl.init('{{ URL::to('/') }}')">

        <div class="content" data-ng-show="ctrl.showClientList">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">
                                    <i class="ti-user"></i>
                                    Clientes
                                    <button class="btn btn-default btn-fill btn-wd" data-ng-click="ctrl.showCreateClient();"
                                            style="float: right;">
                                        <i class="ti-plus"></i> Nuevo
                                    </button>
                                </h4>
                            </div>
                            <div class="content mt-xl">

                                <div class="row">

                                    <div class="col-md-12 col-sm-12 col-xs-12" data-ng-show="!ctrl.reservationList.length">
                                        <div class="alert alert-warning">
                                            <span><b> Info - </b> No se encontraron clientes</span>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12" data-ng-show="ctrl.clientList.length">

                                        <table dt-column-defs="ctrl.dtColumnDefs" datatable="ng" dt-instance="ctrl.dtInstance"
                                               dt-options="ctrl.dtOptions" class="table table-bordered table-striped table-condensed">
                                            <thead>
                                            <tr>
                                                <th width="5%" class="bold">#</th>
                                                <th width="30%" class="bold">Nombre</th>
                                                <th class="bold">Dirección</th>
                                                <th class="bold">Colonia/Municipio</th>
                                                <th width="15%" class="bold">Teléfono</th>
                                                <th width="15%" class="bold">Celular</th>
                                                <th width="15%" class="bold">Correo</th>
                                                <th width="10%" class="bold">Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr data-ng-repeat="client in ctrl.clientList">
                                                <td>@{{ $index + 1 }}</td>
                                                <td>@{{ client.name }} @{{ client.last_name }}</td>
                                                <td>@{{ client.address }}</td>
                                                <td>@{{ client.colonia }}</td>
                                                <td>@{{ client.phone }}</td>
                                                <td>@{{ client.cell_phone }}</td>
                                                <td>@{{ client.email }}</td>
                                                <td>
                                                    <a href="javascript:;" class="btn btn-simple btn-info btn-icon like"
                                                       title="Editar @{{ client.name }} @{{ client.last_name }}"
                                                       data-ng-click="ctrl.showUpdateClient(client, $index);">
                                                        <i class="ti-pencil-alt"></i>
                                                    </a>
                                                    <a href="javascript:;" class="btn btn-simple btn-danger btn-icon like"
                                                       title="Eliminar @{{ product.name }} @{{ client.last_name }}"
                                                       data-ng-click="ctrl.deleteClient(client.id, $index);">
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

        @include('admin/client/clientform')

    </div>


@endsection

@section('script-section')

    <script src="{{ asset('assets/global/plugins/angular-datatable/angular-datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/scripts/client/ClientProvider.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/scripts/client/ClientController.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function () {

        });
    </script>
@endsection