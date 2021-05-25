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
               <h5 class="breadcrumbs-title mt-0 mb-0"><span>Purchasing Analysis</span></h5>
               <ol class="breadcrumbs mb-0">
                  {{-- <li class="breadcrumb-item ">
                     <a href="#">Home</a>
                  </li> --}}
                  <li class="breadcrumb-item ">
                     <a href="#">Finance Analysis</a>
                  </li>
                  <li class="breadcrumb-item">
                     <a href="#">Purchasing Analysis</a>
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
                    Hello {{ Session::get('USERNAME') }}, here's Purchasing Analysis form. Have a good day :)
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
                                 <option value="SR">Sunrise Steel</option>
                                 <option value="SM">Sunrise Mill</option>
                             </select>
                             <label>Mill ID</label>
                         </div>
                        <div class="input-field col m4 s12">
                            <label>Start Periode</label>
                            <input type="text" name="txtStart" id="txtStart" placeholder="Choose start periode date" readonly="readonly">
                            
                        </div>
                        <div class="input-field col m4 s12">
                            <label>End Periode</label>      
                            <input type="text" name="txtEnd" id="txtEnd" placeholder="Choose end periode date" readonly="readonly">     
                        </div>
                     </div>
                     <div class="row">
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">account_circle</i>
                            <select class="browser-default" id="txtPICName" name="txtPICName"></select>
                            <label>PIC Name</label>
                        </div>
                        <div class="input-field col m6 s12">
                           <i class="material-icons prefix">line_weight</i>
                           <select class="browser-default" id="txtDept" name="txtDept"></select>
                           <label>Department</label>
                       </div>
                     </div>
                     <div class="row">
                         <div class="input-field col m6 s12">
                             <i class="material-icons prefix">layers</i>
                             <select class="basic browser-default" id='txtStatus' name='txtStatus'>
                                 <option></option>
                                 <option value='All' selected>All (O/C)</option>
                                 <option value='C'>Close</option>
                                 <option value='O'>Open</option>
                             </select>
                             <label>Status</label>
                         </div>
                         <div class="input-field col m6 s12">
                             <i class="material-icons prefix">border_vertical</i>
                             <select class="sbasic browser-default" id='txtRaw' name='txtRaw'>
                                 <option></option>
                                 <option value='Rawmat'>Rawmat</option>
                                 <option value='General' selected>General</option>
                             </select>
                             <label>Rawmat / General</label>
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


            <div class="card" id="Result" style="display: none">
                <div class="card-content">
                    <div class="section users-view">
                        <div class="row indigo lighten-5">
                        <div class="col s12 m12 users-view-timeline">
                            <h6 class="indigo-text m-0">Query Result: </h6>
                        </div>
                        </div>
                        <br>
                        <div id="container1" style="height: 370px; width: 100%;"></div>
                    </div>
                </div>
            </div>




         </div>
      </div>
   </div>


</div>

