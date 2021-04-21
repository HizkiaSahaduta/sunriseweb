@extends('main')

@section('contentcss')
<link rel="stylesheet" type="text/css" href="{{ asset('outside/material/vendors/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('outside/material/vendors/select2/select2-materialize.css') }}">
<link rel="stylesheet" href="{{ asset('outside/plugins/flatpickr/flatpickr.css') }}" type="text/css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@latest/dist/plugins/monthSelect/style.css">

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
               <h5 class="breadcrumbs-title mt-0 mb-0"><span>SC & Dispatch Analysis</span></h5>
               <ol class="breadcrumbs mb-0">
                  {{-- <li class="breadcrumb-item ">
                     <a href="#">Home</a>
                  </li> --}}
                  <li class="breadcrumb-item ">
                     <a href="#">Sales Marketing Analysis</a>
                  </li>
                  <li class="breadcrumb-item">
                     <a href="#">SC & Dispatch Analysis</a>
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
                    Hello {{ Session::get('USERNAME') }}, here's SC & Dispatch Analysis form. Have a good day :)
                  </p>
               </div>
            </div>

            <div class="card">
                <div class="card-content">

                    <div class="row">
                        <div class="input-field col m4 s12">
                            <i class="material-icons prefix">people</i>
                            <select class="browser-default" id="customer" name="customer" >
                            <option></option>
                            <option value="All">All</option>
                            <option value="KKA">KKA</option>
                            <option value="Non KKA">Non KKA</option>
                            </select>
                            <label>Customer Category</label>
                        </div>
                        <div class="input-field col m4 s12">
                            <label>Start Periode (Request Ship Date)</label>
                            <input type="text" name="start" id="start" placeholder="Choose start periode date" readonly="readonly">
                            
                        </div>
                        <div class="input-field col m4 s12">
                            <label>End Periode (Request Ship Date)</label>      
                            <input type="text" name="end" id="end" placeholder="Choose end periode date" readonly="readonly">     
                        </div>
                    </div>


                    <div class="row">
                        <div class="input-field col m4 s12">
                            <i class="material-icons prefix">branding_watermark</i>
                            <select class="browser-default" id="brand" name="brand">
                            <option></option>
                            </select>
                            <label>Brand</label>
                        </div>
                        <div class="input-field col m4 s12">
                            <i class="material-icons prefix">line_weight</i>
                            <select class="browser-default" id="coat" name="coat">
                            <option></option>
                            </select>
                            <label>Coat (AS-AZ)</label>
                        </div>
                        <div class="input-field col m4 s12">
                            <i class="material-icons prefix">grade</i>
                            <select class="browser-default" id="grade" name="grade">
                            <option></option>
                            </select>
                            <label>Grade</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">unfold_more</i>
                            <select class="browser-default" id="thick" name="thick">
                            <option></option>
                            </select>
                            <label><div id="thick_badge"></div>Thickness</label>
                        </div>
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">swap_horiz</i>
                            <select class="browser-default" id="width" name="width" >
                            <option></option>
                            </select>
                            <label><div id="width_badge"></div>Width</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">color_lens</i>
                            <select class="browser-default" id="colour" name="colour">
                            <option></option>
                            </select>
                            <label><div id="colour_badge"></div>Colour</label>
                        </div>

                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">check_circle</i>
                            <select class="browser-default" id="quality" name="quality">
                            <option></option>
                            </select>
                            <label><div id="quality_badge"></div>Quality</label>
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


            <div class="card" id="sumScShipmentAnalysis" style="display: none">
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

            <div class="card" id="sumScShipmentAnalysisDetail" style="display: none">
                <div class="card-content">
                    <div class="section users-view">
                        <div class="row indigo lighten-5">
                        <div class="col s12 m12 users-view-timeline">
                            <div id="TitleQueryDetail"></div>
                        </div>
                        </div>
                        <br>
                        <div class="row">
    
                            <div class="col s12 m4 l4 xl4">
                                <div class="card">
                                    <div class="card-content">
                                        <div id="container2" style="height: 370px; width: 100%;"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col s12 m4 l4 xl4">
                                <div class="card">
                                    <div class="card-content">
                                        <div id="container3" style="height: 370px; width: 100%;"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col s12 m4 l4 xl4">
                                <div class="card">
                                    <div class="card-content">
                                        <div id="container4" style="height: 370px; width: 100%;"></div>
                                    </div>
                                </div>
                            </div>
                      </div>

                      <div class="row">
    
                        <div class="col s12 m4 l4 xl4">
                            <div class="card">
                                <div class="card-content">
                                    <div id="container5" style="height: 370px; width: 100%;"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col s12 m4 l4 xl4">
                            <div class="card">
                                <div class="card-content">
                                    <div id="container6" style="height: 370px; width: 100%;"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col s12 m4 l4 xl4">
                            <div class="card">
                                <div class="card-content">
                                    <div id="container7" style="height: 370px; width: 100%;"></div>
                                </div>
                            </div>
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
<script src="{{ asset('outside/plugins/flatpickr/flatpickr.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr@latest/dist/plugins/monthSelect/index.js"></script>
<script src="{{ asset('outside/plugins/blockui/jquery.blockUI.min.js') }}"></script>
<script src="{{ asset('canvasjs.min.js') }}"></script>
<script type="text/javascript">

