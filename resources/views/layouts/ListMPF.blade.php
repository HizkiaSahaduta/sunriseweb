@extends('main')

@section('contentcss')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.4/css/responsive.dataTables.min.css" />

<style>

#contact-us .app-wrapper .sidenav{width:340px;padding:2rem}#contact-us .app-wrapper .contact-header{margin-top:-0.5rem}#contact-us .app-wrapper .contact-header .contact-us .social-icons i{font-size:1.3rem;margin-top:1rem;margin-bottom:1rem}#contact-us .app-wrapper .contact-header .contact-us i{font-size:1.9rem}#contact-us .app-wrapper .contact-header .contact-us .form-header{padding:1.88rem;border-radius:.5rem .5rem 0 0;background-color:#d7e0e8}#contact-us .app-wrapper .contact-header .contact-us .form-header i{font-size:3.5rem;margin-right:1rem;vertical-align:middle}#contact-us .app-wrapper .contact-sidenav .contact-left{margin-top:2rem}#contact-us .app-wrapper .contact-sidenav .sidenav-trigger{position:absolute;top:6.5rem;left:1rem}#contact-us .app-wrapper .contact-sidenav .line-height{line-height:1.6rem!important}#contact-us .app-wrapper .contact-sidenav hr{border:0;border-top:1px solid #cfd8dc}#contact-us .app-wrapper .contact-sidenav textarea.materialize-textarea{height:12rem}#contact-us .app-wrapper .contact-sidenav .contact-form{padding:3rem;background-color:#fff;box-shadow:-3px 0 10px 0 #eceff1}#contact-us .app-wrapper .contact-sidenav .contact-form .btn{float:right}#contact-us .app-wrapper .contact-sidenav .contact-form .input-field{overflow:visible!important}#contact-us .app-wrapper .contact-sidenav .contact-form .input-field input,#contact-us .app-wrapper .contact-sidenav .contact-form .input-field textarea{margin-top:.4rem;padding-left:1rem;border:none;border-radius:.3rem;background-color:#eceff1}#contact-us .app-wrapper .contact-sidenav .contact-form .input-field label{width:auto;margin-left:1rem}#contact-us .app-wrapper .contact-sidenav .contact-form .input-field label .active{color:#eceff1!important}.horizontal-layout #main .row .content-wrapper-before{top:128px}.page-header-dark #contact-us .contact-sidenav .sidebar .sidenav-trigger i.material-icons,.page-header-dark #contact-us .contact-us .sidebar-title,.page-header-dark #contact-us .contact-us .sidebar-title h5{color:#fff}@media (min-width:993px){#contact-us .app-sidebar{-webkit-transform:none!important;-ms-transform:none!important;transform:none!important}}@media (max-width:998px){#contact-us .app-wrapper .contact-header{margin-top:1.3rem}#contact-us .app-wrapper .contact-header h5{margin-bottom:1rem!important;margin-left:2rem!important}#contact-us .app-wrapper .contact-header i{margin-top:.1rem}}@media (max-width:600px){#contact-us .sidenav-trigger.hide-on-large-only i.material-icons{position:relative;top:-.5rem}#contact-us .app-wrapper .contact-sidenav .sidenav-trigger{top:6rem}}


.dropify-wrapper {
    display: block;
    position: relative;
    cursor: pointer;
    overflow: hidden;
    margin-left: 40px;
    margin-top: -38px;
    width: 98%;
    /* max-width: 100%; */
    height: 200px;
    padding: 5px 10px;
    font-size: 14px;
    line-height: 22px;
    color: #777;
    background-color: #fff;
    background-image: none;
    text-align: center;
    border: 2px solid #E5E5E5;
    -webkit-transition: border-color .15s linear;
    transition: border-color .15s linear;
}

@media (max-width: 991px) {

    .dropify-wrapper {
        display: block;
        position: relative;
        cursor: pointer;
        overflow: hidden;
        margin-left: 40px;
        margin-top: -38px;
        width: 85%;
        /* max-width: 100%; */
        height: 200px;
        padding: 5px 10px;
        font-size: 14px;
        line-height: 22px;
        color: #777;
        background-color: #fff;
        background-image: none;
        text-align: center;
        border: 2px solid #E5E5E5;
        -webkit-transition: border-color .15s linear;
        transition: border-color .15s linear;
    }

    h6 {
        font-size: 1.15rem;
        margin: .575rem 0 .46rem;
        font-size: 11px;
    }

    .chip {
        display: inline-block;
        height: 30px;
        font-size: 11px;
        font-weight: 500;
        color: rgba(0,0,0,.6);
        line-height: 30px;
        padding: 0 7px;
        border-radius: 16px;
        background-color: #e4e4e4;
        margin-bottom: 4px;
        margin-right: 4px;
    }

    h5 {
        line-height: 110%;
        font-size: 13px;
    }

    html {
        font-size: 12px;
    }

    .btn, .btn-large, .btn-small {
        text-decoration: none;
        color: #fff;
        background-color: #ff4081;
        text-align: center;
        letter-spacing: .5px;
        -webkit-transition: background-color .2s ease-out;
        transition: background-color .2s ease-out;
        cursor: pointer;
        font-size: 11px;
    }

}

