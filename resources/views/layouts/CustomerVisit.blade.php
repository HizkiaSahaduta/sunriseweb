@extends('main')

@section('contentcss')
<link rel="stylesheet" type="text/css" href="{{ asset('outside/material/vendors/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('outside/material/vendors/select2/select2-materialize.css') }}">

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
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
               <h5 class="breadcrumbs-title mt-0 mb-0"><span>Customer Visit</span></h5>
               <ol class="breadcrumbs mb-0">
                  {{-- <li class="breadcrumb-item ">
                     <a href="#">Home</a>
                  </li> --}}
                  <li class="breadcrumb-item ">
                     <a href="#">Sales Activity</a>
                  </li>
                  <li class="breadcrumb-item">
                     <a href="#">Customer Visit</a>
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
                    Hello {{ Session::get('USERNAME') }}, here is a form to fill in the customer data that you've visited. Have a good day :)
                  </p>
               </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <div class="card-tabs">
                        <ul class="tabs tabs-fixed-width">
                          <li class="tab"><a href="#isi" id="existing"><span>Existing</span></a></li>
                          <li class="tab"><a href="#isi" id="newcust"><span>New</span></a></li>
                        </ul>
                    </div>
                    <div class="card-content">
                        <div class="row" id="sel_cust">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">search</i>
                                <select class="browser-default"id="search_cust" name="search_cust"></select>
                                <label>Find Customer</label>
                            </div>
                        </div>
                        <form action="{{ url('storeActivity') }}" method="POST">
                        <div class="row">
                            <div class="input-field col m6 s12" id="input_id">
                                <i class="material-icons prefix">assignment_ind</i>
                                <input type="text" id="customerid" name="customerid" placeholder="Customer ID goes here" disabled/>
                                <label>Customer ID</label>
                            </div>
                            <div class="input-field col m6 s12" id="input_name">
                                <i class="material-icons prefix">person_pin</i>
                                <input type="text" id="customername" name="customername" placeholder="Customer Name goes here" disabled/>
                                <label>Customer Name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col m6 s12">
                                <i class="material-icons prefix">business</i>
                                <input type="text" id="customeraddress" name="customeraddress" placeholder="Customer Address goes here" disabled/>
                                <label>Customer Address</label>
                            </div>
                            <div class="input-field col m6 s12">
                                <i class="material-icons prefix">location_city</i>
                                <input type="text" id="customercity" name="customercity" placeholder="City goes here" disabled/>
                                <label>City</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">edit</i>
                                <textarea id="remark" name="remark" class="materialize-textarea" placeholder="Remark goes here"></textarea>
                                <label>Remark</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col m6 s12">
                                <i class="material-icons prefix">pin_drop</i>
                                <input type="text" id="Longitude" name="Longitude" placeholder="Longitude goes here" disabled />
                                <label>Longitude</label>
                            </div>
                            <div class="input-field col m6 s12">
                                <i class="material-icons prefix">pin_drop</i>
                                <input type="text" id="Latitude" name="Latitude" placeholder="Latitude goes here" disabled />
                                <label>Latitude</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">person_pin_circle</i>
                                <input type="text" id="Address" name="Address" placeholder="Current Address goes here" disabled />
                                <label>Current Address</label>
                            </div>
                        </div>
                        <div class="row" id="map" style="display:none">
                            <div class="input-field col s12">
                                <div id="map_canvas" style="height:300px; border: 1px solid black;"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <button class="mb-2 mr-2 waves-effect waves-light btn green darken-1  btn-block" type="button" value="Get Current Location" onclick="getLocation()" >Get Current Location</button>
                                <p></p>
                                <button type="submit" class="mb-2 mr-2 waves-effect waves-light btn green darken-1  btn-block" id="submitform" name="submitform" >Submit</button>
                                <p></p>
                            </div>
                        </div>
                        </form>
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

@if(\Session::has('alert'))
<script>
    var error = "{{ Session::get('alert') }}"
    swal("Error", error, "error");
