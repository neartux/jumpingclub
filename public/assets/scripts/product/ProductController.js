(function (){
    var app = angular.module('Product', ['ProductProvider']);

    app.controller('ProductController', function($scope, $http, ProductService) {
        var ctrl = this;
        ctrl.productTypeList = [];
        ctrl.productsList = [];
        ctrl.showProductList = true;
        ctrl.productTypeId = "0";

        /**
         * Initialize app, instance context path of app
         * @param contextPath Application path
         */
        ctrl.init = function (contextPath) {
            console.info("Context path = ", contextPath);
            ProductService.contextPath = contextPath;
            ctrl.findProductTypes();
        };

        ctrl.findProductTypes = function () {
            ProductService.findProductTypes().then(function (response) {
                console.info("RESPONSE TYPES = ", response);
                ctrl.productTypeList = response.data;
            });
        };

        ctrl.findProductsByType = function () {
            console.info("ctrl.productTypeId = ", ctrl.productTypeId);
            return ProductService.findProductsByType(ctrl.productTypeId).then(function (response) {
                console.info("PRODUCTS = ", response);
                ctrl.productsList = response.data;
            });
        };

        ctrl.showProductForm = function () {
            ctrl.showProductList = false;
            ProductService.findImagesByProduct();
        };

        ctrl.goBackToProductList = function () {
            ctrl.showProductList = true;
        };

    });

})();