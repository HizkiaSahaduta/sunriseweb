@extends('main')

@section('contentcss')
<link rel="stylesheet" type="text/css" href="{{ asset('outside/material/css/pages/page-maintenance.css') }}">
@endsection

@section('content')

<div class="container">
    <!--  main content -->
    <div class="section p-0 m-0 height-100vh section-maintenance">
        <div class="row">
        <!-- Maintenance -->
            <div id="maintenance" class="col s12 center-align white">
            <img src="{{ asset('outside/material/images/gallery/maintenance.png') }}" class="responsive-img maintenance-img" alt="">
            <h4 class="error-code">Currently our dashboard is under maintenance.</h4>
            <h6 class="mb-2 mt-2">We're sorry for the inconvenience. <br> Please check back later.</h6>
            <h6 class="mb-2 mt-2">You still can use other menus on left section.</h6>
            </div>
        </div>
    </div>
</div>

@endsection

@section('contentjs')
<script type="text/javascript">

$('#index').addClass('active open');
$('#indexCSS').css('display','block');
$('#indexNav').addClass('active');
$('#dashboard').addClass('active gradient-45deg-green-teal gradient-shadow');

</script>

@endsection