<div id="detailAnalysisModal" class="modal modal-fixed-footer">
	<div class="modal-content">
        <a href="javascript:void(0)" class="modal-action modal-close" style="float: right">
            <i class="material-icons">close</i>
        </a>
        <div id="headerStep"></div>
        <div id="headerModal"></div>
        <div class="row">

            <div class="row" id="Cstep1" style="display: none">
                <div class="col m12 s12">
                    <table id="step1" class="striped" role="grid" style="width: 100% ">
                        <thead>
                           <tr>
                               <th>Periode</th>
                               <th>PRU ID</th>
                               <th>DtPRU</th>
                               <th>DtAprvl</th>
                               <th>Interval</th>
                           </tr>
                        </thead>
                    </table>
                </div>   
            </div>  

            <div class="row" id="Cstep2" style="display: none">
                <div class="col m12 s12">
                    <table id="step2" class="striped" role="grid" style="width: 100%">
                        <thead>
                           <tr>
                               <th>Periode</th>
                               <th>PRU ID</th>
                               <th>PRU Item</th>
                               <th>Descr</th>
                               <th>PO ID</th>
                               <th>DtAprvl</th>
                               <th>DtPO</th>
                               <th>Interval</th>
                           </tr>
                        </thead>
                    </table>
                </div>   
            </div>  

            <div class="row" id="Cstep3" style="display: none">
                <div class="col m12 s12">
                    <table id="step3" class="striped" role="grid" style="width: 100%">
                        <thead>
                           <tr>
                               <th>Periode</th>
                               <th>PRU ID</th>
                               <th>PRU Item</th>
                               <th>Descr</th>
                               <th>PO ID</th>
                               <th>PO Item</th>
                               <th>RCV ID</th>
                               <th>DtPO</th>
                               <th>DtRCV</th>
                               <th>Interval</th>
                           </tr>
                        </thead>
                    </table>
                </div>   
            </div>  

            <div class="row" id="Cstep4" style="display: none">
                <div class="col m12 s12">
                    <table id="step4" class="striped" role="grid" style="width: 100%">
                        <thead>
                           <tr>
                               <th>Periode</th>
                               <th>PRU ID</th>
                               <th>PRU Item</th>
                               <th>Descr</th>
                               <th>PO ID</th>
                               <th>PO Item</th>
                               <th>RCV ID</th>
                               <th>DtPRU</th>
                               <th>DtRCV</th>
                               <th>Interval</th>
                           </tr>
                        </thead>
                    </table>
                </div>   
            </div>  

        </div>
    </div>
    <div class="modal-footer" id="modalFooter">
        <button class="btn waves-effect waves-light red darken-1 modal-action modal-close">Close</button>
        </div>
    </div>
</div>
<!-- END: Page Main-->

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


var count, txtMill, txtPICID, txtDeptID, txtStep;
var dp1, dp2, dp3, dp4, container, title, label;
var x = window.matchMedia("(max-width: 991px)");
var QtxtMillID, QtxtStart, QtxtEnd, QtxtPICName, QtxtDept, QtxtStatus, QtxtRaw

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

function addSymbols(e) {
	var suffixes = ["", "K", "M", "B"];
	var order = Math.max(Math.floor(Math.log(e.value) / Math.log(1000)), 0);

	if(order > suffixes.length - 1)
		order = suffixes.length - 1;

	var suffix = suffixes[order];
	return CanvasJS.formatNumber(e.value / Math.pow(1000, order)) + suffix;
}

function toggleDataSeries(e) {
	if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	} else {
		e.dataSeries.visible = true;
	}
	e.chart.render();
}

function toggleDataPointVisibility(e) {
	if(e.dataPoint.hasOwnProperty("actualYValue") && e.dataPoint.actualYValue !== null) {
    e.dataPoint.y = e.dataPoint.actualYValue;
    e.dataPoint.actualYValue = null;
    e.dataPoint.indexLabelFontSize = null;
    e.dataPoint.indexLabelLineThickness = null;
    e.dataPoint.legendMarkerType = "circle";
  } 
  else {
    e.dataPoint.actualYValue = e.dataPoint.y;
    e.dataPoint.y = 0;
    e.dataPoint.indexLabelFontSize = 0;
    e.dataPoint.indexLabelLineThickness = 0; 
    e.dataPoint.legendMarkerType = "cross";
  }
	e.chart.render();
}

function showDefaultText(chart, text) {
  var dataPoints = chart.options.data[0].dataPoints;
  var isEmpty = !(dataPoints && dataPoints.length > 0);

  if (!isEmpty) {
    for (var i = 0; i < dataPoints.length; i++) {
      isEmpty = !dataPoints[i].y;
      if (!isEmpty)
        break;
    }
  }

  if (!chart.options.subtitles)
    chart.options.subtitles = [];
  if (isEmpty) {
    chart.options.subtitles.push({
      text: text,
      verticalAlign: 'center',
    });
    chart.options.data[0].showInLegend = false;
  } else {
    chart.options.data[0].showInLegend = true;
  }
}

