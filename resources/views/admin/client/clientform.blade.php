<div class="content" data-ng-show="!ctrl.showClientList">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">
                            <i class="ti-user"></i>
                            Datos Cliente
                            <button type="button" name="back" class="btn btn-default btn-fill btn-wd mr"
                                    data-ng-click="ctrl.showClientList = true;" style="float: right;">
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
                                                <input type="text" class="form-control border-input" name="name" data-ng-model="ctrl.client.name"
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
                                                       data-ng-model="ctrl.client.last_name" required>
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
                                                       data-ng-model="ctrl.client.address" required>
                                                <span ng-show="clientForm.address.$invalid && !clientForm.address.$pristine"
                                                      class="text-danger">La dirección es requerido.</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Colonia/Municipio:
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control border-input numeric-field" name="colonia"
                                                       data-ng-model="ctrl.client.colonia" required>
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
                                                <input type="text" class="form-control border-input numeric-field" name="phone"
                                                       data-ng-model="ctrl.client.phone">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Celular:
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control border-input numeric-field" name="cell_phone"
                                                       data-ng-model="ctrl.client.cell_phone" required>
                                                <span ng-show="clientForm.cell_phone.$invalid && !clientForm.cell_phone.$pristine"
                                                      class="text-danger">El celular es requerido.</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Correo Eléctronico:
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control border-input numeric-field" name="email"
                                                       data-ng-model="ctrl.client.email">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">&nbsp;</label>
                                            <div class="col-md-6">
                                                <a href="javascript:;" class="btn btn-info btn-fill btn-wd" style="float: right;"
                                                   data-ng-click="ctrl.validateClient(clientForm.$valid);"
                                                   data-ng-disabled="clientForm.$invalid">
                                                    <i class="ti-save"></i> Guardar
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