</script>
@endif

{{-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6gwySuHGQeor31FQ04ZYmNRgofOxf2yA&callback=initMap"></script> --}}
<script src="{{ asset('outside/material/vendors/select2/select2.full.min.js') }}"></script>
<script type="text/javascript">

$(document).ready(function() {

    $('#SalesActivity').addClass('active open');
    $('#SalesActivityCSS').css('display','block');
    $('#CustomerVisit').addClass('active gradient-45deg-green-teal gradient-shadow');

    //autocomplete
    $('#search_cust').select2({
      placeholder: "type any existing custid or custname . . .",
      allowClear: true,
		  minimumInputLength: 3,
        ajax: {
            url: "{{url('autocompletecustomer')}}",
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
            return {
                results:  $.map(data, function (item) {
                return {
                    text: item.cust_id + " || " + item.cust_name + " (" + item.address1 + ", " + item.city + ")" ,
                    id: item.cust_id,
                }
                })
            };

            },
            cache: true
        }
    });

    //on change select
    $('#search_cust').change(function(){
      var id = $( "#search_cust" ).val();

      $.ajax({
          url: "getCustDetails/id="+id,
          type: "Get",
          dataType: 'json',
          success: function(data){
            $('#customerid').val(data.cust_id);
            $('#customername').val(data.cust_name);
            document.getElementById("customername").disabled = true;
            $('#customeraddress').val(data.address1);
            document.getElementById("customeraddress").disabled = true;
            $('#customercity').val(data.city);
            document.getElementById("customercity").disabled = true;
          }
      });
    });

  //tab existing customer
    $('#existing').on('click', function() {
        $("#sel_cust").show();
        $('#customerid').val('');
        document.getElementById("customerid").disabled = true;
        $('#customername').val('');
        document.getElementById("customername").disabled = true;
        $('#customeraddress').val('');
        document.getElementById("customeraddress").disabled = true;
        $('#customercity').val('');
        document.getElementById("customercity").disabled = true;
        $('#remark').val('');
        $('#Longitude').val('');
        $('#Latitude').val('');
        $('#Address').val('');
        $('#map').hide();
        $('#input_id').show();
        var input_name = document.getElementById("input_name");
        input_name.classList.add("m6");
        var newcust = document.getElementById("newcust");
        newcust.classList.remove("active");
        var existing = document.getElementById("existing");
        existing.classList.add("active");
    });

  //tab add new customer
    $('#newcust').on('click', function() {
        $("#sel_cust").hide();
        $('#customerid').val('');
        $('#customername').val('');
        document.getElementById("customername").disabled = false;
        $('#customeraddress').val('');
        document.getElementById("customeraddress").disabled = false;
        $('#customercity').val('');
        document.getElementById("customercity").disabled = false;
        $('#remark').val('');
        $('#Longitude').val('');
        $('#Latitude').val('');
        $('#Address').val('');
        $('#map').hide();
        $('#input_id').hide();
        var input_name = document.getElementById("input_name");
        input_name.classList.remove("m6");
        var existing = document.getElementById("existing");
        existing.classList.remove("active");
        var newcust = document.getElementById("newcust");
        newcust.classList.add("active");
    });


    //submit form
    $('#submitform').on('click', function() {
      /* stop form from submitting normally */
      event.preventDefault();
      //var customerid = $('#customerid').val();
      var customername = $('#customername').val();
      var customeraddress = $('#customeraddress').val();
      var customercity = $('#customercity').val();
      var Longitude = $('#Longitude').val();
      var Latitude = $('#Latitude').val();
      var Address = $('#Address').val();

        if (customername == '' || customeraddress == '' || customercity == '' || Longitude == '' || Latitude == '' || Address == '')
        {
            swal('Oops!','Make sure required field is filled, including GPS location!','error');
        }

        else {

            $.ajax({
                type:"POST",
                url:"{{ url('storeActivity') }}",
                data:{
                '_token': '{{ csrf_token() }}',
                'customerid': $('#customerid').val(),
                'customername': $('#customername').val(),
                'customeraddress': $('#customeraddress').val(),
                'customercity': $('#customercity').val(),
                'remark': $('#remark').val(),
                'Longitude': $('#Longitude').val(),
                'Latitude': $('#Latitude').val(),
                'Address': $('#Address').val()
                },
                success:function(data){
                window.location.href = "{{ url('TodayVisit') }}";
                }
            });
        }
        });
    });

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else { 
            swal("Whops", "Geolocation is not supported by this browser.", "error")
        }
    }

    function showPosition(position) {

        $.get('https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat='+position.coords.latitude+'&lon='+position.coords.longitude, function(data){
            
            var address = data.address.village +', '+ data.address.state_district +', '+ data.address.state;
            document.getElementById('Address').value = address;
        

            document.getElementById('Longitude').value = position.coords.longitude ;
            document.getElementById('Latitude').value = position.coords.latitude;

            var container = L.DomUtil.get('map_canvas');
            if(container != null){
                container._leaflet_id = null;
            }
    
            var mymap = L.map('map_canvas').setView([position.coords.latitude, position.coords.longitude], 13);
            
            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                maxZoom: 18,
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1
            }).addTo(mymap);

            L.marker([position.coords.latitude, position.coords.longitude],
                {draggable: true,        // Make the icon dragable
                //title: 'Hover Text',     // Add a title
                opacity: 0.5}            // Adjust the opacity
                )
                .addTo(mymap)
                .bindPopup('<b>Your current location</b><br>'+address)
                .openPopup();

        });
        map.style.display = "block";
    }

    // Get Long Lat
    // var geocoder;
    // var map;
    // var infowindow = new google.maps.InfoWindow();
    // var marker;

    // function codeLatLng() {
    //     var lat = document.getElementById('Latitude').value;
    //     var lng = document.getElementById('Longitude').value;
    //     var latlng = new google.maps.LatLng(lat, lng);
    //     geocoder.geocode({ 'latLng': latlng }, function (results, status) {
    //         if (status == google.maps.GeocoderStatus.OK && lat != "" && lng != "") {
    //             if (results[1]) {
    //                 map.setZoom(15);
    //                 marker = new google.maps.Marker({
    //                     position: latlng,
    //                     map: map
    //                 });
    //                 var address = (results[1].formatted_address);
    //                 document.getElementById('Address').value = results[1].formatted_address;
    //                 infowindow.setContent(results[1].formatted_address);


    //                 infowindow.open(map, marker);
    //             } else {
    //                 swal("Oops","No results found","error");
    //             }
    //         } else {
    //             swal("Oops","Geocoder failed due to: " + status, "error");
    //         }
    //     });
    // };

    // function getLoc(){
    // initGeolocation();
    // initialize();
    // }

    // function initGeolocation()
    // {
    // if( navigator.geolocation )
    // {
    //     navigator.geolocation.getCurrentPosition( success, fail );
    // }
    // else
    // {
    //     swal("Oops","Your browser does not support geolocation services","error");
    // };
    // };

    // function success(position)
    // {
    //     document.getElementById('Longitude').value = position.coords.longitude ;
    //     document.getElementById('Latitude').value = position.coords.latitude;
    //     var map = document.getElementById("map");
    //     map.style.display = "block";
    //     codeLatLng();
    // };

    // function fail(position)
    // {
    //     // Could not obtain location
    //     swal("Oops","Aktifkan GPS dan Mohon Izinkan Permintaan Lokasi","error");
    //     window.close();
    // };

    // function initialize() {
    //     geocoder = new google.maps.Geocoder();
    //     var latlng = new google.maps.LatLng(-7.468026, 112.4408769);
    //     var myOptions = {
    //         zoom: 15,
    //         center: latlng,
    //         mapTypeId: 'roadmap'
    //     }
    //     map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    // };

</script>


@endsection