function getChart(dp1, dp2, dp3, dp4, container, title, label){

    var chart = new CanvasJS.Chart(container, {
        animationEnabled: true,
        theme: "light2",
        exportEnabled: true,
        title: {
            text: title,
            fontFamily: "Calibri",
            fontSize: 20
        },
        exportEnabled: true,
        subtitles:[
            {
                text: label,
                //Uncomment properties below to see how they behave
                fontFamily: "Calibri",
                fontColor: "red",
                fontSize: 12
            }
        ],
        axisY: {
            crosshair: {
                enabled: true,
                snapToDataPoint: true
            },
            title: "DAYS'",
            labelFormatter: addSymbols,
        },
        toolTip:{
		    shared:true
	    },
        legend: {
            cursor: "pointer",
            itemclick: toggleDataSeries
	    },
        data: [
            {
                type: "column",
                click: Step1,
                showInLegend: true,
                name: "PRU -> APRVL",
                indexLabel: "{y}",
                // indexLabelPlacement: "inside",
                // indexLabelOrientation: "vertical",
                indexLabelFontSize: 12,
                indexLabelFontFamily: "calibri",
                // indexLabelFontColor: "#fff",
                // color: "#325288"
            },
            {
                type: "column",
                click: Step2,
                showInLegend: true,
                name: "APRVL -> PO",
                indexLabel: "{y}",
                // indexLabelPlacement: "inside",
                // indexLabelOrientation: "vertical",
                indexLabelFontSize: 12,
                indexLabelFontFamily: "calibri",
                // indexLabelFontColor: "#fff",
                // color: "#5b6d5b"
            },
            {
                type: "column",
                click: Step3,
                showInLegend: true,
                name: "PO -> RCV",
                indexLabel: "{y}",
                // indexLabelPlacement: "inside",
                // indexLabelOrientation: "vertical",
                indexLabelFontSize: 12,
                indexLabelFontFamily: "calibri",
                // indexLabelFontColor: "#fff",
                // color: "#a35709"
            },
            {
                type: "column",
                click: Step4,
                showInLegend: true,
                name: "PRU -> RCV",
                indexLabel: "{y}",
                // indexLabelPlacement: "inside",
                // indexLabelOrientation: "vertical",
                indexLabelFontSize: 12,
                indexLabelFontFamily: "calibri",
                // indexLabelFontColor: "#fff",
                // color: "#a35709"
            }
        ]
    });
    chart.options.data[0].dataPoints = dp1;
    chart.options.data[1].dataPoints = dp2;
    chart.options.data[2].dataPoints = dp3;
    chart.options.data[3].dataPoints = dp4;
    showDefaultText(chart, "No Data Found!");

    if (x.matches) {

        for(var i = 0; i < chart.options.data.length; i++){
            chart.options.data[i].indexLabelFontSize = 8;
        }
        chart.render();
    }
    chart.render();
}

function DefMillID() {

    $('#txtMillID').select2({
        placeholder: 'Choose Mill ID below',
        allowClear: true
    });
}

function DefPICName() {

    $('select[name="txtPICName"]').empty();
    $('select[name="txtPICName"]').prepend('<option></option>');

    $('#txtPICName').select2({
        placeholder: 'Please choose Mill first',
        allowClear: true
    });
}

function DefDepartment() {

    $('select[name="txtDept"]').empty();
    $('select[name="txtDept"]').prepend('<option></option>');

    $('#txtDept').select2({
        placeholder: 'Please choose Mill first',
        allowClear: true
    });
}

function DefStatus() {

    $('#txtStatus').select2({
        placeholder: 'Choose status below',
        allowClear: true
    });
}

function DefRaw() {

    $('#txtRaw').select2({
        placeholder: 'Choose option below',
        allowClear: true
    });
}

function listPICName(txtMill){


    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "listPIC/id="+txtMill,
        success: function (data) {
            $('select[name="txtPICName"]').empty();
            $('select[name="txtPICName"]').prepend('<option></option>');
            $.each(data, function(index, element) {
                $('select[name="txtPICName"]').append('<option value="'+element.pic_id+'">'+element.pic_name+'</option>');
            });
        }
    });

    $('#txtPICName').select2({
        placeholder: 'Choose PIC below',
        allowClear: true
    });
    
   

}

