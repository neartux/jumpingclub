@extends('admin.layouts.app')

@section('content')
    <link href="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/easy-autocomplete/easy-autocomplete.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/easy-autocomplete/easy-autocomplete.themes.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        #DataTables_Table_0_length, #DataTables_Table_0_filter {
            display: inline;
        }
        #DataTables_Table_0_filter {
            float: right;
        }
        .font-size14 {
        	font-size: 14px !important;
        }
        .font-size12 {
        	font-size: 12px !important;
        }
        .easy-autocomplete-container {
            top: 20px;
        }
        .easy-autocomplete {
            width: 100px !important;
        }
    </style>

    <div data-ng-app="Reservation" data-ng-controller="ReservationController as ctrl" data-ng-init="ctrl.init('{{ URL::to('/') }}')">

        <div class="content" data-ng-show="ctrl.showReservationList">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">
                                    <i class="ti-notepad"></i>
                                    Reservaciones
                                    <button class="btn btn-default btn-fill btn-wd" data-ng-click="ctrl.showCreateReservation();"
                                            style="float: right;">
                                        <i class="ti-plus"></i> Nuevo
                                    </button>
                                </h4>
                            </div>
                            <div class="content mt-xl">

                                <div class="row">

                                    <div class="col-sm-12">
                                        <form action="#" class="form-horizontal form-bordered">
                                            <div class="form-body">

                                                <div class="form-group">
                                                    <label class="control-label col-md-1 bold">Periodo</label>
                                                    <div class="col-md-4">
                                                        <div class="input-group" id="defaultrange">
                                                            <input type="text" class="form-control border-input daterange">
                                                            <span class="input-group-btn">
                                                            <button class="btn btn-info btn-fill date-range-toggle" type="button">
                                                                <i class="ti-calendar"></i>
                                                            </button>
                                                        </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <a href="javascript:;" class="btn btn-info btn-fill"
                                                           data-ng-click="ctrl.findReservationsByDate();">
                                                            <i class="fa fa-search"></i>&nbsp;
                                                            Buscar
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12" data-ng-show="!ctrl.reservationList.data.length">
                                        <div class="alert alert-warning">
                                            <span><b> Info - </b> No se encontraron reservaciones</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12" data-ng-show="ctrl.reservationList.data.length">
                                        <!-- <table class="table table-striped table-bordered"> -->
                                        <table dt-column-defs="ctrl.dtColumnDefs" datatable="ng" dt-instance="ctrl.dtInstance"
                                               dt-options="ctrl.dtOptions" class="table table-bordered table-striped table-condensed">
                                            <thead>
                                            <tr>
                                                <th width="3%" class="bold font-size14 p-n">#</th>
                                                <th width="10%" class="bold font-size14 p-n">Fecha Creación</th>
                                                <th width="10%" class="bold font-size14 p-n">Fecha Evento</th>
                                                <th class="bold font-size14 p-n">Cliente</th>
                                                <th width="8%" class="bold font-size14 p-n">Total</th>
                                                <th width="4%" class="bold font-size14 p-n">Pagado</th>
                                                <th width="15%" class="bold font-size14 p-n">Comentarios</th>
                                                <th width="15%" class="bold font-size14 p-n">Estatus</th>
                                                <th width="15%" class="bold font-size14 p-n">Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            	<tr data-ng-repeat="reservation in ctrl.reservationList.data" data-ng-init="ctrl.setStringStatus(reservation);">
	                                                <td class="font-size12">@{{ $index + 1 }}</td>
	                                                <td class="font-size12">@{{ reservation.created_at }}</td>
	                                                <td class="font-size12">@{{ reservation.event_date }} @{{ reservation.event_time }}</td>
	                                                <td class="font-size12">@{{ reservation.name }} @{{ reservation.last_name }}</td>
	                                                <td class="font-size12">@{{ reservation.total | currency }}</td>
	                                                <td class="font-size12">
                                            			<i class="ti-check"></i>
                                            		</td>
	                                                <td class="font-size12">@{{ reservation.comments }}</td>
	                                                <td class="font-size12">
                                                        <select class="form-control" data-ng-model="reservation.status_ids"
                                                                data-ng-change="ctrl.changeStatuReservation(reservation);">
                                                            <option value="">Seleccion</option>
                                                            <option value="{{ StatusKeys::STATUS_RESERVADO}}">Reservado</option>
                                                            <option value="{{ StatusKeys::STATUS_PAGADO}}">Pagado</option>
                                                            <option value="{{ StatusKeys::STATUS_ENVIADO}}">Enviado</option>
                                                            <option value="{{ StatusKeys::STATUS_FINALIZADO}}">Finalizado</option>
                                                        </select>
	                                                </td>
	                                                <td class="font-size12">
	                                                    <a href="javascript:;" class="btn btn-simple btn-danger btn-icon like"
	                                                       title="Eliminar"
	                                                       data-ng-click="ctrl.eliminarReserva(reservation.id);">
	                                                        <i class="ti-trash"></i>
	                                                    </a>
	                                                </td>
                                            	</tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @include('admin/reservation/reservationForm')

    </div>


@endsection

@section('script-section')
    <script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-daterangepicker/bootstrap-selectpicker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-daterangepicker/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-daterangepicker/demo.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/easy-autocomplete/jquery.easy-autocomplete.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/angular-datatable/angular-datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/scripts/reservation/ReservationProvider.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/scripts/reservation/ReservationController.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            initFieldsNumeric();

            $(".timepicker-no-seconds").timepicker({
                autoclose: !0,
                minuteStep: 5,
                defaultTime: !1
            });

            $(".date-picker").datepicker({
                orientation: "left",
                autoclose: true,
                format: "dd/mm/yyyy"
            });
        });

        function initFieldsNumeric() {
            $(".numeric-field").numeric({
                allowPlus           : false,
                allowMinus          : false,
                allowThouSep        : false,
                allowDecSep         : true,
                allowLeadingSpaces  : false,
                maxDigits           : 10,
                maxDecimalPlaces    : 2,
                maxPreDecimalPlaces : NaN,
                max                 : NaN,
                min                 : NaN
            });
        }
    </script>
@endsection