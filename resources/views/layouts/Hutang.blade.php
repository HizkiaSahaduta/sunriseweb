@extends('main')

@section('contentcss')
<link rel="stylesheet" type="text/css" href="{{ asset('outside/material/vendors/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('outside/material/vendors/select2/select2-materialize.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.4/css/responsive.dataTables.min.css" />
<style>

hr.style {
  border-top: 1px dashed #888ea8;
}

.dataTables_wrapper {
    font-family: muli;
    font-size: 14px;
    position: relative;
    clear: both;
}

div.dataTables_wrapper div.dataTables_length label {
    font-weight: normal;
    text-align: left;
    white-space: nowrap;
    padding: 20px;
}
.preloader1 {
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

#preloader2 {
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

    blockquote {
        margin: 10px 0;
        padding-left: 1.1rem;
        border-left: 5px solid #3f51b5;
        font-size: 11px;
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
               <h5 class="breadcrumbs-title mt-0 mb-0"><span>Hutang</span></h5>
               <ol class="breadcrumbs mb-0">
                  {{-- <li class="breadcrumb-item ">
                     <a href="#">Home</a>
                  </li> --}}
                  <li class="breadcrumb-item ">
                     <a href="#">Report</a>
                  </li>
                  <li class="breadcrumb-item">
                     <a href="#">Hutang</a>
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
                    Hello {{ Session::get('USERNAME') }}, here's list of debt report. Have a good day :)
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
                            <i class="material-icons prefix">account_balance</i>
                            <select class="basic browser-default" id='paid' name='paid'>
                                <option value="" selected>All</option>
                                <option value="N">N</option>
                                <option value="Y">Y</option>
                            </select>
                            <label>Paid Flag</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                        <p>
                                <label>
                                  <input name="group1" type="radio" id="radio1" value="byDateInv" checked/>
                                  <span>by Date Inv.</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                  <input name="group1" type="radio" id="radio2" value="byDueDate"/>
                                  <span>by Due Date</span>
                                </label>
                            </p>
                            <br>

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
                <div class="card-content" id="cardSummaryHutang">
                    <div id="preloader1" style="display: none"></div>
                    <h6>Summary :</h6> 
                    <blockquote id="TotalInv"></blockquote>
                    <blockquote id="TotalBilling"></blockquote> 
                    <blockquote id="TotalPaid"></blockquote>
                    <blockquote id="TotalHutang"></blockquote>
                    {{-- <blockquote id="TotalInvPaid"></blockquote> --}}
                    <table id="SummaryHutang"  class="striped" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>Total.Inv</th>
                            <th>Vendor.Name</th>
                            <th>Amt.Total</th>
                            <th>Amt.Paid</th>
                            {{-- <th>Total.Inv.Paid</th> --}}
                            <th>PaidFlag</th>
                            <th>Total.Hutang</th>
                            <th>Detail</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>


         </div>
      </div>
   </div>


</div>

<div id="detail" class="modal modal-fixed-footer">
    <div class="preloader1"></div>
	<div class="modal-content">
        <div id="headerModal"></div>
        <div class="row">
       
            <div class="divider mb-3 mt-3"></div>
            
            <table id="OverviewHutang" class="striped" style="width: 100%;">
                <thead>
                <tr>
                    <th>VendorName</th>
                    <th>Tr.ID</th>
                    <th>Inv.ID</th>
                    <th>Dt.Inv</th>
                    <th>Due.Date</th>
                    <th>Currency</th>
                    <th>Ex.Rate</th>
                    <th>Amt.Total</th>
                    <th>Amt.Paid.Disc</th>
                    <th>Amt.Paid</th>
                    <th>PayTerm</th>
                    <th>PaidFlag</th>
                    <th>Hutang</th>
                </tr>
                </thead>
            </table>
   
        </div>
    </div>
    <div class="modal-footer">
        <a href="javascript:void(0)" class="modal-action modal-close btn waves-effect waves-light grey darken-3 z-depth-4">
            Close
        </a>
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

var selectedValue, e, mill, dt_start, dt_end, customer, paid, allreq

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function getAllSummary(a){

    $.ajax({
        type: "POST",
        dataType: "json",
        url:'{!!url("getAllSummaryHutang")!!}'+'?mill=' +mill.trim()+a,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success: function (data) {

            if (data['error']) {
                swal("Error", (data['error']) , "error");
            } else {

                $.each(data, function(index, element) {

                    $('#TotalInv').text('Total Invoices: '+numberWithCommas(Math.round(element.total_inv))+" invoices")
                    $('#TotalHutang').text('Total. Unpaid: IDR. '+numberWithCommas(Math.round(element.total_hutang)))
                    $('#TotalBilling').text('Total. Billing: IDR. '+ numberWithCommas(Math.round(element.amt_total)))
                    $('#TotalPaid').text('Total. Paid: IDR. '+ numberWithCommas(Math.round(element.amt_paid)))
                    // $('#TotalInvPaid').text('Paid Invoices: '+numberWithCommas(Math.round(element.total_paid))+" invoices")
                                
                });

                
            }
                        
        }
    });
}

function getTable1 (a, b) {
    var dataTable = $(a).DataTable({
        destroy : true,
        responsive: true,
        processing: true,
        serverSide: true,
        autoWidth: true,
        pageLength: 5,
        // dom: 'Pfrtip',
        ajax: {
            'url':'{!!url("getSummaryHutang")!!}'+'?mill=' +mill.trim()+b,
            'type': 'post',
            'headers': {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        },
        columns: [
                {data: 'total_inv', name: 'total_inv', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                {data: 'vendor_name', name: 'vendor_name'},
                {data: 'amt_total', name: 'amt_total', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                {data: 'amt_paid', name: 'amt_paid', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                // {data: 'total_paid', name: 'total_paid', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                {data: 'paid_flag', name: 'paid_flag'},
                {data: 'total_hutang', name: 'total_hutang', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                {data: 'Detail', name: 'Detail',orderable:false,searchable:false}
        ],
        initComplete: function(settings, json) {
            if (dataTable.rows().data().length) {
                preloader1.style.display = "none";
                document.getElementById("submitform").disabled = false;
            }
            if (!dataTable.rows().data().length) {
                swal("Oops! :(", "Data not available", "error");
                preloader1.style.display = "none";
                document.getElementById("submitform").disabled = false;
            }
        },
    });
}

function getTable2 (a, b) {
    var dataTable = $(a).DataTable({
        destroy : true,
        responsive: true,
        processing: true,
        serverSide: true,
        autoWidth: true,
        pageLength: 3,
        // dom: 'Pfrtip',
        ajax: {
            'url':'{!!url("getOverviewHutang")!!}'+'?mill=' +mill.trim()+b,
            'type': 'post',
            'headers': {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        },
        columns: [
                {data: 'vendor_name', name: 'vendor_name'},
                {data: 'tr_id', name: 'tr_id'},
                {data: 'inv_id', name: 'inv_id'},
                {data: 'dt_inv', name: 'dt_inv'},
                {data: 'dt_due', name: 'dt_due'},
                {data: 'curr_id', name: 'curr_id'},
                {data: 'exchange_rate', name: 'exchange_rate'},
                {data: 'amt_total', name: 'amt_total', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                {data: 'amt_paid_disc', name: 'amt_paid_disc', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                {data: 'amt_paid', name: 'amt_paid', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                {data: 'pay_term_id', name: 'pay_term_id'},
                {data: 'paid_flag', name: 'paid_flag'},
                {data: 'hutang', name: 'hutang', render: $.fn.dataTable.render.number(',', '.', 2, '')}
            ],
            initComplete: function(settings, json) {
                if (dataTable.rows().data().length) {
                    $('.preloader1').hide();
                }
                if (!dataTable.rows().data().length) {
                    swal("Oops! :(", "Data not available", "error");
                    $('.preloader1').hide();
                }
            },
    });
}


$(document).ready(function() {

    $('#Report').addClass('active open');
    $('#ReportCSS').css('display','block');
    $('#Hutang').addClass('active gradient-45deg-green-teal gradient-shadow');

    var reportTable = document.getElementById("reportTable")
    var preloader1 = document.getElementById("preloader1")
    var cardOverviewHutang = document.getElementById("cardOverviewHutang")
    var cardSummaryHutang = document.getElementById("cardSummaryHutang")

    $(".modal").modal();

    $("#vendor").select2({
        placeholder: "Choose Mill Id first"
    });

    $("#mill_id").select2({
        placeholder: "Choose Mill Id first"
    });

    $("#paid").select2({});

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
                            url: '{{url("getVendor")}}?mill=' +mill_id,
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
        
        var rbs = document.querySelectorAll('input[name="group1"]');
            for (const rb of rbs) {
                if (rb.checked) {
                    selectedValue = rb.value;
                    break;
                }
            }

        e = document.getElementById("mill_id");
        mill = e.options[e.selectedIndex].value;
        dt_start = $("#start").val();
        dt_end = $("#end").val();
        vendor = $('#vendor').val();
        paid = $('#paid').val();
        allreq = '';

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


                    if (vendor){

                        allreq = allreq+'&vendor='+vendor.trim();
                    }

                    if (paid){

                        allreq = allreq+'&paid='+paid.trim();
                    }

                    if (selectedValue){

                        allreq = allreq+'&byWhat='+selectedValue.trim();
                    }

                    reportTable.style.display = "block";
                    preloader1.style.display = "block";
                    document.getElementById("submitform").disabled = true;

                    $('html, body').animate({
                        scrollTop: $("#reportTable").offset().top
                    }, 1200);

                    var a = '#SummaryHutang';

                    getAllSummary(allreq);

                    getTable1(a, allreq);

                    
                }
                else {
                    swal("Cancel searching for whole data's");
                }
            });

        }

        else {

          if (vendor){

              allreq = allreq+'&vendor='+vendor.trim();
          }

          if (paid){

              allreq = allreq+'&paid='+paid.trim();
          }

          if (selectedValue){

               allreq = allreq+'&byWhat='+selectedValue.trim();
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

            reportTable.style.display = "block";
            preloader1.style.display = "block";
            document.getElementById("submitform").disabled = true;

            $('html, body').animate({
                scrollTop: $("#reportTable").offset().top
            }, 1200);

            var a = '#SummaryHutang';

            getAllSummary(allreq);

            getTable1(a, allreq);

        }

    });

    $('body').on('click', '.detail', function(e) {

        $('.preloader1').show();
        id = $(this).data('id1');
        id2 = $(this).data('id2');
        var title = "<h6 class='modal-title'>Detail of "+id2+"</h6>";
        $('#headerModal').html(title);

        allreq = '';

        if (id){

            allreq = allreq+'&vendor='+id.trim();
        }

        if (paid){

            allreq = allreq+'&paid='+paid.trim();
        }

        if (selectedValue){

            allreq = allreq+'&byWhat='+selectedValue.trim();

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

        var a = '#OverviewHutang';

        getTable2(a, allreq);





    });

    $('#resetform').on('click', function() {

        $('#mill_id').val(null).trigger('change');
        $('#vendor').val(null).trigger('change');
        $('#paid').val(null).trigger('change');
        $('#start').val('');
        $('#end').val('');
        $("#radio1").prop("checked", true);
        reportTable.style.display = "none"

    });






});



</script>

@endsection
