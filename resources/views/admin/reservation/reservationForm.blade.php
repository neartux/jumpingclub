<div class="content" data-ng-show="!ctrl.showReservationList && !ctrl.showClientData">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">
                            Informacion de la reservacion
                            <button type="button" name="back" class="btn btn-default btn-fill btn-wd mr"
                                    data-ng-click="ctrl.showReservationList = true;" style="float: right;">
                                <i class="ti-back-left"></i> Regresar</button>
                        </h4>
                    </div>
                    <div class="content mt-xl">

                        <div class="row">

                            <div class="col-md-12 col-sm-12 col-xs-12 pr-n pl-n">

                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <label class="bold">Cliente</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="clientId"
                                               data-ng-model="ctrl.ventaCompletaTO.client.completeName">
                                        <span class="input-group-btn">
                                                <button class="btn blue" type="button">
                                                    <i class="ti-user"></i>
                                                </button>
                                            </span>
                                    </div>
                                    <label for="" data-ng-show="ctrl.ventaCompletaTO.client.id">
                                        <span class="label label-warning" data-ng-click="ctrl.changeAddress();"
                                              style="cursor: pointer;">
                                            Datos Envio <i class="ti-map-alt"></i>
                                        </span>
                                    </label>
                                </div>

                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <label class="bold">Fecha Evento</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control border-input date-picker"/>
                                        <span class="input-group-btn">
                                            <button class="btn btn-info btn-fill date-range-toggle" type="button">
                                                <i class="ti-calendar"></i>
                                            </button>
                                        </span>
                                    </div>

                                </div>

                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <label class="bold">Hora Evento</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control border-input timepicker timepicker-no-seconds"/>
                                        <span class="input-group-btn">
                                            <button class="btn btn-info btn-fill date-range-toggle" type="button">
                                                <i class="ti-time"></i>
                                            </button>
                                        </span>
                                    </div>

                                </div>

                        </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <hr>
                                </div>
                            </div>

                        <div class="row">

                            <div class="col-md-12 col-sm-12 col-xs-12">

                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <label class="bold">Producto</label>
                                    <div class="input-group">
                                        <div class="input-icon">
                                            <input class="form-control" type="text" id="productIdSearch"
                                                   data-ng-model="ctrl.codeProduct" data-ng-enter="ctrl.findProductByCode();">
                                        </div>
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" type="button">
                                                <i class="ti-dropbox"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="row" data-ng-show="ctrl.ventaCompletaTO.products.length">
                            <div class="col-sm-12">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Precio</th>
                                        <th>Panel</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr data-ng-repeat="product in ctrl.ventaCompletaTO.products">
                                        <td>@{{ $index + 1 }}</td>
                                        <td>@{{ product.name }}</td>
                                        <td>@{{ product.description }}</td>
                                        <td>@{{ product.sale_price | currency }}</td>
                                        <td>
                                            <a class="btn btn-danger" title="Eliminar" data-ng-click="ctrl.removeFromSale($index);">
                                                <i class="ti-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-right bold">TOTAL</td>
                                        <td>
                                            <span class="bold">
                                                @{{ ctrl.ventaCompletaTO.total | currency }}
                                            </span>
                                        </td>
                                        <td></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="row mt-lg" data-ng-show="ctrl.ventaCompletaTO.products.length">
                            <div class="col-sm-12">
                                <div class="col-sm-6">
                                    <textarea data-ng-model="ctrl.ventaCompletaTO.comments"></textarea>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <button class="btn btn-success" data-ng-click="ctrl.createSale();">
                                        Crear Reservación
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
</div>


<div class="content" data-ng-show="ctrl.showClientData">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">
                            <i class="ti-user"></i>
                            Datos Envio
                            <button type="button" name="back" class="btn btn-default btn-fill btn-wd mr"
                                    data-ng-click="ctrl.showClientData = false;" style="float: right;">
                                <i class="ti-back-left"></i> Regresar</button>
                        </h4>
                    </div>
                    <div class="content mt-xl">

                        <div class="row">
                            <div class="col-sm-12">
                                <form class="form-horizontal form-row-seperated" name="clientForm" novalidate>
                                    <div class="form-body mt-xl">

                                        <div class="col-md-6 col-sm-6 col-xs-12">

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Nombres:
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control border-input" name="name" data-ng-model="ctrl.clientView.name"
                                                           required>
                                                    <span ng-show="clientForm.name.$invalid && !clientForm.name.$pristine"
                                                          class="text-danger">Los nombres son requeridos.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Apellidos:
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control border-input" name="last_name"
                                                           data-ng-model="ctrl.clientView.last_name" required>
                                                    <span ng-show="clientForm.last_name.$invalid && !clientForm.last_name.$pristine"
                                                          class="text-danger">Los apellidos son requeridos.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Dirección:
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control border-input" name="address"
                                                           data-ng-model="ctrl.clientView.address" required>
                                                    <span ng-show="clientForm.address.$invalid && !clientForm.address.$pristine"
                                                          class="text-danger">La dirección es requerido.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Colonia/Municipio:
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control border-input" name="colonia"
                                                           data-ng-model="ctrl.clientView.colonia" required>
                                                    <span ng-show="clientForm.colonia.$invalid && !clientForm.colonia.$pristine"
                                                          class="text-danger">La colonia es requerido.</span>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-6 col-sm-6 col-xs-12">

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Teléfono:
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control border-input" name="phone"
                                                           data-ng-model="ctrl.clientView.phone">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Celular:
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control border-input" name="cell_phone"
                                                           data-ng-model="ctrl.clientView.cell_phone" required>
                                                    <span ng-show="clientForm.cell_phone.$invalid && !clientForm.cell_phone.$pristine"
                                                          class="text-danger">El celular es requerido.</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Correo Eléctronico:
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control border-input" name="email"
                                                           data-ng-model="ctrl.clientView.email">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">&nbsp;</label>
                                                <div class="col-md-6">
                                                    <a href="javascript:;" class="btn btn-info btn-fill btn-wd" style="float: right;"
                                                       data-ng-click="ctrl.validateDatosEnvio(clientForm.$valid);"
                                                       data-ng-disabled="clientForm.$invalid">
                                                        <i class="ti-save"></i> Actualizar
                                                    </a>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>
    </div>
</div>