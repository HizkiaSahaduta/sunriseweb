@extends('main')

@section('contentcss')
<link rel="stylesheet" type="text/css" href="{{ asset('outside/material/vendors/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('outside/material/vendors/select2/select2-materialize.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.4/css/responsive.dataTables.min.css" />
<style>
.dataTables_wrapper {
    font-family: muli;
    font-size: 14px;
    position: relative;
    clear: both;
}
#preloader {
   position: absolute;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   z-index: 9999;
   background-image: url("{{ asset('outside/images/Pulse-0.6s-200px.gif') }}");
   background-repeat: no-repeat;
   background-color: #FFF;
   background-position: center;
}

@media (max-width: 991px) {

    table.striped>tbody>tr>td {
        border-radius: 0;
        font-size: 11px;
    }

    div.dataTables_wrapper div.dataTables_length, div.dataTables_wrapper div.dataTables_filter, div.dataTables_wrapper div.dataTables_info, div.dataTables_wrapper div.dataTables_paginate {
        text-align: center;
        font-size: 11px;
    }

    table.dataTable thead>tr>th.sorting_asc, table.dataTable thead>tr>th.sorting_desc, table.dataTable thead>tr>th.sorting, table.dataTable thead>tr>td.sorting_asc, table.dataTable thead>tr>td.sorting_desc, table.dataTable thead>tr>td.sorting {
        padding-right: 30px;
        font-size: 12px;
    }
}


</style>
@endsection

@section('content')

<!-- BEGIN: Page Main-->
<div class="row">
   <div
      class="content-wrapper-before  gradient-45deg-green-teal ">
   </div>
<!-- BEGIN: Breadcrumb-->
   <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
      <div class="container">
         <div class="row">
            <div class="col s10 m6 l6">
               <h5 class="breadcrumbs-title mt-0 mb-0"><span>Purchase Order Report </span></h5>
               <ol class="breadcrumbs mb-0">
                  {{-- <li class="breadcrumb-item ">
                     <a href="#">Home</a>
                  </li> --}}
                  <li class="breadcrumb-item ">
                     <a href="#">Report</a>
                  </li>
                  <li class="breadcrumb-item">
                     <a href="#">Purchase Order Report</a>
                  </li>
               </ol>
            </div>
         </div>
      </div>
   </div>
<!-- End: Breadcrumb-->

   <div class="col s12">
      <div class="container">
         <div class="section">
            <div class="card">
               <div class="card-content">
                  <p class="caption mb-0">
                    Hello {{ Session::get('USERNAME') }}, here's list of purchase order report. Have a good day :)
                  </p>
               </div>
            </div>

            <div class="card">
                <div class="card-content">

                    <div class="row">
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">business</i>
                            <select class="basic browser-default" id="mill_id" name="mill_id">
                                <option></option>
                                <option value="SR">Sunrise Steel</option>
                                <option value="SM">Sunrise Mill</option>
                            </select>
                            <label>Mill ID</label>
                        </div>
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">account_circle</i>
                            <select class="browser-default" id="vendor" name="vendor"></select>
                            <label>Vendor</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col m4 s12">
                            <i class="material-icons prefix">date_range</i>
                            <input type="text" class="datepicker" name="start" id="start" placeholder="Start date" readonly="readonly">
                            <label>Start Date</label>
                        </div>
                        <div class="input-field col m4 s12">
                            <i class="material-icons prefix">date_range</i>
                            <input type="text" class="datepicker" name="end" id="end" placeholder="End date" readonly="readonly">
                            <label>End Date</label>
                        </div>
                        <div class="input-field col m4 s12">
                            <i class="material-icons prefix">assignment_turned_in</i>
                            <select class="basic browser-default" id='status' name='status'>
                                <option value='' selected>All</option>
                                <option value="O">O</option>
                                <option value="C">C</option>
                                <option value="R">R</option>
                            </select>
                            <label>Status</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">

                            <button class="btn waves-effect waves-light green darken-1" id="resetform">Reset
                                <i class="material-icons right">refresh</i>
                            </button>

                            <button class="btn waves-effect waves-light blue darken-1" type="submit" name="action" id="submitform">Submit
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>


                </div>
            </div>

            <div class="card" id="reportTable" style="display: none">
                <div id="preloader" style="display: none"></div>
                <div class="card-content">
                    <h6> Here's your search result : </h6>
                    <table id="reportPO" class="striped" style="width: 100%">
                        <thead>
                        <tr>
                          <th>Invoice </th>
                          <th>PO ID</th>
                          <th>Stat</th>
                          <th>PO Item</th>
                          <th>Vendor Name</th>
                          <th>Prod.Code</th>
                          <th>Descr</th>
                          <th>Item.Desc</th>
                          <th>Qty</th>
                          <th>Weight</th>
                          <th>Unit.Meas</th>
                          <th>Unit.Price</th>
                          <th>Curr</th>
                          <th>Amt.Net</th>
                          <th>Qty.Rcv</th>
                          <th>Wgt.Rcv</th>
                        </tr>
                        </thead>
                    </table>

                </div>
            </div>


         </div>
      </div>
   </div>


