(function (){
    var app = angular.module('ProductType', ['ProductTypeProvider', 'datatables']);

    app.controller('ProductTypeController', function($scope, $http, ProductTypeService, DTOptionsBuilder, DTColumnDefBuilder) {
        var ctrl = this;
        ctrl.productTypeList = [];
        ctrl.productType = {};
        ctrl.showProductTypeList = true;
        ctrl.isCreateProcess = true;

        ctrl.dtInstance = {};
        ctrl.dtOptions = DTOptionsBuilder.newOptions().withDOM('C<"clear">lfrtip').withOption('aaSorting', []);
        ctrl.dtColumnDefs = [
            DTColumnDefBuilder.newColumnDef(0).notSortable(),
            DTColumnDefBuilder.newColumnDef(1).notSortable(),
            DTColumnDefBuilder.newColumnDef(2).notSortable()
        ];

        /**
         * Init de la aplicacion y busca las categorias
         * @param contextPath
         */
        ctrl.init = function (contextPath) {
            ProductTypeService.contextPath = contextPath;
            // Busca todos las categorias activos
            ctrl.findAllProductTypes();
        };

        /**
         * Metodo para encontrar a todas las categorias
         * @returns {*|PromiseLike<T>|Promise<T>}
         */
        ctrl.findAllProductTypes = function () {
            return ProductTypeService.findAllProductTypes().then(function (response) {
                ctrl.productTypeList = response.data;
            });
        };

        /**
         * Muestra el formulario para crear a una nueva categoria
         */
        ctrl.showCreateProductType = function () {
            ctrl.showProductTypeList = false;
            ctrl.isCreateProcess = true;
            ctrl.productType = {};
        };

        /**
         * Verifica que tipo de proceso se realiza, creacion o modificacion
         */
        ctrl.validateProductType = function () {
            if(ctrl.isCreateProcess) {
                ctrl.createProductType();
            } else {
                ctrl.updateProductType();
            }
        };

        /**
         * Metodo que crea un nuevo categoria
         * @returns {*|PromiseLike<T>|Promise<T>}
         */
        ctrl.createProductType = function () {
            return ProductTypeService.createProductType(ctrl.productType).then(function (response) {
                if(response.data.error) {
                    showNotify('danger', 'ti-close', response.data.message);
                }
                else {
                    ctrl.productType.id = response.data.id;
                    ctrl.productTypeList.push(angular.copy(ctrl.productType));
                    ctrl.showProductTypeList = true;
                    showNotify('success', 'ti-check', response.data.message);
                }
            });
        };

        /**
         * Muestra formulario para actualizar una categoria
         * @param productType
         * @param index
         */
        ctrl.showUpdateProductType = function (productType, index) {
            ctrl.productType = angular.copy(productType);
            ctrl.productType.indexElem = index;
            ctrl.showProductTypeList = false;
            ctrl.isCreateProcess = false;
        };

        /**
         * Metodo que actualiza una categoria
         * @returns {*|PromiseLike<T>|Promise<T>}
         */
        ctrl.updateProductType = function () {
            return ProductTypeService.updateProductType(ctrl.productType).then(function (response) {
                if(response.data.error) {
                    showNotify('danger', 'ti-close', response.data.message);
                }
                else {
                    ctrl.productTypeList[ctrl.productType.indexElem] = angular.copy(ctrl.productType);
                    ctrl.showProductTypeList = true;
                    showNotify('success', 'ti-check', response.data.message);
                }
            });
        };

        /**
         * Metodo para confirmar la eliminacion de una categoria
         * @param id El id de la categoria a eliminar
         * @param index El index en la lista de categorias
         */
        ctrl.deleteProductType = function (id, index) {
            swal({
                title: "Confirmación",
                text: "¿Seguro que deseas eliminar la categoria?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger btn-fill",
                confirmButtonText: "Si, Eliminar!",
                cancelButtonClass: "btn-default btn-fill",
                cancelButtonText: "Cancelar",
                closeOnConfirm: true
            }, function (isConfirm) {
                if(isConfirm) {
                    return ProductTypeService.deleteProductType(id).then(function (response) {
                        if(response.data.error) {
                            showNotify('danger', 'ti-close', response.data.message);
                        }
                        else {
                            ctrl.productTypeList.splice(index, 1);
                            showNotify('success', 'ti-check', response.data.message);
                        }
                    });
                }
            });
        };


    });

})();