@extends('main')

@section('contentcss')
<link rel="stylesheet" type="text/css" href="{{ asset('outside/material/vendors/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('outside/material/vendors/select2/select2-materialize.css') }}">
<link href="{{ asset('outside/plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@latest/dist/plugins/monthSelect/style.css">

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

.ui-datepicker-calendar {
    display: none;
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
               <h5 class="breadcrumbs-title mt-0 mb-0"><span>Cashflow Analysis</span></h5>
               <ol class="breadcrumbs mb-0">
                  {{-- <li class="breadcrumb-item ">
                     <a href="#">Home</a>
                  </li> --}}
                  <li class="breadcrumb-item ">
                     <a href="#">Report</a>
                  </li>
                  <li class="breadcrumb-item">
                     <a href="#">Cashflow Analysis</a>
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
                    Hello {{ Session::get('USERNAME') }}, here's list of debt analysis. Have a good day :)
                  </p>
               </div>
            </div>

            <div class="card">
                <div class="card-content">

                    <div class="row">
                        <div class="input-field col m4 s12">
                            <i class="material-icons prefix">business</i>
                            <select class="basic browser-default" id="mill_id" name="mill_id">
                                <option></option>
                                <option value="SR">Sunrise Steel</option>
                                <option value="SM">Sunrise Mill</option>
                            </select>
                            <label>Mill ID</label>
                        </div>
                        <div class="input-field col m4 s12">
                            <input id="start" class="form-control flatpickr flatpickr-input active" type="text" style="width: 100%;" placeholder="Select start period">
                            <label>Start Date</label>
                        </div>
                        <div class="input-field col m4 s12">
                            <input id="end" class="form-control flatpickr flatpickr-input active" type="text" style="width: 100%;" placeholder="Select end period">
                            <label>End Date</label>
                        </div>
                        <div class="input-field col m4 s12">

                            <button class="btn waves-effect waves-light green darken-1" id="resetform">Reset
                                <i class="material-icons right">refresh</i>
                            </button>
                            <button class="btn waves-effect waves-light blue darken-1" name="action" id="submitform">Submit
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" id="cardGraph" style="display :none">     
                <div class="card-content">
                    <h6>Summary :</h6> 

                    <div id="chartContainer1" style="height: 370px; width: 100%;"></div>

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
<script src="{{ asset('outside/canvasjs.min.js') }}"></script>

<script type="text/javascript">

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var dataPoints1, dataPoints2;
var x = window.matchMedia("(max-width: 991px)");

$(document).ready(function() {

    var cardGraph = document.getElementById("cardGraph")

    $("#mill_id").select2({
        placeholder: "Choose Mill Id first"
    });

    var f1 = flatpickr(document.getElementById('start'), {
        static: true,
        altInput: true,
        plugins: [new monthSelectPlugin({shorthand: false, dateFormat: "Ym", altFormat: "Ym"})],
        disableMobile: "true",
        onReady: function ( dateObj, dateStr, instance ) {
        const $clear = $( '<div class="flatpickr-clear"><button class="btn-primary">Clear</button></div>' )
            .on( 'click', () => {
            instance.clear();
            instance.close();
            } )
            .appendTo( $( instance.calendarContainer ) );
        }
    });

    var f2 = flatpickr(document.getElementById('end'), {
        static: true,
        altInput: true,
        plugins: [new monthSelectPlugin({shorthand: false, dateFormat: "Ym", altFormat: "Ym"})],
        disableMobile: "true",
        onReady: function ( dateObj, dateStr, instance ) {
        const $clear = $( '<div class="flatpickr-clear"><button class="btn-primary">Clear</button></div>' )
                        .on( 'click', () => {
                        instance.clear();
                        instance.close();
                        } )
                        .appendTo( $( instance.calendarContainer ) );
        }
    });
	

    $('#Report').addClass('active open');
    $('#ReportCSS').css('display','block');
    $('#Cashflow').addClass('active gradient-45deg-green-teal gradient-shadow');

    $('#submitform').on('click', function(event){
       
       event.preventDefault();
       var mill_id = $("#mill_id").val();
       $start = $("#start").val();
       $end = $("#end").val();

       if (!mill_id) {

            swal('Whoops', 'Choose Mill ID first','error');

       }

       if (mill_id == "SM") {

            swal('Sorry', 'Data for Sunrise Mill still unavailable','error');

       } 

       if (mill_id == "SR") {

            $.ajax({
                url: "{{ url('CashflowGraph') }}",
                type: "get",
                dataType: "json",
                data: {
                'start' : $start,
                'end' : $end
                },
                success: function(data) {

                    if (data.length > 0) {

                        dataPoints1 = [];
                        dataPoints2 = [];

                        for (var i = 0; i < data.length; i++) {

                            dataPoints1.push({ label: data[i].bulan + ' ' + data[i].tahun, y: data[i].cash_in/1000000 });
                            dataPoints2.push({ label: data[i].bulan + ' ' + data[i].tahun, y: data[i].cash_out/1000000 });

                        }

                        cardGraph.style.display = "block";

                        renderChart1(dataPoints1, dataPoints2);

                        swal('SUCCESS', 'Data populated successfully','success');

                    }
                    else
                    {
                        swal('WARNING', 'Data not found !','warning');
                    }

                }
            });
           
       }

        
    });

    $('#resetform').on('click', function() {

        $('#mill_id').val(null).trigger('change');
        f1.clear();
        f2.clear();
        cardGraph.style.display = "none"

    });

});

function renderChart1(datapoints1, datapoints2)
{

    var chart1 = new CanvasJS.Chart("chartContainer1", {
        animationEnabled: true,
        theme: "light2",
        axisX:{
            crosshair: {
                enabled: true,
                snapToDataPoint: true
            }
	    },
        axisY: {
            title: "IDR x1.000.000",
            titleFontSize: 24,
            crosshair: {
			    enabled: true,
                snapToDataPoint: true
		    },
        },
        legend: {
            fontColor: "red",
            cursor: "pointer",
            itemclick: toggleDataSeries
        },
        toolTip:{
		    shared:true
	    },
        data: [{
            type: "column",
            indexLabel: "{y}",
            name: 'Cash In',
            indexLabelFontSize: 12,
            showInLegend: true,
            indexLabelPlacement: "inside",  
            indexLabelOrientation: "vertical",
            yValueFormatString: "###,###",
            indexLabelFontColor: "white"
        },
        {
            type: "column",
            indexLabel: "{y}",
            name: 'Cash Out',
            indexLabelFontSize: 12,
            showInLegend: true,
            indexLabelPlacement: "inside",
            indexLabelOrientation: "vertical",
            yValueFormatString: "###,###",
            indexLabelFontColor: "white"
        }]
    });

    chart1.options.data[0].dataPoints = datapoints1;
    chart1.options.data[1].dataPoints = datapoints2;

    if (x.matches) {
        for(var i = 0; i < chart1.options.data.length; i++){
            chart1.options.data[i].indexLabelFontSize = 6;
        }
        chart1.render();
    }

    chart1.render();

}

function toggleDataSeries(e) {
	if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	} else {
		e.dataSeries.visible = true;
	}
	e.chart.render();
}


</script>

@endsection
