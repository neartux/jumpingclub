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

        service.createProduct = function (product) {
            return $http({
                method: 'POST',
                url: service.contextPath + '/admin/product/createProduct',
                data: $.param(product),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.updateProduct = function (product) {
            return $http({
                method: 'POST',
                url: service.contextPath + '/admin/product/updateProduct',
                data: $.param(product),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.publicProduct = function (productId, isPublic) {
            return $http({
                method: 'POST',
                url: service.contextPath + '/admin/product/publicProduct',
                data: $.param({productId: productId, isPublic: isPublic}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.deleteProduct = function (id) {
            return $http.get(service.contextPath+'/admin/product/deleteProduct/'+id);
        };

        service.findImagesByProduct = function (id) {
            return $http.get(service.contextPath+'/admin/product/findImagesByProduct/'+id).then(function (response) {
                console.info("RESPONSE = ", response);
                service.listProductImages = response.data;
            });
        };

        return service;

    });

})();