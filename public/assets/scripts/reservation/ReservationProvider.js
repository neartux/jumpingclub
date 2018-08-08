(function () {
    var app = angular.module('ReservationProvider', []);

    app.factory('ReservationService', function ($http, $q) {
        var service = {};

        service.reservationList = {
            data: []
        };

        service.contextPath = '';

        service.setContextPath = function (contextPath) {
            service.contextPath = contextPath;
        };

        service.getContextPath = function () {
            return service.contextPath;
        };

        service.findAllReservations = function (starDate, endDate) {
            service.reservationList.data = [];
            return $http({
                method: 'POST',
                url: service.contextPath + '/admin/reservation/findAllReservation',
                data: $.param({startDate: starDate, endDate: endDate}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        /**
         * Encuentra un cliente para la venta por su id
         * @param clientId El id del cliente
         */
        service.findClientById = function (clientId) {
            return $http.get(service.contextPath+'/admin/client/findClientById/'+clientId);
        };

        service.findProductByCode = function (id) {
            return $http.get(service.contextPath+'/admin/product/findProductsById/'+id);
        };

        service.createSale = function (ventaCompletaTO) {
            return $http({
                method: 'POST',
                url: service.contextPath + '/admin/reservation/createSale',
                data: $.param(ventaCompletaTO),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        };

        service.changeStatusReservation = function (id, status_id) {
            return $http.get(service.contextPath+'/admin/reservation/changeStatus/'+id+'/'+status_id);
        };

        service.eliminarReserva = function (id) {
            return $http.get(service.contextPath+'/admin/reservation/deleteReserva/'+id);
        };

        return service;

    });

})();