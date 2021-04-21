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
               <h5 class="breadcrumbs-title mt-0 mb-0"><span>CRC Availability</span></h5>
               <ol class="breadcrumbs mb-0">
                  {{-- <li class="breadcrumb-item ">
                     <a href="#">Home</a>
                  </li> --}}
                  <li class="breadcrumb-item ">
                     <a href="#">Production Report</a>
                  </li>
                  <li class="breadcrumb-item">
                     <a href="#">CRC Availability</a>
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
                    Hello {{ Session::get('USERNAME') }}, here's CRC Availability form. Have a good day :)
                  </p>
               </div>
            </div>

            <div class="card">
                <div class="card-content">

                    <div class="row">
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">layers</i>
                            <select class="browser-default" id="origin" name="origin">
                            <option></option>
                            </select>
                            <label>Coil Origin</label>
                        </div>
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">branding_watermark</i>
                            <select class="browser-default" id="commodity" name="commodity">
                            <option></option>
                            </select>
                            <label>Commodity</label>
                        </div>
                    </div>
                    <div class="row">

                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">unfold_more</i>
                            <select class="browser-default" id="thick" name="thick">
                            <option></option>
                            </select>
                            <label>Thickness</label>
                        </div>
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">swap_horiz</i>
                            <select class="browser-default" id="width" name="width" >
                            <option></option>
                            </select>
                            <label>Width</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">

                            <button class="btn waves-effect waves-light green darken-1" id="reset">Reset
                                <i class="material-icons right">refresh</i>
                            </button>

                          <button class="btn waves-effect waves-light blue darken-1" id="go">Submit
                            <i class="material-icons right">send</i>
                          </button>
                        </div>
                    </div>


                </div>
            </div>

            <div class="card" id="divCrcAvailability" style="display: none">
                <div class="card-content">
                    <div class="section users-view">
                        <div class="row indigo lighten-5">
                            <div class="col s12 m12 users-view-timeline">
                                {{-- <h6 class="indigo-text m-0">Query Result: </h6> --}}
                                <h6 class="indigo-text m-0">Summary :</h6> 
                                <blockquote id="TotalWgtOH"></blockquote>
                                <blockquote id="TotalQtyOH"></blockquote>
                                <blockquote id="TotalWgtPlan"></blockquote>
                                <blockquote id="TotalQtyPlan"></blockquote>
                                <blockquote id="TotalOutPO"></blockquote>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col s12">
                                <table id="tblCrcAvailability" class="striped" role="grid" style="width:100%">
                                    <thead>
                                    <tr>
                                    <th>Coil Origin</th>
                                    <th>Commodity</th>
                                    <th>Product</th>
                                    <th>Thickness</th>
                                    <th>Width</th>
                                    <th>Wgt OH</th>
                                    <th>Qy OH</th>
                                    <th>Wgt Plan</th>
                                    <th>Qty Plan</th>
                                    <th>Outstanding PO</th>
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

@endsection

@section('contentjs')
<script src="{{ asset('outside/material/vendors/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('outside/plugins/blockui/jquery.blockUI.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.4/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.4/js/responsive.bootstrap4.min.js"></script>
<script type="text/javascript">

var Qcommodity, Qorigin, Qthick, Qwidth;


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

function listCoilOrigin(){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "listCoilOrigin",
        success: function (data) {
            $('select[name="origin"]').empty();
            $('select[name="origin"]').prepend('<option></option>');
            $.each(data, function(index, element) {

                $('select[name="origin"]').append('<option value="'+element.origin_id+'">'+element.descr+'</option>');
            
            });
        }
    });

    $('#origin').select2({
        placeholder: 'Choose coil origin below',
        allowClear: true
    });

}

function listCommodity(){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "listCrcCommodity",
        success: function (data) {
            $('select[name="commodity"]').empty();
            $('select[name="commodity"]').prepend('<option></option>');
            $.each(data, function(index, element) {
                
                $('select[name="commodity"]').append('<option value="'+element.commodity_id+'">'+element.descr+'</option>');
            
            });
        }
    });

    $('#commodity').select2({
        placeholder: 'Choose commodity below',
        allowClear: true
    });

}

function listCrcThickness(){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "listCrcThickness",
        success: function (data) {
            $('select[name="thick"]').empty();
            $('select[name="thick"]').prepend('<option></option>');
            $.each(data, function(index, element) {

                $('select[name="thick"]').append('<option value="'+parseFloat(element.thick).toFixed(2)+'">'
                +parseFloat(element.thick).toFixed(2)+'</option>');

            });
        }
    });

    $('#thick').select2({
        placeholder: 'Choose thickness below',
        allowClear: true
    });

}

