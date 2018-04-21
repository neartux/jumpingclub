(function () {
    var app = angular.module('ProductProvider', []);

    app.factory('ProductService', function ($http, $q) {
        var service = {};

        service.contextPath = '';
        service.valueReloadProduct = {
            data: undefined
        };

        service.setContextPath = function (contextPath) {
            service.contextPath = contextPath;
        };

        service.setDefaultValueReloadProduct = function () {
            service.valueReloadProduct.data = undefined;
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
            return $http.get(service.contextPath+'/admin/product/findImagesByProduct/'+id);
        };

        service.changeValueReloadProduct = function () {
            return service.valueReloadProduct.data = true;
        };

        service.setMainImageByProduct = function (imageId, productId) {
            return $http.get(service.contextPath+'/admin/product/setMainImageByProduct/'+imageId+'/'+productId);
        };

        service.deleteImage = function (imageId) {
            return $http.get(service.contextPath+'/admin/product/deleteImage/'+imageId);
        };

        service.changeOrderImage = function (imageId, order) {
            return $http.get(service.contextPath+'/admin/product/changeOrderImage/'+imageId+'/'+order);
        };

        return service;

    });

})();