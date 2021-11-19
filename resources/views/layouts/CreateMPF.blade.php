@extends('main')

@section('contentcss')
<link rel="stylesheet" type="text/css" href="{{ asset('outside/material/vendors/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('outside/material/vendors/select2/select2-materialize.css') }}">
<link rel="stylesheet" href="{{ asset('outside/plugins/flatpickr/flatpickr.css') }}" type="text/css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@latest/dist/plugins/monthSelect/style.css">
<link href="{{ asset('outside/plugins/dropify/dropify.min.css') }}" rel="stylesheet" type="text/css" >

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
               <h5 class="breadcrumbs-title mt-0 mb-0"><span>Create MPF</span></h5>
               <ol class="breadcrumbs mb-0">
                  {{-- <li class="breadcrumb-item ">
                     <a href="#">Home</a>
                  </li> --}}
                  <li class="breadcrumb-item ">
                     <a href="#">Multi-Purpose Form</a>
                  </li>
                  <li class="breadcrumb-item">
                     <a href="#">Create MPF</a>
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
                    Hello {{ Session::get('USERNAME') }}, here's MPF Creation Form. Have a good day :)
                  </p>
               </div>
            </div>

            <div class="card">
                <div class="card-content">

                    <div id="contact-us" class="section">
                        <div class="app-wrapper">
                          <div class="contact-header">
                            <div class="row contact-us ml-0 mr-0">
                              <div class="col s12 m12 l12 form-header">
                                <h6 class="form-header-text"><i class="material-icons"> mail_outline </i>MPF Creation Form</h6>
                                <p>CREATED BY : {{ Session::get('USERNAME') }}</p>
                                @if(isset($office))
                                    @foreach($office as $office)
                                        <p>OFFICE : {{ $office->office }}</p>
                                    @endforeach
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>

                    <form method="post" id="frmApproval" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="input-field col m12 s12">
                            <i class="material-icons prefix">layers</i>
                            <select class="browser-default" id="txtCategory" name="txtCategory">
                                <option></option>
                                @if(isset($category))
                                    @foreach($category as $category)
                                        <option value='{{ $category->cat_id }}'>{{ $category->cat_desc }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <label>Subject: </label>
                        </div>
                    </div>

                    <div class="row rowType">
                        <div class="input-field col m12 s12">
                            <i class="material-icons prefix">layers</i>
                            <select class="browser-default" id="txtType" name="txtType">
                                    <option></option>
                                    <option value='PP'>PPP (P3)</option>
                                    <option value='SC'>SC (Sales Contract)</option>
                            </select>
                            <label>Type: </label>
                        </div>
                    </div>

                    <div class="row rowExtend">
                        <div class="input-field col m12 s12">
                            <i class="material-icons prefix">layers</i>
                            <select class="browser-default" id="txtExtendType" name="txtExtendType">
                                    <option></option>
                            </select>
                            <label>Extend Type: </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">branding_watermark</i>
                            <input type="text" name="txtReceiver" id="txtReceiver" placeholder="Receiver goes here" disabled>
                            <label>Receiver: </label>
                        </div>
                    </div>


                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">line_weight</i>
                            <input type="text" name="txtOrderId" id="txtOrderId" placeholder="OrderID goes here" disabled>
                            <label>SC Number: </label>
                            <button class="btn btn-small amber lighten-2 modal-trigger detailMPF" data-target="detailScNumber" id="checkOrderID" style="margin-left: 43px" >Check
                                <i class="material-icons right">check</i>
                            </button>
                            
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">edit</i>
                            <label>Remark:</label>
                            <textarea id="txtRemark" name="txtRemark" rows="3" class="materialize-textarea" placeholder="limit 240 char" maxlength="240"></textarea>
                            <div id="remainingC"></div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">image</i>
                            <label>Attachment:</label>
                            <input type="text" placeholder="OrderID goes here" readonly="readonly">
                            <input type="file" class="dropify" data-default-file="{{ asset('outside/assets/img/200x200.jpg') }}" data-max-file-size="5M" data-allowed-file-extensions="jpg jpeg png pdf doc docx" id="txtAttachment" name="txtAttachment"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                          <button class="btn btn-block waves-effect waves-light blue darken-1" type="submit">SUBMIT</button>
                        </div>
                    </div>

                    </form>
        
                    

                </div>
            </div>

         </div>
      </div>
   </div>


</div>

<div id="detailScNumber" class="modal">
	<div class="modal-content">
        <a href="javascript:void(0)" class="modal-action modal-close" style="float: right">
            <i class="material-icons">close</i>
        </a>
        <div id="headerModal"></div>
        <div class="row">
                <div class="row">
                    <div class="col m12 s12">
                        <div id="contentModal"></div>
                    </div>      
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
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
<script src="{{ asset('outside/plugins/dropify/dropify.min.js') }}"></script>
<script type="text/javascript">


var x = window.matchMedia("(max-width: 991px)");
var len = 0;
var maxchar = 240;


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


    $('#MPF').addClass('active open');
    $('#MPFCSS').css('display','block');
    $('#CreateMPF').addClass('active gradient-45deg-green-teal gradient-shadow');

    // $("#checkOrderID").hide();

    $(".modal").modal();

    $('#txtCategory').prepend('<option selected></option>').select2({
        placeholder: "Choose Subject",
        allowClear: true
    });

    $('#txtType').prepend('<option selected></option>').select2({
        placeholder: "Choose Type"
    });

    $('#txtExtendType').prepend('<option selected></option>').select2({
        placeholder: "Choose Extend"
    });

    $('#txtReceiver').val('');

    $('.rowType').hide();
    $('.rowExtend').hide();

    $('#txtRemark').keyup(function(){
		len = this.value.length
		if(len > maxchar){
			return false;
		}
		else if (len > 0) {
            $("#remainingC").show();
			$('#remainingC').html( "<span class='new badge green' style='float: left; margin-left: 41px' data-badge-caption='char remaining'>"+( maxchar - len )+"</span>");
		}
		else {
            $("#remainingC").show();
			$('#remainingC').html( "<span class='new badge green' style='float: left; margin-left: 41px' data-badge-caption='char remaining'>"+( maxchar )+"</span>");
		}
	});

    $('.dropify').dropify({
      messages: { 
            'default': 'Click to Upload or Drag n Drop', 
            'remove':  '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>', 
            'replace': 'Upload or Drag n Drop' 
        }
    });

    $('#txtCategory').change(function(){

        var cat_id = $(this).val();

        if(cat_id){

            $.ajax({
                url: 'needOrderID',
                type: "GET",
                dataType: "json",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'cat_id': cat_id
                },
                success:function(data) {
                    
                    if(data == 'Y'){

                        $("#checkOrderID").show();
                        $("#txtOrderId").prop( "disabled", false );
                        $("#checkOrderID").prop( "disabled", false );
                        $("#txtOrderId").focus();
                    }
                    else{
                        $("#checkOrderID").show();
                        $("#txtOrderId").prop( "disabled", true );
                        $("#checkOrderID").prop( "disabled", true );
                        $("#txtRemark").focus();
                    }
                    
                }
            });

            $.ajax({
                url: 'fillReceiver',
                type: "GET",
                dataType: "json",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'cat_id': cat_id
                },
                success:function(data) {
                    
                    $("#txtReceiver").val(data);
                    
                }
            });

            if(cat_id == '01'){

                $('.rowType').show();

            } else {
                $('.rowType').hide();
            }

        }

    });

    $('#txtType').change(function(){

        var type_id = $(this).val();

        $.ajax({
            url: 'fillMpfExtend',
            type: "POST",
            dataType: "json",
            data: {
                '_token': '{{ csrf_token() }}',
                'type_id': type_id
            },
            success:function(data) {
                
                if(data!=""){

                    $('.rowExtend').show();
                    
                    $('#txtExtendType').empty();
                    // $.each(data, function(index, element) {
                    //     $('select[name="txtExtendType"]').append('<option value="'+ element.extend_id +'">'+ element.descr + '</option>');
                    // });

                    $.each(data, function(index, element) {
                        $('#txtExtendType').append('<option value="' + element.extend_id + '">'+ element.descr +' | '+ element.day +' Hari</option>');
                    });

                } else {

                    $('.rowExtend').hide();

                }
                
            }
        });

        // $('#txtExtendType').select2({

        //     ajax: {
        //         type: 'POST',
        //         url: 'fillMpfExtend',
        //         data: {
        //             '_token': '{{ csrf_token() }}',
        //             'type_id': type_id
        //         },
        //         dataType: 'json'
        //         processResults: function (data) {
        //         return {
        //             results: data.results
        //         };
        //         }
        //     }

        // });

    });

    $('#frmApproval').on('submit', function(event){
        
        event.preventDefault();

        var txtCategory = $('#txtCategory').val();
        var txtRemark = $('#txtRemark').val();
        
        if (!txtCategory && !txtRemark) {
            swal("Whoops", "Pls choose subject and fill in remark field first", "error")
        }

        if (!txtCategory && txtRemark) {
            swal("Whoops", "Pls choose subject and fill in remark field first", "error")
        }

        if (txtCategory && !txtRemark) {
            swal("Whoops", "Pls choose subject and fill in remark field first", "error")
        }

        if (txtCategory && txtRemark) {

            $.ajax({
                url: "{{ url('saveApprovalForm') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){

                    if ((data['response']) == "Success") {

                        swal("Success", "Form submitted!", "success");
                       
                        var drEvent = $('#txtAttachment').dropify();
                        drEvent = drEvent.data('dropify');
                        drEvent.resetPreview();
                        drEvent.clearElement();
                        drEvent.settings.defaultFile = "{{ asset('outside/assets/img/200x200.jpg') }}";
                        drEvent.destroy();
                        drEvent.init();
                        $('.dropify#txtCert').dropify({
                        defaultFile: "{{ asset('outside/assets/img/200x200.jpg') }}",
                        });

                        $('#txtCategory').val(null).trigger('change');
                        $('#txtRemark').val('');
                        $('#txtReceiver').val('');
                        $('#txtOrderId').val('');
                        $("#checkOrderID").hide();
                        $("#remainingC").hide();

                    }
                    else {
                        swal("Whops", (data['response']), "error");

                        var drEvent = $('#txtAttachment').dropify();
                        drEvent = drEvent.data('dropify');
                        drEvent.resetPreview();
                        drEvent.clearElement();
                        drEvent.settings.defaultFile = "{{ asset('outside/assets/img/200x200.jpg') }}";
                        drEvent.destroy();
                        drEvent.init();
                        $('.dropify#txtCert').dropify({
                        defaultFile: "{{ asset('outside/assets/img/200x200.jpg') }}",
                        });

                        $('#txtCategory').val(null).trigger('change');
                        $('#txtRemark').val('');
                        $('#txtReceiver').val('');
                        $('#txtOrderId').val('');
                        $("#checkOrderID").hide();
                        $("#remainingC").hide();
                    }
            
                }
            })
            
        }
      
        
    });

    
	$("#checkOrderID").click(function () {

		blockUI();
        var id = $("#txtOrderId").val();

		$.ajax({
			url: 'checkOrder',
			type: "POST",
			dataType: "json",
			data: {
                '_token': '{{ csrf_token() }}',
				'id':id
			},
			success:function(data) {
				
				if(data['html'].length != 0){

                    var title = 'Detail of '+id;

					$('#headerModal').html(title);
                    $('#contentModal').html(data['html']);
                    $.unblockUI();
				}
				else{
                    $.unblockUI();
					swal("Alert", "Data not found, please check again", "warning");
				}
				
			}
		});

		

	});


});



</script>

@endsection