var dt1, dt2, container, title, label;
var dt_detail, container_detail, title_detail, label_detail;
var x = window.matchMedia("(max-width: 991px)");
var Qcustomer, Qstart, Qend, Qbrand, Qcoat, Qgrade, Qthick, Qwidth, Qcolour, Qquality;


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

function listBrand(){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "listBrand",
        success: function (data) {
            $('select[name="brand"]').empty();
            $('select[name="brand"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="brand"]').append('<option value="'+element.brand_id+'">'+element.descr+'</option>');
            });
        }
    });

    $('#brand').select2({
        placeholder: 'Choose brand below',
        allowClear: true
    });

}

function listCoat(){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "listCoat",
        success: function (data) {
            $('select[name="coat"]').empty();
            $('select[name="coat"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="coat"]').append('<option value="'+element.coat_mass+'">AS'+element.coat_mass+'</option>');
            });
        }
    });

    $('#coat').select2({
        placeholder: 'Choose coat below',
        allowClear: true
    });

}

function listGrade(){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "listGrade",
        success: function (data) {
            $('select[name="grade"]').empty();
            $('select[name="grade"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="grade"]').append('<option value="'+element.grade_id+'">'+element.grade_id+'</option>');
            });
        }
    });

    $('#grade').select2({
        placeholder: 'Choose grade below',
        allowClear: true
    });

}

function allThickness(){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "allThickness",
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
        placeholder: 'Choose thick below',
        allowClear: true
    });

}

function commodityThickness(id){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "commodityThickness/id="+id,
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
        placeholder: 'Choose thick below',
        allowClear: true
    });

}

function brandThickness(id){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "brandThickness/id="+id,
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
        placeholder: 'Choose thick below',
        allowClear: true
    });

}

function getThickness(a, b){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "getThickness/a="+a+ "&b=" +b,
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
        placeholder: 'Choose thick below',
        allowClear: true
    });

}

function allWidth(){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "allWidth",
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

function commodityWidth(id){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "commodityWidth/id="+id,
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

function brandWidth(id){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "brandWidth/id="+id,
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

function getWidth(a, b){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "getWidth/a="+a+ "&b="+b,
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

function allColour(){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "allColour",
        success: function (data) {
            $('select[name="colour"]').empty();
            $('select[name="colour"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="colour"]').append('<option value="'+element.color_id+'">'+element.descr+'</option>');
            });
        }
    });

    $('#colour').select2({
        placeholder: 'Choose colour below',
        allowClear: true
    });

}

function getColour(id){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "getColour/id="+id,
        success: function (data) {
            $('select[name="colour"]').empty();
            $('select[name="colour"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="colour"]').append('<option value="'+element.color_id+'">'+element.descr+'</option>');
            });
        }
    });

    $('#colour').select2({
        placeholder: 'Choose colour below',
        allowClear: true
    });

}

function allQuality(){

    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "allQuality",
        success: function (data) {
            $('select[name="quality"]').empty();
            $('select[name="quality"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="quality"]').append('<option value="'+element.quality_id+'">'+element.quality_id+'</option>');
            });
        }
    });

    $('#quality').select2({
        placeholder: 'Choose quality below',
        allowClear: true
    });

}

function getChart(dt1, dt2, container, title, label){

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
            // scaleBreaks: {
            //     autoCalculate: true,
            //     type: "wavy"
		    // },
            crosshair: {
                enabled: true,
                snapToDataPoint: true
            },
            title: "TON",
            labelFormatter: addSymbols,
        },
        toolTip:{
		    shared:true
	    },
        legend: {
            // cursor: "pointer",
            itemclick: toggleDataSeries,
            fontSize: 11
	    },
        data: [
        {
            type: "column",
            click: onClick1,
            name: "Total SC (by ReqShipDate)",
            indexLabel: "{y}",
            indexLabelFontSize: 14,
            // indexLabelFontColor: "#FFF",
            showInLegend: true,
            indexLabelPlacement: "outside",  
            indexLabelOrientation: "horizontal",
            color: "#75cfb8",
            // yValueFormatString: "#,###,,,.##",
        },
        {
            type: "column",
            click: onClick2,
            name: "Total Dispatch",
            indexLabel: "{y}",
            indexLabelFontSize: 14,
            // indexLabelFontColor: "#FFF",
            showInLegend: true,
            indexLabelPlacement: "outside",  
            indexLabelOrientation: "horizontal",
            color: "#ed6663",
            // yValueFormatString: "#,###,,,.##",
        }]
    });

    chart.options.data[0].dataPoints = dt1;
    chart.options.data[1].dataPoints = dt2;
    showDefaultText(chart, "No Data Found!");

    if (x.matches) {

        for(var i = 0; i < chart.options.data.length; i++){
            chart.options.data[i].indexLabelFontSize = 8;
        }
        chart.render();
    }
    chart.render();
}

