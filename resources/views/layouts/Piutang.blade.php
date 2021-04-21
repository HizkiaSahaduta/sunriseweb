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
#preloader1 {
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
               <h5 class="breadcrumbs-title mt-0 mb-0"><span>Piutang</span></h5>
               <ol class="breadcrumbs mb-0">
                  {{-- <li class="breadcrumb-item ">
                     <a href="#">Home</a>
                  </li> --}}
                  <li class="breadcrumb-item ">
                     <a href="#">Report</a>
                  </li>
                  <li class="breadcrumb-item">
                     <a href="#">Piutang</a>
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
                    Hello {{ Session::get('USERNAME') }}, here's list of acc. receiveable report. Have a good day :)
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
                            <select class="browser-default" id="customer" name="vendor"></select>
                            <label>Customer</label>
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
                            <select class="browser-default" id='paid' name='paid'>
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
                <div class="card-content" id="cardSummaryPiutang">
                    <div id="preloader1" style="display: none"></div>
                    <h6>Summary :</h6> 
                    <blockquote id="TotalInvoice"></blockquote>
                    {{-- <blockquote id="TotalPiutangCurrent"></blockquote> --}}
                    <blockquote id="TotalPiutangAll"></blockquote>
                    <table id="SummaryPiutang"  class="striped" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>Total.Inv</th>
                            <th>Cust.Name</th>
                            <th>Amt.Total</th>
                            <th>Amt.Paid</th>
                            <th>Total.Inv.Paid</th>
                            <th>PaidFlag</th>
                            <th>TotalPiutang</th>
                        </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th colspan="3"></th>
                                <th colspan="4"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <hr class="style">

                <div class="card-content" id="cardOverviewPiutang">
                    <h6>Overview :</h6>
                    <table id="OverviewPiutang" class="striped" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>Cust.Name</th>
                            <th>Inv.ID</th>
                            <th>Order.ID</th>
                            <th>Dt.Inv</th>
                            <th>Due.Date</th>
                            <th>Salesman</th>
                            <th>Amt.Total</th>
                            <th>Amt.Disc.Pay</th>
                            <th>Amt.Paid</th>
                            <th>Amt.Retur</th>
                            <th>PaidFlag</th>
                            <th>Piutang</th>
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

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}


