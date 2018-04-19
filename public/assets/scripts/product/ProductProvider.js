(function () {
    var app = angular.module('ProductProvider', []);

    app.factory('ProductService', function ($http, $q) {
        var service = {};

        service.contextPath = '';
        service.listProductImages = [];

        service.setContextPath = function (contextPath) {
            service.contextPath = contextPath;
        };

        service.findProductTypes = function () {
            return $http.get(service.contextPath+'/admin/product/findProductTypes');
        };

        service.findProductsByType = function (productTypeId) {
            return $http.get(service.contextPath+'/admin/product/findProductsByType/'+productTypeId);
        };

        service.findImagesByProduct = function () {
            console.info("UPDATING ............................");
        };

        return service;

    });

})();