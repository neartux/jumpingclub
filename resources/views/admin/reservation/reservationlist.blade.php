@extends('admin.layouts.app')

@section('content')
    <link href="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .dropdown-menu{
            position:absolute;
            top:100%;
            left:0;
            z-index:1000;
            display:none;
            float:left;
            min-width:160px;
            padding:5px 0;
            margin:2px 0 0;
            font-size:14px;
            text-align:left;
            list-style:none;
            background-color:#fff;
            -webkit-background-clip:padding-box;
            background-clip:padding-box;
            border:1px solid #ccc;
            border:1px solid rgba(0,0,0,.15);
            border-radius:4px;
            -webkit-box-shadow:0 6px 12px rgba(0,0,0,.175);
            box-shadow:0 6px 12px rgba(0,0,0,.175)
        }
        #DataTables_Table_0_length, #DataTables_Table_0_filter {
            display: inline;
        }
        #DataTables_Table_0_filter {
            float: right;
        }
        @media (min-width: 992px){
            .typo-line{
                padding-left: 140px;
                margin-bottom: 40px;
                position: relative;
            }

            .typo-line .category{
                transform: translateY(-50%);
                top: 50%;
                left: 0px;
                position: absolute;
            }
        }

        .icon-section {
            margin: 0 0 3em;
            clear: both;
            overflow: hidden;
        }
        .icon-container {
            width: 240px;
            padding: .7em 0;
            float: left;
            position: relative;
            text-align: left;
        }
        .icon-container [class^="ti-"],
        .icon-container [class*=" ti-"] {
            color: #000;
            position: absolute;
            margin-top: 3px;
            transition: .3s;
        }
        .icon-container:hover [class^="ti-"],
        .icon-container:hover [class*=" ti-"] {
            font-size: 2.2em;
            margin-top: -5px;
        }
        .icon-container:hover .icon-name {
            color: #000;
        }
        .icon-name {
            color: #aaa;
            margin-left: 35px;
            font-size: .8em;
            transition: .3s;
        }
        .icon-container:hover .icon-name {
            margin-left: 45px;
        }

        .places-buttons .btn{
            margin-bottom: 30px
        }
        .sidebar .nav > li.active-pro{
            position: absolute;
            width: 100%;
            bottom: 10px;
        }
        .sidebar .nav > li.active-pro a{
            background: rgba(255, 255, 255, 0.14);
            opacity: 1;
            color: #FFFFFF;
        }

        .table-upgrade td:nth-child(2),
        .table-upgrade td:nth-child(3){
            text-align: center;
        }
        body.nude{
            background-color: #f4f3ef;
        }

        /* fixed plugin on the right */
        .fixed-plugin li > a,
        .fixed-plugin .badge{
            transition: all .34s;
            -webkit-transition: all .34s;
            -moz-transition: all .34s;
        }

        .fixed-plugin{
            position: absolute;
            top: 180px;
            right: 0;
            width: 64px;
            background: rgba(0,0,0,.3);
            z-index: 1031;
            border-radius: 8px 0 0 8px;
            text-align: center;
        }
        .fixed-plugin .fa-cog{
            color: #FFFFFF;
            padding: 10px;
            border-radius: 0 0 6px 6px;
            width: auto;
        }
        .fixed-plugin .dropdown-menu{
            right: 80px;
            left: auto;
            width: 290px;
            border-radius: 10px;
            padding: 10px;
        }
        .fixed-plugin .dropdown-menu:after, .fixed-plugin .dropdown-menu:before{
            right: 10px;
            margin-left: auto;
            left: auto;
        }
        .fixed-plugin .fa-circle-thin{
            color: #FFFFFF;
        }
        .fixed-plugin .active .fa-circle-thin{
            color: #00bbff;
        }

        .fixed-plugin .dropdown-menu > .active > a,
        .fixed-plugin .dropdown-menu > .active > a:hover,
        .fixed-plugin .dropdown-menu > .active > a:focus{
            color: #777777;
            text-align: center;
        }

        .fixed-plugin img{
            border-radius: 0;
            width: auto;
            height: 100px;
            transform: translateX(-30%);
            -webkit-transform: translateX(-30%);
            margin: 0 auto;
        }

        .fixed-plugin .badge{
            border: 3px solid #FFFFFF;
            border-radius: 50%;
            cursor: pointer;
            display: inline-block;
            height: 28px;
            margin-right: 5px;
            position: relative;
            width: 28px;
        }

        .fixed-plugin .badge.active,
        .fixed-plugin .badge:hover{
            border-color: #00bbff;
        }

        .fixed-plugin .badge-white{
            background-color: #EBEBEB;
        }
        .fixed-plugin .badge-black{
            background-color: #212120;
        }
        .fixed-plugin .badge-primary{
            background-color: #7A9E9F;
        }
        .fixed-plugin .badge-info{
            background-color: #68B3C8;
        }
        .fixed-plugin .badge-success{
            background-color: #7AC29A;
        }
        .fixed-plugin .badge-warning{
            background-color: #F3BB45;
        }
        .fixed-plugin .badge-danger{
            background-color: #EB5E28;
        }
        .fixed-plugin .badge-brown{
            background-color: #66615B;
        }

        .fixed-plugin h5{
            font-size: 14px;
            margin: 10px;
        }
        .fixed-plugin .dropdown-menu li{
            display: block;
            padding: 10px 5px;
            width: 25%;
            float: left;
        }

        .fixed-plugin li.adjustments-line,
        .fixed-plugin li.header-title,
        .fixed-plugin li.button-container{
            width: 100%;
            min-height: inherit;
        }

        .fixed-plugin li.button-container{
            height: auto;
        }
        .fixed-plugin li.button-container div{
            margin-bottom: 5px;
        }

        .fixed-plugin #sharrreTitle{
            text-align: center;
            padding: 10px 0;
            height: 50px;
        }

        .fixed-plugin li.header-title{
            height: 30px;
            line-height: 35px;
            font-size: 12px;
            font-weight: 600;
            text-align: center;
            text-transform: uppercase;
        }

        .fixed-plugin .adjustments-line p{
            float: left;
            display: inline-block;
            margin-bottom: 0;
            font-size: 1em;
        }
        .fixed-plugin .adjustments-line .switch{
            float: right;
        }
        .fixed-plugin .dropdown-menu > li.adjustments-line > a{
            padding-right: 0;
            padding-left: 0;
            border-bottom: 1px solid #ddd;
            margin: 0;
        }

        .fixed-plugin .dropdown-menu > li > a.switch-trigger:hover,
        .fixed-plugin .dropdown-menu > li > a.switch-trigger:focus{
            background-color: transparent;
        }

        .fixed-plugin .dropdown-menu > li > a img{
            margin-top: auto;
        }

        .fixed-plugin .btn-social{
            width: 50%;
            display: block;
            width: 48%;
            float: left;
            font-weight: 600;
        }
        .fixed-plugin .btn-social i{
            margin-right: 5px;
        }
        .fixed-plugin .btn-social:first-child{
            margin-right: 2%;
        }

        .fixed-plugin .dropdown-menu{
            background: #FFFFFF;
        }

        @media (min-width: 992px){
            .fixed-plugin .dropdown .dropdown-menu{
                -webkit-transform: translateY(-15%);
                -moz-transform: translateY(-15%);
                -o-transform: translateY(-15%);
                -ms-transform: translateY(-15%);
                transform: translateY(-15%);
                top: 27px;
                opacity: 0;

                transform-origin: 0 0;
            }
            .fixed-plugin .dropdown.open .dropdown-menu{
                opacity: 1;

                -webkit-transform: translateY(-15%);
                -moz-transform: translateY(-15%);
                -o-transform: translateY(-15%);
                -ms-transform: translateY(-15%);
                transform: translateY(-15%);

                transform-origin: 0 0;
            }

            .fixed-plugin .dropdown-menu:before,
            .fixed-plugin .dropdown-menu:after{
                content: "";
                display: inline-block;
                position: absolute;
                top: 33px;
                width: 16px;
                transform: translateY(-50%);
                -webkit-transform: translateY(-50%);
                -moz-transform: translateY(-50%);

            }
            .fixed-plugin .dropdown-menu:before{
                border-bottom: 16px solid rgba(0, 0, 0, 0);
                border-left: 16px solid #F1EAE0;
                border-top: 16px solid rgba(0,0,0,0);
                right: -16px;
            }

            .fixed-plugin .dropdown-menu:after{
                border-bottom: 16px solid rgba(0, 0, 0, 0);
                border-left: 16px solid #FFFFFF;
                border-top: 16px solid rgba(0,0,0,0);
                right: -15px;
            }

            .typo-line{
                padding-left: 140px;
                margin-bottom: 40px;
                position: relative;
            }

            .typo-line .category{
                transform: translateY(-50%);
                top: 50%;
                left: 0px;
                position: absolute;
            }

            .fixed-plugin{
                top: 120px;
            }

        }

        @media (max-width: 991px){
            .fixed-plugin .dropdown-menu{
                right: 60px;
                width: 220px;
            }
            .fixed-plugin .dropdown-menu li{
                width: 50%;
            }

            .fixed-plugin li.adjustments-line,
            .fixed-plugin li.header-title,
            .fixed-plugin li.button-container{
                width: 100%;
                height: 55px;
                min-height: inherit;
            }

            .fixed-plugin li.button-container{
                height: auto;
            }

            .fixed-plugin .adjustments-line .switch{
                float: right;
                margin: 0 0px;
            }

            .fixed-plugin li.header-title{
                height: 40px;
            }
            .fixed-plugin .dropdown .dropdown-menu{
                top: -170px;
            }

            .fixed-plugin .dropdown-menu:before,
            .fixed-plugin .dropdown-menu:after{
                display: none;
            }
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

                                    {{--<div class="col-sm-12">
                                        <div class="col-md-4">
                                            <h4 class="card-title">Date Picker</h4>
                                            <div class="form-group">
                                                <input type="text" class="form-control border-input datepicker" placeholder="Date Picker Here"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h4 class="card-title">Time Picker</h4>
                                            <div class="form-group">
                                                <input type="text" class="form-control border-input timepicker" placeholder="Time Picker Here"/>
                                            </div>
                                        </div>
                                    </div>--}}

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
                                                <th width="3%" class="bold">#</th>
                                                <th width="10%" class="bold">Fecha Creación</th>
                                                <th width="10%" class="bold">Fecha Evento</th>
                                                <th class="bold">Cliente</th>
                                                <th width="8%" class="bold">Total</th>
                                                <th width="15%" class="bold">Comentarios</th>
                                                <th width="10%" class="bold">Estatus</th>
                                                <th width="15%" class="bold">Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr data-ng-repeat="reservation in ctrl.reservationList.data">
                                                <td>@{{ $index + 1 }}</td>
                                                <td>@{{ reservation.created_at }}</td>
                                                <td>@{{ reservation.event_date }} @{{ reservation.event_time }}</td>
                                                <td>@{{ reservation.name }} @{{ reservation.last_name }}</td>
                                                <td>@{{ reservation.total | currency }}</td>
                                                <td>@{{ reservation.comments }}</td>
                                                <td>
                                                    <span class="badge badge-info"
                                                          data-ng-if="reservation.status_id == '{{ StatusKeys::STATUS_ACTIVE}}'">
                                                        Activo
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="javascript:;" class="btn btn-simple btn-info btn-icon like"
                                                       title="Editar @{{ product.name }}" data-ng-click="ctrl.showEditProduct(product);">
                                                        <i class="ti-pencil-alt"></i>
                                                    </a>
                                                    <a href="javascript:;" class="btn btn-simple btn-warning btn-icon like"
                                                       title="Publicar @{{ product.name }}"
                                                       data-ng-show="product.public == 0" data-ng-click="ctrl.publicProduct(product, true);">
                                                        <i class="ti-world"></i>
                                                    </a>
                                                    <a href="javascript:;" class="btn btn-simple btn-success btn-icon like"
                                                       title="Despublicar @{{ product.name }}"
                                                       data-ng-show="product.public == 1" data-ng-click="ctrl.publicProduct(product, false);">
                                                        <i class="ti-world"></i>
                                                    </a>
                                                    <a href="javascript:;" class="btn btn-simple btn-danger btn-icon like"
                                                       title="Eliminar @{{ product.name }}"
                                                       data-ng-click="ctrl.deleteProduct($index, product.id);">
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

        <div class="content" data-ng-show="!ctrl.showReservationList">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">
                                    Informacion de la reservacion
                                    <button type="button" name="back" class="btn btn-default btn-fill btn-wd mr"
                                            data-ng-click="ctrl.goBackToProductList()" style="float: right;">
                                        <i class="ti-back-left"></i> Regresar</button>
                                </h4>
                            </div>
                            <div class="content mt-xl">




                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>


@endsection

@section('script-section')
    <script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/demo.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/angular-datatable/angular-datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/scripts/reservation/ReservationProvider.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/scripts/reservation/ReservationController.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            initFieldsNumeric();
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