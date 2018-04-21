(function (){
    var app = angular.module('Product', ['ProductProvider', 'datatables']);

    app.controller('ProductController', function($scope, $http, ProductService, DTOptionsBuilder, DTColumnDefBuilder) {
        var ctrl = this;
        ctrl.listProductImages = [];
        ctrl.valueReloadProduct = ProductService.valueReloadProduct;
        ctrl.productTypeList = [];
        ctrl.productsList = [];
        ctrl.product = {};
        ctrl.showProductList = true;
        ctrl.isCreateProcess = true;
        ctrl.productTypeId = "0";
        ctrl.mainImageRadio = "1";

        ctrl.dtInstance = {};
        ctrl.dtOptions = DTOptionsBuilder.newOptions().withDOM('C<"clear">lfrtip').withOption('aaSorting', []);
        ctrl.dtColumnDefs = [
            DTColumnDefBuilder.newColumnDef(0).notSortable(),
            DTColumnDefBuilder.newColumnDef(1).notSortable(),
            DTColumnDefBuilder.newColumnDef(2).notSortable(),
            DTColumnDefBuilder.newColumnDef(3).notSortable(),
            DTColumnDefBuilder.newColumnDef(4).notSortable(),
            DTColumnDefBuilder.newColumnDef(5).notSortable()
        ];

        /**
         * Initialize app, instance context path of app
         * @param contextPath Application path
         */
        ctrl.init = function (contextPath) {
            ProductService.contextPath = contextPath;
            ctrl.findProductTypes();
        };

        ctrl.findProductTypes = function () {
            ProductService.findProductTypes().then(function (response) {
                ctrl.productTypeList = response.data;
            });
        };

        ctrl.findProductsByType = function () {
            return ProductService.findProductsByType(ctrl.productTypeId).then(function (response) {
                ctrl.productsList = response.data;
            });
        };

        ctrl.showCreateProduct = function () {
            ctrl.cleanFormProduct();
            ctrl.showProductList = false;
            ctrl.isCreateProcess = true;
            //$scope.productForm.$setPristine();
            $(".secondTab").removeClass("active");
            $(".initialTab").addClass("active");
        };

        /**
         * Valida el form del producto para reacion o modificacion
         *
         * @param isValid Verifica si es valido el form
         */
        ctrl.validateProduct = function (isValid) {
            // Si el form del producto es valido
            if(isValid) {
                // Crea un nuevo producto
                if(ctrl.isCreateProcess) {
                    ctrl.createProduct();
                }
                // Modifica un producto existente
                else {
                    ctrl.updateProduct();
                }
            }
        };

        /**
         * Metodo para crear un producto
         *
         * @returns {*|PromiseLike<T>|Promise<T>}
         */
        ctrl.createProduct = function () {
            return ProductService.createProduct(ctrl.product).then(function (response) {
                if(response.data.error) {
                    showNotify('danger', 'ti-close', response.data.message);
                }
                else {
                    ctrl.productTypeId = ctrl.product.product_type_id;
                    ctrl.findProductsByType();
                    ctrl.showProductList = true;
                    showNotify('success', 'ti-check', response.data.message);
                }
            });
        };

        /**
         * Muestra el formulario para modificar un producto y agregar imagenes
         *
         * @param product El producto a modificar
         */
        ctrl.showEditProduct = function (product) {
            ctrl.product = angular.copy(product);
            ctrl.product.product_type_id = ctrl.product.product_type_id + "";
            ctrl.showProductList = false;
            ctrl.isCreateProcess = false;
            ctrl.findImagesByProduct();
            //$scope.productForm.$setPristine();
            $(".secondTab").removeClass("active");
            $(".initialTab").addClass("active");
        };

        ctrl.updateProduct = function () {
            return ProductService.updateProduct(ctrl.product).then(function (response) {
                if(response.data.error) {
                    showNotify('danger', 'ti-close', response.data.message);
                }
                else {
                    ctrl.productTypeId = ctrl.product.product_type_id;
                    ctrl.findProductsByType();
                    ctrl.showProductList = true;
                    showNotify('success', 'ti-check', response.data.message);
                }
            });
        };

        ctrl.publicProduct = function (product, isPublicated) {
            var msj = isPublicated ? "¿Seguro deseas publicar el producto?" : "¿Seguro deseas despublicar el producto?";
            swal({
                title: "Confirmación",
                text: msj,
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Si, Aplicar!",
                cancelButtonText: "Cancelar",
                closeOnConfirm: true
            }, function (isConfirm) {
                if(isConfirm) {
                    product.public = isPublicated;
                    return ProductService.publicProduct(product.id, isPublicated).then(function (response) {
                        if(response.data.error) {
                            showNotify('danger', 'ti-close', response.data.message);
                        }
                        else {
                            showNotify('success', 'ti-check', response.data.message);
                        }
                    });
                }
            });
        };

        ctrl.deleteProduct = function (index, id) {
            swal({
                title: "Confirmación",
                text: "¿Deseas eliminar el producto?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Si, Eliminar!",
                cancelButtonText: "Cancelar",
                closeOnConfirm: true
            }, function (isConfirm) {
                if(isConfirm) {
                    return ProductService.deleteProduct(id).then(function (response) {
                        if(response.data.error) {
                            showNotify('danger', 'ti-close', response.data.message);
                        }
                        else {
                            showNotify('success', 'ti-check', response.data.message);
                            ctrl.productsList.splice(index, 1);
                        }
                    });
                }
            });
        };

        ctrl.findImagesByProduct = function () {
            return ProductService.findImagesByProduct(ctrl.product.id).then(function (response) {
                ctrl.listProductImages = response.data;
                ProductService.setDefaultValueReloadProduct();
                initFieldsNumeric();
            });
        };

        ctrl.setPrincipalImage = function (index) {
            swal({
                title: "Confirmación",
                text: "¿Estas seguro de colocar imagen como principal?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Si, Aplicar!",
                cancelButtonText: "Cancelar",
                closeOnConfirm: true
            }, function (isConfirm) {
                if(isConfirm) {
                    return ProductService.setMainImageByProduct(ctrl.listProductImages[index].id, ctrl.listProductImages[index].product_id).then(function (response) {
                        if(response.data.error) {
                            showNotify('danger', 'ti-close', response.data.message);
                        }
                        else {
                            showNotify('success', 'ti-check', response.data.message);
                        }
                    });
                }
            });
        };

        ctrl.deleteImage = function (index) {
            swal({
                title: "Confirmación",
                text: "¿Estas seguro de eliminar la imagen?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Si, Eliminar!",
                cancelButtonText: "Cancelar",
                closeOnConfirm: true
            }, function (isConfirm) {
                if(isConfirm) {
                    var image = ctrl.listProductImages[index];
                    return ProductService.deleteImage(image.id).then(function (response) {
                        if(response.data.error) {
                            showNotify('danger', 'ti-close', response.data.message);
                        }
                        else {
                            showNotify('success', 'ti-check', response.data.message);
                            ctrl.listProductImages.splice(index, 1);
                        }
                    });
                }
            });
        };

        ctrl.saveOrderImage = function (image) {
            swal({
                title: "Confirmación",
                text: "¿Estas seguro de actualizar el orden?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Si, Actualizar!",
                cancelButtonText: "Cancelar",
                closeOnConfirm: true
            }, function (isConfirm) {
                if(isConfirm) {
                    return ProductService.changeOrderImage(image.id, image.order).then(function (response) {
                        if(response.data.error) {
                            showNotify('danger', 'ti-close', response.data.message);
                        }
                        else {
                            image.order = image.orderN;
                            showNotify('success', 'ti-check', response.data.message);
                        }
                        setTimeout(function () {
                            image.editOrder = false;
                            ctrl.blockEditAllImages = false;
                            $scope.$apply();
                        },200);
                    });
                }else {
                    setTimeout(function () {
                        image.editOrder = false;
                        ctrl.blockEditAllImages = false;
                        $scope.$apply();
                    },200);
                }

            });
        };

        $scope.$watch('ctrl.valueReloadProduct', function(newVal, oldVal){
            console.log('changed');
            console.log('newVal = ', newVal, " oldVal = ", oldVal);
            if(newVal.data !== undefined && newVal.data){
                ctrl.findImagesByProduct();
            }
        }, true);

        ctrl.goBackToProductList = function () {
            ctrl.showProductList = true;
        };

        ctrl.cleanFormProduct = function () {
            ctrl.product = {};
            ctrl.listProductImages = [];
        };

    });

})();