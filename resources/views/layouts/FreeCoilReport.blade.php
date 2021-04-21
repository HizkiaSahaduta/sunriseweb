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
               <h5 class="breadcrumbs-title mt-0 mb-0"><span>Free Coil Report</span></h5>
               <ol class="breadcrumbs mb-0">
                  {{-- <li class="breadcrumb-item ">
                     <a href="#">Home</a>
                  </li> --}}
                  <li class="breadcrumb-item ">
                     <a href="#">Production Report</a>
                  </li>
                  <li class="breadcrumb-item">
                     <a href="#">Free Coil Report</a>
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
                    Hello {{ Session::get('USERNAME') }}, here's Free Coil Report form. Have a good day :)
                  </p>
               </div>
            </div>

            <div class="card">
                <div class="card-content">

                    <div class="row">
                        <div class="input-field col m3 s12">
                            <i class="material-icons prefix">layers</i>
                            <select class="browser-default" id="commodity" name="commodity">
                            <option></option>
                            </select>
                            <label>Commodity</label>
                        </div>
                        <div class="input-field col m3 s12">
                            <i class="material-icons prefix">branding_watermark</i>
                            <select class="browser-default" id="brand" name="brand">
                            <option></option>
                            </select>
                            <label>Brand</label>
                        </div>
                        <div class="input-field col m3 s12">
                            <i class="material-icons prefix">line_weight</i>
                            <select class="browser-default" id="coat" name="coat">
                            <option></option>
                            </select>
                            <label>Coat (AS-AZ)</label>
                        </div>
                        <div class="input-field col m3 s12">
                            <i class="material-icons prefix">grade</i>
                            <select class="browser-default" id="grade" name="grade">
                            <option></option>
                            </select>
                            <label>Grade</label>
                        </div>
                    </div>
                    <div class="row">

                        <div class="input-field col m3 s12">
                            <i class="material-icons prefix">unfold_more</i>
                            <select class="browser-default" id="thick" name="thick">
                            <option></option>
                            </select>
                            <label><div id="thick_badge"></div>Thickness</label>
                        </div>
                        <div class="input-field col m3 s12">
                            <i class="material-icons prefix">swap_horiz</i>
                            <select class="browser-default" id="width" name="width" >
                            <option></option>
                            </select>
                            <label><div id="width_badge"></div>Width</label>
                        </div>

                        <div class="input-field col m3 s12">
                            <i class="material-icons prefix">color_lens</i>
                            <select class="browser-default" id="colour" name="colour">
                            <option></option>
                            </select>
                            <label><div id="colour_badge"></div>Colour</label>
                        </div>

                        <div class="input-field col m3 s12">
                            <i class="material-icons prefix">check_circle</i>
                            <select class="browser-default" id="quality" name="quality">
                            <option></option>
                            </select>
                            <label><div id="quality_badge"></div>Quality</label>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="input-field col m6 s12">
                            <label>Start Periode</label>
                            <input type="text" name="start" id="start" placeholder="Choose start periode date" readonly="readonly">
                            
                        </div>
                        <div class="input-field col m6 s12">
                            <label>End Periode</label>      
                            <input type="text" name="end" id="end" placeholder="Choose end periode date" readonly="readonly">     
                        </div>
                    </div> --}}
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

            <div class="card" id="divFreeCoilReport" style="display: none">
                <div class="card-content">
                    <div class="section users-view">
                        <div class="row indigo lighten-5">
                            <div class="col s12 m12 users-view-timeline">
                                {{-- <h6 class="indigo-text m-0">Query Result: </h6> --}}
                                <h6 class="indigo-text m-0">Summary :</h6> 
                                <blockquote id="TotalQty"></blockquote>
                                <blockquote id="TotalWeight"></blockquote>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col s12">
                                <table id="tblFreeCoilReport" class="striped" role="grid" style="width:100%">
                                    <thead>
                                    <tr>
                                    <th>Descr</th>
                                    <th>Commodity</th>
                                    <th>Brand</th>
                                    <th>Thickness</th>
                                    <th>Width</th>
                                    <th>Grade</th>
                                    <th>Coat Mass (AZ)</th>
                                    <th>Color</th>
                                    <th>Quality</th>
                                    <th>Total Weight (Ton)</th>
                                    <th>Qty</th>
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

var Qcommodity, Qbrand, Qcoat, Qgrade, Qthick, Qwidth, Qcolour, Qquality;


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

function listCommodity(){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "listCommodity",
        success: function (data) {
            $('select[name="commodity"]').empty();
            $('select[name="commodity"]').prepend('<option></option>');
            $('select[name="commodity"]').prepend('<option value = "All">ALL</option>');
            $.each(data, function(index, element) {
            if (element.commodity_id == "GLV") {

                $('select[name="commodity"]').append('<option value="'+element.commodity_id+'">FULL WIDTH</option>');

            }

            else {

                $('select[name="commodity"]').append('<option value="'+element.commodity_id+'">SLITTED</option>');


            }
            
            });
        }
    });

    $('#commodity').select2({
        placeholder: 'Choose commodity below',
        allowClear: true
    });

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


