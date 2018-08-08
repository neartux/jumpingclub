(function (){
    var app = angular.module('Reservation', ['ReservationProvider', 'datatables']);

    app.controller('ReservationController', function($scope, $http, ReservationService, DTOptionsBuilder, DTColumnDefBuilder) {
        var ctrl = this;
        ctrl.reservationList = {
            data: []
        };
        ctrl.dates = { startDate: '', endDate: '' };
        ctrl.showReservationList = true;
        ctrl.ventaCompletaTO = {};
        ctrl.clientId = undefined;
        ctrl.codeProduct = '';
        ctrl.isProcessSaveActive = false;
        ctrl.showClientData = false;
        ctrl.reservationView = {};

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
            return ReservationService.findAllReservations(ctrl.dates.startDate, ctrl.dates.endDate).then(function (value) {
                ctrl.reservationList.data = value.data;
                setTimeout(function () {
                    $scope.$apply();
                },200);
            });
        };

        /**
         * Busca un cliente por su id
         * @param idClient El id del cliente
         * @returns {PromiseLike<T> | Promise<T> | *}
         */
        ctrl.findClientById = function (idClient) {
            return ReservationService.findClientById(idClient).then(function (response) {
                if (response.data.id !== undefined) {
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
                return ReservationService.findProductByCode(ctrl.codeProduct).then(function (response) {
                    var product = response.data[0];
                    if (product !== undefined) {
                        ctrl.addProductToSale(product);
                    }
                });
            }
        };

        ctrl.addProductToSale = function (product) {
            ctrl.ventaCompletaTO.products.push(product);
            ctrl.calculateTotalSale();
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
                    },
                    onHideListEvent: function() {
                        $("#clientId").val('');
                    },
                    match: {
                        enabled: true
                    },
                    onChooseEvent: function () {
                        ctrl.clientId = $("#clientId").getSelectedItemData().id;
                        ctrl.findClientById(ctrl.clientId);
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
                    return element.name + ' - ' + element.description;
                },
                ajaxSettings: { dataType: "json", method: "GET", data: { dataType: "json" } },
                preparePostData: function(data) {
                    data.q = $("#productIdSearch").val();
                    return data;
                },
                list: {
                    onSelectItemEvent: function() {
                    },
                    onChooseEvent: function () {
                        ctrl.codeProduct = $("#productIdSearch").getSelectedItemData().id;
                        ctrl.findProductByCode();
                    },
                    onHideListEvent: function() {
                        $("#productIdSearch").val('');
                    },
                    match: {
                        enabled: true
                    },
                    onClickEvent: function() {
                    }
                },
                theme: "round",
                requestDelay: 300
            };
            $("#productIdSearch").easyAutocomplete(options);
        };

        ctrl.showCreateReservation = function () {
            ctrl.showReservationList = false;
            ctrl.initSale();
        };

        ctrl.removeFromSale = function (index) {
            ctrl.ventaCompletaTO.products.splice(index, 1);
            ctrl.calculateTotalSale();
        };

        ctrl.createSale = function () {
            var clientId = ctrl.ventaCompletaTO.client.id;
            if (clientId === undefined || clientId <= 0) {
                showNotify('info', 'ti-warning', 'No se ha seleccionado cliente');
                return;
            }
            var fecha = $(".date-picker").val();
            if (fecha === undefined || $.trim(fecha).length <= 0) {
                showNotify('info', 'ti-warning', 'La fecha es requerida');
                return;
            }
            var time = $(".timepicker").val();
            if (time === undefined || $.trim(time).length <= 0) {
                showNotify('info', 'ti-warning', 'La hora es requerida');
                return;
            }
            if(ctrl.ventaCompletaTO.products.length <= 0) {
                showNotify('info', 'ti-warning', 'selecciona un producto');
                return;
            }
            if(!ctrl.isProcessSaveActive) {
                startLoading("Creando Venta");
                ctrl.isProcessSaveActive = true;
                ctrl.ventaCompletaTO.fechaEvento = fecha;
                ctrl.ventaCompletaTO.horaEvento = time;
                // Agrega la forma de pago estatica, esto en un futuro hay que cambiarlo, para varias formas de pago
                return ReservationService.createSale(ctrl.ventaCompletaTO).then(function(response) {
                    if (!response.data.error) {
                        showNotify('success', 'ti-check', response.data.message);
                        ctrl.showReservationList = true;
                        ctrl.findReservationsByDate();
                    } else {
                        showNotify('danger', 'ti-close', response.data.message);
                    }
                    stopLoading();
                    setTimeout(function () {
                        $scope.$apply();
                        //$(".ticket-area").printArea();
                    },100);
                    ctrl.isProcessSaveActive = false;
                });
            }
        };

        ctrl.changeAddress = function () {
            ctrl.showClientData = true;
            ctrl.clientView = angular.copy(ctrl.ventaCompletaTO.client);
        };

        ctrl.validateDatosEnvio = function (isValida) {
            if(isValida) {
                ctrl.ventaCompletaTO.client = angular.copy(ctrl.clientView);
                ctrl.showClientData = false;
            }
        };

        ctrl.calculateTotalSale = function () {
            var total = 0;
            angular.forEach(ctrl.ventaCompletaTO.products, function (item, key) {
                total += parseFloat(item.sale_price);
            });
            ctrl.ventaCompletaTO.total = total.toFixed(2);
        };

        ctrl.initSale = function () {
            ctrl.isProcessSaveActive = false;
            ctrl.ventaCompletaTO = {
                client: {},
                products: [],
                comments: ''
            };
            $(".date-picker").val('');
            $(".timepicker").val('');
        };

        ctrl.changeStatuReservation = function (reservation) {
            setTimeout(function () {
                if(confirm("¿Estas seguro de cambiar el estatus?")){
                    return ReservationService.changeStatusReservation(reservation.id, reservation.status_ids).then(function (value) {
                        if (!value.data.error) {
                            showNotify('success', 'ti-check', value.data.message);
                            ctrl.showReservationList = true;
                            ctrl.findReservationsByDate();
                        } else {
                            showNotify('danger', 'ti-close', value.data.message);
                        }
                    });
                }
            },500);
        };

        ctrl.eliminarReserva = function (id) {
            if(confirm("¿Desea eliminar la reserva?")){
                return ReservationService.eliminarReserva(id).then(function (value) {
                    if (!value.data.error) {
                        showNotify('success', 'ti-check', value.data.message);
                        ctrl.showReservationList = true;
                        ctrl.findReservationsByDate();
                    } else {
                        showNotify('danger', 'ti-close', value.data.message);
                    }
                });
            }
        };

        ctrl.setStringStatus = function (reservation) {
            reservation.status_ids = reservation.status_id.toString();
            setTimeout(function () {
                $scope.$apply();
            },200);
        };

    });

})();