(function (){
    var app = angular.module('Client', ['ClientProvider', 'datatables']);

    app.controller('ClientController', function($scope, $http, ClientService, DTOptionsBuilder, DTColumnDefBuilder) {
        var ctrl = this;
        ctrl.clientList = [];
        ctrl.client = {};
        ctrl.showClientList = true;
        ctrl.isCreateProcess = true;

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
         * Init de la aplicacion y busca los clientes
         * @param contextPath
         */
        ctrl.init = function (contextPath) {
            ClientService.contextPath = contextPath;
            // Busca todos los clientes activos
            ctrl.findAllClients();
        };

        /**
         * Metodo para encontrar a todos los usuarios activos
         * @returns {*|PromiseLike<T>|Promise<T>}
         */
        ctrl.findAllClients = function () {
            return ClientService.findAllClients().then(function (response) {
                ctrl.clientList = response.data;
            });
        };

        /**
         * Muestra el formulario para crear a un nuevo cliente
         */
        ctrl.showCreateClient = function () {
            ctrl.showClientList = false;
            ctrl.isCreateProcess = true;
            ctrl.client = {};
        };

        /**
         * Verifica que tipo de proceso se realiza, creacion o modificacion
         */
        ctrl.validateClient = function () {
            if(ctrl.isCreateProcess) {
                ctrl.createClient();
            } else {
                ctrl.updateClient();
            }
        };

        /**
         * Metodo que crea un nuevo cliente
         * @returns {*|PromiseLike<T>|Promise<T>}
         */
        ctrl.createClient = function () {
            return ClientService.createClient(ctrl.client).then(function (response) {
                if(response.data.error) {
                    showNotify('danger', 'ti-close', response.data.message);
                }
                else {
                    ctrl.client.id = response.data.id;
                    ctrl.clientList.push(angular.copy(ctrl.client));
                    ctrl.showClientList = true;
                    showNotify('success', 'ti-check', response.data.message);
                }
            });
        };

        /**
         * Muestra formulario para actualizar un cliente
         * @param client
         * @param index
         */
        ctrl.showUpdateClient = function (client, index) {
            ctrl.client = angular.copy(client);
            ctrl.client.indexElem = index;
            ctrl.showClientList = false;
            ctrl.isCreateProcess = false;
        };

        /**
         * Metodo que actualiza un cliente
         * @returns {*|PromiseLike<T>|Promise<T>}
         */
        ctrl.updateClient = function () {
            return ClientService.updateClient(ctrl.client).then(function (response) {
                if(response.data.error) {
                    showNotify('danger', 'ti-close', response.data.message);
                }
                else {
                    ctrl.clientList[ctrl.client.indexElem] = angular.copy(ctrl.client);
                    ctrl.showClientList = true;
                    showNotify('success', 'ti-check', response.data.message);
                }
            });
        };

        /**
         * Metodo para confirmar la eliminacion de un cliente
         * @param clientId El id del cliente a eliminar
         * @param index El index en la lista de clientes
         */
        ctrl.deleteClient = function (clientId, index) {
            swal({
                title: "Confirmación",
                text: "¿Seguro que deseas eliminar al cliente?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger btn-fill",
                confirmButtonText: "Si, Eliminar!",
                cancelButtonClass: "btn-default btn-fill",
                cancelButtonText: "Cancelar",
                closeOnConfirm: true
            }, function (isConfirm) {
                if(isConfirm) {
                    return ClientService.deleteClient(clientId).then(function (response) {
                        if(response.data.error) {
                            showNotify('danger', 'ti-close', response.data.message);
                        }
                        else {
                            ctrl.clientList.splice(index, 1);
                            showNotify('success', 'ti-check', response.data.message);
                        }
                    });
                }
            });
        };


    });

})();