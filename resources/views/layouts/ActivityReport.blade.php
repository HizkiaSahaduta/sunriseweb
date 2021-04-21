@extends('main')

@section('contentcss')
<link rel="stylesheet" type="text/css" href="{{ asset('outside/material/vendors/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('outside/material/vendors/select2/select2-materialize.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.4/css/responsive.dataTables.min.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
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
               <h5 class="breadcrumbs-title mt-0 mb-0"><span>Activity Report</span></h5>
               <ol class="breadcrumbs mb-0">
                  {{-- <li class="breadcrumb-item ">
                     <a href="#">Home</a>
                  </li> --}}
                  <li class="breadcrumb-item ">
                     <a href="#">Sales Activity</a>
                  </li>
                  <li class="breadcrumb-item">
                     <a href="#">Activity Report</a>
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
                    Hello {{ Session::get('USERNAME') }}, here's sales activity report form. Have a good day :)
                </p>
                </div>
              </div>

            <div class="card">
               <div class="card-content">
                <div class="row">

                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">supervisor_account</i>
                            <select class="browser-default" id="salesid" name="salesid">
                            @if(isset($listsales))
                            @if(Session::get('GROUPID') == 'SALES')
                            @foreach($listsales as $o)
                            <option value='{{ $o->salesman_id }}'>{{ $o->salesman_name }}</option>
                            @endforeach

                            @elseif(Session::get('GROUPID') == 'PRIV')
                            <option></option>
                            @foreach($listsales as $o)
                            <option value='{{ $o->salesman_id }}'>{{ $o->salesman_name }}</option>
                            @endforeach

                            @elseif(Session::get('GROUPID') == 'KOORDINATOR')
                            <option></option>
                            @foreach($listsales as $o)
                            <option value='{{ $o->salesman_id }}'>{{ $o->salesman_name }}</option>
                            @endforeach

                            @elseif(Session::get('GROUPID') == 'DEVELOPMENT')
                            <option></option>
                            @foreach($listsales as $o)
                                <option value='{{ $o->salesman_id }}'>{{ $o->salesman_name }}</option>
                            @endforeach
                            @endif
                            @endif
                            </select>
                            <label>Salesman</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">date_range</i>
                            <input type="text" class="datepicker" name="start" id="start" placeholder="Start date" readonly="readonly">
                            <label>Start Date</label>
                        </div>
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">date_range</i>
                            <input type="text" class="datepicker" name="end" id="end" placeholder="End date" readonly="readonly">
                            <label>End Date</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">

                            <button class="btn waves-effect waves-light green darken-1" id="reset">Reset
                                <i class="material-icons right">refresh</i>
                            </button>
                            <button class="btn waves-effect waves-light blue darken-1" type="submit" name="action" id="find">Submit
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>
                </div>
              </div>
            </div>

            <div class="card " id="dua" style="display:none">
                <div id="preloader" style="display: none"></div>
                <div class="card-content">
                    <div class="card-title">
                        <div class="row">
                          <div class="col s12 m6 l10">
                            <h4 class="card-title">Here's your search result:</h4>
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                        <table id="example" class="striped" role="grid" style="width:100%">
                         <thead>
                            <tr>
                            <th>CustName</th>
                            <th>SalesName</th>
                            <th>SalesId</th>
                            <th>CustAddress</th>
                            <th>CustCity</th>
                            <th>DateVisit</th>
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
<div id="remarkModal" class="modal modal-fixed-footer">
    <div id="preloader2" style="display: none"></div>
	<div class="modal-content">
        <div id="remarkModalBody"></div>
        <div class="col s12">
            <ul class="collapsible collapsible-accordion" id="accord" style="display:none">
                <li>
                <div class="collapsible-header grey darken-2 white-text">
                    <i class="material-icons">collections_bookmark</i>
                    Click for open/close saved remark
                </div>
                <div class="collapsible-body">
                    <p id="content_remark"></p>
                </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="modal-footer">
        <a href="javascript:void(0)" class="modal-action modal-close btn waves-effect waves-light grey darken-3 ">
            Close
        </a>
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
{{-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6gwySuHGQeor31FQ04ZYmNRgofOxf2yA"></script> --}}
<script src="{{ asset('outside/material/vendors/select2/select2.full.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.4/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.4/js/responsive.bootstrap4.min.js"></script>
<script type="text/javascript">

function showMap(lat, lng){

    $.get('https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat='+lat+'&lon='+lng, function(data){
        
        var address = data.address.village +', '+ data.address.state_district +', '+ data.address.state;
        var container = L.DomUtil.get('map_canvas');
        if(container != null){
            container._leaflet_id = null;
        }

        var mymap = L.map('map_canvas').setView([lat, lng], 13);
        
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 18,
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1
        }).addTo(mymap);

        L.marker([lat, lng],
            {draggable: true,        // Make the icon dragable
            //title: 'Hover Text',     // Add a title
            opacity: 0.5}            // Adjust the opacity
            )
            .addTo(mymap)
            .bindPopup('<b>Your log location</b><br>'+address)
            .openPopup();

    });
}

