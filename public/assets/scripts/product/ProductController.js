(function (){
    var app = angular.module('Product', ['ProductProvider']);

    app.controller('ProductController', function($scope, $http, ProductService) {
        var ctrl = this;
        ctrl.listProductImages = ProductService.listProductImages;
        ctrl.valueReloadProduct = ProductService.valueReloadProduct;
        ctrl.productTypeList = [];
        ctrl.productsList = [];
        ctrl.product = {};
        ctrl.showProductList = true;
        ctrl.isCreateProcess = true;
        ctrl.productTypeId = "0";
        ctrl.mainImageRadio = "1";

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
            ctrl.showProductList = false;
            ctrl.isCreateProcess = true;
        };

        ctrl.validateProduct = function () {
            if(ctrl.isCreateProcess) {
                ctrl.createProduct();
            }
            else {
                ctrl.updateProduct();
            }
        };

        ctrl.createProduct = function () {
            return ProductService.createProduct(ctrl.product).then(function (response) {
                if(response.data.error) {
                    showNotify('danger', 'ti-close', response.data.message);
                }
                else {
                    showNotify('success', 'ti-check', response.data.message);
                }
            });
        };

        ctrl.showEditProduct = function (product) {
            ctrl.product = angular.copy(product);
            ctrl.showProductList = false;
            ctrl.isCreateProcess = false;
            ctrl.findImagesByProduct();
            $(".secondTab").removeClass("active");
            $(".initialTab").addClass("active");
        };

        ctrl.updateProduct = function () {
            return ProductService.updateProduct(ctrl.product).then(function (response) {
                if(response.data.error) {
                    showNotify('danger', 'ti-close', response.data.message);
                }
                else {
                    showNotify('success', 'ti-check', response.data.message);
                }
            });
        };

        ctrl.publicProduct = function (product, isPublicated) {
            if(isPublicated) {
                if(confirm("Seguro deseas publicar el producto")){
                    product.public = true;
                    return ProductService.publicProduct(product.id, true).then(function (response) {
                        if(response.data.error) {
                            showNotify('danger', 'ti-close', response.data.message);
                        }
                        else {
                            showNotify('success', 'ti-check', response.data.message);
                        }
                    });
                }
            }
            else {
                if(confirm("Quieres despublicar el producto")){
                    product.public = false;
                    return ProductService.publicProduct(product.id, false).then(function (response) {
                        if(response.data.error) {
                            showNotify('danger', 'ti-close', response.data.message);
                        }
                        else {
                            showNotify('success', 'ti-check', response.data.message);
                        }
                    });
                }
            }
        };

        ctrl.deleteProduct = function (index, id) {
            if(confirm("Deseas eleiminar el producto")) {
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
        };

        ctrl.findImagesByProduct = function () {
            return ProductService.findImagesByProduct(ctrl.product.id).then(function (response) {
                ctrl.listProductImages = response.data;
                ProductService.setDefaultValueReloadProduct();
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

    });

})();