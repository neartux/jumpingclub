<div class="row" nv-file-drop="" uploader="uploader" id="ng-app"
     data-ng-controller="AngularFileUploadController as ctrlFile">

    <div class="col-md-12 col-sm-12 col-xs-12">

        <form class="form-horizontal form-row-seperated" name="productForm" novalidate>

            <div class="tabbable-bordered">
                <ul class="nav nav-tabs">
                    <li class="active initialTab" data-ng-click="ctrl.isTabImages = false;">
                        <a href="#tab_general" data-toggle="tab"> General </a>
                    </li>
                    <li data-ng-click="ctrlFile.setProductId(ctrl.product.id);ctrl.isTabImages = true;"
                        data-ng-show="!ctrl.isCreateProcess" class="secondTab">
                        <a href="#tab_images" data-toggle="tab"> Images </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active initialTab" id="tab_general">
                        <div class="form-body mt-xl">

                            <div class="col-md-6 col-sm-6 col-xs-12">

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Tipo Producto:
                                        <span class="required"> * </span></label>
                                    <div class="col-md-6">
                                        <select class="form-control border-input" data-ng-model="ctrl.product.product_type_id"
                                                required name="productType">
                                            <option value="">Selecciona</option>
                                            <option value="@{{ type.id }}" data-ng-repeat="type in ctrl.productTypeList">
                                                @{{ type.description }}
                                            </option>
                                        </select>
                                        <span ng-show="productForm.productType.$invalid && !productForm.productType.$pristine"
                                              class="text-danger">Selecciona un tipo de producto.</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nombre:
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control border-input" name="name" data-ng-model="ctrl.product.name"
                                                required>
                                        <span ng-show="productForm.name.$invalid && !productForm.name.$pristine"
                                              class="text-danger">El nombre es requerido.</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Descripción:
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control border-input" name="description"
                                               data-ng-model="ctrl.product.description" required>
                                        <span ng-show="productForm.description.$invalid && !productForm.description.$pristine"
                                              class="text-danger">La descripción es requerido.</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Dimensiones:
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control border-input" name="dimensions"
                                               data-ng-model="ctrl.product.area" required>
                                        <span ng-show="productForm.dimensions.$invalid && !productForm.dimensions.$pristine"
                                              class="text-danger">La dimensión es requerido.</span>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Precio Compra:
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control border-input numeric-field" name="purchase_price"
                                               data-ng-model="ctrl.product.purchase_price" required>
                                        <span ng-show="productForm.purchase_price.$invalid && !productForm.purchase_price.$pristine"
                                              class="text-danger">El precio compra es requerido.</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Precio Renta:
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control border-input numeric-field" name="sale_price"
                                               data-ng-model="ctrl.product.sale_price" required>
                                        <span ng-show="productForm.sale_price.$invalid && !productForm.sale_price.$pristine"
                                              class="text-danger">El precio renta es requerido.</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Stock:
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control border-input numeric-field" name="stock"
                                               data-ng-model="ctrl.product.stock" required>
                                        <span ng-show="productForm.stock.$invalid && !productForm.stock.$pristine"
                                              class="text-danger">El stock es requerido.</span>
                                    </div>
                                </div>

                                <a href="javascript:;" class="btn btn-info btn-fill btn-wd" style="float: right;"
                                        data-ng-show="!ctrl.isTabImages"
                                        data-ng-click="ctrl.validateProduct(productForm.$valid);"
                                        data-ng-disabled="productForm.$invalid">
                                    <i class="ti-save"></i> Guardar
                                </a>

                            </div>

                        </div>
                    </div>

                    <div class="tab-pane secondTab" id="tab_images">

                        <div class="col-md-3">

                            <h5 class="bold">Seleccionar imagenes</h5>

                            <div ng-show="uploader.isHTML5">
                                <!-- 3. nv-file-over uploader="link" over-class="className" -->
                                <div class="well my-drop-zone" nv-file-over="" uploader="uploader">
                                    Arrastrar imagenes
                                </div>
                            </div>

                            <!-- Example: nv-file-select="" uploader="{Object}" options="{Object}" filters="{String}" -->
                            <div class="form-group">
                                <div class="col-sm-8">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <input type="file" nv-file-select="" uploader="uploader" multiple/>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-9" style="margin-bottom: 40px" data-ng-show="uploader.queue.length">
                            <h3>Lista de imagenes</h3>
                            <p>Num. @{{ uploader.queue.length }}</p>

                            <table class="table">
                                <thead>
                                <tr>
                                    <th width="50%">imagen</th>
                                    <th ng-show="uploader.isHTML5">Tamaño</th>
                                    <th ng-show="uploader.isHTML5">Progreso</th>
                                    <th>Status</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="item in uploader.queue">
                                    @{{ item |json }}
                                    <td>
                                        <strong>@{{ item.file.name }}</strong>
                                        <!-- Image preview -->
                                        <!--auto height-->
                                        <!--<div ng-thumb="{ file: item.file, width: 100 }"></div>-->
                                        <!--auto width-->
                                        <div ng-show="uploader.isHTML5" ng-thumb="{ file: item._file, height: 100 }"></div>
                                        <!--fixed width and height -->
                                        <!--<div ng-thumb="{ file: item.file, width: 100, height: 100 }"></div>-->
                                    </td>
                                    <td ng-show="uploader.isHTML5" nowrap>@{{ item.file.size/1024/1024|number:2 }} MB</td>
                                    <td ng-show="uploader.isHTML5">
                                        <div class="progress" style="margin-bottom: 0;">
                                            <div class="progress-bar" role="progressbar" ng-style="{ 'width': item.progress + '%' }"></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span ng-show="item.isSuccess"><i class="glyphicon glyphicon-ok"></i></span>
                                        <span ng-show="item.isCancel"><i class="glyphicon glyphicon-ban-circle"></i></span>
                                        <span ng-show="item.isError"><i class="glyphicon glyphicon-remove"></i></span>
                                    </td>
                                    <td nowrap>
                                        <button type="button" class="btn btn-success btn-fill btn-xs" ng-click="item.upload();ctrlTour.findImagesByTour();" ng-disabled="item.isReady || item.isUploading || item.isSuccess">
                                            <span class="ti-upload"></span> Upload
                                        </button>
                                        <button type="button" class="btn btn-warning btn-fill btn-xs" ng-click="item.cancel()" ng-disabled="!item.isUploading">
                                            <span class="ti-close"></span> Cancelar
                                        </button>
                                        <button type="button" class="btn btn-danger btn-fill btn-xs" ng-click="item.remove()">
                                            <span class="ti-trash"></span> Eliminar
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <div>
                                <div>
                                    Progreso de carga:
                                    <div class="progress" style="">
                                        <div class="progress-bar" role="progressbar" ng-style="{ 'width': uploader.progress + '%' }"></div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success btn-fill btn-s" ng-click="uploader.uploadAll();ctrlTour.findImagesByTour();" ng-disabled="!uploader.getNotUploadedItems().length">
                                    <span class="ti-upload"></span> Subir todos
                                </button>
                                <button type="button" class="btn btn-warning btn-fill btn-s" ng-click="uploader.cancelAll()" ng-disabled="!uploader.isUploading">
                                    <span class="ti-close"></span> Cancelar todos
                                </button>
                                <button type="button" class="btn btn-danger btn-fill btn-s" ng-click="uploader.clearQueue()" ng-disabled="!uploader.queue.length">
                                    <span class="ti-trash"></span> Eliminar Todos
                                </button>
                            </div>

                        </div>


                        <table class="table table-bordered table-hover" data-ng-show="ctrl.listProductImages.length">
                            <thead>
                            <tr role="row" class="heading">
                                <th width="8%"> Imagen </th>
                                <th width="20%"> Nombre </th>
                                <th width="8%"> Orden </th>
                                <th width="5%"> Principal </th>
                                <th width="20%"> Acciones </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr data-ng-repeat="image in ctrl.listProductImages">
                                <td>
                                    <img class="img-responsive" data-ng-src="/images/@{{ image.product_id }}/@{{ image.name }}" alt="@{{ image.name }}">
                                </td>
                                <td>
                                    @{{ image.name }}
                                </td>
                                <td>
                                    <span data-ng-show="!image.editOrder">
                                        @{{ image.order }}
                                    </span>
                                    <span data-ng-show="image.editOrder">
                                        <input type="text" class="form-control border-input numeric-field"
                                               data-ng-model="ctrl.listProductImages[$index].orderN" value="@{{ image.orderN }}">
                                    </span>
                                </td>
                                <td>
                                    <label>
                                        <input type="radio" name="mainRadio" data-ng-model="ctrl.mainImageRadio"
                                               value="@{{ ctrl.listProductImages[$index].main }}" data-ng-click="ctrl.setPrincipalImage($index);">
                                    </label>
                                </td>
                                <td>
                                    <a href="javascript:;" class="btn btn-success btn-sm btn-fill"
                                       data-ng-show="!image.editOrder && !ctrl.blockEditAllImages" data-ng-disabled=""
                                       data-ng-click="image.editOrder = true;ctrl.blockEditAllImages = true;image.orderN = image.order;">
                                        <i class="ti-pencil-alt"></i> Editar
                                    </a>
                                    <a href="javascript:;" class="btn btn-success btn-sm btn-fill"
                                       data-ng-show="image.editOrder"
                                       data-ng-click="ctrl.saveOrderImage(image);">
                                        <i class="ti-save-alt"></i> Save
                                    </a>
                                    <a href="javascript:;" class="btn btn-danger btn-sm btn-fill" data-ng-click="ctrl.deleteImage($index);">
                                        <i class="ti-trash"></i> Eliminar
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </form>

    </div>
</div>