$(document).ready(function() {

    $('#ProductionReport').addClass('active open');
    $('#ProductionReportCSS').css('display','block');
    $('#FreeCoilReport').addClass('active gradient-45deg-green-teal gradient-shadow');

    listCommodity();listBrand();listCoat();
    listGrade();allThickness();allWidth();allColour();allQuality();

    var divFreeCoilReport = document.getElementById("divFreeCoilReport")

    var commodity = "All";

    html1 = "<span class='new badge green' data-badge-caption='bound'>"+commodity+"</span>";
    $('#thick_badge').empty();
    $('#thick_badge').append(html1);

    html2 = "<span class='new badge green' data-badge-caption='bound'>"+commodity+"</span>";
    $('#width_badge').empty();
    $('#width_badge').append(html2);

    commodityThickness(commodity);
    commodityWidth(commodity);

    // var f1 = flatpickr(document.getElementById('start'), {
    //     static: true,
    //     altInput: true,
    //     plugins: [new monthSelectPlugin({shorthand: false, dateFormat: "Ym", altFormat: "Ym"})],
    //     disableMobile: "true",
    // });

    // var f2 = flatpickr(document.getElementById('end'), {
    //     static: true,
    //     altInput: true,
    //     plugins: [new monthSelectPlugin({shorthand: false, dateFormat: "Ym", altFormat: "Ym"})],
    //     disableMobile: "true",
    // });

    $('#commodity').change(function(){

        var commodity = $('#commodity').val();
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

    $('#brand').change(function(){

        var commodity = $('#commodity').val();
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

        var commodity = $('#commodity').val();
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

        var commodity = $('#commodity').val();
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

        var commodity = $('#commodity').val();
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

        var commodity = $('#commodity').val();
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

        var commodity = $('#commodity').val();
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

        $('#commodity').val(null).trigger('change');
        $('#quality').val(null).trigger('change');
        $('#brand').val(null).trigger('change');
        $('#coat').val(null).trigger('change');
        $('#grade').val(null).trigger('change');
        $('#thick').val(null).trigger('change');
        $('#width').val(null).trigger('change');
        $('#colour').val(null).trigger('change');
        // f1.clear();
        // f2.clear();
        divFreeCoilReport.style.display = "none";

    });

    $('#go').on('click', function() {

        blockUI();

        Qcommodity = $('#commodity').val();
        Qbrand = $('#brand').val();
        Qcoat = $('#coat').val();
        Qgrade = $('#grade').val();
        Qthick = $('#thick').val();
        Qwidth = $('#width').val();
        Qcolour = $('#colour').val();
        Qquality =  $('#quality').val();

        var dataTable = $('#tblFreeCoilReport').DataTable({
            destroy: true,
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            pageLength: 5,
            ajax: {
                'url':'{!!url("getFreeCoilReport")!!}',
                'type': 'post',
                data: {
                        '_token': '{{ csrf_token() }}',
                        'commodity' : Qcommodity,
                        'brand': Qbrand,
                        'coat': Qcoat, 
                        'grade': Qgrade, 
                        'thick': Qthick,
                        'width': Qwidth ,
                        'colour': Qcolour,
                        'quality': Qquality 
                    }
            },
            columns: [

                    { data: 'descr', name: 'descr' },
                    { data: 'commodity_id', name: 'commodity_id' },
                    { data: 'brand_desc', name: 'brand_desc' },
                    { data: 'thick', name: 'thick', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                    { data: 'width', name: 'width' , render: $.fn.dataTable.render.number(',', '.', 2, '')},
                    { data: 'grade_id', name: 'grade_id' },
                    { data: 'AZ', name: 'AZ' },
                    { data: 'color', name: 'color' },
                    { data: 'quality_id', name: 'quality_id' },
                    { data: 'total_wgt', name: 'total_wgt', render: $.fn.dataTable.render.number(',', '.', 2, '')},
                    { data: 'qty', name: 'qty' }

            ],
            initComplete: function(settings, json) {
                if (dataTable.rows().data().length) {

                    $.unblockUI();
                    divFreeCoilReport.style.display = "block";
                    $('#TotalQty').text('Total Quantity: '+json.total_qty+" item")
                    $('#TotalWeight').text('Total Weight: '+json.total_weight+" TON")
                    $('html, body').animate({
                        scrollTop: $("#divFreeCoilReport").offset().top
                    }, 1200)

                }
                if (!dataTable.rows().data().length) {

                    $.unblockUI();
                    swal("Oops! :(", "Data not available", "error");
                    divFreeCoilReport.style.display = "block";
                    $('#TotalQty').text('Total Quantity: 0 item')
                    $('#TotalWeight').text('Total Weight: 0 TON')
                    $('html, body').animate({
                        scrollTop: $("#divFreeCoilReport").offset().top
                    }, 1200)

                }
            },
        });





        
       
    }); 


    
    
   
    



    




});



</script>

@endsection
