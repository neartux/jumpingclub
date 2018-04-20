(function (){
    var app = angular.module('Product', ['ProductProvider']);

    app.controller('ProductController', function($scope, $http, ProductService) {
        var ctrl = this;
        ctrl.listProductImages = ProductService.listProductImages;
        ctrl.productTypeList = [];
        ctrl.productsList = [];
        ctrl.product = {};
        ctrl.showProductList = true;
        ctrl.isCreateProcess = true;
        ctrl.productTypeId = "0";

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
            console.info("ctrl.product = ", ctrl.product);
            return ProductService.createProduct(ctrl.product).then(function (response) {
                console.info("RESPONSE = ", response);
            });
        };

        ctrl.showEditProduct = function (product) {
            console.info("product =", product);
            ctrl.product = angular.copy(product);
            ctrl.showProductList = false;
            ctrl.isCreateProcess = false;
            ctrl.findImagesByProduct();
        };

        ctrl.updateProduct = function () {
            console.info("Update product");
            return ProductService.updateProduct(ctrl.product).then(function (response) {
                console.info("RESPONSE = ", response);
            });
        };

        ctrl.publicProduct = function (product, isPublicated) {
            if(isPublicated) {
                if(confirm("Seguro deseas publicar el producto")){
                    product.public = true;
                    return ProductService.publicProduct(product.id, true).then(function (response) {
                        console.info("public = ", response);
                    });
                }
            }
            else {
                if(confirm("Quieres despublicar el producto")){
                    product.public = false;
                    return ProductService.publicProduct(product.id, false).then(function (response) {
                        console.info("public = ", response);
                    });
                }
            }
        };

        ctrl.deleteProduct = function (index, id) {
            if(confirm("Deseas eleiminar el producto")) {
                return ProductService.deleteProduct(id).then(function (response) {
                    console.info("DELETE = ", response);
                    ctrl.productTypeList.slice(index, 1);
                });
            }
        };

        ctrl.findImagesByProduct = function () {
            return ProductService.findImagesByProduct(ctrl.product.id);
        };

        ctrl.goBackToProductList = function () {
            ctrl.showProductList = true;
        };

    });

})();