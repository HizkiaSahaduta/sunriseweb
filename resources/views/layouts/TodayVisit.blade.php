@extends('main')

@section('contentcss')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.4/css/responsive.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="{{ asset('outside/material/css/pages/page-404.css') }}">
<style>
.dataTables_wrapper {
    font-family: muli;
    font-size: 14px;
    position: relative;
    clear: both;
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
      <div class="container" id="bread" style="display:none">
         <div class="row">
            <div class="col s10 m6 l6">
               <h5 class="breadcrumbs-title mt-0 mb-0"><span>Today Visit </span></h5>
               <ol class="breadcrumbs mb-0">
                  {{-- <li class="breadcrumb-item ">
                     <a href="#">Home</a>
                  </li> --}}
                  <li class="breadcrumb-item ">
                     <a href="#">Sales Activity</a>
                  </li>
                  <li class="breadcrumb-item">
                     <a href="#">Today Visit</a>
                  </li>
               </ol>
            </div>
         </div>
      </div>

      <div class="container" id="error" style="display:none">
        <!--  main content -->
        <div class="section section-404 p-0 m-0 height-100vh">
            <div class="row">
        <!-- 404 -->
            <div class="col s12 center-align white">
                <h1 class="error-code m-0">404</h1>
                <h6 class="mb-2">Nothing to do here</h6>
                <img src="{{ asset('outside/material/images/gallery/error-2.png') }}" class="bg-image-404" alt="">
                </div>
            </div>
        </div>
       </div>

   </div>
<!-- End: Breadcrumb-->

   <div class="col s12">
      <div class="container">
         <div class="section">


            <div class="card" id="satu" style="display:none">
               <div class="card-content">
                  <p class="caption mb-0">
                    Hello {{ Session::get('USERNAME') }}, here is your visting report today. Have a good day :)
                  </p>
               </div>
            </div>

            <div class="card" id="dua" style="display:none">
                <div class="card-content">
                 <div class="row">
                    <div class="col s12">
                     <table id="example" class="striped" role="grid" style="width:100%">
                      <thead>
                       <tr>
                        <th>CustName</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Date</th>
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
<input type = "hidden" value="{{ Session::get('SALESID') }}" id="salesid">
<div id="remarkModal" class="modal modal-fixed-footer">
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
        <a href="#!" class="modal-action modal-close btn waves-effect waves-light grey darken-3">
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

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6gwySuHGQeor31FQ04ZYmNRgofOxf2yA&callback=initMap"></script>
<script src="{{ asset('outside/material/vendors/select2/select2.full.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.4/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.4/js/responsive.bootstrap4.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {

    var bread = document.getElementById("bread");
    var error = document.getElementById("error");
    var satu = document.getElementById("satu");
    var dua = document.getElementById("dua");
    var accord = document.getElementById("accord");

    $(".modal").modal();

    $('.collapsible').collapsible({
        accordion:true
    });


    $('#SalesActivity').addClass('active open');
    $('#SalesActivityCSS').css('display','block');
    $('#TodayVisit').addClass('active gradient-45deg-green-teal gradient-shadow');


    var salesid = $( "#salesid" ).val();

    if (salesid == '' || salesid == null){

    swal("Oops", "You dont have SALESID", "error");
    error.style.display = "block";

    }
        else {
            var dataTable = $('#example').DataTable({
            destroy: true,
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            pageLength: 10,
            // scrollX: true,
            "order": [[ 0, "desc" ]],
            ajax: 'getTodayVisit/id=' +salesid,
            columns: [
                    // { data: 'checkbox', orderable:false, searchable:false},
                    { data: 'namacustomer', name: 'namacustomer' },
                    { data: 'alamat', name: 'alamat' },
                    { data: 'city', name: 'city' },
                    { data: 'tr_date', name: 'tr_date' },
                    { data: 'Detail', name: 'Detail',orderable:false,searchable:false}

                ],
                initComplete: function(settings, json) {
                if (dataTable.rows().data().length) {
                    // alert('Data not empty');
                    bread.style.display = "block";
                    satu.style.display = "block";
                    swal("Yay!", "You've visited the customer today", "success");
                    dua.style.display = "block";

                    }
                if (!dataTable.rows().data().length) {
                    // alert('Data empty');
                    //document.getElementById("send_all").disabled = false;
                    bread.style.display = "block";
                    satu.style.display = "block";
                    swal("Oops!", "You haven't visit any customer today", "error");
                    dua.style.display = "block";
                }
                },
        });
    }

    var geocoder;
    var map;
    var infowindow = new google.maps.InfoWindow();
    var marker;

    function codeLatLng() {
        var lat = document.getElementById('latitude').value;
        var lng = document.getElementById('longitude').value;
        var latlng = new google.maps.LatLng(lat, lng);
        geocoder.geocode({ 'latLng': latlng }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK && lat != "" && lng != "") {
                if (results[1]) {
                    map.setZoom(15);
                    marker = new google.maps.Marker({
                        position: latlng,
                        map: map
                    });
                    infowindow.setContent(results[1].formatted_address);
                    infowindow.open(map, marker);
                } else {
                swal("Oops","No results found","error");
            }
        } else {
            swal("Oops","Geocoder failed due to: " + status, "error");
            }
        });
    };

    function initialize() {
        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(-7.468026, 112.4408769);
        var myOptions = {
            zoom: 15,
            center: latlng,
            mapTypeId: 'roadmap'
        }
        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    };

    var id;
    $('body').on('click', '#getRemark', function(e) {
    e.preventDefault();
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            id = $(this).data('id');
            $.ajax({
                url: 'getRemark/id='+id,
                method: 'GET',
                // data: {
                //     id: id,
                // },
                success: function(result) {
                console.log(result);
                // $('.collapsible').collapsible('open', 0);
                $('#remarkModalBody').html(result.html);
                var val_remark = document.getElementById('val_remark').value;
                $('#content_remark').text(val_remark);
                accord.style.display = "block";
                initialize();
                codeLatLng();
                }
            });
    });



});




</script>

@endsection
