@extends('main')

@section('contentcss')
<link rel="stylesheet" type="text/css" href="{{ asset('outside/material/vendors/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('outside/material/vendors/select2/select2-materialize.css') }}">
<style>

hr.style {
  border-top: 1px dashed #888ea8;
}

@media (max-width:1366px) {

    h6 {
        font-size: 12px !important;
        font-weight: 600 !important;
        margin: .575rem 0 .46rem;
    }

    h5 {
        font-size: 16px !important;
        font-weight: 800 !important;
        margin: .575rem 0 .46rem;
    }

}  


@media (max-width: 991px) {

    h6 {
        font-size: 11px !important;
        font-weight: 600 !important;
        margin: .575rem 0 .46rem;
    }

    h5 {
        font-size: 14px !important;
        font-weight: 800 !important;
        margin: .575rem 0 .46rem;
    }
}



</style>
@endsection

@section('content')

<!-- BEGIN: Page Main-->
<div class="row">
   <div
      class="content-wrapper-before gradient-45deg-green-teal ">
   </div>
<!-- BEGIN: Breadcrumb-->
   <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
      <div class="container">
         <div class="row">
            <div class="col s10 m6 l6">
               <h5 class="breadcrumbs-title mt-0 mb-0"><span>Production Summary</span></h5>
               <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item ">
                     <a href="#">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item ">
                     <a href="#">Production Summary</a>
                  </li>
               </ol>
            </div>
         </div>
      </div>
   </div>
<!-- End: Breadcrumb-->

  

    <div class="col s12">
        <div class="container">
            <div class="section users-view">
              <div class="card">
                  <div class="card-content">
                      <h5 style="font-weight: 900;">CGL1</h5>
                      <div class="row indigo lighten-5">
                        <div class="col s12 m12 users-view-timeline">
                            <h6 class="indigo-text m-0">Production Summary (Year to Year)</h6>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col s12">
                            <div class="row">

                                <div class="col s12 m12 l12 xl12">
                                    <div class="card">
                                        <div class="card-content">
                                            <div id="container1" style="height: 370px; width: 100%;"></div>
                                        </div>
                                    </div>
                                </div>
                          </div>
                        </div>
                      </div>
                      <h5 style="font-weight: 900;">CGL2</h5>
                      <div class="row indigo lighten-5">
                        <div class="col s12 m12 users-view-timeline">
                            <h6 class="indigo-text m-0">Production Summary (Year to Year)</h6>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col s12">
                            <div class="row">
                                <div class="col s12 m12 l12 xl12">
                                    <div class="card">
                                        <div class="card-content">
                                            <div id="container2" style="height: 370px; width: 100%;"></div>
                                        </div>
                                    </div>
                                </div>
                          </div>
                        </div>
                      </div>
                      <h5 style="font-weight: 900;">CGL1 + CGL2</h5>
                      <div class="row indigo lighten-5">
                        <div class="col s12 m12 users-view-timeline">
                            <h6 class="indigo-text m-0">Production Summary (Year to Year)</h6>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col s12">
                            <div class="row">
                                <div class="col s12 m12 l12 xl12">
                                    <div class="card">
                                        <div class="card-content">
                                            <div id="container3" style="height: 370px; width: 100%;"></div>
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

    




    
</div>
<!-- END: Page Main-->

@endsection

@section('contentjs')
<script src="{{ asset('outside/material/vendors/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('outside/plugins/blockui/jquery.blockUI.min.js') }}"></script>
<script src="{{ asset('canvasjs.min.js') }}"></script>

<script type="text/javascript">

var year = {{ $year }};
var subyear = {{ $subyear }};
var dt1, dt2, container

var months = [
    'Jan', 'Feb', 'Mar', 'Apr', 'May',
    'Jun', 'Jul', 'Aug', 'Sep',
    'Oct', 'Nov', 'Dec'
];

var x = window.matchMedia("(max-width: 991px)")

