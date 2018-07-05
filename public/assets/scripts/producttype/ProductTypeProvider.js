(function () {
    var app = angular.module('ProductTypeProvider', []);

    app.factory('ProductTypeService', function ($http, $q) {
        var service = {};

        service.contextPath = '';

        service.setContextPath = function (contextPath) {
            service.contextPath = contextPath;
        };

        service.findAllProductTypes = function () {
            return $http.get(service.contextPath+'/admin/product/findProductTypes');
        };

        service.createProductType = function (productType) {
            return $http({
                method: 'POST',
                url: service.contextPath + '/admin/product/createProductType',
                data: $.param(productType),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.updateProductType = function (productType) {
            return $http({
                method: 'POST',
                url: service.contextPath + '/admin/product/updateProductType',
                data: $.param(productType),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.deleteProductType = function (id) {
            return $http.get(service.contextPath+'/admin/product/deleteProductType/' + id);
        };


        return service;

    });

})();