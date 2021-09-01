@extends('main')

@section('contentcss')
<link rel="stylesheet" type="text/css" href="{{ asset('outside/material/vendors/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('outside/material/vendors/select2/select2-materialize.css') }}">
<link rel="stylesheet" href="{{ asset('outside/plugins/flatpickr/flatpickr.css') }}" type="text/css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@latest/dist/plugins/monthSelect/style.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.4/css/responsive.dataTables.min.css" />

<style>
.dataTables_wrapper {
    font-family: muli;
    font-size: 14px;
    position: relative;
    clear: both;
}

.select2-container--default.select2-container--disabled .select2-selection--single {
    background-color: #fff;
    cursor: default;
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
               <h5 class="breadcrumbs-title mt-0 mb-0"><span>Sales Contract Report</span></h5>
               <ol class="breadcrumbs mb-0">
                  {{-- <li class="breadcrumb-item ">
                     <a href="#">Home</a>
                  </li> --}}
                  <li class="breadcrumb-item ">
                     <a href="#">Production Report</a>
                  </li>
                  <li class="breadcrumb-item">
                     <a href="#">Sales Contract Repor</a>
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
                    Hello {{ Session::get('USERNAME') }}, here's Sales Contract Report form. Have a good day :)
                  </p>
               </div>
            </div>

            <div class="card">
                <div class="card-content">
                   <div class="row">
                     <div class="row">
                         <div class="input-field col m4 s12">
                             <i class="material-icons prefix">business</i>
                             <select class="basic browser-default" id="txtMillID" name="txtMillID">
                                 <option></option>
                                 <option value="SR" selected>Sunrise Steel</option>
                             </select>
                             <label>Mill ID</label>
                         </div>
                         <div class="input-field col m4 s12">
                            <i class="material-icons prefix">date_range</i>
                            <input type="text" class="datepicker" name="txtStart" id="txtStart" placeholder="Start date" readonly="readonly">
                            <label>Start Date</label>
                        </div>
                        <div class="input-field col m4 s12">
                            <i class="material-icons prefix">date_range</i>
                            <input type="text" class="datepicker" name="txtEnd" id="txtEnd" placeholder="End date" readonly="readonly">
                            <label>End Date</label>
                        </div>
                     </div>
                     <div class="row">
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">account_circle</i>
                            <select class="browser-default" id="txtSalesman" name="txtSalesman">
                                <option></option>
                                @if(isset($listsales))
                                @if(Session::get('GROUPID') == 'SALES')
                                @foreach($listsales as $o)
                                <option value='{{ $o->salesman_id }}' selected>{{ $o->salesman_name }}</option>
                                @endforeach

                                @elseif(Session::get('GROUPID') != 'SALES')
                                <option></option>
                                @foreach($listsales as $o)
                                <option value='{{ $o->salesman_id }}'>{{ $o->salesman_name }}</option>
                                @endforeach
                                @endif
                                @endif
                            </select>
                            <label>Sales Person</label>
                        </div>
                        <div class="input-field col m6 s12">
                           <i class="material-icons prefix">account_box</i>
                           <select class="browser-default" id="txtCustomer" name="txtCustomer"></select>
                           <label>Customer</label>
                       </div>
                     </div>
                     <div class="row">
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">assignment</i>
                            <select class="browser-default" id="txtOrderID" name="txtOrderID"></select>
                            <label>Sales Contract</label>
                        </div>
                         <div class="input-field col m6 s12">
                             <i class="material-icons prefix">border_vertical</i>
                             <select class="sbasic browser-default" id='txtOutstanding' name='txtOutstanding'>
                                 <option></option>
                                 <option value='Y' selected>Yes</option>
                                 <option value='N'>No</option>
                             </select>
                             <label>Outstanding Order</label>
                         </div>
                     </div>
                   </div>
                   <div class="row">
                     <div class="input-field col s12">
 
                         <button class="btn waves-effect waves-light green darken-1" id="reset">Reset
                             <i class="material-icons right">refresh</i>
                         </button>
                         
                         <button class="btn waves-effect waves-light blue darken-1" type="submit" name="action" id="go">Submit
                             <i class="material-icons right">send</i>
                         </button>
 
                     </div>
                   </div>
 
                </div>
            </div>

            <div class="card" id="divResults" style="display: none">
                <div class="card-content">
                    <div class="section users-view">
                        <div class="row">
                            <div class="col s12">
                                <table id="tableOrder" class="striped" role="grid" style="width:100%">
                                    <thead>
                                    <tr>
                                    <th>SC Number</th>
                                    <th>SC Status</th>
                                    <th>SC Date</th>
                                    <th>Customer</th>
                                    <th>Sales Person</th>
                                    <th>Sched Date</th>
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
      </div>
   </div>


</div>
<!-- END: Page Main-->

<div id="detailOrderModal" class="modal">
	<div class="modal-content">
        <a href="javascript:void(0)" class="modal-action modal-close" style="float: right">
            <i class="material-icons">close</i>
        </a>
        <div id="headerModal"></div>
        <div class="row">
            <div class="row">
                <div class="col s12">
                    <table id="tableOrderDetail" class="striped" role="grid" style="width:100%">
                        <thead>
                        <tr>
                        <th>ItemNum</th>
                        <th>Descr</th>
                        <th>Req.Week</th>
                        <th>(KG) Order</th>
                        <th>(KG) Rsv</th>
                        <th>(KG) PPP</th>
                        <th>(KG) Delivery</th>
                        <th>(KG) Shipped</th>
                        <th>(KG) Stock</th>
                        <th>(KG) Plan</th>
                        <th>(KG) Outstanding</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
      </div>
    </div>
</div>

@endsection

@section('contentjs')
<script src="{{ asset('outside/material/vendors/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('outside/plugins/flatpickr/flatpickr.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr@latest/dist/plugins/monthSelect/index.js"></script>
<script src="{{ asset('outside/plugins/blockui/jquery.blockUI.min.js') }}"></script>
<script src="{{ asset('canvasjs.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.4/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.4/js/responsive.bootstrap4.min.js"></script>
<script type="text/javascript">

var txtMillID, txtStart, txtEnd, txtSalesman, txtCustomer, txtOrderID, txtOutstanding;

function blockUI(){

    $.blockUI({
        message: '<div class="preloader-wrapper small active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>',
        fadeIn: 100,
        overlayCSS: {
            backgroundColor: '#1b2024',
            opacity: 0.8,
            zIndex: 1200,
            cursor: 'wait'
        },
        css: {
            border: 0,
            color: '#fff',
            zIndex: 1201,
            padding: 0,
            backgroundColor: 'transparent'
        }
    });
}

function getMillID() {

    $('#txtMillID').select2({});
    $('#txtMillID').prop('disabled', true);

}

function getCustomer() {

    var txtSalesman = $('#txtSalesman').val();
    var txtOrderID = $('#txtOrderID').val();
    var txtCustomer = $('#txtCustomer').val();

    if (!txtSalesman && !txtOrderID) { 

        $('select[name="txtCustomer"]').empty();
        $('select[name="txtCustomer"]').prepend('<option></option>');

        @if(Session::get('GROUPID') != 'KKA')

            $('#txtCustomer').select2({
            placeholder: "Type any existing custid or custname . . .",
            allowClear: true,
                minimumInputLength: 3,
                ajax: {
                    url: "{{url('order_autocompletecustomer')}}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                        return {
                            text: item.cust_id + " || " + item.cust_name,
                            id: item.cust_id,
                        }
                        })
                    };

                    },
                    cache: false
                }
            });

        @endif

        @if(Session::get('GROUPID') == 'KKA')

            $.ajax({
                    type: "POST",
                    url: "{{ url('getCustomer2') }}",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'txtSalesman': txtSalesman, 
                        'txtOrderID': txtOrderID
                    },
                    success: function (data) {

                        var count = Object.keys(data).length;

                        if (count > 2) { 

                            $('select[name="txtCustomer"]').empty();
                            $('select[name="txtCustomer"]').prepend('<option></option>');
                            $.each(data, function(index, element) {
                                $('select[name="txtCustomer"]').append('<option value="'+element.cust_id+'">'+element.cust_name+'</option>');
                            });
                        }

                        else {

                            $('select[name="txtCustomer"]').empty();
                            $('select[name="txtCustomer"]').prepend('<option></option>');
                            $.each(data, function(index, element) {
                                $('select[name="txtCustomer"]').append('<option value="'+element.cust_id+'" selected>'+element.cust_name+'</option>');
                            });
                        }

                        $('#txtCustomer').select2({
                            placeholder: 'Choose customer below',
                            allowClear: true
                        });

                                    
                    }
                });

        @endif


    }

    else {

        if (!txtCustomer) {

            $.ajax({
                type: "POST",
                url: "{{ url('getCustomer2') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'txtSalesman': txtSalesman, 
                    'txtOrderID': txtOrderID
                },
                success: function (data) {

                    var count = Object.keys(data).length;

                    if (count > 2) { 

                        $('select[name="txtCustomer"]').empty();
                        $('select[name="txtCustomer"]').prepend('<option></option>');
                        $.each(data, function(index, element) {
                            $('select[name="txtCustomer"]').append('<option value="'+element.cust_id+'">'+element.cust_name+'</option>');
                        });
                    }

                    else {

                        $('select[name="txtCustomer"]').empty();
                        $('select[name="txtCustomer"]').prepend('<option></option>');
                        $.each(data, function(index, element) {
                            $('select[name="txtCustomer"]').append('<option value="'+element.cust_id+'" selected>'+element.cust_name+'</option>');
                        });
                    }

                    $('#txtCustomer').select2({
                        placeholder: 'Choose customer below',
                        allowClear: true
                    });

                                
                }
            });

        }

    }

   
}