$(document).ready(function() {

    var dua = document.getElementById("dua");
    var preloader = document.getElementById("preloader");
    var preloader2 = document.getElementById("preloader2")
    var accord = document.getElementById("accord");

    $(".modal").modal();

    $('.collapsible').collapsible({
        accordion:true
    });

    $('#salesid').select2({
    placeholder: "type sales name or leave it blank if you want to search all salesman",
    allowClear: true,
    minimumInputLength: 3
    });

    $('.datepicker').datepicker({
        format: 'yyyymmdd',
        autoClose: true,
        showClearBtn: true,
    });

    $('#SalesActivity').addClass('active open');
    $('#SalesActivityCSS').css('display','block');
    $('#ActivityReport').addClass('active gradient-45deg-green-teal gradient-shadow');


    $('#find').on('click', function(){

        var id =  $('#salesid').val();
        var dt_start =  $('#start').val();
        var dt_end =  $('#end').val();
        allreq = '';
        if ((dt_start == '' && dt_end == '') || (dt_start == null && dt_end == null)){

            swal({
            title: "Are you sure ?",
            text: "If you wanna search without adding date, it will searching whole data's and maybe will take a long time to be completed.",
            icon: "warning",
            buttons: true
            })
            .then((willGo) => {
                if (willGo) {

                    if (id != '' || id != null){
                        allreq = allreq+'&id='+id.trim();
                    }

                    dua.style.display = "block";
                    preloader.style.display = "block";
                    document.getElementById("find").disabled = true;

                    $('html, body').animate({
                        scrollTop: $("#dua").offset().top
                    }, 1200);

                    var dataTable = $('#example').DataTable({
                        "drawCallback": function( settings ) {
                            $('.tooltipped').tooltip();
                        },
                        destroy: true,
                        responsive: true,
                        processing: true,
                        serverSide: true,
                        autoWidth: false,
                        pageLength: 10,
                        ajax: {
                                'url':'{!!url("getActivityReport")!!}'+'?'+allreq,
                                'type': 'post',
                                'headers': {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            },
                        columns: [
                                // { data: 'checkbox', orderable:false, searchable:false},
                                { data: 'namacustomer', name: 'namacustomer' },
                                { data: 'salesman_name', name: 'salesman_name' },
                                { data: 'salesman_id', name: 'salesman_id' },
                                { data: 'alamat', name: 'alamat' },
                                { data: 'city', name: 'city' },
                                { data: 'tr_date', name: 'tr_date' },
                                { data: 'GPSLog & Remark', name: 'GPSLog & Remark',orderable:false,searchable:false}

                        ],
                        initComplete: function(settings, json) {
                            if (dataTable.rows().data().length) {

                                swal("Yay!", "Data loaded successfully", "success");
                                preloader.style.display = "none";
                                document.getElementById("find").disabled = false;

                            }
                            if (!dataTable.rows().data().length) {

                                swal("Oops! :(", "Data not available", "error");
                                preloader.style.display = "none";
                                document.getElementById("find").disabled = false;

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

            if (id != '' || id != null){
                allreq = allreq+'&id='+id.trim();
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

            dua.style.display = "block";
            preloader.style.display = "block";
            document.getElementById("find").disabled = true;

            $('html, body').animate({
                scrollTop: $("#dua").offset().top
            }, 1200);

            var dataTable = $('#example').DataTable({
            "drawCallback": function( settings ) {
                $('.tooltipped').tooltip();
            },
            destroy: true,
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            pageLength: 10,
            ajax: {
                    'url':'{!!url("getActivityReport")!!}'+'?'+allreq,
                    'type': 'post',
                    'headers': {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
            columns: [
                    // { data: 'checkbox', orderable:false, searchable:false},
                    { data: 'namacustomer', name: 'namacustomer' },
                    { data: 'salesman_name', name: 'salesman_name' },
                    { data: 'salesman_id', name: 'salesman_id' },
                    { data: 'alamat', name: 'alamat' },
                    { data: 'city', name: 'city' },
                    { data: 'tr_date', name: 'tr_date' },
                    { data: 'GPSLog & Remark', name: 'GPSLog & Remark',orderable:false,searchable:false}

            ],
            initComplete: function(settings, json) {
                if (dataTable.rows().data().length) {

                    swal("Yay!", "Data loaded successfully", "success");
                    preloader.style.display = "none";
                    document.getElementById("find").disabled = false;

                }
                if (!dataTable.rows().data().length) {

                    swal("Oops! :(", "Data not available", "error");
                    preloader.style.display = "none";
                    document.getElementById("find").disabled = false;

                }
            },
        });

        }
    });

//   var geocoder;
//   var map;
//   var infowindow = new google.maps.InfoWindow();
//   var marker;

//   function codeLatLng() {
//       var lat = document.getElementById('latitude').value;
//       var lng = document.getElementById('longitude').value;
//       var latlng = new google.maps.LatLng(lat, lng);
//       geocoder.geocode({ 'latLng': latlng }, function (results, status) {
//           if (status == google.maps.GeocoderStatus.OK && lat != "" && lng != "") {
//               if (results[1]) {
//                   map.setZoom(15);
//                   marker = new google.maps.Marker({
//                       position: latlng,
//                       map: map
//                   });
//                   infowindow.setContent(results[1].formatted_address);
//                   infowindow.open(map, marker);
//                 } else {
//                 swal("Oops","No results found","error");
//             }
//         } else {
//             swal("Oops","Geocoder failed due to: " + status, "error");
//           }
//       });
//     };

//     function initialize() {
//       geocoder = new google.maps.Geocoder();
//       var latlng = new google.maps.LatLng(-7.468026, 112.4408769);
//       var myOptions = {
//           zoom: 15,
//           center: latlng,
//           mapTypeId: 'roadmap'
//       }
//       map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
//     };

    var id;

    $('body').on('click', '#getRemark', function(e) {
    e.preventDefault();
    preloader2.style.display = "block";
          id = $(this).data('id');
          $.ajax({
              url: 'getRemarkAll/id='+id,
              method: 'GET',
                // data: {
                //     id: id,
                // },
              success: function(result) {
                console.log(result);
                // $('.collapsible').collapsible('open', 0);
                preloader2.style.display = "none";
                $('#remarkModalBody').html(result.html);
                var val_remark = document.getElementById('val_remark').value;
                $('#content_remark').text(val_remark);
                accord.style.display = "block";
                // initialize();
                // codeLatLng();
                //getLocation();
              }
          });
    });

    $('#reset').on('click', function() {

        @if(Session::get('GROUPID') != 'SALES')

            $('#salesid').val(null).trigger('change');
            $('#start').val('');
            $('#end').val('');
            dua.style.display="none";

        @endif

        @if(Session::get('GROUPID') == 'SALES')

            $('#start').val('');
            $('#end').val('');
            dua.style.display="none";

        @endif
    });



});




</script>

@endsection
