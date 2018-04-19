(function (){
    var app = angular.module('Product', ['ProductProvider']);

    app.controller('ProductController', function($scope, $http, ProductService) {
        var ctrl = this;

        ctrl.showProductList = true;

        /**
         * Initialize app, instance context path of app
         * @param contextPath Application path
         */
        ctrl.init = function (contextPath) {
            console.info("Context path = ", contextPath);
            ProductService.contextPath = contextPath;
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