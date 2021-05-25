<!DOCTYPE html>
<html class="loading" lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sunrise Web Dashboard</title>
    <link rel="apple-touch-icon" href="images/favicon/apple-touch-icon-152x152.png">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon/favicon-32x32.png">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('outside/material/vendors/vendors.min.css') }}">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('outside/material/vendors/sweetalert/sweetalert.css') }}">

    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('outside/material/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('outside/material/css/themes/vertical-modern-menu-template/style.css') }}">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('outside/material/css/laravel-custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('outside/material/css/custom/custom.css') }}">

    <!-- END: Custom CSS-->
    <style>

    .users-edit i,
    .users-list-wrapper i,
    .users-view i {
        vertical-align: middle;
    }
    .users-list-wrapper .users-list-filter .show-btn {
        padding-top: 43px !important;
    }
    .users-list-wrapper .users-list-table {
        overflow: hidden;
    }
    .users-list-wrapper .users-list-table .dataTables_filter label input {
        width: auto;
        height: auto;
        margin-left: 0.5rem;
    }
    .users-list-wrapper .users-list-table .dataTables_length label select {
        display: inline-block;
        width: auto;
        height: auto;
    }
    .users-list-wrapper .users-list-table .dataTable {
        border-collapse: collapse;
    }
    .users-list-wrapper .users-list-table .dataTable th {
        width: auto !important;
        padding: 19px 15px;
        border-bottom: 1px solid #e0e0e0;
    }
    .users-list-wrapper .users-list-table .dataTable tbody td {
        padding: 0.8rem;
    }
    .users-list-wrapper .users-list-table .dataTables_paginate .paginate_button {
        margin-top: 0.25rem;
        padding: 0.25em 0.65em;
    }
    .users-list-wrapper .users-list-table .dataTables_paginate .paginate_button.current,
    .users-list-wrapper .users-list-table .dataTables_paginate .paginate_button:hover {
        color: #fff !important;
        border: 1px solid #3f51b5;
        border-radius: 4px;
        background: #3f51b5;
        box-shadow: 0 0 8px 0 #3f51b5;
    }
    .users-view .media .avatar {
        margin-right: 0.6rem;
    }
    .users-view .media .users-view-name {
        font-size: 1.47rem;
    }
    .users-view .quick-action-btns a {
        margin-left: 1rem;
    }
    .users-view .users-view-timeline {
        padding: 1.2rem;
    }
    .users-view .users-view-timeline h6 span {
        font-size: 1.2rem;
        vertical-align: middle;
    }
    .users-view .striped td:first-child {
        width: 140px;
    }
    .users-edit .tabs .tab a {
        text-overflow: clip;
    }
    .users-edit .tabs .tab a span {
        position: relative;
        top: 2px;
    }
    .users-edit .tabs .tab a.active {
        border-radius: 4px;
        background-color: #e8eaf6;
    }
    .users-edit .user-edit-btns a,
    .users-edit form button[type="submit"] {
        margin-right: 1rem;
    }

    #load{
    position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background:url("{{ asset('outside/images/Leonardo.gif') }}") center no-repeat #fff;
    }

    @media (max-width: 991px) {

        h5 {
            line-height: 110%;
            font-size: 15px;
        }

        .card .card-content {
            padding: 24px;
            border-radius: 0 0 2px 2px;
            font-size: 12px;
        }

        #breadcrumbs-wrapper .breadcrumbs {
            padding: 0;
            margin: 15px 0;
            list-style: none;
            font-size: 10px;
        }

        #breadcrumbs-wrapper .breadcrumbs-title {
            font-size: 17px;
            line-height: 1.4rem;
        }

        .select-wrapper input.select-dropdown {
            position: relative;
            cursor: pointer;
            background-color: transparent;
            border: none;
            border-bottom: 1px solid #424242;
            outline: none;
            height: 3rem;
            line-height: 3rem;
            width: 100%;
            font-size: 1rem;
            margin: 0 0 8px;
            padding: 0;
            display: block;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            z-index: 1;
            font-size: 14px;
        }
        .input-field.col .prefix~.validate~label, .input-field.col .prefix~label {
            width: calc(100% - 4.5rem);
            font-size: 12px;
        }

        .input-field .prefix {
            position: absolute;
            width: 3rem;
            font-size: 1.5rem;
            -webkit-transition: color .2s;
            transition: color .2s;
            top: .5rem;
        }

        .input-field>label:not(.label-icon).active {
            -webkit-transform: translateY(-14px) scale(.8);
            transform: translateY(-14px) scale(.8);
            -webkit-transform-origin: 0 0;
            transform-origin: 0 0;
            font-size: 16px;
        }

        .btn, .btn-large, .btn-small {
            text-decoration: none;
            color: #fff;
            background-color: #ff4081;
            text-align: center;
            letter-spacing: .5px;
            -webkit-transition: background-color .2s ease-out;
            transition: background-color .2s ease-out;
            cursor: pointer;
            font-size: 12px;
        }

        input:not([type]):disabled, input:not([type])[readonly=readonly], input[type=date]:not(.browser-default):disabled, input[type=date]:not(.browser-default)[readonly=readonly], input[type=datetime-local]:not(.browser-default):disabled, input[type=datetime-local]:not(.browser-default)[readonly=readonly], input[type=datetime]:not(.browser-default):disabled, input[type=datetime]:not(.browser-default)[readonly=readonly], input[type=email]:not(.browser-default):disabled, input[type=email]:not(.browser-default)[readonly=readonly], input[type=number]:not(.browser-default):disabled, input[type=number]:not(.browser-default)[readonly=readonly], input[type=password]:not(.browser-default):disabled, input[type=password]:not(.browser-default)[readonly=readonly], input[type=search]:not(.browser-default):disabled, input[type=search]:not(.browser-default)[readonly=readonly], input[type=tel]:not(.browser-default):disabled, input[type=tel]:not(.browser-default)[readonly=readonly], input[type=text]:not(.browser-default):disabled, input[type=text]:not(.browser-default)[readonly=readonly], input[type=time]:not(.browser-default):disabled, input[type=time]:not(.browser-default)[readonly=readonly], input[type=url]:not(.browser-default):disabled, input[type=url]:not(.browser-default)[readonly=readonly], textarea.materialize-textarea:disabled, textarea.materialize-textarea[readonly=readonly] {
            color: #424242;
            border-bottom: 1px dotted #424242;
            font-size: 12px;
        }
        h6 {
            font-size: 1.15rem;
            margin: .575rem 0 .46rem;
            font-size: 15px;
        }
        .page-footer .container {
                padding: 0 15px;
                font-size: 9px;
        }
        .navbar .navbar-dark .header-search-wrapper i, .navbar .navbar-dark ul a {
            color: #fff;
            font-size: 10px;
        }
        .dropdown-content li>a>i {
            margin: 0 10px 0 15px;
            width: 20px;
        }

        [type=radio]:checked+span, [type=radio]:not(:checked)+span {
            position: relative;
            padding-left: 35px;
            cursor: pointer;
            display: inline-block;
            height: 25px;
            line-height: 25px;
            font-size: 1rem;
            -webkit-transition: .28s ease;
            transition: .28s ease;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            font-size: 10px;
        }

        .flatpickr-calendar {
            font-size: 12px !important;
        }
}

    </style>

    <script type="text/javascript">

        document.onreadystatechange = function () {
        var state = document.readyState
        if (state == 'complete') {
            setTimeout(function(){
                document.getElementById('interactive');
                document.getElementById('load').style.visibility="hidden";
            },1000);
        }
        }
    </script>

    @yield('contentcss')