function listCrcWidth(){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "listCrcWidth",
        success: function (data) {
            $('select[name="width"]').empty();
            $('select[name="width"]').prepend('<option></option>');
            $.each(data, function(index, element) {

                $('select[name="width"]').append('<option value="'+parseFloat(element.width).toFixed(2)+'">'
                +parseFloat(element.width).toFixed(2)+'</option>');

            });
        }
    });

    $('#width').select2({
        placeholder: 'Choose width below',
        allowClear: true
    });

}

$(document).ready(function() {

    $('#ProductionReport').addClass('active open');
    $('#ProductionReportCSS').css('display','block');
    $('#CRCAvailability').addClass('active gradient-45deg-green-teal gradient-shadow');

    listCommodity(); listCoilOrigin(); listCrcThickness(); listCrcWidth();

    var divCrcAvailability = document.getElementById("divCrcAvailability")

    $('#reset').on('click', function() {

        $('#commodity').val(null).trigger('change');
        $('#origin').val(null).trigger('change');
        $('#thick').val(null).trigger('change');
        $('#width').val(null).trigger('change');
        divCrcAvailability.style.display = "none";

    });

    $('#go').on('click', function() {

        blockUI();

        Qcommodity = $('#commodity').val();
        Qorigin = $('#origin').val();
        Qthick = $('#thick').val();
        Qwidth = $('#width').val();
   

        var dataTable = $('#tblCrcAvailability').DataTable({
            destroy: true,
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            pageLength: 5,
            ajax: {
                'url':'{!!url("getCRCAvailability")!!}',
                'type': 'post',
                data: {
                        '_token': '{{ csrf_token() }}',
                        'commodity' : Qcommodity,
                        'origin' : Qorigin,
                        'thick': Qthick,
                        'width': Qwidth,
                    }
            },
            columns: [

                    { data: 'origin', name: 'origin' },
                    { data: 'commodity', name: 'commodity' },
                    { data: 'prod_descr', name: 'prod_descr' },
                    { data: 'thick', name: 'thick', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                    { data: 'width', name: 'width' , render: $.fn.dataTable.render.number(',', '.', 2, '')},
                    { data: 'wgt_oh', name: 'wgt_oh', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                    { data: 'qty_oh', name: 'qty_oh' , render: $.fn.dataTable.render.number(',', '.', 2, '')},
                    { data: 'wgt_plan', name: 'wgt_plan', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                    { data: 'qty_plan', name: 'qty_plan' , render: $.fn.dataTable.render.number(',', '.', 2, '')},
                    { data: 'out_po', name: 'out_po', render: $.fn.dataTable.render.number(',', '.', 2, '')}
                  
            ],
            initComplete: function(settings, json) {
                if (dataTable.rows().data().length) {

                    $.unblockUI();
                    divCrcAvailability.style.display = "block";

                    $('#TotalWgtOH').text('Total Wgt OH: '+json.total_wgt_oh+" TON")
                    $('#TotalQtyOH').text('Total Qty OH: '+json.total_qty_oh)
                    $('#TotalWgtPlan').text('Total Wgt Plan: '+json.total_wgt_plan+" TON")
                    $('#TotalQtyPlan').text('Total Qty Plan: '+json.total_qty_plan)
                    $('#TotalOutPO').text('Total Outstanding PO: '+json.total_out_po+" TON")
                    $('html, body').animate({
                        scrollTop: $("#divCrcAvailability").offset().top
                    }, 1200)

                }
                if (!dataTable.rows().data().length) {

                    $.unblockUI();
                    swal("Oops! :(", "Data not available", "error");
                    divCrcAvailability.style.display = "block";

                    $('#TotalWgtOH').text('Total Wgt OH: '+json.total_wgt_oh+" TON")
                    $('#TotalQtyOH').text('Total Qty OH: '+json.total_qty_oh)
                    $('#TotalWgtPlan').text('Total Wgt Plan: '+json.total_wgt_plan+" TON")
                    $('#TotalQtyPlan').text('Total Qty Plan: '+json.total_qty_plan)
                    $('#TotalOutPO').text('Total Outstanding PO: '+json.total_out_po+" TON")
                    $('html, body').animate({
                        scrollTop: $("#divCrcAvailability").offset().top
                    }, 1200)

                }
            },
        }); 
       
    }); 






});



</script>

@endsection
