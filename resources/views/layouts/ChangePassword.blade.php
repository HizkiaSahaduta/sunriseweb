@extends('main')

@section('contentcss')

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
               <h5 class="breadcrumbs-title mt-0 mb-0"><span>Change Password </span></h5>
               <ol class="breadcrumbs mb-0">
                  {{-- <li class="breadcrumb-item ">
                     <a href="#">Home</a>
                  </li> --}}
                  <li class="breadcrumb-item ">
                     <a href="#">User Management</a>
                  </li>
                  <li class="breadcrumb-item">
                     <a href="#">Change Password</a>
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

                <div class="row">

                    <div class="row">
                        <form action="{{ url('changePass') }}" method="POST" id="formcust">
                            {{ csrf_field() }}
                        <div class="input-field col s12">
                            <i class="material-icons prefix">account_box</i>
                            <input type="text" name="userid" id="userid" value="{{ Session::get('USERNAME') }}" disabled>
                            <label>Username</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">lock</i>
                            <input type="password" name="currentpassword" id="currentpassword" placeholder="Current Password">
                            <label>Current Password</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">vpn_key</i>
                            <input type="password" name="newpassword" id="newpassword" placeholder="New Password">
                            <label>New Password</label>
                            <p>
                                <label><input type="checkbox" id="showPass">
                                <span>Show Password</span></label>
                            <p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                          <button class="btn waves-effect waves-light green darken-1 right" type="submit" name="action" id="submitform">Submit
                            <i class="material-icons right">send</i>
                          </button>
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

@if(\Session::has('alert-success'))
<script>
    var success = "{{ Session::get('alert-success') }}"
    swal("Success", success, "success");
</script>
@endif
<script type="text/javascript">

$(document).ready(function() {

    $('#UsrManage').addClass('active open');
    $('#UsrManageCSS').css('display','block');
    $('#changepass').addClass('active gradient-45deg-green-teal gradient-shadow');

    $('#showPass').on('change', function(){
          $('#newpassword').attr('type',$('#showPass').prop('checked')==true?"text":"password");
          $('#currentpassword').attr('type',$('#showPass').prop('checked')==true?"text":"password");
      });

});



</script>

@endsection