function listDept(txtMill){


    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "listDept/id="+txtMill,
        success: function (data) {
            $('select[name="txtDept"]').empty();
            $('select[name="txtDept"]').prepend('<option></option>');
            $.each(data, function(index, element) {
                $('select[name="txtDept"]').append('<option value="'+element.dept_id+'">'+element.descr+'</option>');
            });
        }
    });

    $('#txtDept').select2({
        placeholder: 'Choose Department below',
        allowClear: true
    });
    
   

}

function listPICDept(txtMill, txtPICID){


    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "listPICDept/id="+txtMill+ "&pic=" +txtPICID,
        success: function (data) {

            count = Object.keys(data).length; 

            $('select[name="txtDept"]').empty();
            $('select[name="txtDept"]').prepend('<option></option>');

            if (count < 2) {

                $.each(data, function(index, element) {
                    $('select[name="txtDept"]').append('<option value="'+element.dept_id+'" selected>'+element.descr+'</option>');
                });


            }

            else {

                $.each(data, function(index, element) {
                    $('select[name="txtDept"]').append('<option value="'+element.dept_id+'">'+element.descr+'</option>');
                });

            }

           
        }
    });

    $('#txtDept').select2({
        placeholder: 'Choose Department below',
        allowClear: true
    });
    
   

}

function listDeptPIC(txtMill, txtDeptID){


    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "listDeptPIC/id="+txtMill+ "&pic=" +txtDeptID,
        success: function (data) {

            count = Object.keys(data).length; 
            $('select[name="txtPICName"]').empty();
            $('select[name="txtPICName"]').prepend('<option></option>');

            if (count < 2) {

                $.each(data, function(index, element) {
                    $('select[name="txtPICName"]').append('<option value="'+element.pic_id+'" selected>'+element.pic_name+'</option>');
                });


            }

            else {

                $.each(data, function(index, element) {
                    $('select[name="txtPICName"]').append('<option value="'+element.pic_id+'">'+element.pic_name+'</option>');
                });

            }
            
        }
    });

    $('#txtPICName').select2({
        placeholder: 'Choose PIC below',
        allowClear: true
    });
    
   

}

function Step1(e){

    blockUI();

    txtStep = "step1";
    var txtParam = e.dataPoint.label;
    var HeaderDetail = "Periode: "+txtParam;
    $("#headerStep").html('<h6>PRU -> APRVL </h6>')
    $("#headerModal").html('<h6>Detail from '+HeaderDetail+'</h6>')

    var dataTable = $('#step1').DataTable({
        stripeClasses: [],
        lengthMenu: [5, 10, 20, 50],
        pageLength: 10,
        destroy : true,
        responsive: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        ajax: {
            'url':'{!!url("getPurchasingAnalysisDetail")!!}',
            'type': 'post',
            data: {
                '_token': '{{ csrf_token() }}',
                'txtMillID': QtxtMillID, 
                'txtParam': txtParam, 
                'txtPICName': QtxtPICName, 
                'txtDept': QtxtDept, 
                'txtStatus': QtxtStatus, 
                'txtRaw': QtxtRaw,
                'txtStep': txtStep
                }
        },
        columns: [
            { data: 'period', name: 'period'},
            { data: 'pru_id', name: 'pru_id'},
            { data: 'dt_pru', name: 'dt_pru' },
            { data: 'dt_aprv', name: 'dt_aprv'},
            { data: 'DayInterval', name: 'DayInterval' }
        ],
        initComplete: function(settings, json) {

            if (!dataTable.rows().data().length) {

                $.unblockUI();

                swal("Whops", "Data not available", "error");
            }

            else {

                $.unblockUI();
                $('#detailAnalysisModal').modal('open');
                document.getElementById("Cstep1").style.display = "block";
                document.getElementById("Cstep2").style.display = "none";
                document.getElementById("Cstep3").style.display = "none";
                document.getElementById("Cstep4").style.display = "none";    
               
            }
        },
    });


}