function onClick1(e){

    blockUI();

    var param = e.dataPoint.label;
    label_detail = "Periode: "+param;

    $.ajax({
        type: "POST",
        url: "{{ url('getScShipmentAnalysisDetailbySC') }}",
        data: {
            '_token': '{{ csrf_token() }}',
            'customer': Qcustomer,
            'periode' : param,
            'brand': Qbrand,
            'coat': Qcoat, 
            'grade': Qgrade, 
            'thick': Qthick,
            'width': Qwidth ,
            'colour': Qcolour,
            'quality': Qquality 
        },
        success: function (data) {

            sumScShipmentAnalysisDetail.style.display = "block";

            if (data['qWidth'].length > 0) {

                for (var i = 0; i < data['qWidth'].length; i++) {

                    dt_detail =  [];

                    for (var i = 0; i < data['qWidth'].length; i++) {

                        dt_detail.push({  label: data['qWidth'][i].width,  y: parseInt(data['qWidth'][i].total_wgt), legendText: data['qWidth'][i].width });

                    }
                    container_detail = 'container2';
                    title_detail = 'by Width'
                    getPieChart(dt_detail, container_detail, title_detail, label_detail)

                }

            }

            if (data['qWidth'].length < 1) {

                dt_detail =  [];
                dt_detail.push({ y: 0 });
                container_detail = 'container2';
                title_detail = 'by Width'
                getPieChart(dt_detail, container_detail, title_detail, label_detail)
            
            }

            if (data['qThick'].length > 0) {

                for (var i = 0; i < data['qThick'].length; i++) {

                    dt_detail =  [];

                    for (var i = 0; i < data['qThick'].length; i++) {

                        dt_detail.push({  label: data['qThick'][i].thick,  y: parseInt(data['qThick'][i].total_wgt), legendText: data['qThick'][i].thick });

                    }
                    container_detail = 'container3';
                    title_detail = 'by Thickness'
                    getPieChart(dt_detail, container_detail, title_detail, label_detail)

                }

            }

            if (data['qThick'].length < 1) {

                dt_detail =  [];
                dt_detail.push({ y: 0 });
                container_detail = 'container3';
                title_detail = 'by Thickness'
                getPieChart(dt_detail, container_detail, title_detail, label_detail)

            
            }

            if (data['qCoatMass'].length > 0) {

                for (var i = 0; i < data['qCoatMass'].length; i++) {

                    dt_detail =  [];

                    for (var i = 0; i < data['qCoatMass'].length; i++) {

                        dt_detail.push({  label: data['qCoatMass'][i].coat_mass,  y: parseInt(data['qCoatMass'][i].total_wgt), legendText: data['qCoatMass'][i].coat_mass });

                    }
                    container_detail = 'container4';
                    title_detail = 'by AS/AZ'
                    getPieChart(dt_detail, container_detail, title_detail, label_detail)

                }

            }

            if (data['qCoatMass'].length < 1) {

                dt_detail =  [];
                dt_detail.push({ y: 0 });
                container_detail = 'container4';
                title_detail = 'by AS/AZ'
                getPieChart(dt_detail, container_detail, title_detail, label_detail)
            
            }

            if (data['qGrade'].length > 0) {

                for (var i = 0; i < data['qGrade'].length; i++) {

                    dt_detail =  [];

                    for (var i = 0; i < data['qGrade'].length; i++) {

                        dt_detail.push({  label: data['qGrade'][i].grade_id,  y: parseInt(data['qGrade'][i].total_wgt), legendText: data['qGrade'][i].grade_id });

                    }
                    container_detail = 'container5';
                    title_detail = 'by Grade'
                    getPieChart(dt_detail, container_detail, title_detail, label_detail)

                }

            }

            if (data['qGrade'].length < 1) {

                dt_detail =  [];
                dt_detail.push({ y: 0 });
                container_detail = 'container5';
                title_detail = 'by Grade'
                getPieChart(dt_detail, container_detail, title_detail, label_detail)
            
            }

            if (data['qQuality'].length > 0) {

                for (var i = 0; i < data['qQuality'].length; i++) {

                    dt_detail =  [];

                    for (var i = 0; i < data['qQuality'].length; i++) {

                        dt_detail.push({  label: data['qQuality'][i].quality_id,  y: parseInt(data['qQuality'][i].total_wgt), legendText: data['qQuality'][i].quality_id });

                    }
                    container_detail = 'container6';
                    title_detail = 'by Quality'
                    getPieChart(dt_detail, container_detail, title_detail, label_detail)

                }

            }

            if (data['qQuality'].length < 1) {

                dt_detail =  [];
                dt_detail.push({ y: 0 });
                container_detail = 'container6';
                title_detail = 'by Quality'
                getPieChart(dt_detail, container_detail, title_detail, label_detail)
            
            }

            if (data['qColor'].length > 0) {

                for (var i = 0; i < data['qColor'].length; i++) {

                    dt_detail =  [];

                    for (var i = 0; i < data['qColor'].length; i++) {

                        dt_detail.push({  label: data['qColor'][i].color_name,  y: parseInt(data['qColor'][i].total_wgt), legendText: data['qColor'][i].color_name });

                    }
                    container_detail = 'container7';
                    title_detail = 'by Color'
                    getPieChart(dt_detail, container_detail, title_detail, label_detail)

                }

            }

            if (data['qColor'].length < 1) {

                dt_detail =  [];
                dt_detail.push({ y: 0 });
                container_detail = 'container7';
                title_detail = 'by Color'
                getPieChart(dt_detail, container_detail, title_detail, label_detail)
            
            }
        
            $.unblockUI();

            $('#TitleQueryDetail').html('<h6 class="indigo-text m-0">Query Result Detail (bySC): </h6>')

            $('html, body').animate({
                scrollTop: $("#sumScShipmentAnalysisDetail").offset().top
            }, 1200)
            
        }
    });



}

