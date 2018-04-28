<div class="content" data-ng-show="ctrl.showReservationList">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">
                            Informacion de la reservacion
                            <button type="button" name="back" class="btn btn-default btn-fill btn-wd mr"
                                    data-ng-click="ctrl.goBackToProductList()" style="float: right;">
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
                                    <label for="">
                                        Cliente: @{{ ctrl.ventaCompletaTO.client.name }} @{{ ctrl.ventaCompletaTO.client.last_name }}
                                        <br>
                                        <span class="label label-warning" style="cursor: pointer;">
                                            Datos Ubicacion <i class="ti-map-alt"></i>
                                        </span>
                                    </label>
                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-12 col-sm-12 col-xs-12 pr-n pl-n">

                                <div class="col-md-6 col-sm-6 col-xs-6 pr-n pl-n">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h4 class="card-title">Fecha Evento</h4>
                                        <div class="input-group">
                                            <input type="text" class="form-control border-input datepicker"/>
                                            <span class="input-group-btn">
                                            <button class="btn btn-info btn-fill date-range-toggle" type="button">
                                                <i class="ti-calendar"></i>
                                            </button>
                                        </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 pr-n pl-n">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h4 class="card-title">Hora Evento</h4>
                                        <div class="input-group">
                                            <input type="text" class="form-control border-input timepicker"/>
                                            <span class="input-group-btn">
                                            <button class="btn btn-info btn-fill date-range-toggle" type="button">
                                                <i class="ti-time"></i>
                                            </button>
                                        </span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-12 col-sm-12 col-xs-12 pr-n pl-n">

                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <label class="bold">Producto</label>
                                    <div class="input-group">
                                        <div class="input-icon">
                                            <input class="form-control" type="text" id="productIdSearch"
                                                   data-ng-model="ctrl.codeProduct" data-ng-enter="ctrl.findProductByCode();">
                                        </div>
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" type="button">
                                                <i class="ti-timer"></i>
                                            </button>
                                        </span>
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