function Step2(e){

    blockUI();

    txtStep = "step2";
    var txtParam = e.dataPoint.label;
    var HeaderDetail = "Periode: "+txtParam;
    $("#headerStep").html('<h6>APRVL -> PO </h6>')
    $("#headerModal").html('<h6>Detail from '+HeaderDetail+'</h6>')

    var dataTable = $('#step2').DataTable({
        stripeClasses: [],
        lengthMenu: [5, 10, 20, 50],
        pageLength: 10,
        destroy : true,
        responsive: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        ajax: {
            'url':'{!!url("getPurchasingAnalysisDetail")!!}',
            'type': 'post',
            data: {
                '_token': '{{ csrf_token() }}',
                'txtMillID': QtxtMillID, 
                'txtParam': txtParam, 
                'txtPICName': QtxtPICName, 
                'txtDept': QtxtDept, 
                'txtStatus': QtxtStatus, 
                'txtRaw': QtxtRaw,
                'txtStep': txtStep
                }
        },
        columns: [
            { data: 'period', name: 'period'},
            { data: 'pru_id', name: 'pru_id'},
            { data: 'pru_item', name: 'pru_item'},
            { data: 'descr', name: 'descr'},
            { data: 'po_id', name: 'po_id'},
            { data: 'dt_aprv', name: 'dt_aprv'},
            { data: 'dt_po', name: 'dt_po' },
            { data: 'DayInterval', name: 'DayInterval' }
        ],
        initComplete: function(settings, json) {

            if (!dataTable.rows().data().length) {

                $.unblockUI();

                swal("Whops", "Data not available", "error");
            }

            else {

                $.unblockUI();
                $('#detailAnalysisModal').modal('open');
                document.getElementById("Cstep1").style.display = "none";
                document.getElementById("Cstep2").style.display = "block";
                document.getElementById("Cstep3").style.display = "none";
                document.getElementById("Cstep4").style.display = "none";    
               
            }
        },
    });

}

function Step3(e){

    blockUI();

    txtStep = "step3";
    var txtParam = e.dataPoint.label;
    var HeaderDetail = "Periode: "+txtParam;
    $("#headerStep").html('<h6>PO -> RCV</h6>')
    $("#headerModal").html('<h6>Detail from '+HeaderDetail+'</h6>')

    var dataTable = $('#step3').DataTable({
        stripeClasses: [],
        lengthMenu: [5, 10, 20, 50],
        pageLength: 10,
        destroy : true,
        responsive: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        ajax: {
            'url':'{!!url("getPurchasingAnalysisDetail")!!}',
            'type': 'post',
            data: {
                '_token': '{{ csrf_token() }}',
                'txtMillID': QtxtMillID, 
                'txtParam': txtParam, 
                'txtPICName': QtxtPICName, 
                'txtDept': QtxtDept, 
                'txtStatus': QtxtStatus, 
                'txtRaw': QtxtRaw,
                'txtStep': txtStep
                }
        },
        columns: [
            { data: 'period', name: 'period'},
            { data: 'pru_id', name: 'pru_id'},
            { data: 'pru_item', name: 'pru_item'},
            { data: 'descr', name: 'descr'},
            { data: 'po_id', name: 'po_id'},
            { data: 'po_item', name: 'po_item'},
            { data: 'rcv_id', name: 'rcv_id'},
            { data: 'dt_po', name: 'dt_po'},
            { data: 'dt_rcv', name: 'dt_rcv' },
            { data: 'DayInterval', name: 'DayInterval' }
        ],
        initComplete: function(settings, json) {

            if (!dataTable.rows().data().length) {

                $.unblockUI();

                swal("Whops", "Data not available", "error");
            }

            else {

                $.unblockUI();
                $('#detailAnalysisModal').modal('open');
                document.getElementById("Cstep1").style.display = "none";
                document.getElementById("Cstep2").style.display = "none";
                document.getElementById("Cstep3").style.display = "block";
                document.getElementById("Cstep4").style.display = "none";    
               
            }
        },
    });



}

