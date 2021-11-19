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
    .info {
        font-family: muli;
        font-size: 10px;
        position: relative;
        clear: both;
    }
    #preloader {
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
               <h5 class="breadcrumbs-title mt-0 mb-0"><span>PR Approval</span></h5>
               <ol class="breadcrumbs mb-0">
                  {{-- <li class="breadcrumb-item ">
                     <a href="#">Home</a>
                  </li> --}}
                  <li class="breadcrumb-item ">
                     <a href="#">Approval</a>
                  </li>
                  <li class="breadcrumb-item">
                     <a href="#">PR Approval</a>
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
                    Hello {{ Session::get('USERNAME') }}, here's PR approval form. Have a good day :)
                    <input type="hidden" id="username" name="username" value="{{ Session::get('USERNAME') }}">
                </p>
                </div>
              </div>


            <div class="card">
               <div class="card-content">
                  <div class="row">
                    <div class="row">
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">business</i>
                            <select class="basic browser-default" id="mill_id" name="mill_id">
                                <option></option>
                                <option value="SR">Sunrise Steel</option>
                                {{-- <option value="SM">Sunrise Mill</option> --}}
                            </select>
                            <label>Mill ID</label>
                        </div>
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">account_circle</i>
                            <select class="browser-default" id="pic_name" name="pic_name"></select>
                            <label>PIC Name</label>
                            <input type="hidden" id="pic_id">
                            <input type="hidden" id="dept_id">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">date_range</i>
                            <input type="text" class="datepicker" name="start" id="start" placeholder="Start date" readonly="readonly">
                            <label>Start Date</label>
                        </div>
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">date_range</i>
                            <input type="text" class="datepicker" name="end" id="end" placeholder="End date" readonly="readonly">
                            <label>End Date</label>
                        </div>
                    </div>
                    <div class="row" id='reset2'>
                        <div class="input-field col m4 s12">
                            <i class="material-icons prefix">assignment_turned_in</i>
                            <select class="basic browser-default" id='aprv' name='aprv'>
                                <option value='' selected>All (Y/N)</option>
                                <option value='Y'>Yes</option>
                                <option value='N'>No</option>
                            </select>
                            <label>Approved</label>
                        </div>
                        <div class="input-field col m4 s12">
                            <i class="material-icons prefix">layers</i>
                            <select class="basic browser-default" id='status' name='status'>
                                <option value='' selected>All (O/C)</option>
                                <option value='C'>Close</option>
                                <option value='O'>Open</option>
                            </select>
                            <label>Status</label>
                        </div>
                        <div class="input-field col m4 s12">
                            <i class="material-icons prefix">border_vertical</i>
                            <select class="sbasic browser-default" id='raw' name='raw'>
                                <option value='' selected>All (Y/N)</option>
                                <option value='Y'>Yes</option>
                                <option value='N'>No</option>
                            </select>
                            <label>Raw</label>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">

                        <button class="btn waves-effect waves-light green darken-1" id="resetform">Reset
                            <i class="material-icons right">refresh</i>
                        </button>
                        
                        <button class="btn waves-effect waves-light blue darken-1" type="submit" name="action" id="submitform">Submit
                            <i class="material-icons right">send</i>
                        </button>

                    </div>
                  </div>

               </div>
            </div>

            <div class="card " id="dua" style="display:none">
                <div id="preloader" style="display: none"></div>
                <div class="card-content">
                    <div class="card-title">
                        <div class="row">
                          <div class="col s12 m6 l10">
                            <h4 class="card-title">Here's your search result:</h4>
                            <p class="info"><em class="green-text text-darken-4">*green: closed</em>,
                            <em class="red-text text-darken-4"> *red: open</em>,
                            <em class="yellow-text text-darken-4"> *yellow: hasn't been closed/open</em>
                            </p>
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                        <table id="example" class="striped" role="grid" style="width:100%">
                        <thead>
                            <tr>
                                <th>PrID</th>
                                <th>DtPr</th>
                                <th>Dept</th>
                                <th>PIC</th>
                                <th>Approved 1</th>
                                <th>Approved 2</th>
                                <th>Raw</th>
                                <th>Stat</th>
                                <th>Memo</th>
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
<div id="DetailPrModal" class="modal modal-fixed-footer">
    <div id="preloader2" style="display: none"></div>
	<div class="modal-content">

        <div id="DetailPrModalHeader"></div>
        <div id="DetailPrModalInfo"></div>
        <div id="DetailPrModalBody"></div>
			<div id="detrawno" style="display:none">
                <table class="striped" role="grid" style="width:100%" id="RawNo">
					<thead>
						<tr>
                         <th>No</th>
                         <th>ProdCode</th>
                         <th>ProdName</th>
                         <th>Qty</th>
                         <th>Wgt</th>
                         <th>UnitMeas</th>
                         <th>Desc1</th>
                         <th>Desc2</th>
                         <th>Remark</th>
                         </tr>
                     </thead>
                 </table>
            </div>
            <div id="detrawyes" style="display:none">
				<table class="striped" role="grid" style="width:100%" id="RawYes">
					<thead>
						<tr>
                         <th>No</th>
                         <th>GradeSpec</th>
                         <th>ProdName</th>
                         <th>Qty</th>
                         <th>Wgt</th>
                         <th>UnitMeas</th>
                         <th>Desc1</th>
                         <th>Desc2</th>
                         <th>Remark</th>
                         </tr>
                     </thead>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="mb-6 btn waves-effect waves-light green accent-4 z-depth-2" id="approve">
                Approve
            </button>
            {{-- <button type="button" class="mb-6 btn waves-effect waves-light pink accent-3 z-depth-2" id="reject">
                Reject
            </button> --}}
            <button type="button" class="mb-6 btn waves-effect waves-light yellow accent-4 z-depth-2" id="reset">
                UnApprove
            </button>
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
<script src="{{ asset('outside/material/vendors/select2/select2.full.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.4/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.4/js/responsive.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/plug-ins/1.10.11/sorting/date-eu.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js" integrity="sha512-lOtDAY9KMT1WH9Fx6JSuZLHxjC8wmIBxsNFL6gJPaG7sLIVoSO9yCraWOwqLLX+txsOw0h2cHvcUJlJPvMlotw==" crossorigin="anonymous"></script>
<script type="text/javascript">

