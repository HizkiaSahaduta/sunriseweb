@extends('main')

@section('contentcss')
<link rel="stylesheet" type="text/css" href="{{ asset('outside/material/vendors/magnific-popup/magnific-popup.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
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
             <h5 class="breadcrumbs-title mt-0 mb-0"><span>Upload Image</span></h5>
             <ol class="breadcrumbs mb-0">
                {{-- <li class="breadcrumb-item ">
                   <a href="#">Home</a>
                </li> --}}
                <li class="breadcrumb-item ">
                   <a href="#">Sales Order</a>
                </li>
                <li class="breadcrumb-item">
                   <a href="#">Upload Image</a>
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
                  Hello {{ Session::get('USERNAME') }}, here's list of uploaded image order. Have a good day :)
                </p>
             </div>
          </div>
          <div class="card">
              <div class="card-content">
               <div class="row">


                <div class="row">
                    <div class="input-field col s12">
                        <p class="caption mb-0">UPLOADED FILE</p>
                    </div>
                </div>
                <div class="masonry-gallery-wrapper">
                    <div class="popup-gallery">
                      <div class="gallery-sizer"></div>
                      <div class="row">
                        <div id="uploaded_image"></div>
                      </div>
                    </div>
                </div>


                <div class="row">
                    <div class="input-field col s12">
                        <p class="caption mb-0">UPLOAD ORDER PHOTO</p>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <form id="dropzoneForm" class="dropzone" action="{{ url('ImgUpload') }}">
                            @csrf
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <button type="button" class="btn right green" id="submit-all">Upload
                        <i class="material-icons left">file_upload</i>
                        </button>
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
@if(\Session::has('success'))
<script>
    var msg = "{{ Session::get('success') }}"
    swal("Success", msg, "success");
</script>
@endif

@if(\Session::has('error'))
<script>
    var msg = "{{ Session::get('error') }}"
    swal("Whoops", msg, "error");
</script>
@endif


<script src="{{ asset('outside/material/vendors/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
<script type="text/javascript">

$(function () {
    $(".popup-gallery").magnificPopup({
        delegate: "a",
        type: "image",
        closeOnContentClick: !0,
        fixedContentPos: !0,
        tLoading: "Loading image #%curr%...",
        mainClass: "mfp-img-mobile mfp-no-margins mfp-with-zoom",
        gallery: { enabled: !0, navigateByImgClick: !0, preload: [0, 1] },
        image: {
            verticalFit: !0,
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
            titleSrc: function (e) {
                return e.el.attr("title") + "<small>SunriseWeb - PreOrder</small>";
            },
            zoom: { enabled: !0, duration: 300 },
        },
    });
});


Dropzone.options.dropzoneForm = {
    autoProcessQueue : false,
    acceptedFiles : ".png,.jpg,.jpeg",
    addRemoveLinks: true,
    init:function(){
      var submitButton = document.querySelector("#submit-all");
      myDropzone = this;

      submitButton.addEventListener('click', function(){
        myDropzone.processQueue();
      });

      this.on("complete", function(){
        if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
        {
          var _this = this;
          _this.removeAllFiles();
        }
        load_images();
      });

    }

  };

  load_images();

  function load_images()
  {
    $.ajax({
      url:"{{ url('ImgFetch') }}",
      success:function(data)
      {
        $('#uploaded_image').html(data);
      }
    })
  }

$(document).ready(function() {

  $('body').on('click', '.remove_image', function(){
    var name = $(this).attr('id');
    swal({
        title: "Delete image "+name+" ?",
        icon: "warning",
        buttons: true
        })
        .then((willGo) => {
            if (willGo) {

                 $.ajax({
                url:"{{ url('ImgDelete') }}",
                data:{name : name},
                success:function(data){
                    if ((data['response']) == "Image deleted") {
                        swal("Success", (data['response']), "success");
                        load_images();
                    }
                    else {
                        swal("Error", "Something error", "error");
                        load_images();
                    }
                }
                })

            }
            else {
                swal("Canceling delete Image "+name);
            }
        });






  });



});



</script>

@endsection
