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

.amber-text {
    color: #43a047!important;
}

.small-ico-bg {
    padding: 5px;
    background-color: #f3f1f1;
    border-radius: 50%;
}

.material-icons {
    font-family: Material Icons;
    font-weight: 400;
    font-style: normal;
    font-size: 30px;
    display: inline-block;
    line-height: 1;
    text-transform: none;
    letter-spacing: normal;
    word-wrap: normal;
    white-space: nowrap;
    direction: ltr;
    -webkit-font-smoothing: antialiased;
    text-rendering: optimizeLegibility;
    -moz-osx-font-smoothing: grayscale;
    font-feature-settings: "liga";
}

td, th {
    padding: 5px 5px;
    display: table-cell;
    text-align: left;
    vertical-align: middle;
    border-radius: 2px;
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

.users-edit i,
.users-list-wrapper i,
.users-view i {
    vertical-align: middle;
}
.users-list-wrapper .users-list-filter .show-btn {
    padding-top: 43px !important;
}
.users-list-wrapper .users-list-table {
    overflow: hidden;
}
.users-list-wrapper .users-list-table .dataTables_filter label input {
    width: auto;
    height: auto;
    margin-left: 0.5rem;
}
.users-list-wrapper .users-list-table .dataTables_length label select {
    display: inline-block;
    width: auto;
    height: auto;
}
.users-list-wrapper .users-list-table .dataTable {
    border-collapse: collapse;
}
.users-list-wrapper .users-list-table .dataTable th {
    width: auto !important;
    padding: 19px 15px;
    border-bottom: 1px solid #e0e0e0;
}
.users-list-wrapper .users-list-table .dataTable tbody td {
    padding: 0.8rem;
}
.users-list-wrapper .users-list-table .dataTables_paginate .paginate_button {
    margin-top: 0.25rem;
    padding: 0.25em 0.65em;
}
.users-list-wrapper .users-list-table .dataTables_paginate .paginate_button.current,
.users-list-wrapper .users-list-table .dataTables_paginate .paginate_button:hover {
    color: #fff !important;
    border: 1px solid #3f51b5;
    border-radius: 4px;
    background: #3f51b5;
    box-shadow: 0 0 8px 0 #3f51b5;
}
.users-view .media .avatar {
    margin-right: 0.6rem;
}
.users-view .media .users-view-name {
    font-size: 1.47rem;
}
.users-view .quick-action-btns a {
    margin-left: 1rem;
}
.users-view .users-view-timeline {
    padding: 1.2rem;
}
.users-view .users-view-timeline h6 span {
    font-size: 1.2rem;
    vertical-align: middle;
}
.users-view .striped td:first-child {
    width: 140px;
}
.users-edit .tabs .tab a {
    text-overflow: clip;
}
.users-edit .tabs .tab a span {
    position: relative;
    top: 2px;
}
.users-edit .tabs .tab a.active {
    border-radius: 4px;
    background-color: #e8eaf6;
}
.users-edit .user-edit-btns a,
.users-edit form button[type="submit"] {
    margin-right: 1rem;
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

/* @media (max-width: 600px) {

    .users-view .media {
        margin-bottom: 0.5rem;
    }
    .users-view .media .media-heading {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
    }
    .users-view .media .media-heading .users-view-name {
        font-size: 1.2rem;
    }
    .users-view .media .media-heading .users-view-username {
        font-size: 0.8rem;
    }

    .users-view-timeline h6 {
        text-align: left;
        font-size: 8px;
    }

    h5, h6 {
            font-size: 13px !important; 
            font-weight: 600 !important;
            margin: .575rem 0 .46rem;
        }
} */


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

    .page-footer .container {
        padding: 0 15px;
        font-size: 9px;
    }

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
               <h5 class="breadcrumbs-title mt-0 mb-0"><span>Live Data Production</span></h5>
               <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item ">
                     <a href="#">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item ">
                     <a href="#">Live Data Production</a>
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

                    <div id = "dashboardHeader">

                        <h5 style="font-weight: 900;">Pls wait...</h5>
                        <div class="row indigo lighten-5">
                        <div class="col s12 m12 users-view-timeline">
                            <h6 class="indigo-text m-0">Real Time Data, Last Update @</h6>
                        </div>
                        </div>

                        <div class="row">
                            <div class="col s12 m4 l4 card-width">
                                <div class="card border-radius-6">
                                <div class="card-content center-align">
                                    <i class="material-icons amber-text small-ico-bg mb-5">album</i>
                                    <p>Pls wait...</p>
                                </div>
                                </div>
                            </div>
                            <div class="col s12 m4 l4 card-width">
                                <div class="card border-radius-6">
                                <div class="card-content center-align">
                                    <i class="material-icons amber-text small-ico-bg mb-5">donut_small</i>
                                    <p>Pls wait...</p>
                                </div>
                                </div>
                            </div>
                            <div class="col s12 m4 l4 card-width">
                                <div class="card border-radius-6">
                                <div class="card-content center-align">
                                    <i class="material-icons amber-text small-ico-bg mb-5">fiber_smart_record</i>
                                    <p>Pls wait...</p>
                                </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                    <div class="col s12">
                        <div class="row">

                            <div id = "RealTimeData">
                                <div class="col s12 m4 l4 xl4">
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="row cyan lighten-5">
                                                <div class="col s12 m users-view-timeline">
                                                    <h6 style="font-weight: 600;" class="cyan-text text-darken-3 m-0"><i class="material-icons">timer</i> Real Time Data</h6>
                                                </div>
                                            </div>
                                            <table>
                                            <tbody>
                                                <tr>
                                                <tr>
                                                <td style="font-weight: 600;">Entry Thickness:</td>
                                                <td class="cyan-text text-darken-3">Pls wait...</td>
                                                </tr>
                                                <tr>
                                                <td style="font-weight: 600;">Entry Width:</td>
                                                <td class="cyan-text text-darken-3">Pls wait...</td>
                                                </tr>
                                                <tr>
                                                <td style="font-weight: 600;">Grade:</td>
                                                <td class="cyan-text text-darken-3">Pls wait...</td>
                                                </tr>
                                                <tr>
                                                <td style="font-weight: 600;">AZ:</td>
                                                <td class="cyan-text text-darken-3">Pls wait...</td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col s12 m4 l4 xl4">
                                <div class="card">
                                    <div class="card-content">
                                        <div id="container1" style="height: 198px; width: 100%;"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col s12 m4 l4 xl4">
                                <div class="card">
                                    <div class="card-content">
                                        <div id="container2" style="height: 198px; width: 100%;"></div>
                                    </div>
                                </div>
                            </div>


                            <div id = "dashboardContent">


                                <h5 style="font-weight: 900;">Last Production Summary :</h5>
                                <div class="row indigo lighten-5">
                                <div class="col s12 m12 users-view-timeline">
                                    <h6 class="indigo-text m-0">Last Update @</h6>
                                </div>
                                </div>

                                <div class="col s12 m4 l4 xl4">
                                    <div class="card animate fadeLeft">
                                        <div class="card-content">
                                            <div class="row blue lighten-5">
                                                <div class="col s12 m12 users-view-timeline">
                                                    <h6 style="font-weight: 600;" class="blue-text text-darken-3 m-0"><i class="material-icons">link</i> Entry</h6>
                                                </div>
                                            </div>
                                            <table>
                                            <tbody>
                                                <tr>
                                                <td style="font-weight: 600;">CRCID:</td>
                                                <td class="blue-text text-darken-3">Pls wait...</td>
                                                </tr>
                                                <tr>
                                                <td style="font-weight: 600;">Welded Time:</td>
                                                <td class="blue-text text-darken-3">Pls wait...</td>
                                                </tr>
                                                <tr>
                                                <td style="font-weight: 600;">Thickness:</td>
                                                <td class="blue-text text-darken-3">Pls wait...</td>
                                                </tr>
                                                <tr>
                                                <td style="font-weight: 600;">Width:</td>
                                                <td class="blue-text text-darken-3">Pls wait...</td>
                                                </tr>
                                                <tr>
                                                <td style="font-weight: 600;">Weight:</td>
                                                <td class="blue-text text-darken-3">Pls wait...</td>
                                                </tr>
                                                <tr>
                                                <td style="font-weight: 600;">Porpos:</td>
                                                <td class="blue-text text-darken-3">Pls wait...</td>
                                                </tr>
                                                <tr>
                                                <td style="font-weight: 600;">AVG Speed:</td>
                                                <td class="blue-text text-darken-3">Pls wait...</td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m4 l4 xl4">
                                    <div class="card animate fadeLeft">
                                        <div class="card-content">
                                            <div class="row orange lighten-5">
                                                <div class="col s12 m12 users-view-timeline">
                                                    <h6 style="font-weight: 600;" class="orange-text text-darken-3 m-0"><i class="material-icons">center_focus_strong</i> Center</h6>
                                                </div>
                                            </div>
                                            <table>
                                            <tbody>
                                                <tr>
                                                <td style="font-weight: 600;">Grade:</td>
                                                <td class="orange-text text-darken-3">Pls wait...</td> 
                                                </tr>
                                                <tr>
                                                <td style="font-weight: 600;">AZ:</td>
                                                <td class="orange-text text-darken-3">Pls wait...</td> 
                                                </tr>
                                                <tr>
                                                <td style="font-weight: 600;">AVG Speed:</td>
                                                <td class="orange-text text-darken-3">Pls wait...</td> 
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m4 l4 xl4">
                                    <div class="card animate fadeLeft">
                                        <div class="card-content">
                                            <div class="row green lighten-5">
                                                <div class="col s12 m12 users-view-timeline">
                                                    <h6 style="font-weight: 600;" class="green-text text-darken-3 m-0"><i class="material-icons">cancel</i> Exit</h6>
                                                </div>
                                            </div>
                                            <table>
                                            <tbody>
                                                <tr>
                                                <td style="font-weight: 600;">CoilID:</td>
                                                <td style="font-weight: 600;" class="green-text text-darken-3">Pls wait...</td>
                                                </tr>
                                                <tr>
                                                <td style="font-weight: 600;">Weight:</td>
                                                <td style="font-weight: 600;" class="green-text text-darken-3">Pls wait...</td>
                                                </tr>
                                                <tr>
                                                <td style="font-weight: 600;">Length:</td>
                                                <td style="font-weight: 600;" class="green-text text-darken-3">Pls wait...</td>
                                                </tr>
                                                <tr>
                                                <td style="font-weight: 600;">Quality:</td>
                                                <td style="font-weight: 600;" class="green-text text-darken-3">Pls wait...</td>
                                                </tr>
                                                <tr>
                                                <td style="font-weight: 600;">TensionLoop:</td>
                                                <td style="font-weight: 600;" class="green-text text-darken-3">Pls wait...</td>
                                                </tr>
                                                <tr>
                                                <td style="font-weight: 600;">TensionReal:</td>
                                                <td style="font-weight: 600;" class="green-text text-darken-3">Pls wait...</td>
                                                </tr>
                                                <tr>
                                                <td style="font-weight: 600;">CuttingTime:</td>
                                                <td style="font-weight: 600;" class="green-text text-darken-3">Pls wait...</td>
                                                </tr>
                                            </tbody>
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
<script src="{{ asset('outside/plugins/blockui/jquery.blockUI.min.js') }}"></script>
<script src="{{ asset('canvasjs.min.js') }}"></script>

<script type="text/javascript">
var x = window.matchMedia("(max-width: 991px)");
var dt1, title1, subtitle1, subtitle_color1, lastUpdate1, container1, color1, name1
var dt2, title2, subtitle2, subtitle_color2, lastUpdate2, container2, color2, name2

function toggleDataSeries(e) {
	if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	} else {
		e.dataSeries.visible = true;
	}
	e.chart.render();
}

function time_convert(num){ 
    
  var hours = Math.floor(num / 60)+ " hours";  
  var minutes = num % 60;
  return hours + ", " + minutes + " minutes";    

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

function getChart(dt, title, subtitle, subtitle_color, lastUpdate, container, color, name){
    chart = new CanvasJS.Chart(container, {
        animationEnabled: false,
        theme: "light2",
        title: {
            text: title, 
            fontFamily: "Calibri",
            fontSize: 20
        },
        subtitles:[
            {
                text: subtitle,
                fontFamily: "Calibri",
                fontColor: subtitle_color,
                fontSize: 20
            }
		],
        exportEnabled: true,
        axisY: {
            crosshair: {
			    enabled: true,
                snapToDataPoint: true
		    },
            title: "mpm",
        },
        // axisX:{
        //     title: "Last Update : "+lastUpdate,
        //     titleFontSize: 14,
        //     titleFontColor: "#0f3057",
        //     titleFontWeight: "bold",
        //     labelFontSize: 12
        //  },
        toolTip:{
		    shared:true
	    },
        legend: {
            fontSize: 11,
            itemMaxWidth: 150,
			itemWrap: true ,
            cursor: "pointer",
            itemclick: toggleDataSeries
	    },
        data: [
            {
                type: "line",
                showInLegend: true,
                name: name,
                indexLabel: "{y}",
                indexLabelFontSize: 12,
                indexLabelFontFamily: "calibri",
                color: color
            }
        ]
    });
    chart.options.data[0].dataPoints = dt;

    if (x.matches) {

        for(var i = 0; i < chart.options.data.length; i++){
            chart.options.data[i].indexLabelFontSize = 6;
        }
        chart.render();
    }

    chart.render();

}

function updateChart() {
    
    $.ajax({
        type: "POST",
        url: "{{ url('updateSpeed') }}",
        data: {
            '_token': '{{ csrf_token() }}'
        },
        success: function(data) {


            $('#dashboardHeader').html(data['dashboardHeader']);

            $('#RealTimeData').html(data['realtimedata']);

            if (data["updateSpeed"].length > 0) {

                dt1 =  [];
                dt2 =  [];

                for (var i = 0; i < data["updateSpeed"].length; i++) {
                   
                    dt1.push({ label: data["updateSpeed"][i].date, y: parseFloat(data["updateSpeed"][i].ENSpeed_sec.slice(0, -1)) });
                    dt2.push({ label: data["updateSpeed"][i].date, y: parseFloat(data["updateSpeed"][i].CENSpeed_sec.slice(0, -1)) });
                    var tes = parseInt(data["updateSpeed"][i].sub_min);
                    lastUpdate1 = data["updateSpeed"][i].date2;
                    lastUpdate2 = data["updateSpeed"][i].date2;
                }

                
                if (tes > 10 ) {

                    if (tes > 60 ) {

                        subtitle1 = "Stop line in : " +time_convert(tes);
                        subtitle2 = "Stop line in : " +time_convert(tes);
                    }

                    else {

                        subtitle1 = "Stop line in : " +tes+ " minutes";
                        subtitle2 = "Stop line in : " +tes+ " minutes";

                    }
                    
                    subtitle_color1 = "red";
                    title1 = "Entry Speed";
                    container1 = "container1";
                    color1 = "#0e9aa7";
                    name1 = "Entry Speed";

                    subtitle_color2 = "red";
                    title2 = "Center Speed";
                    container2 = "container2";
                    color2 = "#c70039";
                    name2 = "Center Speed";

                    getChart(dt1, title1, subtitle1, subtitle_color1, lastUpdate1, container1, color1, name1 );
                    getChart(dt2, title2, subtitle2, subtitle_color2, lastUpdate2, container2, color2, name2 );
                }

                else {

                    subtitle1 = "-";
                    subtitle_color1 = "black";
                    title1 = "Entry Speed";
                    container1 = "container1";
                    color1 = "#0e9aa7";
                    name1 = "Entry Speed";

                    subtitle2 = "-";
                    subtitle_color2 = "black";
                    title2 = "Center Speed";
                    container2 = "container2";
                    color2 = "#c70039";
                    name2 = "Center Speed";

                    getChart(dt1, title1, subtitle1, subtitle_color1, lastUpdate1, container1, color1, name1 );
                    getChart(dt2, title2, subtitle2, subtitle_color2, lastUpdate2, container2, color2, name2 );

                }

            }
            else {

                dt1 =  [];
                dt2 =  [];
                dt1.push({ y: 0 });
                dt2.push({ y: 0 });
                
                subtitle1 = "Chart updated every 15 secs";
                subtitle_color1 = "black";
                title1 = "Real Time Entry Speed";
                container1 = "container1";
                color1 = "#0e9aa7";
                name1 = "Entry Speed";

                subtitle2 = "Chart updated every 15 secs";
                subtitle_color2 = "black";
                title2 = "Real Time Center Speed";
                container2 = "container2";
                color2 = "#c70039";
                name2 = "Center Speed";

                getChart(dt1, title1, subtitle1, subtitle_color1, lastUpdate1, container1, color1, name1 );
                getChart(dt2, title2, subtitle2, subtitle_color2, lastUpdate2, container2, color2, name2 );


            }


        }
    });
}

function updateDashboard () {

    $.ajax({
        type: "POST",
        url: "{{ url('getDashboard') }}",
        data: {
            '_token': '{{ csrf_token() }}'
        },
        success: function(data) {

            $('#dashboardContent').html(data['dashboardContent']);

           
        }
    });


}

$(document).ready(function() {

    $('#Dashboard').addClass('active open');
    $('#DashboardCSS').css('display','block');
    $('#LiveDataProd').addClass('active gradient-45deg-green-teal gradient-shadow');

    $.ajax({
        type: "POST",
        url: "{{ url('getDashboard') }}",
        data: {
            '_token': '{{ csrf_token() }}'
        },
        success: function(data) {

            $('#dashboardContent').html(data['dashboardContent']);

           
        }
    });

    $.ajax({
        type: "POST",
        url: "{{ url('updateSpeed') }}",
        data: {
            '_token': '{{ csrf_token() }}'
        },
        success: function(data) {


            $('#dashboardHeader').html(data['dashboardHeader']);

            $('#RealTimeData').html(data['realtimedata']);

            if (data["updateSpeed"].length > 0) {

                dt1 =  [];
                dt2 =  [];

                for (var i = 0; i < data["updateSpeed"].length; i++) {
                   
                    dt1.push({ label: data["updateSpeed"][i].date, y: parseFloat(data["updateSpeed"][i].ENSpeed_sec.slice(0, -1)) });
                    dt2.push({ label: data["updateSpeed"][i].date, y: parseFloat(data["updateSpeed"][i].CENSpeed_sec.slice(0, -1)) });
                    var tes = parseInt(data["updateSpeed"][i].sub_min);
                    lastUpdate1 = data["updateSpeed"][i].date2;
                    lastUpdate2 = data["updateSpeed"][i].date2;
                }

                
                if (tes > 10 ) {

                    if (tes > 60 ) {

                        subtitle1 = "Stop line in : " +time_convert(tes);
                        subtitle2 = "Stop line in : " +time_convert(tes);
                    }

                    else {

                        subtitle1 = "Stop line in : " +tes+ " minutes";
                        subtitle2 = "Stop line in : " +tes+ " minutes";

                    }
                    
                    subtitle_color1 = "red";
                    title1 = "Entry Speed";
                    container1 = "container1";
                    color1 = "#0e9aa7";
                    name1 = "Entry Speed";

                    subtitle_color2 = "red";
                    title2 = "Center Speed";
                    container2 = "container2";
                    color2 = "#c70039";
                    name2 = "Center Speed";

                    getChart(dt1, title1, subtitle1, subtitle_color1, lastUpdate1, container1, color1, name1 );
                    getChart(dt2, title2, subtitle2, subtitle_color2, lastUpdate2, container2, color2, name2 );
                }

                else {

                    subtitle1 = "-";
                    subtitle_color1 = "black";
                    title1 = "Entry Speed";
                    container1 = "container1";
                    color1 = "#0e9aa7";
                    name1 = "Entry Speed";

                    subtitle2 = "-";
                    subtitle_color2 = "black";
                    title2 = "Center Speed";
                    container2 = "container2";
                    color2 = "#c70039";
                    name2 = "Center Speed";

                    getChart(dt1, title1, subtitle1, subtitle_color1, lastUpdate1, container1, color1, name1 );
                    getChart(dt2, title2, subtitle2, subtitle_color2, lastUpdate2, container2, color2, name2 );

                }

            }
            else {

                dt1 =  [];
                dt2 =  [];
                dt1.push({ y: 0 });
                dt2.push({ y: 0 });
                
                subtitle1 = "Chart updated every 15 secs";
                subtitle_color1 = "black";
                title1 = "Real Time Entry Speed";
                container1 = "container1";
                color1 = "#0e9aa7";
                name1 = "Entry Speed";

                subtitle2 = "Chart updated every 15 secs";
                subtitle_color2 = "black";
                title2 = "Real Time Center Speed";
                container2 = "container2";
                color2 = "#c70039";
                name2 = "Center Speed";

                getChart(dt1, title1, subtitle1, subtitle_color1, lastUpdate1, container1, color1, name1 );
                getChart(dt2, title2, subtitle2, subtitle_color2, lastUpdate2, container2, color2, name2 );


            }


        }
    });

    setInterval(function(){updateChart()}, 3000);

    setInterval(function(){updateDashboard()}, 60000);

    


});



</script>

@endsection