function getSalesman() {

    $('#txtSalesman').select2({
        placeholder: "Choose Sales Person",
        allowClear: true
    });
    var length = $('#txtSalesman').children('option').length;

    console.log(length)

    if (length <= 2) {
        $('#txtSalesman').prop('disabled', true);
    }


}

function getSalesContract() {

    var txtSalesman = $('#txtSalesman').val();
    var txtCustomer = $('#txtCustomer').val();
    var txtOrderID = $('#txtOrderID').val();

    if (!txtSalesman && !txtCustomer) {

        $('select[name="txtOrderID"]').empty();
        $('select[name="txtOrderID"]').prepend('<option></option>');

        @if(Session::get('GROUPID') != 'KKA')

            $('#txtOrderID').select2({
            placeholder: "Type any existing Sales Contract",
            allowClear: true,
                minimumInputLength: 3,
                ajax: {
                    url: "{{url('getAllSalesContract')}}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                        return {
                            text: item.order_id,
                            id: item.order_id,
                            }
                        })
                    };

                    },
                    cache: false
                }
            });

        @endif

        @if(Session::get('GROUPID') == 'KKA')

            $.ajax({
                type: "POST",
                url: "{{ url('getSalesContract') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'txtSalesman': txtSalesman, 
                    'txtCustomer': txtCustomer
                },
                success: function (data) {

                    var count = Object.keys(data).length;

                    if (count > 2) { 

                        $('select[name="txtOrderID"]').empty();
                        $('select[name="txtOrderID"]').prepend('<option></option>');
                        $.each(data, function(index, element) {
                            $('select[name="txtOrderID"]').append('<option value="'+element.order_id+'">'+element.order_id+'</option>');
                        });

                    }

                    else {

                        $('select[name="txtOrderID"]').empty();
                        $('select[name="txtOrderID"]').prepend('<option></option>');
                        $.each(data, function(index, element) {
                            $('select[name="txtOrderID"]').append('<option value="'+element.order_id+'"selected>'+element.order_id+'</option>');
                        });
                    }

                    $('#txtOrderID').select2({
                        placeholder: 'Choose Sales Contract below',
                        allowClear: true
                    });

            
                }
            });

        @endif

    }

    else {

        if (!txtOrderID ) {

            $.ajax({
                type: "POST",
                url: "{{ url('getSalesContract') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'txtSalesman': txtSalesman, 
                    'txtCustomer': txtCustomer
                },
                success: function (data) {

                    var count = Object.keys(data).length;

                    if (count > 2) { 

                        $('select[name="txtOrderID"]').empty();
                        $('select[name="txtOrderID"]').prepend('<option></option>');
                        $.each(data, function(index, element) {
                            $('select[name="txtOrderID"]').append('<option value="'+element.order_id+'">'+element.order_id+'</option>');
                        });

                    }

                    else {

                        $('select[name="txtOrderID"]').empty();
                        $('select[name="txtOrderID"]').prepend('<option></option>');
                        $.each(data, function(index, element) {
                            $('select[name="txtOrderID"]').append('<option value="'+element.order_id+'"selected>'+element.order_id+'</option>');
                        });
                    }

                    $('#txtOrderID').select2({
                        placeholder: 'Choose Sales Contract below',
                        allowClear: true
                    });

            
                }
            });
        }
    }

}

