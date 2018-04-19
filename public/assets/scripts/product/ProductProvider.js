(function () {
    var app = angular.module('ProductProvider', []);

    app.factory('ProductService', function ($http, $q) {
        var service = {};

        service.contextPath = '';
        service.listProductImages = [];

        service.setContextPath = function (contextPath) {
            service.contextPath = contextPath;
        };

        service.findImagesByProduct = function () {
            console.info("UPDATING ............................");
        };

        return service;

    });

})();