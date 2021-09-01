@extends('main')

@section('contentcss')
<link rel="stylesheet" type="text/css" href="{{ asset('outside/material/vendors/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('outside/material/vendors/select2/select2-materialize.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.4/css/responsive.dataTables.min.css" />
<style>

hr.style {
  border-top: 1px dashed #888ea8;
}

.amber-text {
    color: #43a047!important;
}

.small-ico-bg {
    padding: 5px;
    background-color: #f3f1f1;
    border-radius: 50%;
}

.material-icons {
    font-family: Material Icons;
    font-weight: 400;
    font-style: normal;
    font-size: 30px;
    display: inline-block;
    line-height: 1;
    text-transform: none;
    letter-spacing: normal;
    word-wrap: normal;
    white-space: nowrap;
    direction: ltr;
    -webkit-font-smoothing: antialiased;
    text-rendering: optimizeLegibility;
    -moz-osx-font-smoothing: grayscale;
    font-feature-settings: "liga";
}

td, th {
    padding: 5px 5px;
    display: table-cell;
    text-align: left;
    vertical-align: middle;
    border-radius: 2px;
}

.dataTables_wrapper {
    font-family: muli;
    font-size: 14px;
    position: relative;
    clear: both;
}

div.dataTables_wrapper div.dataTables_length label {
    font-weight: normal;
    text-align: left;
    white-space: nowrap;
    padding: 20px;
}
.preloader1 {
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

.users-edit i,
.users-list-wrapper i,
.users-view i {
    vertical-align: middle;
}
.users-list-wrapper .users-list-filter .show-btn {
    padding-top: 43px !important;
}
.users-list-wrapper .users-list-table {
    overflow: hidden;
}
.users-list-wrapper .users-list-table .dataTables_filter label input {
    width: auto;
    height: auto;
    margin-left: 0.5rem;
}
.users-list-wrapper .users-list-table .dataTables_length label select {
    display: inline-block;
    width: auto;
    height: auto;
}
.users-list-wrapper .users-list-table .dataTable {
    border-collapse: collapse;
}
.users-list-wrapper .users-list-table .dataTable th {
    width: auto !important;
    padding: 19px 15px;
    border-bottom: 1px solid #e0e0e0;
}
.users-list-wrapper .users-list-table .dataTable tbody td {
    padding: 0.8rem;
}
.users-list-wrapper .users-list-table .dataTables_paginate .paginate_button {
    margin-top: 0.25rem;
    padding: 0.25em 0.65em;
}
.users-list-wrapper .users-list-table .dataTables_paginate .paginate_button.current,
.users-list-wrapper .users-list-table .dataTables_paginate .paginate_button:hover {
    color: #fff !important;
    border: 1px solid #3f51b5;
    border-radius: 4px;
    background: #3f51b5;
    box-shadow: 0 0 8px 0 #3f51b5;
}
.users-view .media .avatar {
    margin-right: 0.6rem;
}
.users-view .media .users-view-name {
    font-size: 1.47rem;
}
.users-view .quick-action-btns a {
    margin-left: 1rem;
}
.users-view .users-view-timeline {
    padding: 1.2rem;
}
.users-view .users-view-timeline h6 span {
    font-size: 1.2rem;
    vertical-align: middle;
}
.users-view .striped td:first-child {
    width: 140px;
}
.users-edit .tabs .tab a {
    text-overflow: clip;
}
.users-edit .tabs .tab a span {
    position: relative;
    top: 2px;
}
.users-edit .tabs .tab a.active {
    border-radius: 4px;
    background-color: #e8eaf6;
}
.users-edit .user-edit-btns a,
.users-edit form button[type="submit"] {
    margin-right: 1rem;
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

/* @media (max-width: 600px) {

    .users-view .media {
        margin-bottom: 0.5rem;
    }
    .users-view .media .media-heading {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
    }
    .users-view .media .media-heading .users-view-name {
        font-size: 1.2rem;
    }
    .users-view .media .media-heading .users-view-username {
        font-size: 0.8rem;
    }

    .users-view-timeline h6 {
        text-align: left;
        font-size: 8px;
    }

    h5, h6 {
            font-size: 13px !important; 
            font-weight: 600 !important;
            margin: .575rem 0 .46rem;
        }
} */


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

    blockquote {
        margin: 10px 0;
        padding-left: 1.1rem;
        border-left: 5px solid #3f51b5;
        font-size: 11px;
    }

    .page-footer .container {
        padding: 0 15px;
        font-size: 9px;
    }

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
           <h5 class="breadcrumbs-title mt-0 mb-0"><span>Sunrise Landing Page</span></h5>
           <ol class="breadcrumbs mb-0">
              <li class="breadcrumb-item ">
                 <a href="#">Landing Page</a>
              </li>
              <li class="breadcrumb-item ">
                 <a href="#">Welcome Aboard</a>
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

            <div class="page-title-subheading">Hope you can any find desired information here. Have good day !</div>

          </div>
      </div>

      </div>
  </div>
</div>

</div>
<!-- END: Page Main-->

@endsection

@section('contentjs')


<script type="text/javascript">


$(document).ready(function() {



    


});



</script>

@endsection