function getOutstanding() {

    $('#txtOutstanding').select2({
        placeholder: 'Choose Outstanding status',
        allowClear: true
    });
}


$(document).ready(function() {

    $('#ProductionReport').addClass('active open');
    $('#ProductionReportCSS').css('display','block');
    $('#OrderReport').addClass('active gradient-45deg-green-teal gradient-shadow');

    var divResults = document.getElementById("divResults");

    $(".modal").modal();

    $('.datepicker').datepicker({
        format: 'yyyymmdd',
        autoClose: true,
        showClearBtn: true,
    });

    getMillID(); getCustomer(); getSalesman(); getSalesContract(); getOutstanding();

    $('#txtSalesman').change(function(){

        getCustomer();  getSalesContract();

    });

    $('#txtCustomer').change(function(){

        getSalesContract();

    });

    $('#txtOrderID').change(function(){

        getCustomer();

    });

    $('#go').on('click', function() {

        blockUI();
        txtMillID = $('#txtMillID').val();
        txtStart = $('#txtStart').val();
        txtEnd = $('#txtEnd').val();
        txtSalesman = $('#txtSalesman').val();
        txtCustomer = $('#txtCustomer').val();
        txtOrderID = $('#txtOrderID').val();
        txtOutstanding = $('#txtOutstanding').val();

        var dataTable = $('#tableOrder').DataTable({
            destroy : true,
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: true,
            pageLength: 5,
            ajax: {
                'url':'{!!url("getOrderReport")!!}',
                'type': 'post',
                data: {
                        '_token': '{{ csrf_token() }}',
                        'txtMillID': txtMillID,
                        'txtStart': txtStart,
                        'txtEnd': txtEnd,
                        'txtSalesman': txtSalesman,
                        'txtCustomer': txtCustomer,
                        'txtOrderID': txtOrderID,
                        'txtOutstanding': txtOutstanding
                    }
            },
            columns: [
                    {data: 'order_id', name: 'order_id'},
                    {data: 'stat', name: 'stat'},
                    {data: 'dt_order', name: 'dt_order'},
                    {data: 'cust_name', name: 'cust_name'},
                    {data: 'salesman_name', name: 'salesman_name'},
                    {data: 'tgl_plan', name: 'tgl_plan'},
                    {data: 'Detail', name: 'Detail',orderable:false,searchable:false }
                ],
                initComplete: function(settings, json) {
                    if (dataTable.rows().data().length) {
                        $.unblockUI();
                        document.getElementById("divResults").style.display = 'block';
                        $('html, body').animate({
                            scrollTop: $("#divResults").offset().top
                        }, 1200)
                    }
                    if (!dataTable.rows().data().length) {
                        $.unblockUI();
                        swal("Oops! :(", "Data not available", "error");
                        document.getElementById("divResults").style.display = 'block';
                        
                    }
                },
        });
 
       
    }); 
    
    $('#reset').on('click', function() {

        $('#txtSalesman').val(null).trigger('change');
        $('#txtCustomer').val(null).trigger('change');
        $('#txtOrderId').val(null).trigger('change');
        $('#txtOutstanding').val('Y').trigger('change');
        $('#txtStart').val('');
        $('#txtEnd').val('');
        divResults.style.display = 'none';

    });

    $('body').on('click', '.detailOrderReport', function(e) {

        blockUI();
        var id = $(this).data('id');
        $('#headerModal').html('Detail of '+id);
        var dataTable = $('#tableOrderDetail').DataTable({
            destroy : true,
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: true,
            pageLength: 2,
            ajax: {
                'url':'{!!url("getOrderReportDetail")!!}',
                'type': 'post',
                data: {
                        '_token': '{{ csrf_token() }}',
                        'txtOrderID': id
                    }
            },
            columns: [
                    {data: 'item_num', name: 'item_num'},
                    {data: 'descr', name: 'descr'},
                    {data: 'req_ship_week', name: 'req_ship_week'},
                    {data: 'wgt_ord', name: 'wgt_ord', render: $.fn.dataTable.render.number( ',', '.', 2, '' )},
                    {data: 'wgt_rsv', name: 'wgt_rsv', render: $.fn.dataTable.render.number( ',', '.', 2, '' )},
                    {data: 'wgt_ppp', name: 'wgt_ppp', render: $.fn.dataTable.render.number( ',', '.', 2, '' )},
                    {data: 'wgt_deliv', name: 'wgt_deliv', render: $.fn.dataTable.render.number( ',', '.', 2, '' )},
                    {data: 'wgt_shipped', name: 'wgt_shipped', render: $.fn.dataTable.render.number( ',', '.', 2, '' )},
                    {data: 'wgt_stock', name: 'wgt_stock', render: $.fn.dataTable.render.number( ',', '.', 2, '' )},
                    {data: 'wgt_plan', name: 'wgt_plan', render: $.fn.dataTable.render.number( ',', '.', 2, '' )},
                    {data: 'wgt_outstanding', name: 'wgt_outstanding', render: $.fn.dataTable.render.number( ',', '.', 2, '' )},
                    
                ],
                initComplete: function(settings, json) {
                    if (dataTable.rows().data().length) {
                        $.unblockUI();
                    }
                    if (!dataTable.rows().data().length) {
                        $.unblockUI();
                        swal("Oops! :(", "Data not available", "error");
                        
                    }
                },
        });
    }); 

});



</script>

@endsection