</div>
<!-- END: Page Main-->

@endsection

@section('contentjs')
<script src="{{ asset('outside/material/vendors/select2/select2.full.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.4/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.4/js/responsive.bootstrap4.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {

    $('#Report').addClass('active open');
    $('#ReportCSS').css('display','block');
    $('#POReport').addClass('active gradient-45deg-green-teal gradient-shadow');

    var reportTable = document.getElementById("reportTable")
    var preloader = document.getElementById("preloader")
    var reportPO = document.getElementById("reportPO")


    $("#vendor").select2({
        placeholder: "Choose Mill Id first"
    });

    $("#mill_id").select2({
        placeholder: "Choose Mill Id first"
    });

    $("#status").select2({});

    $('#mill_id').change(function(){

        var e = document.getElementById("mill_id");
        var mill_id = e.options[e.selectedIndex].value;
        if (mill_id == '' || mill_id == null || mill_id == '--Choose Mill--'){;
            $("#vendor").select2({
                placeholder: "Choose Mill Id first"
            });
        }
        else {

                $("#vendor").select2({
                    placeholder: "Search Vendor Name",
                    allowClear: true,
                    minimumInputLength: 3,
                        ajax: {
                            url: "{{url('getVendor')}}?mill=" +mill_id,
                            dataType: 'json',
                            delay: 250,
                            processResults: function (data) {
                            return {
                                results:  $.map(data, function (item) {
                                    return {
                                        text: item.vendor_id + " || (" + item.vendor_name + ")",
                                        id: item.vendor_id
                                    }
                                })
                            };
                            },

                        cache: true
                        }
                });


        }
    });

    $('.datepicker').datepicker({
        format: 'yyyymmdd',
        autoClose: true,
        showClearBtn: true,
    });

    $('#submitform').on('click', function() {

        event.preventDefault();
        var e = document.getElementById("mill_id");
        var mill = e.options[e.selectedIndex].value;
        var dt_start = $("#start").val();
        var dt_end = $("#end").val();
        var status = $('#status').val();
        var vendor = $('#vendor').val();
        var allreq = '';

        if (mill == '' || mill == null || mill == '--Choose Mill--'){

          swal('Oops!','You must choose Mill ID first','error');

        }

        else if ((dt_start == '' && dt_end == '') || (dt_start == null && dt_end == null)){

            swal({
            title: "Are you sure ?",
            text: "If you wanna search without adding date, it will searching whole data's and maybe will take a long time to be completed.",
            icon: "warning",
            buttons: true
            })
            .then((willGo) => {
                if (willGo) {

                    if (status){

                        allreq = allreq+'&status='+status.trim();
                    }

                    if (vendor){

                        allreq = allreq+'&vendor='+vendor.trim();
                    }

                    reportTable.style.display = "block";
                    preloader.style.display = "block";
                    document.getElementById("submitform").disabled = true;

                    $('html, body').animate({
                        scrollTop: $("#reportTable").offset().top
                        }, 1200);

                    var dataTable = $('#reportPO').DataTable({
                        destroy : true,
                        responsive: true,
                        processing: true,
                        serverSide: true,
                        autoWidth: true,
                        pageLength: 5,
                        // dom: 'Pfrtip',
                        ajax: {
                            'url':'{!!url("getPOReport")!!}'+'?mill=' +mill.trim()+allreq,
                            'type': 'post',
                            'headers': {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        },
                        columns: [
                                {data: 'dt_po', name: 'dt_po'},
                                {data: 'po_id', name: 'po_id'},
                                {data: 'stat', name: 'stat'},
                                {data: 'po_item', name: 'po_item'},
                                {data: 'vendor_name', name: 'vendor_name'},
                                {data: 'prod_code', name: 'prod_code'},
                                {data: 'descr', name: 'descr'},
                                {data: 'item_desc1', name: 'item_desc1'},
                                {data: 'qty', name: 'qty', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                                {data: 'wgt', name: 'wgt', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                                {data: 'unit_meas', name: 'unit_meas', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                                {data: 'unit_price', name: 'unit_price', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                                {data: 'curr_id', name: 'curr_id'},
                                {data: 'amt_net', name: 'amt_net', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                                {data: 'qty_recive', name: 'qty_recive', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                                {data: 'wgt_recive', name: 'wgt_recive', render: $.fn.dataTable.render.number(',', '.', 2, '')}
                            ],
                            initComplete: function(settings, json) {
                                if (dataTable.rows().data().length) {
                                    swal("Yay!", "Data loaded successfully", "success");
                                    preloader.style.display = "none";
                                    document.getElementById("submitform").disabled = false;
                                }
                                if (!dataTable.rows().data().length) {
                                    swal("Oops! :(", "Data not available", "error");
                                    preloader.style.display = "none";
                                    document.getElementById("submitform").disabled = false;
                                }
                            },
                        });


                }
                else {
                    swal("Cancel searching for whole data's");
                }
            });

        }

        else {


          if (status){

              allreq = allreq+'&status='+status.trim();
          }

          if (vendor){

              allreq = allreq+'&vendor='+vendor.trim();
          }

          if (dt_start && !dt_end){

              allreq = allreq+'&dt_start='+dt_start.trim();
          }

          if (!dt_start && dt_end){

              allreq = allreq+'&dt_end='+dt_end.trim();
          }

          if (dt_start && dt_end){

              allreq = allreq+'&dt_start='+dt_start.trim();
              allreq = allreq+'&dt_end='+dt_end.trim();
          }

          //alert(allreq);
          reportTable.style.display = "block";
          preloader.style.display = "block";
          document.getElementById("submitform").disabled = true;

          $('html, body').animate({
            scrollTop: $("#reportTable").offset().top
            }, 1200);

          var dataTable = $('#reportPO').DataTable({
            destroy : true,
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: true,
            pageLength: 5,
            // dom: 'Pfrtip',
            ajax: {
                'url':'{!!url("getPOReport")!!}'+'?mill=' +mill.trim()+allreq,
                'type': 'post',
                'headers': {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            columns: [
                    {data: 'dt_po', name: 'dt_po'},
                    {data: 'po_id', name: 'po_id'},
                    {data: 'stat', name: 'stat'},
                    {data: 'po_item', name: 'po_item'},
                    {data: 'vendor_name', name: 'vendor_name'},
                    {data: 'prod_code', name: 'prod_code'},
                    {data: 'descr', name: 'descr'},
                    {data: 'item_desc1', name: 'item_desc1'},
                    {data: 'qty', name: 'qty', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                    {data: 'wgt', name: 'wgt', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                    {data: 'unit_meas', name: 'unit_meas', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                    {data: 'unit_price', name: 'unit_price', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                    {data: 'curr_id', name: 'curr_id'},
                    {data: 'amt_net', name: 'amt_net', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                    {data: 'qty_recive', name: 'qty_recive', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                    {data: 'wgt_recive', name: 'wgt_recive', render: $.fn.dataTable.render.number(',', '.', 2, '')}
                ],
                initComplete: function(settings, json) {
                    if (dataTable.rows().data().length) {
                        swal("Yay!", "Data loaded successfully", "success");
                        preloader.style.display = "none";
                        document.getElementById("submitform").disabled = false;
                    }
                    if (!dataTable.rows().data().length) {
                        swal("Oops! :(", "Data not available", "error");
                        preloader.style.display = "none";
                        document.getElementById("submitform").disabled = false;
                    }
                },
            });


        }

    });

    $('#resetform').on('click', function() {

        $('#mill_id').val(null).trigger('change');
        $('#vendor').val(null).trigger('change');
        $('#status').val(null).trigger('change');
        $('#start').val('');
        $('#end').val('');
        reportTable.style.display = "none"



    });




});



</script>

@endsection
