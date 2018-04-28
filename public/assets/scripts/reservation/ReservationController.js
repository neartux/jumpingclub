(function (){
    var app = angular.module('Reservation', ['ReservationProvider', 'datatables']);

    app.controller('ReservationController', function($scope, $http, ReservationService, DTOptionsBuilder, DTColumnDefBuilder) {
        var ctrl = this;
        ctrl.reservationList = ReservationService.reservationList;
        ctrl.dates = { startDate: '', endDate: '' };
        ctrl.showReservationList = true;
        ctrl.ventaCompletaTO = {};
        ctrl.clientId = undefined;
        ctrl.codeProduct = '';

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
            // Init autocomplete client
            ctrl.initAutocompleteClient();
            // Init autocomplete product
            ctrl.initAutocompleteProduct();
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

        /**
         * Busca un cliente por su id
         * @param idClient El id del cliente
         * @returns {PromiseLike<T> | Promise<T> | *}
         */
        ctrl.findClientById = function (idClient) {
            return ReservationService.findClientById(idClient).then(function (response) {
                if (response.data.id !== undefined) {
                    console.info("response.data = ", response.data);
                    ctrl.ventaCompletaTO.client = response.data;
                }
                ctrl.clientId = undefined;
            });
        };

        /**
         * Busca un producto por su codigo
         */
        ctrl.findProductByCode = function () {
            if (ctrl.codeProduct !== '') {
                return PointSaleService.findProductByCode(ctrl.codeProduct).then(function (response) {
                    conosle.info("response.data = ", response.data);
                    if(response.data.id !== undefined) {
                        //ctrl.addProductToSale(response.data);
                    }
                    //ctrl.cleanAndFocusInputProduct();
                });
            }
        };

        /**
         * Configura el autocomplete para cliente
         */
        ctrl.initAutocompleteClient = function () {
            var options = {
                minCharNumber: 2,
                url: function(phrase) {
                    return ReservationService.getContextPath() + "/admin/reservation/findClientByNameOrLastName";
                },
                getValue: function(element) {
                    return element.name + ' ' + element.last_name;
                },
                ajaxSettings: { dataType: "json", method: "GET", data: { dataType: "json" } },
                preparePostData: function(data) {
                    data.q = $("#clientId").val();
                    return data;
                },
                list: {
                    onSelectItemEvent: function() {
                        ctrl.clientId = $("#clientId").getSelectedItemData().id;
                    },
                    onHideListEvent: function() {
                        $("#clientId").val('');
                    },
                    match: {
                        enabled: true
                    },
                    onClickEvent: function() {
                        ctrl.findClientById(ctrl.clientId);
                    }
                },
                theme: "round",
                requestDelay: 300
            };
            $("#clientId").easyAutocomplete(options);
        };

        /**
         * Configura el autocomplete para busqueda avanzada del producto
         */
        ctrl.initAutocompleteProduct = function () {
            var options = {
                minCharNumber: 2,
                url: function(phrase) {
                    return ReservationService.getContextPath() + "/admin/product/findProductsByCodeOrName";
                },
                getValue: function(element) {
                    return element.code + ' - ' + element.description;
                },
                ajaxSettings: { dataType: "json", method: "GET", data: { dataType: "json" } },
                preparePostData: function(data) {
                    data.q = $("#productIdSearch").val();
                    return data;
                },
                list: {
                    onSelectItemEvent: function() {
                        ctrl.codeProduct = $("#productIdSearch").getSelectedItemData().code;
                    },
                    onHideListEvent: function() {
                        $("#productIdSearch").val('');
                    },
                    match: {
                        enabled: true
                    },
                    onClickEvent: function() {
                        ctrl.findProductByCode();
                    }
                },
                theme: "round",
                requestDelay: 300
            };
            $("#productIdSearch").easyAutocomplete(options);
        };

    });

})();