@media (max-width: 1366px) {

.dropify-wrapper {
    display: block;
    position: relative;
    cursor: pointer;
    overflow: hidden;
    margin-left: 40px;
    margin-top: -38px;
    width: 96%;
    /* max-width: 100%; */
    height: 200px;
    padding: 5px 10px;
    font-size: 14px;
    line-height: 22px;
    color: #777;
    background-color: #fff;
    background-image: none;
    text-align: center;
    border: 2px solid #E5E5E5;
    -webkit-transition: border-color .15s linear;
    transition: border-color .15s linear;
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
               <h5 class="breadcrumbs-title mt-0 mb-0"><span>MPF List</span></h5>
               <ol class="breadcrumbs mb-0">
                  {{-- <li class="breadcrumb-item ">
                     <a href="#">Home</a>
                  </li> --}}
                  <li class="breadcrumb-item ">
                     <a href="#">Multi-Purpose Form</a>
                  </li>
                  <li class="breadcrumb-item">
                     <a href="#">MPF List</a>
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
                    Hello {{ Session::get('USERNAME') }}, here's List of MPF. Have a good day :)
                  </p>
               </div>
            </div>

            <div class="card">
                <div class="card-content">

                    <div class="row">
                        <div class="col s12">
                        <table id="listMPF" class="striped" role="grid" style="width:100%">
                         <thead>
                            <tr>
                                {{-- <th>No</th> --}}
                                <th>ID</th>
                                <th>DtCreate</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Subject</th>
                                <th>Status</th>
                                {{-- <th>Detail</th> --}}
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

<div id="detailMPFModal" class="modal">
	<div class="modal-content">
        <a href="javascript:void(0)" class="modal-action modal-close" style="float: right">
            <i class="material-icons">close</i>
        </a>
        <div id="headerModal"></div>
        <div class="row">
                <div class="row">
                    <div class="col m12 s12">
                        <div class="divider show-on-small hide-on-med-and-up mb-3"></div>
                        <h6>CreatedBy: <span id="createdby"></span>, to: <span id="to"></span></h6>
                        <h6>DtCreation: <span id="dtcreation"></span></h6>
                        <h6>Subject: <span id="subject"></span></h6>
                        <h6>ReviewedBy: <span id="reviewedby"></span></h6>
                        <div id="attachment"></div>
                        <div class="divider mb-3 mt-3"></div>
                        <h6>Description:</h6>
                        <div>
                            <span id="description"></span>
                        </div>
                        <div class="divider mb-3 mt-3"></div>

                    </div>

                    <div class="col m12 s12" id="divCC"></div>

                        
                     
            </div>
        </div>
    </div>
    <div class="modal-footer" id="modalFooter">
        <button class="btn waves-effect waves-light blue darken-1" id="accept">Accept</button>
        <button class="btn waves-effect waves-light red darken-1" id="reject">Reject</button>
        </div>
    </div>
</div>

<!-- END: Page Main-->

@endsection

@section('contentjs')

<script src="{{ asset('outside/plugins/blockui/jquery.blockUI.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.4/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.4/js/responsive.bootstrap4.min.js"></script>
<script type="text/javascript">


var x = window.matchMedia("(max-width: 991px)");
var id;


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

function getListMPF(){

    blockUI();

    var dataTable = $('#listMPF').DataTable({
        order: [ [1, 'desc'] ],
        stripeClasses: [],
        lengthMenu: [5, 10, 20, 50],
        pageLength: 10,
        destroy : true,
        responsive: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        ajax: {
            'url':'{!!url("getListCcMPF")!!}',
            'type': 'post',
            data: {
                    '_token': '{{ csrf_token() }}'
                }
        },
        columns: [
            // { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'mpf_id', name: 'mpf_id'},
            { data: 'tr_date', name: 'tr_date'},
            { data: 'userid', name: 'userid' },
            { data: 'target_id', name: 'target_id'},
            { data: 'cat_desc', name: 'cat_desc' },
            { data: 'Status', name: 'Status'}
            // { data: 'amt_net', name: 'amt_net', render: $.fn.dataTable.render.number( ',', '.', 2, 'IDR ' )},
            // { data: 'Detail', name: 'Detail',orderable:false,searchable:false }
        ],
        initComplete: function(settings, json) {

            if (!dataTable.rows().data().length) {

                $.unblockUI();

                swal("Whops", "Data not available", "error");
            }

            else {

                $.unblockUI();
            }
        },
    });

}



$(document).ready(function() {


    $('#MPF').addClass('active open');
    $('#MPFCSS').css('display','block');
    $('#ListMPF').addClass('active gradient-45deg-green-teal gradient-shadow');

    var modalFooter = document.getElementById("modalFooter");

    $(".modal").modal();
    getListMPF();

    $('body').on('click', '.detailMPF', function(e) {

        blockUI();
        id = $(this).data('id');
       

        $.ajax({
                type: "POST",
                url: "{{ url('detailMPF') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id': id
                },
                success: function (data) {

                   
                    $('#createdby').text(data['userid']);
                    $('#to').text(data['target_id']);
                    $('#dtcreation').text(data['tr_date']);
                    $('#subject').text(data['cat_desc']);
                    $('#description').text(data['remark1']);
                    $('#headerModal').html(title);

                    @if(Session::get('GROUPID') == 'SALES')

                        modalFooter.style.display = "none";

                       if (data['status'] == "PENDING") {

                            var title = "<h5 class='modal-title'>#"+id+"</h5><div class='chip amber white-text'>"+data['status']+"</div>";

                        }

                        if (data['status'] == "REJECTED") {

                            var title = "<h5 class='modal-title'>#"+id+"</h5><div class='chip red white-text'>"+data['status']+"</div>";

                        }

                        if (data['status'] == "APPROVED") {

                            var title = "<h5 class='modal-title'>#"+id+"</h5><div class='chip green white-text'>"+data['status']+"</div>";

                        }

                        $('#headerModal').html(title);

                    @endif


                    @if(Session::get('GROUPID') != 'SALES')

                        if (data['status'] == "PENDING") {

                            var title = "<h5 class='modal-title'>#"+id+"</h5><div class='chip amber white-text'>"+data['status']+"</div>";
                            modalFooter.style.display = "block";
                            $('#divCC').html(data['checkbox']);

                        }

                        if (data['status'] == "REJECTED") {

                            var title = "<h5 class='modal-title'>#"+id+"</h5><div class='chip red white-text'>"+data['status']+"</div>";
                            modalFooter.style.display = "none";
                            $('#divCC').empty();

                        }

                        if (data['status'] == "APPROVED") {

                            var title = "<h5 class='modal-title'>#"+id+"</h5><div class='chip green white-text'>"+data['status']+"</div>";
                            modalFooter.style.display = "none";
                            $('#divCC').empty();

                        }

                        $('#headerModal').html(title);

                        if (data['user_action'] == "N/A") {

                        $('#reviewedby').text(data['user_action']);
                        $('#reviewedby').removeClass();
                        $('#reviewedby').addClass('chip red white-text');

                         }

                    if (data['user_action'] != "N/A") {

                        $('#reviewedby').text(data['user_action']);
                        $('#reviewedby').removeClass();
                        $('#reviewedby').addClass('chip blue white-text');

                    }


                    if (data['attach_path'] == "N/A") {
                        $('#attachment').html("<h6>Attachment: <span>"+data['attach_path']+"</span></h6>");
                    }

                    else {

                        var html = "<h6>Attachment: <a href='"+data['attach_path']+"' target='_blank'>"+data['filename']+"</a></h6>";

                        $('#attachment').html(html);
                        
                    }

                    $.unblockUI();


                    @endif

                   

                }
            });


    });

    $('#accept').on('click', function() { 

        var arr = [];
        $.each($("input[name='checkCC']:checked"), function(){            
                arr.push($(this).val());
        });
        // console.log(arr);

        $.ajax({
            url: 'acceptApproval',
            type: "POST",
            dataType: "json",
            data: {
                '_token': '{{ csrf_token() }}',
                'id' : id,
                'arr' : arr
            },
            success:function(data) {

                if (data['status'] == "Sukses") {


                    swal("Success", "This MPF approved", "success");

                    $('#detailMPFModal').modal('close');

                    getListMPF();

                }

                
                
            }
        });


    });

    $('#reject').on('click', function() { 


        $.ajax({
            url: 'rejectApproval',
            type: "POST",
            dataType: "json",
            data: {
                '_token': '{{ csrf_token() }}',
                'id' : id
            },
            success:function(data) {

                if (data['status'] == "Sukses") {


                    swal("Success", "This MPF Rejected", "success");

                    $('#detailMPFModal').modal('close');

                    getListMPF();

                }

                
                
            }
        });

        

    });





});



</script>

@endsection
