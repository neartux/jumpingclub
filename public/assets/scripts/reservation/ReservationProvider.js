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
            }).then(function (response) {
                console.info("response = ", response);
                service.reservationList.data = response.data;
            });
        };

        /**
         * Encuentra un cliente para la venta por su id
         * @param clientId El id del cliente
         */
        service.findClientById = function (clientId) {
            return $http.get(service.contextPath+'/admin/client/findClientById/'+clientId);
        };

        return service;

    });

})();