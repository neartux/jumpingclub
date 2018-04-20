<div class="row" nv-file-drop="" uploader="uploader" id="ng-app"
     data-ng-controller="AngularFileUploadController as ctrlFile">

    <div class="col-md-12 col-sm-12 col-xs-12">

        <form class="form-horizontal form-row-seperated" action="#" name="productForm" novalidate>

            <div class="tabbable-bordered">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab_general" data-toggle="tab"> General </a>
                    </li>
                    <li data-ng-click="ctrlFile.setProductId(ctrl.product.id);">
                        <a href="#tab_images" data-toggle="tab"> Images </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_general">
                        <div class="form-body mt-xl">

                            <div class="col-md-6 col-sm-6 col-xs-12">

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Tipo Producto:
                                        <span class="required"> * </span></label>
                                    <div class="col-md-6">
                                        <select class="form-control border-input" data-ng-model="ctrl.product.product_type_id">
                                            <option value="">Selecciona</option>
                                            <option value="@{{ type.id }}" data-ng-repeat="type in ctrl.productTypeList">
                                                @{{ type.description }}
                                            </option>
                                        </select>
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
                                        <input type="text" class="form-control border-input" name="description" data-ng-model="ctrl.product.description">
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Area:
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control border-input" name="area" data-ng-model="ctrl.product.area">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Precio:
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control border-input" name="price" data-ng-model="ctrl.product.price">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Stock:
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control border-input" name="tock" data-ng-model="ctrl.product.stock">
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="tab-pane" id="tab_images">

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
                                        <input type="file" nv-file-select="" uploader="uploader" multiple  />
                                        <span class="fileinput-filename"></span>
                                        <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
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


                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr role="row" class="heading">
                                <th width="8%"> Image </th>
                                <th width="25%"> Label </th>
                                <th width="8%"> Sort Order </th>
                                <th width="10%"> Base Image </th>
                                <th width="10%"> Small Image </th>
                                <th width="10%"> Thumbnail </th>
                                <th width="10%"> </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <a href="../assets/pages/media/works/img1.jpg" class="fancybox-button" data-rel="fancybox-button">
                                        <img class="img-responsive" src="../assets/pages/media/works/img1.jpg" alt=""> </a>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="product[images][1][label]" value="Thumbnail image"> </td>
                                <td>
                                    <input type="text" class="form-control" name="product[images][1][sort_order]" value="1"> </td>
                                <td>
                                    <label>
                                        <input type="radio" name="product[images][1][image_type]" value="1"> </label>
                                </td>
                                <td>
                                    <label>
                                        <input type="radio" name="product[images][1][image_type]" value="2"> </label>
                                </td>
                                <td>
                                    <label>
                                        <input type="radio" name="product[images][1][image_type]" value="3" checked> </label>
                                </td>
                                <td>
                                    <a href="javascript:;" class="btn btn-default btn-sm">
                                        <i class="fa fa-times"></i> Remove </a>
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