function onClick2(e){

    blockUI();

    var param = e.dataPoint.label;
    label_detail = "Periode: "+param;

    $.ajax({
        type: "POST",
        url: "{{ url('getScShipmentAnalysisDetailbyDeliv') }}",
        data: {
            '_token': '{{ csrf_token() }}',
            'customer': Qcustomer,
            'periode' : param,
            'brand': Qbrand,
            'coat': Qcoat, 
            'grade': Qgrade, 
            'thick': Qthick,
            'width': Qwidth ,
            'colour': Qcolour,
            'quality': Qquality 
        },
        success: function (data) {

            sumScShipmentAnalysisDetail.style.display = "block";

            if (data['qWidth'].length > 0) {

                for (var i = 0; i < data['qWidth'].length; i++) {

                    dt_detail =  [];

                    for (var i = 0; i < data['qWidth'].length; i++) {

                        dt_detail.push({  label: data['qWidth'][i].width,  y: parseInt(data['qWidth'][i].total_wgt), legendText: data['qWidth'][i].width });

                    }
                    container_detail = 'container2';
                    title_detail = 'by Width'
                    getPieChart(dt_detail, container_detail, title_detail, label_detail)

                }

            }

            if (data['qWidth'].length < 1) {

                dt_detail =  [];
                dt_detail.push({ y: 0 });
                container_detail = 'container2';
                title_detail = 'by Width'
                getPieChart(dt_detail, container_detail, title_detail, label_detail)
            
            }

            if (data['qThick'].length > 0) {

                for (var i = 0; i < data['qThick'].length; i++) {

                    dt_detail =  [];

                    for (var i = 0; i < data['qThick'].length; i++) {

                        dt_detail.push({  label: data['qThick'][i].thick,  y: parseInt(data['qThick'][i].total_wgt), legendText: data['qThick'][i].thick });

                    }
                    container_detail = 'container3';
                    title_detail = 'by Thickness'
                    getPieChart(dt_detail, container_detail, title_detail, label_detail)

                }

            }

            if (data['qThick'].length < 1) {

                dt_detail =  [];
                dt_detail.push({ y: 0 });
                container_detail = 'container3';
                title_detail = 'by Thickness'
                getPieChart(dt_detail, container_detail, title_detail, label_detail)

            
            }

            if (data['qCoatMass'].length > 0) {

                for (var i = 0; i < data['qCoatMass'].length; i++) {

                    dt_detail =  [];

                    for (var i = 0; i < data['qCoatMass'].length; i++) {

                        dt_detail.push({  label: data['qCoatMass'][i].coat_mass,  y: parseInt(data['qCoatMass'][i].total_wgt), legendText: data['qCoatMass'][i].coat_mass });

                    }
                    container_detail = 'container4';
                    title_detail = 'by AS/AZ'
                    getPieChart(dt_detail, container_detail, title_detail, label_detail)

                }

            }

            if (data['qCoatMass'].length < 1) {

                dt_detail =  [];
                dt_detail.push({ y: 0 });
                container_detail = 'container4';
                title_detail = 'by AS/AZ'
                getPieChart(dt_detail, container_detail, title_detail, label_detail)
            
            }

            if (data['qGrade'].length > 0) {

                for (var i = 0; i < data['qGrade'].length; i++) {

                    dt_detail =  [];

                    for (var i = 0; i < data['qGrade'].length; i++) {

                        dt_detail.push({  label: data['qGrade'][i].grade_id,  y: parseInt(data['qGrade'][i].total_wgt), legendText: data['qGrade'][i].grade_id });

                    }
                    container_detail = 'container5';
                    title_detail = 'by Grade'
                    getPieChart(dt_detail, container_detail, title_detail, label_detail)

                }

            }

            if (data['qGrade'].length < 1) {

                dt_detail =  [];
                dt_detail.push({ y: 0 });
                container_detail = 'container5';
                title_detail = 'by Grade'
                getPieChart(dt_detail, container_detail, title_detail, label_detail)
            
            }

            if (data['qQuality'].length > 0) {

                for (var i = 0; i < data['qQuality'].length; i++) {

                    dt_detail =  [];

                    for (var i = 0; i < data['qQuality'].length; i++) {

                        dt_detail.push({  label: data['qQuality'][i].quality_id,  y: parseInt(data['qQuality'][i].total_wgt), legendText: data['qQuality'][i].quality_id });

                    }
                    container_detail = 'container6';
                    title_detail = 'by Quality'
                    getPieChart(dt_detail, container_detail, title_detail, label_detail)

                }

            }

            if (data['qQuality'].length < 1) {

                dt_detail =  [];
                dt_detail.push({ y: 0 });
                container_detail = 'container6';
                title_detail = 'by Quality'
                getPieChart(dt_detail, container_detail, title_detail, label_detail)
            
            }

            if (data['qColor'].length > 0) {

                for (var i = 0; i < data['qColor'].length; i++) {

                    dt_detail =  [];

                    for (var i = 0; i < data['qColor'].length; i++) {

                        dt_detail.push({  label: data['qColor'][i].color_name,  y: parseInt(data['qColor'][i].total_wgt), legendText: data['qColor'][i].color_name });

                    }
                    container_detail = 'container7';
                    title_detail = 'by Color'
                    getPieChart(dt_detail, container_detail, title_detail, label_detail)

                }

            }

            if (data['qColor'].length < 1) {

                dt_detail =  [];
                dt_detail.push({ y: 0 });
                container_detail = 'container7';
                title_detail = 'by Color'
                getPieChart(dt_detail, container_detail, title_detail, label_detail)
            
            }
        
            $.unblockUI();

            $('#TitleQueryDetail').html('<h6 class="indigo-text m-0">Query Result Detail (byDispatch): </h6>')

            $('html, body').animate({
                scrollTop: $("#sumScShipmentAnalysisDetail").offset().top
            }, 1200)
            
        }
    });



}