$(document).ready(function() {

    $('#Report').addClass('active open');
    $('#ReportCSS').css('display','block');
    $('#Piutang').addClass('active gradient-45deg-green-teal gradient-shadow');

    var reportTable = document.getElementById("reportTable")
    var preloader1 = document.getElementById("preloader1")
    var cardOverviewPiutang = document.getElementById("cardOverviewPiutang")
    var cardSummaryPiutang = document.getElementById("cardSummaryPiutang")


    $("#customer").select2({
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

                $("#customer").select2({
                    placeholder: "Search Customer Name",
                    allowClear: true,
                    minimumInputLength: 3,
                        ajax: {
                            url: '{{url("getCustomer")}}?mill=' +mill_id,
                            dataType: 'json',
                            delay: 250,
                            processResults: function (data) {
                            return {
                                results:  $.map(data, function (item) {
                                    return {
                                        text: item.cust_id + " || (" + item.cust_name + ")",
                                        id: item.cust_id
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
            var selectedValue;
            for (const rb of rbs) {
                if (rb.checked) {
                    selectedValue = rb.value;
                    break;
                }
            }

        var e = document.getElementById("mill_id");
        var mill = e.options[e.selectedIndex].value;
        var dt_start = $("#start").val();
        var dt_end = $("#end").val();
        var customer = $('#customer').val();
        var paid = $('#paid').val();
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


                    if (customer){

                        allreq = allreq+'&customer='+customer.trim();
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

                    var dataTable1 = $('#SummaryPiutang').DataTable({
                        destroy : true,
                        responsive: true,
                        processing: true,
                        serverSide: false,
                        autoWidth: true,
                        pageLength: 5,
                        // dom: 'Pfrtip',
                        ajax: {
                            'url':'{!!url("getSummaryPiutang")!!}'+'?mill=' +mill.trim()+allreq,
                            'type': 'post',
                            'headers': {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        },
                        columns: [
                                {data: 'total_inv', name: 'total_inv', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                                {data: 'cust_name', name: 'cust_name'},
                                {data: 'amt_total', name: 'amt_total', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                                {data: 'amt_paid', name: 'amt_paid', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                                {data: 'total_paid', name: 'total_paid', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                                {data: 'paid_flag', name: 'paid_flag'},
                                {data: 'total_piutang', name: 'total_piutang', render: $.fn.dataTable.render.number(',', '.', 2, '')}
                        ],
                        "footerCallback": function ( row, data, start, end, display ) {
                            var api = this.api(), data;
                
                            // Remove the formatting to get integer data for summation
                            var intVal = function ( i ) {
                                return typeof i === 'string' ?
                                    i.replace(/[\$,]/g, '')*1 :
                                    typeof i === 'number' ?
                                        i : 0;
                            };
                
                            // Total over all pages
                            total1 = api
                                .column( 6 )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );

                            total2 = api
                                .column( 0 )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );    
                
                            // Total over this page
                            pageTotal1 = api
                                .column( 6, { page: 'current'} )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );

                            pageTotal2 = api
                                .column( 0, { page: 'current'} )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );
                
                            // Update footer

							// $('#TotalInvoice').text('Total Invoice: '+numberWithCommas(pageTotal2) +' ('+ numberWithCommas(total2) +' total from all page )')
							// $('#TotalPiutangCurrent').text('Total Piutang: IDR. '+numberWithCommas(pageTotal1))
							// $('#TotalPiutangAll').text('IDR. '+ numberWithCommas(total1) +' (total from all page)')

							$('#TotalInvoice').text('Total Invoice: '+numberWithCommas(Math.round(total2)))
							$('#TotalPiutangAll').text('Total Piutang: IDR. '+ numberWithCommas(Math.round(total1)))
                            
                           
                        },
                        initComplete: function(settings, json) {
                            if (dataTable1.rows().data().length) {
                                // preloader1.style.display = "none";
                                // document.getElementById("submitform").disabled = false;
                            }
                            if (!dataTable1.rows().data().length) {
                                swal("Oops! :(", "Data not available", "error");
                                // preloader1.style.display = "none";
                                // document.getElementById("submitform").disabled = false;
                            }
                        },
                    });


                    var dataTable2 = $('#OverviewPiutang').DataTable({
                        destroy : true,
                        responsive: true,
                        processing: true,
                        serverSide: true,
                        autoWidth: true,
                        pageLength: 5,
                        // dom: 'Pfrtip',
                        ajax: {
                            'url':'{!!url("getOverviewPiutang")!!}'+'?mill=' +mill.trim()+allreq,
                            'type': 'post',
                            'headers': {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        },
                        columns: [
                                {data: 'cust_name', name: 'cust_name'},
                                {data: 'inv_id', name: 'inv_id'},
                                {data: 'order_id', name: 'order_id'},
                                {data: 'dt_inv', name: 'dt_inv'},
                                {data: 'dt_due', name: 'dt_due'},
                                {data: 'salesman_name', name: 'salesman_name'},
                                {data: 'amt_total', name: 'amt_total', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                                {data: 'amt_disc_pay', name: 'amt_disc_pay', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                                {data: 'amt_paid', name: 'amt_paid', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                                {data: 'amt_retur', name: 'amt_retur', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                                {data: 'paid_flag', name: 'paid_flag'},
                                {data: 'Piutang', name: 'Piutang', render: $.fn.dataTable.render.number(',', '.', 2, '')}
                            ],
                            initComplete: function(settings, json) {
                                if (dataTable2.rows().data().length) {
                
                                    preloader1.style.display = "none";
                                    document.getElementById("submitform").disabled = false;
                                }
                                if (!dataTable2.rows().data().length) {
                                    swal("Oops! :(", "Data not available", "error");
                                    preloader1.style.display = "none";
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

          if (customer){

              allreq = allreq+'&customer='+customer.trim();
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

          var dataTable1 = $('#SummaryPiutang').DataTable({
            destroy : true,
            responsive: true,
            processing: true,
            serverSide: false,
            autoWidth: true,
            pageLength: 5,
            // dom: 'Pfrtip',
            ajax: {
                'url':'{!!url("getSummaryPiutang")!!}'+'?mill=' +mill.trim()+allreq,
                'type': 'post',
                'headers': {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            columns: [
                    {data: 'total_inv', name: 'total_inv', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                    {data: 'cust_name', name: 'cust_name'},
                    {data: 'amt_total', name: 'amt_total', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                    {data: 'amt_paid', name: 'amt_paid', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                    {data: 'total_paid', name: 'total_paid', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                    {data: 'paid_flag', name: 'paid_flag'},
                    {data: 'total_piutang', name: 'total_piutang', render: $.fn.dataTable.render.number(',', '.', 2, '')}
            ],
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;

                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                // Total over all pages
                total1 = api
                    .column( 6 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                total2 = api
                    .column( 0 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );    

                // Total over this page
                pageTotal1 = api
                    .column( 6, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                pageTotal2 = api
                    .column( 0, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer

				// $('#TotalInvoice').text('Total Invoice: '+numberWithCommas(pageTotal2) +' ('+ numberWithCommas(total2) +' total from all page )')
				// $('#TotalPiutangCurrent').text('Total Piutang: IDR. '+numberWithCommas(pageTotal1))
				// $('#TotalPiutangAll').text('IDR. '+ numberWithCommas(total1) +' (total from all page)')

				$('#TotalInvoice').text('Total Invoice: '+numberWithCommas(Math.round(total2)))
				$('#TotalPiutangAll').text('Total Piutang: IDR. '+ numberWithCommas(Math.round(total1)))
                
                    
            },
                initComplete: function(settings, json) {
                    if (dataTable1.rows().data().length) {
                        // preloader1.style.display = "none";
                        // document.getElementById("submitform").disabled = false;
                    }
                    if (!dataTable1.rows().data().length) {
                        swal("Oops! :(", "Data not available", "error");
                        // preloader1.style.display = "none";
                        // document.getElementById("submitform").disabled = false;
                    }
                },
            });


            var dataTable2 = $('#OverviewPiutang').DataTable({
                destroy : true,
                responsive: true,
                processing: true,
                serverSide: true,
                autoWidth: true,
                pageLength: 5,
                // dom: 'Pfrtip',
                ajax: {
                    'url':'{!!url("getOverviewPiutang")!!}'+'?mill=' +mill.trim()+allreq,
                    'type': 'post',
                    'headers': {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                columns: [
                        {data: 'cust_name', name: 'cust_name'},
                        {data: 'inv_id', name: 'inv_id'},
                        {data: 'order_id', name: 'order_id'},
                        {data: 'dt_inv', name: 'dt_inv'},
                        {data: 'dt_due', name: 'dt_due'},
                        {data: 'salesman_name', name: 'salesman_name'},
                        {data: 'amt_total', name: 'amt_total', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                        {data: 'amt_disc_pay', name: 'amt_disc_pay', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                        {data: 'amt_paid', name: 'amt_paid', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                        {data: 'amt_retur', name: 'amt_retur', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                        {data: 'paid_flag', name: 'paid_flag'},
                        {data: 'Piutang', name: 'Piutang', render: $.fn.dataTable.render.number(',', '.', 2, '')}
                    ],
                    initComplete: function(settings, json) {
                        if (dataTable2.rows().data().length) {
        
                            preloader1.style.display = "none";
                            document.getElementById("submitform").disabled = false;
                        }
                        if (!dataTable2.rows().data().length) {
                            swal("Oops! :(", "Data not available", "error");
                            preloader1.style.display = "none";
                            document.getElementById("submitform").disabled = false;
                        }
                    },
            });
        }

    });

    $('#resetform').on('click', function() {

        $('#mill_id').val(null).trigger('change');
        $('#customer').val(null).trigger('change');
        $('#paid').val(null).trigger('change');
        $('#start').val('');
        $('#end').val('');
        $("#radio1").prop("checked", true);
        reportTable.style.display = "none"

    });




});



</script>

@endsection