function Step4(e){

   blockUI();

    txtStep = "step4";
    var txtParam = e.dataPoint.label;
    var HeaderDetail = "Periode: "+txtParam;
    $("#headerStep").html('<h6>PRU -> RCV</h6>')
    $("#headerModal").html('<h6>Detail from '+HeaderDetail+'</h6>')

    var dataTable = $('#step4').DataTable({
        stripeClasses: [],
        lengthMenu: [5, 10, 20, 50],
        pageLength: 10,
        destroy : true,
        responsive: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        ajax: {
            'url':'{!!url("getPurchasingAnalysisDetail")!!}',
            'type': 'post',
            data: {
                '_token': '{{ csrf_token() }}',
                'txtMillID': QtxtMillID, 
                'txtParam': txtParam, 
                'txtPICName': QtxtPICName, 
                'txtDept': QtxtDept, 
                'txtStatus': QtxtStatus, 
                'txtRaw': QtxtRaw,
                'txtStep': txtStep
                }
        },
        columns: [
            { data: 'period', name: 'period'},
            { data: 'pru_id', name: 'pru_id'},
            { data: 'pru_item', name: 'pru_item'},
            { data: 'descr', name: 'descr'},
            { data: 'po_id', name: 'po_id'},
            { data: 'po_item', name: 'po_item'},
            { data: 'rcv_id', name: 'rcv_id'},
            { data: 'dt_pru', name: 'dt_pru'},
            { data: 'dt_rcv', name: 'dt_rcv' },
            { data: 'DayInterval', name: 'DayInterval' }
        ],
        initComplete: function(settings, json) {

            if (!dataTable.rows().data().length) {

                $.unblockUI();

                swal("Whops", "Data not available", "error");
            }

            else {

                $.unblockUI();
                $('#detailAnalysisModal').modal('open');
                document.getElementById("Cstep1").style.display = "none";
                document.getElementById("Cstep2").style.display = "none";
                document.getElementById("Cstep3").style.display = "none";
                document.getElementById("Cstep4").style.display = "block";    
               
            }
        },
    });


}


