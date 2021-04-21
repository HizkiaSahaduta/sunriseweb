@extends('main')

@section('contentcss')
<link rel="stylesheet" type="text/css" href="{{ asset('outside/material/vendors/animate-css/animate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('outside/material/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" />
<style>
.dataTables_wrapper {
    font-family: muli;
    font-size: 14px;
    position: relative;
    clear: both;
}
td.details-control {
    background: url("{{ asset('img/etc/details_open.png') }}") no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url("{{ asset('img/etc/details_close.png') }}") no-repeat center center;
}
.preloader {
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
      class="content-wrapper-before  gradient-45deg-green-teal">
   </div>
<!-- BEGIN: Breadcrumb-->
   <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
      <div class="container">
         <div class="row">
            <div class="col s10 m6 l6">
               <h5 class="breadcrumbs-title mt-0 mb-0"><span>List PreOrder </span></h5>
               <ol class="breadcrumbs mb-0">
                  {{-- <li class="breadcrumb-item ">
                     <a href="#">Home</a>
                  </li> --}}
                  <li class="breadcrumb-item ">
                     <a href="#">Sales Order</a>
                  </li>
                  <li class="breadcrumb-item">
                     <a href="#">List PreOrder</a>
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
                    Hello {{ Session::get('USERNAME') }}, here's list of order report. Have a good day :)
                  </p>
               </div>
            </div>
            <div class="card">
                <div class="card-content">
                 <div class="row">
                    <div class="col s12">
                     <table id="listOrder" class="striped" role="grid" style="width:100%">
                      <thead>
                       <tr>
                        <th>Cust.Name</th>
                        <th>Total</th>
                        <th>Salesman</th>
                        <th>Tr.Date</th>
                        <th>Status</th>
                        <th>Images</th>
                        <th style="width: 10%">Action</th>
                       </tr>
                      </thead>
                     </table>
                    </div>
                 </div>
                </div>
             </div>
         </div>
      </div>
   </div>


</div>

<div id="detailOrderModal" class="modal modal-fixed-footer">
    <div class="preloader"></div>
	<div class="modal-content">
        <div id="headerModal"></div>
        <div class="row">
            <div class="row" id="divInvoiceNo" style="display: none">
            </div>
            <div class="row">
            <div class="col m6 s12">
                <div class="divider show-on-small hide-on-med-and-up mb-3"></div>
                <h6>Bill To</h6>
                <div>
                    <span id="custName"></span>
                </div>
                <div>
                    <span id="custAddress"></span>
                </div>
                <div>
                    <span id="custPhone"></span>
                </div>
                <h6>Ship To</h6>
                <div>
                    <span id="shipTo"></span>
                </div>
            </div>
            {{-- <div class="col m6 s12">
                <div class="divider show-on-small hide-on-med-and-up mb-3"></div>
                <h6>Payment</h6>
                <div>
                    <span id="payment"></span>
                </div>
                <h6>Proj.Flag</h6>
                <div>
                    <span id="projFlag"></span>
                </div>
                <h6>Cust.PO Num</h6>
                <div>
                    <span id="custPoNum"></span>
                </div>
                <h6>Remark</h6>
                <div>
                    <span id="remark1"></span>
                </div>
            </div> --}}
            </div>
            <!-- Item List -->
            <div>
            <div class="divider mb-3 mt-3"></div>
            <div id="tableItem" style="display: none">
                <h6>Your item list:</h6>
                <table class="striped" role="grid" style="width:100%" id="orderItem">
                    <thead>
                        <tr>
                        <th class="center">Detail</th>
                        <th class="center">No</th>
                        <th>Descr</th>
                        <th>Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="card-alert card grey darken-3" id="infoItem">
                <div class="card-content white-text">
                <p>
                <i class="material-icons">info_outline</i> INFO : You haven't adding item in this order yet</p>
                </div>
                <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
             </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="javascript:void(0)" class="modal-action modal-close btn waves-effect waves-light grey darken-3 z-depth-4">
            Close
        </a>
        </div>
    </div>
</div>
<!-- END: Page Main-->

@endsection

@section('contentjs')
@if(\Session::has('alert'))
  <script>
      var error = "{{ Session::get('alert') }}"
      swal("Error", error, "error");

  </script>
@endif

@if(\Session::has('success'))
  <script>
      var msg = "{{ Session::get('success') }}"
      swal("SUCCESS", msg, "success");

  </script>
@endif
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('outside/material/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('outside/material/js/scripts/css-animation.js') }}"></script>
<script type="text/javascript">

var id;
function addCommas(nStr){
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}

function format(d) {
    // `d` is the original data object for the row
    return '<table class="table">' +
        '<tr>' +
        '<td>Weight:</td>' +
        '<td>' + addCommas(parseFloat(d.wgt).toFixed(2)) + ' KG</td>' +
        '</tr>' +
        '<td>Price:</td>' +
        '<td>IDR ' + addCommas(parseFloat(d.unit_price).toFixed(2)) + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Amt.Gross:</td>' +
        '<td>IDR ' +  addCommas(parseFloat(d.amt_gross).toFixed(2)) + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Disc(%):</td>' +
        '<td>' + addCommas(parseFloat(d.pct_disc).toFixed(2)) + '%</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Amt.Disc:</td>' +
        '<td>IDR ' + addCommas(parseFloat(d.amt_disc).toFixed(2)) + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Amt.Net:</td>' +
        '<td>IDR ' + addCommas(parseFloat(d.amt_net).toFixed(2)) + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Remark:</td>' +
        '<td>' + d.remark + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Dt.ReqShip:</td>' +
        '<td>' + d.dt_req_ship + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Req.Week:</td>' +
        '<td>' + d.req_week + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Req.Month:</td>' +
        '<td>' + d.req_month + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Req.Year:</td>' +
        '<td>' + d.req_year + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>ApplNote:</td>' +
        '<td>' + d.aplikasi_note + '</td>' +
        '</tr>' +
        '<tr>' +
        '</table>';
}

$(document).ready(function() {

    $('#PreOrder').addClass('active open');
    $('#PreOrderCSS').css('display','block');
    $('#ListPreOrder').addClass('active gradient-45deg-green-teal gradient-shadow');

    $(".modal").modal();
    $(".materialboxed").materialbox();

    var dataTable = $('#listOrder').DataTable({
        "drawCallback": function( settings ) {
            $('.tooltipped').tooltip();
        },
        destroy: true,
        responsive: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        pageLength: 10,
        "order": [[ 0, "desc" ]],
        ajax: {
            'url': '{!!url("getListOrder")!!}',
            'type': 'post',
            'headers': {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        },
        columns: [
                    { data: 'cust_name', name: 'cust_name' },
                    { data: 'amt_net', name: 'amt_net', render: $.fn.dataTable.render.number( ',', '.', 2, 'IDR ' )},
                    { data: 'salesman_name', name: 'salesman_name' },
                    { data: 'fr_date', name: 'fr_date'},
                    { data: 'stat', name: 'stat'},
                    { data: 'images', name: 'images'},
                    { data: 'Detail', name: 'Detail',orderable:false,searchable:false }

                ],
                initComplete: function(settings, json) {
                    if (dataTable.rows().data().length) {



                        }
                    if (!dataTable.rows().data().length) {

                    }
                },
    });

    $('body').on('click', '.confirmOrder', function(e) {
        var id = $(this).data('id');
        swal({
        title: "Confirm "+id+" ?",
        text: "Once confirmed, status for this order will be Closed.",
        icon: "warning",
        buttons: true
        })
        .then((willGo) => {
            if (willGo) {

                $.ajax({
                type: "POST",
                url: "{{ url('confirmOrder') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'book_id': id
                },
                    success: function(data) {

                        if ((data['response']) == 'Order Confirmed') {
                            swal("Success", (data['response']), "success");
                            $('#listOrder').DataTable().ajax.url('{!!url("getListOrder")!!}').load();
                        }
                        else {
                            swal("Error", (data['response']), "error");
                            $('#listOrder').DataTable().ajax.url('{!!url("getListOrder")!!}').load();
                        }

                    }
                });
            }
            else {
                swal("Canceling Confirm for "+id);
            }
        });

    });

    $('body').on('click', '.deleteOrder', function(e) {
        var id = $(this).data('id');
        swal({
        title: "Delete "+id+" ?",
        icon: "warning",
        buttons: true
        })
        .then((willGo) => {
            if (willGo) {

                $.ajax({
                type: "POST",
                url: "{{ url('deleteOrder') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'book_id': id
                },
                    success: function(data) {

                        if ((data['response']) == 'Order Deleted') {
                            swal("Success", (data['response']), "success");
                            $('#listOrder').DataTable().ajax.url('{!!url("getListOrder")!!}').load();
                        }
                        else {
                            swal("Error", (data['response']), "error");
                            $('#listOrder').DataTable().ajax.url('{!!url("getListOrder")!!}').load();
                        }

                    }
                });

            }
            else {
                swal("Canceling Delete "+id);
            }
        });

    });

    $('body').on('click', '.detailOrder', function(e) {

        $('.preloader').show();
        id = $(this).data('id');
        var title = "<h5 class='modal-title'>Detail of "+id+"</h5>";
        $('#headerModal').html(title);

        $.ajax({
                type: "POST",
                url: "{{ url('detailHdr') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id': id
                },
                success: function (data) {

                    var cust_name = data['cust_name'];
                    if (!cust_name){
                        cust_name = 'not set';
                    }
                    var cust_address = data['cust_address'];
                    if (!cust_address){
                        cust_address = 'not set';
                    }
                    var phone = data['phone'];
                    if (!phone){
                        phone = 'not set';
                    }
                    var ship_to = data['ship_to'];
                    if (!ship_to){
                        ship_to = 'not set';
                    }
                    var proj_flag= data['proj_flag'];
                    if (!proj_flag){
                        proj_flag = 'not set';
                    }
                    else if (proj_flag == 'N'){
                        proj_flag = 'Non Project';
                    }
                    else if (proj_flag == 'T'){
                        proj_flag = 'Project';
                    }
                    var pay_term_desc = data['pay_term_desc'];
                    if (!pay_term_desc){
                        pay_term_desc = 'not set';
                    }
                    var cust_po_num = data['cust_po_num'];
                    if (!cust_po_num){
                        cust_po_num = 'not set';
                    }
                    var remark1 = data['remark1'];
                    if (!remark1){
                        remark1 = 'not set';
                    }

                    $('#custName').text(cust_name);
                    $('#custAddress').text(cust_address);
                    $('#custPhone').text(phone);
                    $('#shipTo').text(ship_to);
                    // $('#payment').text(pay_term_desc);
                    // $('#projFlag').text(proj_flag);
                    // $('#custPoNum').text(cust_po_num);
                    // $('#remark1').text(remark1);

                    var load = $('#orderItem').DataTable().ajax.url('detailDtl?id='+id).load();
                    if (load) {
                        tableItem.style.display = "block";
                        infoItem.style.display = "none";
                        $('.preloader').hide();
                    }
                }
            });


    });

    var table = $('#orderItem').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        searching: false,
        paging: false,
        info: false,
        fixedHeader: true,
        "order": [
        [1, "asc"]
        ],
        dom: 'Pfrtip',
        ajax: {
        'url': '{!!url("detailDtl")!!}' + '?id=' + id,
        'type': 'post',
        'headers': {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
        },
        columns: [{
            "className": 'details-control',
            "orderable": false,
            "searchable": false,
            "data": null,
            "defaultContent": ''
        },
        {
            data: 'item_num',
            name: 'item_num',
            sClass: "center"
        },
        {
            data: 'descr',
            name: 'descr'
        },
        {
            data: 'stat',
            name: 'stat'
        }
        ],
        initComplete: function(settings, json) {

            if (table.rows().data().length) {

                tableItem.style.display = "block";
                infoItem.style.display = "none";

            } else if (!table.rows().data().length) {

                tableItem.style.display = "none";
                infoItem.style.display = "block";
            } else {

                swal("Oops!", "Something error", "error");
            }
        },
    });

    $('#orderItem tbody').on('click', 'td.details-control', function() {
        var tr = $(this).closest('tr');
        var row = $('#orderItem').DataTable().row(tr);
        // var data = table.row(this).data();
        // console.log(table.row(tr));

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
             // Open this row
            row.child(format(row.data())).show();
            tr.addClass('shown');

        }
    });






});



</script>

@endsection