function getPieChart(dt_detail, container_detail, title_detail, label_detail){
    var pie_chart = new CanvasJS.Chart(container_detail, {
	    animationEnabled: true,
        exportEnabled: true,
        theme: "light2",
        exportEnabled: true,
        title: {
            text: title_detail,
            fontFamily: "Calibri",
            fontSize: 20
        },
        exportEnabled: true,
        subtitles:[
            {
                text: label_detail,
                //Uncomment properties below to see how they behave
                fontFamily: "Calibri",
                fontColor: "red",
                fontSize: 12
            }
        ],
        legend: {
			itemclick: toggleDataPointVisibility
		},
        data: [{

            type: "pie",
            percentFormatString: "#0.##",
            indexLabel: "{label} #percent%",
            indexLabelFontSize: 12,

        }]
    });
    pie_chart.options.data[0].dataPoints = dt_detail;
    showDefaultText(pie_chart, "No Data Found!");

    if (x.matches) {

        for(var i = 0; i < pie_chart.options.data.length; i++){
            pie_chart.options.data[i].indexLabelFontSize = 6;
        }
        pie_chart.render();
    }
    pie_chart.render();
}

$(document).ready(function() {

    var sumScShipmentAnalysis = document.getElementById("sumScShipmentAnalysis")
    var sumScShipmentsAnalysiDetail = document.getElementById("sumScShipmentsAnalysiDetail")

    $('#SalesDataAnalysis').addClass('active open');
    $('#SalesDataAnalysisCSS').css('display','block');
    $('#ScShipmentAnalysis').addClass('active gradient-45deg-green-teal gradient-shadow');

    listBrand();listCoat();
    listGrade();allThickness();allWidth();allColour();allQuality();

    $("#customer").select2({
        placeholder: "Choose Customer Category"
    });

    var commodity = "All";

    html1 = "<span class='new badge green' data-badge-caption='bound'>"+commodity+"</span>";
    $('#thick_badge').empty();
    $('#thick_badge').append(html1);

    html2 = "<span class='new badge green' data-badge-caption='bound'>"+commodity+"</span>";
    $('#width_badge').empty();
    $('#width_badge').append(html2);

    commodityThickness(commodity);
    commodityWidth(commodity);

    var f1 = flatpickr(document.getElementById('start'), {
        static: true,
        altInput: true,
        plugins: [new monthSelectPlugin({shorthand: false, dateFormat: "Ym", altFormat: "Ym"})],
        disableMobile: "true",
    });

    var f2 = flatpickr(document.getElementById('end'), {
        static: true,
        altInput: true,
        plugins: [new monthSelectPlugin({shorthand: false, dateFormat: "Ym", altFormat: "Ym"})],
        disableMobile: "true",
    });

    $('#brand').change(function(){

        var commodity = "All";
        var brand = $('#brand').val();
        var coat = $('#coat').val();
        var grade = $('#grade').val();
        var thick = $('#thick').val();
        var width = $('#width').val();
        var colour = $('#colour').val();
        $('select[name="thick]').empty();
        $('select[name="width"]').empty();
        $('select[name="colour"]').empty();

        if (!brand){

            $('#colour_badge').empty();
            allColour();
        }

        else {

            html = "<span class='new badge green' data-badge-caption='bound'>"+brand+"</span>";
            $('#colour_badge').empty();
            $('#colour_badge').append(html);
            getColour(brand);
        }

        if (!commodity && !brand){

            $('#thick_badge').empty();
            $('#width_badge').empty();
            allThickness();
            allWidth();
        }

        else if (commodity && !brand){

            html1 = "<span class='new badge green' data-badge-caption='bound'>"+commodity+"</span>";
            $('#thick_badge').empty();
            $('#thick_badge').append(html1);

            html2 = "<span class='new badge green' data-badge-caption='bound'>"+commodity+"</span>";
            $('#width_badge').empty();
            $('#width_badge').append(html2);

            commodityThickness(commodity);
            commodityWidth(commodity);

        }

        else if (!commodity && brand){

            html1 = "<span class='new badge green' data-badge-caption='bounded'>"+brand+"</span>";
            $('#thick_badge').empty();
            $('#thick_badge').append(html1);

            html2 = "<span class='new badge green' data-badge-caption='bounded'>"+brand+"</span>";
            $('#width_badge').empty();
            $('#width_badge').append(html2);

            brandThickness(brand);
            brandWidth(brand);

        }

        else{

            html1 = "<span class='new badge green' data-badge-caption='bound'>"+commodity+'-'+brand+"</span>";
            $('#thick_badge').empty();
            $('#thick_badge').append(html1);

            html2 = "<span class='new badge green' data-badge-caption='bound'>"+commodity+'-'+brand+"</span>";
            $('#width_badge').empty();
            $('#width_badge').append(html2);

            getThickness(commodity, brand);
            getWidth(commodity, brand);

        }

        $.ajax({
            type: "POST",
            url: "{{ url('getQuality') }}",
            data: {
                '_token': '{{ csrf_token() }}',
                'commodity': commodity,
                'brand': brand,
                'coat': coat, 
                'grade': grade, 
                'thick': thick,
                'width': width ,
                'colour': colour 
            },
            success: function (data) {

                if (data.length > 0) {

                    html1 = "<span class='new badge green' data-badge-caption=''>Updated</span>";
                    $('#quality_badge').empty();
                    $('#quality_badge').append(html1);
                    $('select[name="quality"]').empty();
                    $('select[name="quality"]').prepend('<option></option>');
                    $.each(data, function(index, element) {
                        $('select[name="quality"]').append('<option value="'+element.quality_id+'">'+element.quality_id+'</option>');
                    });

                }

                else {

                    html1 = "<span class='new badge red' data-badge-caption=''>N/A</span>";
                    $('#quality_badge').empty();
                    $('#quality_badge').append(html1);
                    $('select[name="quality"]').empty();
                    $('select[name="quality"]').prepend('<option></option>');
                    $.each(data, function(index, element) {
                        $('select[name="quality"]').append('<option value="'+element.quality_id+'">'+element.quality_id+'</option>');
                    });

                }
                
            }
        });

        $('#quality').select2({
            placeholder: 'Choose quality below',
            allowClear: true
        });

    });

    $('#grade').change(function(){

        var commodity = "All";
        var brand = $('#brand').val();
        var coat = $('#coat').val();
        var grade = $('#grade').val();
        var thick = $('#thick').val();
        var width = $('#width').val();
        var colour = $('#colour').val();

        $.ajax({
            type: "POST",
            url: "{{ url('getQuality') }}",
            data: {
                '_token': '{{ csrf_token() }}',
                'commodity': commodity,
                'brand': brand,
                'coat': coat, 
                'grade': grade, 
                'thick': thick,
                'width': width ,
                'colour': colour 
            },
            success: function (data) {

                if (data.length > 0) {

                    html1 = "<span class='new badge green' data-badge-caption=''>Updated</span>";
                    $('#quality_badge').empty();
                    $('#quality_badge').append(html1);
                    $('select[name="quality"]').empty();
                    $('select[name="quality"]').prepend('<option></option>');
                    $.each(data, function(index, element) {
                        $('select[name="quality"]').append('<option value="'+element.quality_id+'">'+element.quality_id+'</option>');
                    });

                }

                else {

                    html1 = "<span class='new badge red' data-badge-caption=''>N/A</span>";
                    $('#quality_badge').empty();
                    $('#quality_badge').append(html1);
                    $('select[name="quality"]').empty();
                    $('select[name="quality"]').prepend('<option></option>');
                    $.each(data, function(index, element) {
                        $('select[name="quality"]').append('<option value="'+element.quality_id+'">'+element.quality_id+'</option>');
                    });

                }
                
            }
        });

        $('#quality').select2({
            placeholder: 'Choose quality below',
            allowClear: true
        });

    });

    $('#thick').change(function(){

        var commodity = "All";
        var brand = $('#brand').val();
        var coat = $('#coat').val();
        var grade = $('#grade').val();
        var thick = $('#thick').val();
        var width = $('#width').val();
        var colour = $('#colour').val();

        $.ajax({
            type: "POST",
            url: "{{ url('getQuality') }}",
            data: {
                '_token': '{{ csrf_token() }}',
                'commodity': commodity,
                'brand': brand,
                'coat': coat, 
                'grade': grade, 
                'thick': thick,
                'width': width ,
                'colour': colour 
            },
            success: function (data) {

                if (data.length > 0) {

                    html1 = "<span class='new badge green' data-badge-caption=''>Updated</span>";
                    $('#quality_badge').empty();
                    $('#quality_badge').append(html1);
                    $('select[name="quality"]').empty();
                    $('select[name="quality"]').prepend('<option></option>');
                    $.each(data, function(index, element) {
                        $('select[name="quality"]').append('<option value="'+element.quality_id+'">'+element.quality_id+'</option>');
                    });

                }

                else {

                    html1 = "<span class='new badge red' data-badge-caption=''>N/A</span>";
                    $('#quality_badge').empty();
                    $('#quality_badge').append(html1);
                    $('select[name="quality"]').empty();
                    $('select[name="quality"]').prepend('<option></option>');
                    $.each(data, function(index, element) {
                        $('select[name="quality"]').append('<option value="'+element.quality_id+'">'+element.quality_id+'</option>');
                    });

                }
                
            }
        });

        $('#quality').select2({
            placeholder: 'Choose quality below',
            allowClear: true
        });

    });

    $('#width').change(function(){

        var commodity = "All";
        var brand = $('#brand').val();
        var coat = $('#coat').val();
        var grade = $('#grade').val();
        var thick = $('#thick').val();
        var width = $('#width').val();
        var colour = $('#colour').val();

        $.ajax({
            type: "POST",
            url: "{{ url('getQuality') }}",
            data: {
                '_token': '{{ csrf_token() }}',
                'commodity': commodity,
                'brand': brand,
                'coat': coat, 
                'grade': grade, 
                'thick': thick,
                'width': width ,
                'colour': colour 
            },
            success: function (data) {

                if (data.length > 0) {

                    html1 = "<span class='new badge green' data-badge-caption=''>Updated</span>";
                    $('#quality_badge').empty();
                    $('#quality_badge').append(html1);
                    $('select[name="quality"]').empty();
                    $('select[name="quality"]').prepend('<option></option>');
                    $.each(data, function(index, element) {
                        $('select[name="quality"]').append('<option value="'+element.quality_id+'">'+element.quality_id+'</option>');
                    });

                }

                else {

                    html1 = "<span class='new badge red' data-badge-caption=''>N/A</span>";
                    $('#quality_badge').empty();
                    $('#quality_badge').append(html1);
                    $('select[name="quality"]').empty();
                    $('select[name="quality"]').prepend('<option></option>');
                    $.each(data, function(index, element) {
                        $('select[name="quality"]').append('<option value="'+element.quality_id+'">'+element.quality_id+'</option>');
                    });

                }
                
            }
        });

        $('#quality').select2({
            placeholder: 'Choose quality below',
            allowClear: true
        });

    });

    $('#colour').change(function(){

        var commodity = "All";
        var brand = $('#brand').val();
        var coat = $('#coat').val();
        var grade = $('#grade').val();
        var thick = $('#thick').val();
        var width = $('#width').val();
        var colour = $('#colour').val();

        $.ajax({
            type: "POST",
            url: "{{ url('getQuality') }}",
            data: {
                '_token': '{{ csrf_token() }}',
                'commodity': commodity,
                'brand': brand,
                'coat': coat, 
                'grade': grade, 
                'thick': thick,
                'width': width ,
                'colour': colour 
            },
            success: function (data) {

                if (data.length > 0) {

                    html1 = "<span class='new badge green' data-badge-caption=''>Updated</span>";
                    $('#quality_badge').empty();
                    $('#quality_badge').append(html1);
                    $('select[name="quality"]').empty();
                    $('select[name="quality"]').prepend('<option></option>');
                    $.each(data, function(index, element) {
                        $('select[name="quality"]').append('<option value="'+element.quality_id+'">'+element.quality_id+'</option>');
                    });

                }

                else {

                    html1 = "<span class='new badge red' data-badge-caption=''>N/A</span>";
                    $('#quality_badge').empty();
                    $('#quality_badge').append(html1);
                    $('select[name="quality"]').empty();
                    $('select[name="quality"]').prepend('<option></option>');
                    $.each(data, function(index, element) {
                        $('select[name="quality"]').append('<option value="'+element.quality_id+'">'+element.quality_id+'</option>');
                    });

                }
                
            }
        });

        $('#quality').select2({
            placeholder: 'Choose quality below',
            allowClear: true
        });

    });

    $('#coat').change(function(){

        var commodity = "All";
        var brand = $('#brand').val();
        var coat = $('#coat').val();
        var grade = $('#grade').val();
        var thick = $('#thick').val();
        var width = $('#width').val();
        var colour = $('#colour').val();

        $.ajax({
            type: "POST",
            url: "{{ url('getQuality') }}",
            data: {
                '_token': '{{ csrf_token() }}',
                'commodity': commodity,
                'brand': brand,
                'coat': coat, 
                'grade': grade, 
                'thick': thick,
                'width': width ,
                'colour': colour 
            },
            success: function (data) {

                if (data.length > 0) {

                    html1 = "<span class='new badge green' data-badge-caption=''>Updated</span>";
                    $('#quality_badge').empty();
                    $('#quality_badge').append(html1);
                    $('select[name="quality"]').empty();
                    $('select[name="quality"]').prepend('<option></option>');
                    $.each(data, function(index, element) {
                        $('select[name="quality"]').append('<option value="'+element.quality_id+'">'+element.quality_id+'</option>');
                    });

                }

                else {

                    html1 = "<span class='new badge red' data-badge-caption=''>N/A</span>";
                    $('#quality_badge').empty();
                    $('#quality_badge').append(html1);
                    $('select[name="quality"]').empty();
                    $('select[name="quality"]').prepend('<option></option>');
                    $.each(data, function(index, element) {
                        $('select[name="quality"]').append('<option value="'+element.quality_id+'">'+element.quality_id+'</option>');
                    });

                }
                
            }
        });

        $('#quality').select2({
            placeholder: 'Choose quality below',
            allowClear: true
        });

    });

    $('#reset').on('click', function() {

        $('#customer').val(null).trigger('change');
        $('#quality').val(null).trigger('change');
        $('#brand').val(null).trigger('change');
        $('#coat').val(null).trigger('change');
        $('#grade').val(null).trigger('change');
        $('#thick').val(null).trigger('change');
        $('#width').val(null).trigger('change');
        $('#colour').val(null).trigger('change');
        f1.clear();
        f2.clear();
        sumScShipmentAnalysis.style.display = "none";
        sumScShipmentAnalysisDetail.style.display = "none";



    });

    $('#go').on('click', function() {

        label = '';
        Qcustomer = $('#customer').val();
        if (Qcustomer) {

            label = label+'Cust. Category: '+Qcustomer.trim();

        }
        Qstart = $('#start').val();
        Qend = $('#end').val();
        if (Qstart && !Qend) {

            label = label+', Periode > '+Qstart.trim();
            
        }
        if (!Qstart && Qend) {

            label = label+', Periode < '+Qend.trim();
            
        }
        if (Qstart && Qend) {


            label = label+', Periode: '+Qstart+' - '+Qend.trim();

        }
        Qbrand = $('#brand').val();
        if (Qbrand) {

            label = label+', BrandID: '+Qbrand.trim();
            
        }
        Qcoat = $('#coat').val();
        if (Qcoat) {

            label = label+', AS/AZ: '+Qcoat.trim();
            
        }
        Qgrade = $('#grade').val();
        if (Qgrade) {

            label = label+', GradeID: '+Qgrade.trim();
            
        }
        Qthick = $('#thick').val();
        if (Qthick) {

            label = label+', Thick: '+Qthick.trim();
            
        }
        Qwidth = $('#width').val();
        if (Qwidth) {

            label = label+', Width: '+Qwidth.trim();
            
        }
        Qcolour = $('#colour').val();
        if (Qcolour) {

            label = label+', ColorID: '+Qcolour.trim();
            
        }
        Qquality = $('#quality').val();
        if (Qquality) {

            label = label+', Quality: '+Qquality.trim();
            
        }

        if (!Qcustomer) {

            swal("Whops", "Choose Customer Category first", "error");
        }

        else {

            blockUI();

            $.ajax({
                type: "POST",
                url: "{{ url('getScShipmentAnalysis') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'customer': Qcustomer,
                    'start' : Qstart,
                    'end' : Qend,
                    'brand': Qbrand,
                    'coat': Qcoat, 
                    'grade': Qgrade, 
                    'thick': Qthick,
                    'width': Qwidth ,
                    'colour': Qcolour,
                    'quality': Qquality 
                },
                success: function (data) {

                    if (data['bySC'].length > 0 && data['byDeliv'].length > 0) {

                        dt1 = [];
                        dt2 = [];

                        for (var i = 0; i < data['bySC'].length; i++) {
                            dt1.push({ label: data['bySC'][i].periode , y: parseFloat(data['bySC'][i].total_wgt)});
                        }

                        for (var i = 0; i < data['byDeliv'].length; i++) {
                            dt2.push({ label: data['byDeliv'][i].periode , y: parseFloat(data['byDeliv'][i].total_wgt)});
                        }

                        container = 'container1';
                        title = Qcustomer+" Summary";
                        sumScShipmentAnalysis.style.display = "block";
                        sumScShipmentAnalysisDetail.style.display = "none";
                        getChart(dt1, dt2, container, title, label);
                        $.unblockUI();

                        $('html, body').animate({
                            scrollTop: $("#sumScShipmentAnalysis").offset().top
                        }, 1200)
                    }

                    else {
                        
                        dt1 = [];
                        dt2 = [];
                        
                        dt1.push({ y: 0 });
                        dt2.push({ y: 0 });
                        container = 'container1';
                        title = Qcustomer+" Summary";
                        sumScShipmentAnalysis.style.display = "block";
                        sumScShipmentAnalysisDetail.style.display = "none";
                        getChart(dt1, dt2, container, title, label);
                        $.unblockUI();

                        $('html, body').animate({
                            scrollTop: $("#sumScShipmentAnalysis").offset().top
                        }, 1200)
                    }
                    
                }
            });


        }

        
       
    }); 


    
    
   
    



    




});



</script>

@endsection
