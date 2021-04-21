@extends('main')

@section('contentcss')
<link rel="stylesheet" type="text/css" href="{{ asset('outside/material/vendors/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('outside/material/vendors/select2/select2-materialize.css') }}">
<style>

hr.style {
  border-top: 1px dashed #888ea8;
}

.tabs {
    position: relative;
    overflow-x: auto;
    overflow-y: hidden;
    height: 63px;
    width: 100%;
    background-color: #fff;
    margin: 0 auto;
    white-space: nowrap;
}

span.badge.new {
    font-weight: 300;
    font-size: .5rem;
    color: #fff;
    background-color: #ff4081;
    border-radius: 2px;
}

span.badge {
    min-width: .5rem;
    padding: 0 6px;
    margin-left: 5px;
    text-align: center;
    font-size: 1rem;
    line-height: 22px;
    height: 20px;
    color: #757575;
    float: right;
    box-sizing: border-box;
    margin-top: 12px;
}

.material-icons {
    font-size: 15px;
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
               <h5 class="breadcrumbs-title mt-0 mb-0"><span>Block Schedule</span></h5>
               <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item ">
                     <a href="#">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item ">
                     <a href="#">Block Schedule</a>
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
                    <h5 style="font-weight: 900;">CGL1
                    
                        {{-- <a class="btn mb-1 waves-effect waves-light green darken-1 modal-trigger" href="#modal">
                            <i class="material-icons">search</i> Order ID
                        </a> --}}

                        <div class="chip">
                            <a class="modal-trigger" href="#modal">
                                <i class="material-icons">search</i> Order ID
                            </a>
                        </div>
                    
                    </h5>

                    <div class="row indigo lighten-5" id="header1">
                        <div class="col s12 m12 users-view-timeline">
                            <h6 class="indigo-text m-0">Pls wait...</h6>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col s12">
                            <ul class="tabs tab-demo-active z-depth-1" id="listStep1">
                                <li class="tab"><a href="#plswait1" class="active">Pls wait..</a></li>
                            </ul>
                        </div>

                        <div class="col s12" id="detailStep1">

                            <div id="plswait1" class="col s12">
        
                                <blockquote>
                                Pls wait..
                                </blockquote> 
                        
                            </div>

                        </div>  
                    </div>
                  
                </div>
            </div>

            <div class="card">
                <div class="card-content">
                    <h5 style="font-weight: 900;">CGL2</h5>

                    <div class="row indigo lighten-5" id="header2">
                        <div class="col s12 m12 users-view-timeline">
                            <h6 class="indigo-text m-0">Pls wait...</h6>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col s12">
                            <ul class="tabs tab-demo-active z-depth-1" id="listStep2">

                                <li class="tab"><a href="#plswait2" class="active">Pls wait..</a></li>
                               
                            </ul>
                        </div>

                        <div class="col s12" id="detailStep2">

                            <div id="plswait2" class="col s12">
        
                                <blockquote>
                                Pls wait..
                                </blockquote> 
                        
                            </div>


                        </div>  
                    </div>
                  
                </div>
            </div>
        </div>
    </div>

    <div id="modal" class="modal">
        <div class="modal-content">
            <h5>Form Search</h5>
            <p>by Order ID</p>

            <div class="row">
                <div class="input-field col m12 s12">
                    <i class="material-icons prefix">layers</i>
                    <input type="text" id="orderid" name="orderid" placeholder="OrderID goes here"/>
                    <label>OrderID</label>
                </div>
            </div>

          
        </div>
        <div class="modal-footer">
            <button class="btn waves-effect waves-light blue darken-1" id="GoCGL">Apply
                <i class="material-icons right">check</i>
            </button>
            <button class="btn waves-effect waves-light green darken-1" id="ResetForm">Reset
                <i class="material-icons right">all_inclusive</i>
            </button>
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close<i class="material-icons right">close</i></a>
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

function load () {

    // blockUI();

    $.ajax({
        type: "post",
        url: "{{ url('getBlockSchedule') }}",
        data: {
            '_token': '{{ csrf_token() }}'
        },
        success: function(data) {


            $('#header1').html(data['header1']);
            $('#listStep1').html(data['listStep1']);
            $('#detailStep1').html(data['detailStep1']);
            $('#header2').html(data['header2']);
            $('#listStep2').html(data['listStep2']);
            $('#detailStep2').html(data['detailStep2']);


        }

          
    });
}

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


$(document).ready(function() {

    $('#Dashboard').addClass('active open');
    $('#DashboardCSS').css('display','block');
    $('#BlockSchedule').addClass('active gradient-45deg-green-teal gradient-shadow');

    
    $('.modal').modal();
    load();

    $('body').on('click', '.detailStep1', function(e) {
        
        e.preventDefault();
        var sched_id_1 = $(this).data('id1');
        var stepnum1 = $(this).data('id2');

        blockUI();

        $.ajax({
            type: "POST",
            url: "{{ url('getBlockScheduleDetail1') }}",
            data: {
                '_token': '{{ csrf_token() }}',
                'sched_id_1': sched_id_1,
                'stepnum1': stepnum1
            },
            success: function(data) {

                $.unblockUI();

                if (Object.keys(data).length > 0) { 

                    $.unblockUI();
                    $('#detailStep1').html(data['detailStep1']);

                }

                else {

                    $.unblockUI();
                    swal("Whops", "Detail for STEPNum "+stepnum1+ " not found","error")


                }

            }

                
            });

    });

    $('body').on('click', '.detailStep2', function(e) {
        
        e.preventDefault();
        var sched_id_2 = $(this).data('id1');
        var stepnum2 = $(this).data('id2');
        
        blockUI();

        $.ajax({
            type: "POST",
            url: "{{ url('getBlockScheduleDetail2') }}",
            data: {
                '_token': '{{ csrf_token() }}',
                'sched_id_2': sched_id_2,
                'stepnum2': stepnum2
            },
            success: function(data) {

                if (Object.keys(data).length > 0) { 

                    $.unblockUI();
                    $('#detailStep2').html(data['detailStep2']);

                }

                else {

                    $.unblockUI();
                    swal("Whops", "Detail for STEPNum "+stepnum2+ " not found","error")

                }

            }

            
        });

    });

    $('#GoCGL').on('click', function() {

        var orderid = $('#orderid').val();

        if (!orderid) {

            swal("Whops", "OrderID not entered yet", "error")

        }

        else {

            blockUI();

            $.ajax({
                type: "post",
                url: "{{ url('getBlockSchedule') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'orderid': orderid
                },
                success: function(data) {


                    if (Object.keys(data).length > 0) { 

                        $.unblockUI();

                        if (data['foundInfo'] == "CGL1CGL2") {
                            
                            $('#modal').modal('close');
                            swal("Found in CGL1 & CGL2", orderid+" found in StepNum(CGL1):"+data['listFound1']+", also found in StepNum(CGL2):"+data['listFound2'], "success")
                            $('#header1').html(data['header1']);
                            $('#listStep1').html(data['listStep1']);
                            $('#detailStep1').html(data['detailStep1']);
                            $('#headerQuery1').html(data['headerFound1']);

                            $('#header2').html(data['header2']);
                            $('#listStep2').html(data['listStep2']);
                            $('#detailStep2').html(data['detailStep2']);
                            $('#headerQuery2').html(data['headerFound2']);

                        }

                        if (data['foundInfo'] == "CGL1") {

                            $('#modal').modal('close');
                            swal("Found in CGL1", orderid+" found in StepNum:"+data['listFound1'], "success")
                            $('#header1').html(data['header1']);
                            $('#listStep1').html(data['listStep1']);
                            $('#detailStep1').html(data['detailStep1']);
                            $('#headerQuery1').html(data['headerFound1']);

                        }

                        if (data['foundInfo'] == "CGL2") {

                            $('#modal').modal('close');
                            swal("Found in CGL2", orderid+" found in StepNum:"+data['listFound2'], "success")
                            $('#header2').html(data['header2']);
                            $('#listStep2').html(data['listStep2']);
                            $('#detailStep2').html(data['detailStep2']);
                            $('#headerQuery2').html(data['headerFound2']);

                        }

                        if (data['foundInfo'] == "N/A") {
                            
                            $('#modal').modal('close');
                            swal("Whops", orderid1+ "not found!", "error")

                        }


                    }

                    else {

                        $.unblockUI();
                        $('#modal').modal('close');
                        swal("Whops", orderid1+ "not found!", "error")
                       

                    }


                }

            });

        }

        
    });


    $('#ResetForm').on('click', function() {

        blockUI();

        $.ajax({
            type: "post",
            url: "{{ url('getBlockSchedule') }}",
            data: {
                '_token': '{{ csrf_token() }}'
            },
            success: function(data) {


                $('#header1').html(data['header1']);
                $('#listStep1').html(data['listStep1']);
                $('#detailStep1').html(data['detailStep1']);
                $('#header2').html(data['header2']);
                $('#listStep2').html(data['listStep2']);
                $('#detailStep2').html(data['detailStep2']);

                $.unblockUI();
                $('#modal').modal('close');


            }

            
        });


    });

    


});



</script>

@endsection