function monthNumToName(monthnum) {
    return months[monthnum - 1] || '';
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

function getChart(dt1, dt2, container){

    var chart = new CanvasJS.Chart(container, {
        animationEnabled: true,
        theme: "light2",
        exportEnabled: true,
        axisY: {
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
            cursor: "pointer",
            itemclick: toggleDataSeries
	    },
        data: [
        {
            type: "column",
            indexLabel: "{y}",
            indexLabelFontSize: 14,
            indexLabelFontColor: "#FFF",
            name: subyear+ " Production",
            showInLegend: true,
            indexLabelPlacement: "inside",  
            indexLabelOrientation: "vertical",
            color: "#2d4059",
            // yValueFormatString: "#,###,,,.##",
        },
        {
            type: "column",
            indexLabel: "{y}",
            indexLabelFontSize: 14,
            indexLabelFontColor: "#FFF",
            name: year+ " Production",
            showInLegend: true,
            indexLabelPlacement: "inside",  
            indexLabelOrientation: "vertical",
            // color: "#2d4059",
            color: "#ed6663",
            // yValueFormatString: "#,###,,,.##",
        }]
    });

    chart.options.data[0].dataPoints = dt1;
    chart.options.data[1].dataPoints = dt2;

    if (x.matches) {

        for(var i = 0; i < chart.options.data.length; i++){
            chart.options.data[i].indexLabelFontSize = 8;
        }
        chart.render();
    }
    chart.render();
}

$(document).ready(function() {

    $('#Dashboard').addClass('active open');
    $('#DashboardCSS').css('display','block');
    $('#ProdSum').addClass('active gradient-45deg-green-teal gradient-shadow');

    dt1 = [];
    dt2 = [];
    dt1.push({ y: 0 });
    dt2.push({ y: 0 });
    container1 = "container1";
    container2 = "container2";
    getChart(dt1, dt2, container1);
    getChart(dt1, dt2, container2);


    $.ajax({
      type: "get",
      url: "{{ url('getDashboardProduction') }}",
      success: function(data) {

        if (data['cgl1_now'].length > 0  && data['cgl1_sub'].length > 0) {

          dt1 = [];
          dt2 = [];

          for (var i = 0; i < data['cgl1_now'].length; i++) {
                    
              dt2.push({ label: monthNumToName(parseInt(data['cgl1_now'][i].bulan)), y: parseFloat(data['cgl1_now'][i].total_wgt)});
          }


          for (var i = 0; i < data['cgl1_sub'].length; i++) {
              
              dt1.push({ label: monthNumToName(parseInt(data['cgl1_sub'][i].bulan)), y: parseFloat(data['cgl1_sub'][i].total_wgt) });
          }


          container = "container1";

          getChart(dt1, dt2, container);


        }

        if (data['cgl1_now'].length < 1  && data['cgl1_sub'].length < 1) {

          dt1 = [];
          dt2 = [];
          dt1.push({ y: 0 });
          dt2.push({ y: 0 });
          container = "container1";
          getChart(dt1, dt2, container);

        }

        if (data['cgl2_now'].length > 0  && data['cgl2_sub'].length > 0) {

          dt1 = [];
          dt2 = [];

          for (var i = 0; i < data['cgl2_now'].length; i++) {
                    
              dt2.push({ label: monthNumToName(parseInt(data['cgl2_now'][i].bulan)), y: parseFloat(data['cgl2_now'][i].total_wgt) });
          }


          for (var i = 0; i < data['cgl2_sub'].length; i++) {
              
              dt1.push({ label: monthNumToName(parseInt(data['cgl2_sub'][i].bulan)), y: parseFloat(data['cgl2_sub'][i].total_wgt) });
          }


          container = "container2";

          getChart(dt1, dt2, container);


        }

        if (data['cgl2_now'].length < 1  && data['cgl2_sub'].length < 1) {

          dt1 = [];
          dt2 = [];
          dt1.push({ y: 0 });
          dt2.push({ y: 0 });
          container = "container2";
          getChart(dt1, dt2, container);

        }

        if (data['cgl1_now'].length > 0  && data['cgl1_sub'].length > 0 && data['cgl2_now'].length > 0  && data['cgl2_sub'].length > 0) {

            dt1 = [];
            dt2 = [];

            for (var i = 0; i < data['cgl1_now'].length; i++) {

                for (var i = 0; i < data['cgl2_now'].length; i++) {

                    if (monthNumToName(parseInt(data['cgl1_now'][i].bulan)) == monthNumToName(parseInt(data['cgl2_now'][i].bulan))) {

                        dt2.push({ label: monthNumToName(parseInt(data['cgl1_now'][i].bulan)), y: parseFloat(data['cgl1_now'][i].total_wgt)+parseFloat(data['cgl2_now'][i].total_wgt)});
                    }

                }
            
            }


            for (var i = 0; i < data['cgl1_sub'].length; i++) {

                for (var i = 0; i < data['cgl2_sub'].length; i++) { 

                    if (monthNumToName(parseInt(data['cgl1_sub'][i].bulan)) == monthNumToName(parseInt(data['cgl2_sub'][i].bulan))) {

                        dt1.push({ label: monthNumToName(parseInt(data['cgl1_sub'][i].bulan)), y: parseFloat(data['cgl1_sub'][i].total_wgt)+parseFloat(data['cgl2_sub'][i].total_wgt) });
                        
                    }


                }
                
            }


            container = "container3";

            getChart(dt1, dt2, container);


        }


      }

          
    });


    

    


});



</script>

@endsection
