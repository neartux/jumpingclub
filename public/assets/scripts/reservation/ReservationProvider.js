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

        return service;

    });

})();