</head>
<!-- END: Head-->

<body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu 2-columns"
data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">
<div id="load"></div>

@include('header')

@include('sidebar')

<div id="main">
@yield('content')
</div>

@include('footer')

<!-- BEGIN VENDOR JS-->
<script src="{{ asset('outside/material/js/vendors.min.js') }}"></script>
<script src="{{ asset('outside/material/vendors/sweetalert/sweetalert.min.js') }}"></script>
<!-- END PAGE VENDOR JS-->

<!-- BEGIN THEME  JS-->
<script src="{{ asset('outside/material/js/plugins.js') }}"></script>
<script src="{{ asset('outside/material/js/search.js') }}"></script>
<!-- END THEME  JS-->

<!-- BEGIN PAGE LEVEL JS-->
@yield('contentjs')
<script>
$(document).ready(function() {

    var MillProductionHeader = document.getElementById('MillProductionHeader');
    var SalesMarketingHeader = document.getElementById('SalesMarketingHeader');
    var FinanceHeader = document.getElementById('FinanceHeader');
    var EApprovalHeader = document.getElementById('EApprovalHeader');



    $(".SalesDataAnalysisTree").each(function(index){
        if(!$(this).find("li").length){
            var SalesDataAnalysis = document.getElementById('SalesDataAnalysis');
            var SalesDataAnalysisCSS = document.getElementById('SalesDataAnalysisCSS');
            SalesDataAnalysis.style.display = 'none';
            SalesDataAnalysisCSS.style.display = 'none';
            SalesMarketingHeader.style.display = 'none';
        }
    });

    $(".ProductionReportTree").each(function(index){
        if(!$(this).find("li").length){
            var ProductionReport = document.getElementById('ProductionReport');
            var ProductionReportCSS = document.getElementById('ProductionReportCSS');
            ProductionReport.style.display = 'none';
            ProductionReportCSS.style.display = 'none';
            MillProductionHeader.style.display = 'none';
        
        }
        
    });


    $(".SunriseSystemTree").each(function(index){
        if(!$(this).find("li").length){
            var SunriseSystem = document.getElementById('SunriseSystem');
            var SunriseSystemCSS = document.getElementById('SunriseSystemCSS');
            SunriseSystem.style.display = 'none';
            SunriseSystemCSS.style.display = 'none';
            MillProductionHeader.style.display = 'none';
        }
    });

    $(".ReportTree").each(function(index){
        if(!$(this).find("li").length){
            var Report = document.getElementById('Report');
            var ReportCSS = document.getElementById('ReportCSS');
            Report.style.display = 'none';
            ReportCSS.style.display = 'none';
            FinanceHeader.style.display = 'none';
        }
    });

    $(".FinAnalysisTree").each(function(index){
        if(!$(this).find("li").length){
            var Report = document.getElementById('FinAnalysis');
            var ReportCSS = document.getElementById('FinAnalysisCSS');
            FinAnalysis.style.display = 'none';
            FinAnalysisCSS.style.display = 'none';
            FinanceHeader.style.display = 'none';
        }
    });

    $(".PreOrderTree").each(function(index){
        if(!$(this).find("li").length){
            var PreOrder = document.getElementById('PreOrder');
            // var PreOrderHeader = document.getElementById('PreOrderHeader');
            var PreOrderCSS = document.getElementById('PreOrderCSS');
            PreOrder.style.display = 'none';
            // PreOrderHeader.style.display = 'none';
            PreOrderCSS.style.display = 'none';
        }
    });

    $(".PurchaseTree").each(function(index){
        if(!$(this).find("li").length){
            var Purchase = document.getElementById('Purchase');
            var PurchaseCSS = document.getElementById('PurchaseCSS');
            Purchase.style.display = 'none';
            PurchaseCSS.style.display = 'none';
            FinanceHeader.style.display = 'none';
        }
    });

    $(".SalesActivityTree").each(function(index){
        if(!$(this).find("li").length){
            var SalesActivity = document.getElementById('SalesActivity');
            var SalesActivityCSS = document.getElementById('SalesActivityCSS');
            SalesActivity.style.display = 'none';
            SalesActivityCSS.style.display = 'none';
            SalesMarketingHeader.style.display = 'none';
        }
    });

    $(".UsrManageTree").each(function(index){
        if(!$(this).find("li").length){
            var UsrManageTree = document.getElementById('UsrManageTree');
            var UsrManageTreeHeader = document.getElementById('UsrManageTreeHeader');
            var UsrManageCSS = document.getElementById('UsrManageCSS');
            UsrManageTree.style.display = 'none';
            UsrManageTreeHeader.style.display = 'none';
            UsrManageCSS.style.display = 'none';
        }
    });

    $(".MPFTree").each(function(index){
        if(!$(this).find("li").length){
            var MPFTree = document.getElementById('MPFTree');
            var mpfcss = document.getElementById('MPFCSS');
            MPFTree.style.display = 'none';
            mpfcss.style.display = 'none';
            EApprovalHeader.style.display = 'none';
        }
    });

});

</script>
<!-- BEGIN PAGE LEVEL JS-->

</body>
</html>
