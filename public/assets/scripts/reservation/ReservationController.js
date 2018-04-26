(function (){
    var app = angular.module('Reservation', ['ReservationProvider', 'datatables']);

    app.controller('ReservationController', function($scope, $http, ReservationService, DTOptionsBuilder, DTColumnDefBuilder) {
        var ctrl = this;
        ctrl.reservationList = ReservationService.reservationList;
        ctrl.dates = { startDate: '', endDate: '' };
        ctrl.showReservationList = true;

        ctrl.dtInstance = {};
        ctrl.dtOptions = DTOptionsBuilder.newOptions().withDOM('C<"clear">lfrtip').withOption('aaSorting', []);
        ctrl.dtColumnDefs = [
            DTColumnDefBuilder.newColumnDef(0).notSortable(),
            DTColumnDefBuilder.newColumnDef(1).notSortable(),
            DTColumnDefBuilder.newColumnDef(2).notSortable(),
            DTColumnDefBuilder.newColumnDef(3).notSortable(),
            DTColumnDefBuilder.newColumnDef(4).notSortable(),
            DTColumnDefBuilder.newColumnDef(5).notSortable(),
            DTColumnDefBuilder.newColumnDef(6).notSortable(),
            DTColumnDefBuilder.newColumnDef(7).notSortable()
        ];

        /**
         * Initialize app, instance context path of app
         * @param contextPath Application path
         */
        ctrl.init = function (contextPath) {
            ReservationService.contextPath = contextPath;
            // Asigna la fecha
            var date = new Date();
            ctrl.dates.startDate = moment(new Date(date.getFullYear(), date.getMonth(), 1)).format('DD/MM/YYYY');
            ctrl.dates.endDate = moment(new Date(date.getFullYear(), date.getMonth() + 1, 0)).format('DD/MM/YYYY');
            // Inicia el date range
            ctrl.initDateRange();
            // Busca todas las reservaciones por fecha
            ctrl.findReservationsByDate();
        };

        /**
         * Inicia el daterange
         */
        ctrl.initDateRange = function () {
            $('.daterange').daterangepicker(
                {
                    locale: {
                        format: 'DD/MM/YYYY'
                    },
                    startDate: ctrl.dates.startDate,
                    endDate: ctrl.dates.endDate,
                    autoApply: true
                },
                function(start, end, label) {
                    ctrl.dates.startDate = start.format('DD/MM/YYYY');
                    ctrl.dates.endDate = end.format('DD/MM/YYYY');
                });
        };

        /**
         * Metodo para buscar las reservaciones por fechas
         */
        ctrl.findReservationsByDate = function () {
            return ReservationService.findAllReservations(ctrl.dates.startDate, ctrl.dates.endDate);
        };

    });

})();