$(document).ready(function() {

    var Result = document.getElementById("Result")
    var sumProductAnalysisDetail = document.getElementById("sumProductAnalysisDetail")

    $(".modal").modal();

    DefMillID(); DefPICName(); DefDepartment(); DefRaw(); DefStatus();

    $('#FinAnalysis').addClass('active open');
    $('#FinAnalysisCSS').css('display','block');
    $('#PurchasingAnalysis').addClass('active gradient-45deg-green-teal gradient-shadow');

    var f1 = flatpickr(document.getElementById('txtStart'), {
        static: true,
        altInput: true,
        plugins: [new monthSelectPlugin({shorthand: false, dateFormat: "Ym", altFormat: "Ym"})],
        disableMobile: "true",
    });

    var f2 = flatpickr(document.getElementById('txtEnd'), {
        static: true,
        altInput: true,
        plugins: [new monthSelectPlugin({shorthand: false, dateFormat: "Ym", altFormat: "Ym"})],
        disableMobile: "true",
    });

    $('#txtMillID').change(function(){

        txtMill = $('#txtMillID').val();

        if (txtMill) {

            listPICName(txtMill);
            listDept(txtMill);

        }

        else {

            DefPICName();
            DefDepartment();
        }
        
    });

    $('#txtPICName').change(function(){

        txtMill = $('#txtMillID').val();
        txtPICID = $('#txtPICName').val();

        if (txtMill && txtPICID) {

            listPICDept(txtMill, txtPICID);

        }

        if (txtMill && !txtPICID) {

            listDept(txtMill);

        }

        if (!txtMill) {

            DefDepartment();

        }

        

      
        
    });

    $('#txtDept').change(function(){

        txtMill = $('#txtMillID').val();
        txtDeptID = $('#txtDept').val();

        if (txtMill && txtDeptID) {

            listDeptPIC(txtMill, txtDeptID);

        }

        if (txtMill && !txtDeptID) {

            listPICName(txtMill);

        }

        if (!txtMill) {

            DefPICName();

        }

        

      
        
    });
  
    $('#reset').on('click', function() {

        $('#txtMillID').val(null).trigger('change');
        $('#txtPICName').val(null).trigger('change');
        $('#txtDept').val(null).trigger('change');
        $('#txtStatus').val('All').trigger('change');
        $('#txtRaw').val('General').trigger('change');
        f1.clear();
        f2.clear();
        Result.style.display = "none";


    });

    $('#go').on('click', function() {

        label = '';

        QtxtMillID = $('#txtMillID').val();
        if(QtxtMillID) {
            label = label+'MillID: '+QtxtMillID.trim();
        }
        QtxtStart = $('#txtStart').val();
        QtxtEnd  = $('#txtEnd').val();
        if(QtxtStart && !QtxtEnd) {
            label = label+', Periode >= '+QtxtStart.trim();
        } 
        if(QtxtEnd && !QtxtStart) {
            label = label+', Periode <= '+QtxtEnd.trim();
        }
        if(QtxtEnd && QtxtStart) {
            label = label+', Periode: '+QtxtStart+' - '+QtxtEnd.trim();
        }
        QtxtPICName = $('#txtPICName').val();
        if(QtxtPICName) {
            label = label+', PIC: '+QtxtPICName.trim();
        }
        QtxtDept = $('#txtDept').val();
        if(QtxtDept) {
            label = label+', Department: '+QtxtDept.trim();
        }
        QtxtStatus = $('#txtStatus').val();
        if(QtxtStatus) {
            label = label+', Status: '+QtxtStatus.trim();
        }
        QtxtRaw = $('#txtRaw').val();
        if(QtxtRaw) {
            label = label+', Rawmat/General: '+QtxtRaw.trim();
        }

        if (!QtxtMillID) {

            swal("Whops", "Choose MIll ID first!", "error");
        }

        else {

            blockUI();

            $.ajax({
                type: "POST",
                url: "{{ url('chartPurchasingAnalysis') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'txtMillID': QtxtMillID, 
                    'txtStart': QtxtStart, 
                    'txtEnd': QtxtEnd, 
                    'txtPICName': QtxtPICName, 
                    'txtDept': QtxtDept, 
                    'txtStatus': QtxtStatus, 
                    'txtRaw': QtxtRaw
                },
                success: function (data) {

                    if (data['result'].length > 0) {

                        dp1 = []; dp2 = []; dp3 = []; dp4 = [];

                        for (var i = 0; i < data['result'].length; i++) {

                            dp1.push({  label: data['result'][i].period,  y: parseFloat(data['result'][i].step1) });
                            dp2.push({  label: data['result'][i].period,  y: parseFloat(data['result'][i].step2) });
                            dp3.push({  label: data['result'][i].period,  y: parseFloat(data['result'][i].step3) });
                            dp4.push({  label: data['result'][i].period,  y: parseFloat(data['result'][i].step4) });

                        }
                        container = 'container1';
                        title = "Mill "+QtxtMillID+" Summary";
                        Result.style.display = "block";
                        getChart(dp1, dp2, dp3, dp4, container, title, label);
                        $.unblockUI();

                        $('html, body').animate({
                            scrollTop: $("#Report").offset().top
                        }, 1200)
                    }

                    else {
                        
                        dp1 = []; dp2 = []; dp3 = []; dp4 = [];
                        dp1.push({ y: 0 }); dp2.push({ y: 0 }); dp3.push({ y: 0 }); dp4.push({ y: 0 });
                        container = 'container1';
                        title = "Mill "+QtxtMillID+" Summary";
                        Result.style.display = "block";
                        getChart(dp1, dp2, dp3, dp4, container, title, label);
                        $.unblockUI();

                        $('html, body').animate({
                            scrollTop: $("#Report").offset().top
                        }, 1200)
                    }
                    
                }
            });


        }

        
       
    }); 


    
    
   
    



    




});



</script>

@endsection
