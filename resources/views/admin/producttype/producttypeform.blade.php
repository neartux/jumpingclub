<div class="content" data-ng-show="!ctrl.showProductTypeList">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">
                            <i class="ti-tag"></i>
                            Datos Categoria
                            <button type="button" name="back" class="btn btn-default btn-fill btn-wd mr"
                                    data-ng-click="ctrl.showProductTypeList = true;" style="float: right;">
                                <i class="ti-back-left"></i> Regresar</button>
                        </h4>
                    </div>
                    <div class="content mt-xl">

                        <div class="row">
                            <div class="col-sm-12">
                                <form class="form-horizontal form-row-seperated" name="productTypeForm" novalidate>
                                    <div class="form-body mt-xl">

                                        <div class="col-md-6 col-sm-6 col-xs-12">

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Descripción:
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control border-input" name="description" data-ng-model="ctrl.productType.description"
                                                           required>
                                                    <span ng-show="productTypeForm.description.$invalid && !productTypeForm.description.$pristine"
                                                          class="text-danger">La descripción es requerida.</span>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-6 col-sm-6 col-xs-12">

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">&nbsp;</label>
                                                <div class="col-md-6">
                                                    <a href="javascript:;" class="btn btn-info btn-fill btn-wd" style="float: right;"
                                                       data-ng-click="ctrl.validateProductType(productTypeForm.$valid);"
                                                       data-ng-disabled="productTypeForm.$invalid">
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