$(document).ready(function() {

    var dua = document.getElementById("dua");
    var preloader = document.getElementById("preloader")
    var preloader2 = document.getElementById("preloader2")
    var detrawyes = document.getElementById("detrawyes");
    var detrawno = document.getElementById("detrawno");
    // var action = document.getElementById("action");
    // var reset = document.getElementById("reset");

    // $('.basic').on('select2:open', function() {
    //     if (Modernizr.touch) {
    //         $('.select2-search__field').prop('focus', false);
    //     }
    // });

    $('#approve').hide();
    $('#reject').hide();
    $('#reset').hide();

    $('#Purchase').addClass('active open');
    $('#PurchaseCSS').css('display','block');
    $('#PrApp').addClass('active gradient-45deg-green-teal gradient-shadow');

    $('#pic_id').val("kosong");
    $('#dept_id').val("kosong");
    $(".modal").modal();

    $("#pic_name").select2({
        placeholder: "Choose Mill Id first"
    });
    
    $("#mill_id").select2({
        placeholder: "Choose Mill Id first"
    });

    $("#aprv").select2({});

    $("#raw").select2({});

    $("#status").select2({});

    $('.datepicker').datepicker({
        format: 'yyyymmdd',
        autoClose: true,
        showClearBtn: true,
    });

    $('#mill_id').change(function(){

        $('#pic_name').val(null);
        $('#pic_id').val("kosong");
        $('#dept_id').val("kosong");
        var e = document.getElementById("mill_id");
        var mill_id = e.options[e.selectedIndex].value;
        if (mill_id == '' || mill_id == null || mill_id == '--Choose Mill--'){;
            $("#pic_name").select2({
                placeholder: "Choose Mill Id first"
            });
        }
        else {
                $("#pic_name").select2({
                    placeholder: "Search PIC Name",
                    allowClear: true,
                        minimumInputLength: 3,
                        ajax: {
                            url: '{{url("search_pic")}}?mill=' +mill_id,
                            dataType: 'json',
                            delay: 250,
                            processResults: function (data) {
                            return {
                                results:  $.map(data, function (item) {
                                return {
                                    text: item.mill_id + " || (" + item.pic_name + ", " + item.descr+")",
                                    id: item.pic_id
                                }
                                })
                            };
                            },
                            cache: true
                        }
                });
        }
    });

    $('#pic_name').change(function(){

        $('#pic_id').val("kosong");
        $('#dept_id').val("kosong");
        var id = $( "#pic_name" ).val();
        var e = document.getElementById("mill_id");
        var mill = e.options[e.selectedIndex].value;
        $.ajax({
            url: "getPicDetail/id="+id+ '&mill=' +mill,
            type: "Get",
            dataType: 'json',
            data:{
                '_token': '{{ csrf_token() }}'
            },
            success: function(data){
            $('#pic_id').val(data.pic_id);
            $('#dept_id').val(data.dept_id);
            }
        });
    });

    $('#submitform').on('click', function() {

        event.preventDefault();
        var e = document.getElementById("mill_id");
        var mill = e.options[e.selectedIndex].value;
        var dt_start = $("#start").val();
        var dt_end = $("#end").val();
        var aprv = $('#aprv').val();
        var status = $('#status').val();
        var raw = $('#raw').val();
        var pic_id = $('#pic_id').val();
        var dept_id = $('#dept_id').val();
        var username = $('#username').val();
        var allreq = '';
        allreq = '&username='+username;

        if (mill == '' || mill == null || mill == '--Choose Mill--'){

          swal('Oops!','You must choose Mill ID first','error');

        }

        else if ((dt_start == '' && dt_end == '') || (dt_start == null && dt_end == null)){

            swal({
            title: "Are you sure ?",
            text: "If you wanna search without adding date, it will searching whole data's and maybe will take a long time to be completed.",
            icon: "warning",
            buttons: true
            })
            .then((willGo) => {
                if (willGo) {

                    if (aprv != " "){

                    allreq = allreq+'&aprv='+aprv.trim();
                    }

                    if (status != "All (O/C)"){

                    allreq = allreq+'&status='+status.trim();
                    }

                    if (raw != "All (Y/N)"){

                    allreq = allreq+'&raw='+raw.trim();

                    }

                    if (pic_id != "kosong" && dept_id != "kosong"){

                    allreq = allreq+'&pic_id='+pic_id.trim();
                    allreq = allreq+'&dept_id='+dept_id.trim();

                    }

                    dua.style.display = "block";
                    preloader.style.display = "block";
                    document.getElementById("submitform").disabled = true;

                    $('html, body').animate({
                        scrollTop: $("#dua").offset().top
                    }, 1200);

                    var dataTable = $('#example').DataTable({
                    "drawCallback": function( settings ) {
                    $('.tooltipped').tooltip();
                    },
                    order: [[ 1, "desc" ]], //or asc 
                    columnDefs : [{"targets":1, "type":"date-eu"}],
                    destroy : true,
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    pageLength: 10,
                    dom: 'Pfrtip',
                    ajax: {
                    'url':'{!!url("getPrHdr")!!}'+'?mill=' +mill.trim()+allreq,
                    'type': 'post',
                    'headers': {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                    },
                    columns: [
                        {data: 'pr_id', name: 'pr_id'},
                        {data: 'dt_pr', name: 'dt_pr', orderable:true},
                        {data: 'department', name: 'department'},
                        {data: 'pic_name', name: 'pic_name'},
                        {data: 'APRV1', name: 'APRV1'},
                        {data: 'APRV2', name: 'APRV2'},
                        {data: 'raw_flag', name: 'raw_flag'},
                        {data: 'stat', name: 'stat'},
                        {data: 'memo_txt', name: 'memo_txt'},
                        {data: 'Detail', name: 'Detail',orderable:false,searchable:false}
                    ],
                    "rowCallback": function( row, data ) {
                        if ( data.stat == "C") {
                            $('td', row).addClass('green-text text-darken-4');
                        }
                        else if ( data.stat == "O") {
                            $('td', row).addClass('red-text text-darken-4');
                        }
                        else {
                            $('td', row).addClass('yellow-text text-darken-4');
                        }

                    },
                    initComplete: function(settings, json) {
                    if (dataTable.rows().data().length) {
                    swal("Yay!", "Data loaded successfully", "success");
                    preloader.style.display = "none";
                    document.getElementById("submitform").disabled = false;


                    }
                    if (!dataTable.rows().data().length) {
                    swal("Oops! :(", "Data not available", "error");
                    preloader.style.display = "none";
                    document.getElementById("submitform").disabled = false;

                    }
                    },
                    });

                }
                else {
                    swal("Cancel searching for whole data's");
                }
            });

        }

        else {

          if (aprv != " "){

              allreq = allreq+'&aprv='+aprv.trim();
          }

          if (status != "All (O/C)"){

              allreq = allreq+'&status='+status.trim();
          }

          if (raw != "All (Y/N)"){

              allreq = allreq+'&raw='+raw.trim();

          }

          if (pic_id != "kosong" && dept_id != "kosong"){

              allreq = allreq+'&pic_id='+pic_id.trim();
              allreq = allreq+'&dept_id='+dept_id.trim();

          }

          if (dt_start && !dt_end){

              allreq = allreq+'&dt_start='+dt_start.trim();
          }

          if (!dt_start && dt_end){

              allreq = allreq+'&dt_end='+dt_end.trim();
          }

          if (dt_start && dt_end){

               allreq = allreq+'&dt_start='+dt_start.trim();
               allreq = allreq+'&dt_end='+dt_end.trim();
          }

          dua.style.display = "block";
          preloader.style.display = "block";
          document.getElementById("submitform").disabled = true;

          $('html, body').animate({
             scrollTop: $("#dua").offset().top
          }, 1200);

            var dataTable = $('#example').DataTable({
            "drawCallback": function( settings ) {
            $('.tooltipped').tooltip();
            },
            order: [[ 1, "desc" ]], //or asc 
            columnDefs : [{"targets":1, "type":"date-eu"}],
            destroy : true,
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            pageLength: 10,
            dom: 'Pfrtip',
            ajax: {
                'url':'{!!url("getPrHdr")!!}'+'?mill=' +mill.trim()+allreq,
                'type': 'post',
                'headers': {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            columns: [
                    {data: 'pr_id', name: 'pr_id'},
                    {data: 'dt_pr', name: 'dt_pr', orderable:true},
                    {data: 'department', name: 'department'},
                    {data: 'pic_name', name: 'pic_name'},
                    {data: 'APRV1', name: 'APRV1'},
                    {data: 'APRV2', name: 'APRV2'},
                    {data: 'raw_flag', name: 'raw_flag'},
                    {data: 'stat', name: 'stat'},
                    {data: 'memo_txt', name: 'memo_txt'},
                    {data: 'Detail', name: 'Detail',orderable:false,searchable:false}
                ],
                "rowCallback": function( row, data ) {
                    if ( data.stat == "C") {
                        $('td', row).addClass('green-text text-darken-4');
                    }
                    else if ( data.stat == "O") {
                        $('td', row).addClass('red-text text-darken-4');
                    }
                    else {
                        $('td', row).addClass('yellow-text text-darken-4');
                    }

                },
                initComplete: function(settings, json) {
                if (dataTable.rows().data().length) {
                swal("Yay!", "Data loaded successfully", "success");
                preloader.style.display = "none";
                document.getElementById("submitform").disabled = false;


                }
                if (!dataTable.rows().data().length) {
                swal("Oops! :(", "Data not available", "error");
                preloader.style.display = "none";
                document.getElementById("submitform").disabled = false;

                }
                },
            });
        }
    });

    $('body').on('click', '#getDetailPr', function(e) {
      e.preventDefault();
      var id1 = $(this).data('id1');
      var pr_id = $(this).data('id2')
      var id2 = encodeURIComponent($(this).data('id2'));
      var id3 = $(this).data('id3');
      var id4 = $(this).data('id4');

      var info="";
      
    //   if (id4 == "Y") {

    //     $('#approve').hide();
    //     $('#reject').hide();
    //     $('#reset').show();
    //     info = "<h6 class='green-text text-darken-4'>*Already approved</h6>";

    //   }

    //   else if (id5 == "N") {


    //     $('#approve').hide();
    //     $('#reject').hide();
    //     $('#reset').show();
    //     info = "<h6 class='red-text text-darken-4'>*Already rejected</h6>";

    //   }

    //   else {


    //     $('#approve').show();
    //     // $('#reject').show();
    //     $('#reset').hide();
    //     info = "<h6 class='yellow-text text-darken-4'>*Hasn't been approved</h6>";
    //   }

      var html = "";
      html = "<input type='hidden' name='send_mill' id='send_mill' value='"+id1+"'>";
      html = html+"<input type='hidden' name='send_pr' id='send_pr' value='"+pr_id+"'>";
      var title = "<h5 class='modal-title'>Detail of "+pr_id+"</h5>";

      $('#DetailPrModalHeader').html(title)
      $('#DetailPrModalBody').html(html);
      $('#DetailPrModalInfo').html(info);

      if (id3 == 'N' || id3 == '') {

        preloader2.style.display = "block";

        var dataTable = $('#RawNo').DataTable({
          destroy: true,
          responsive: true,
          processing: true,
          serverSide: true,
          autoWidth: false,
          pageLength: 5,
          dom: 'Pfrtip',
          ajax: {
                  'url':'{!!url("getDetailRawNoPr")!!}'+'?id1='+id1+ '&id2=' +id2+ '&id3=' +id3,
                  'type': 'post',
                  'headers': {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
                  }
            },
          columns: [
              { data: 'pr_item', name: 'pr_item' },
              { data: 'prod_code', name: 'prod_code' },
              { data: 'prod_name', name: 'prod_name' },
              { data: 'qty', name: 'qty' },
              { data: 'wgt', name: 'wgt' },
              { data: 'unit_meas', name: 'unit_meas' },
              { data: 'descr', name: 'descr' },
              { data: 'descr2', name: 'descr2' },
              { data: 'remark', name: 'remark' }

            ],
            initComplete: function(settings, json) {
              if (dataTable.rows().data().length) {

                detrawyes.style.display = "none";
                detrawno.style.display = "block";
                preloader2.style.display = "none";

              }
              if (!dataTable.rows().data().length) {

                swal("Oops! :(", "Data not available", "error");

              }
            },
        });

      }

      else {

        preloader2.style.display = "block";

          var dataTable = $('#RawYes').DataTable({
            destroy: true,
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            pageLength: 5,
            dom: 'Pfrtip',
            ajax: {
                  'url':'{!!url("getDetailRawYesPr")!!}'+'?id1='+id1+ '&id2=' +id2+ '&id3=' +id3,
                  'type': 'post',
                  'headers': {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
                  }
            },
            columns: [

                { data: 'pr_item', name: 'pr_item' },
                { data: 'grade_spec', name: 'grade_spec' },
                { data: 'prod_name', name: 'prod_name' },
                { data: 'qty', name: 'qty' },
                { data: 'wgt', name: 'wgt' },
                { data: 'unit_meas', name: 'unit_meas' },
                { data: 'descr1', name: 'descr1' },
                { data: 'descr2', name: 'descr2' },
                { data: 'remark', name: 'remark' }

              ],
              initComplete: function(settings, json) {
                if (dataTable.rows().data().length) {

                    detrawno.style.display = "none";
                    detrawyes.style.display = "block";
                    preloader2.style.display = "none";
                }
                if (!dataTable.rows().data().length) {

                  swal("Oops! :(", "Data not available", "error");

                }
              },
          });

      }


    });

    $('#resetform').on('click', function() {

        $('#mill_id').val(null).trigger('change');
        $('#pic_name').val(null).trigger('change');
        $('#aprv').val(null).trigger('change');
        $('#raw').val(null).trigger('change');
        $('#status').val(null).trigger('change');
        $('#start').val('');
        $('#end').val('');
        dua.style.display = "none"



    });

    $('#example').on('click', 'button#moveApprove1', function(e) {
        e.preventDefault();
        var mill_id = $(this).data('mill');
        var pr_id = $(this).data('pr');

        swal({
            title: "Are you sure",
            text: "Approving PR ID: "+pr_id+" ?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willGo) => {
            if (willGo) {

                $.ajaxSetup({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                });

                $.ajax({
                url: "{{ url('setApprovePr') }}",
                method: 'POST',
                data: {
                    mill: mill_id,
                    pr: pr_id,
                },
                    success: function(result) {
                    if(result.errors) {
                        $.each(result.errors, function(key, value) {
                            swal("Error", value, "error")
                        });
                    } else {
                        swal("Approval Success", result, "success")
                        $('#example').DataTable().ajax.reload();
                        $('#DetailPrModal').modal('close');

                        }
                    }
                });

            }
            else {
                swal("Cancel approval for PR ID: "+pr_id);
            }
        });
    });

    $('#example').on('click', 'button#moveUnApprove1', function(e) {
        e.preventDefault();
        var mill_id = $(this).data('mill');
        var pr = $(this).data('pr');

        swal({
            title: "Are you sure",
            text: "UnApprove PR ID: "+pr+" ?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willGo) => {
            if (willGo) {

            $.ajaxSetup({
            headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });

            $.ajax({
                url: "{{ url('setResetPr') }}",
                method: 'POST',
                data: {
                    mill: mill_id,
                    pr: pr,
                },
                success: function(result) {
                    if(result.errors) {
                        $.each(result.errors, function(key, value) {
                            swal("Error", value, "error")
                        });
                    } else {
                        swal("Resetting Success", result, "success")
                        $('#example').DataTable().ajax.reload();
                        $('#DetailPrModal').modal('close');

                    }
                    }
                });

            }
            else {
            swal("Cancel resetting for PR ID: "+pr);
            }
        });
    });

    $('#example').on('click', 'button#moveApprove2', function(e) {
        e.preventDefault();
        var mill_id = $(this).data('mill');
        var pr_id = $(this).data('pr');

        swal({
            title: "Are you sure",
            text: "Approving PR ID: "+pr_id+" ?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willGo) => {
            if (willGo) {

                $.ajaxSetup({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                });

                $.ajax({
                url: "{{ url('setApprove2Pr') }}",
                method: 'POST',
                data: {
                    mill: mill_id,
                    pr: pr_id,
                },
                    success: function(result) {
                    if(result.errors) {
                        $.each(result.errors, function(key, value) {
                            swal("Error", value, "error")
                        });
                    } else {
                        swal("Approval Success", result, "success")
                        $('#example').DataTable().ajax.reload();
                        $('#DetailPrModal').modal('close');

                        }
                    }
                });

            }
            else {
                swal("Cancel approval for PR ID: "+pr_id);
            }
        });
    });

    $('#example').on('click', 'button#moveUnApprove2', function(e) {
        e.preventDefault();
        var mill_id = $(this).data('mill');
        var pr = $(this).data('pr');

        swal({
            title: "Are you sure",
            text: "UnApprove PR ID: "+pr+" ?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willGo) => {
            if (willGo) {

            $.ajaxSetup({
            headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });

            $.ajax({
                url: "{{ url('setReset2Pr') }}",
                method: 'POST',
                data: {
                    mill: mill_id,
                    pr: pr,
                },
                success: function(result) {
                    if(result.errors) {
                        $.each(result.errors, function(key, value) {
                            swal("Error", value, "error")
                        });
                    } else {
                        swal("Resetting Success", result, "success")
                        $('#example').DataTable().ajax.reload();
                        $('#DetailPrModal').modal('close');

                    }
                    }
                });

            }
            else {
            swal("Cancel resetting for PR ID: "+pr);
            }
        });
    });

    
});


</script>


@endsection
