@extends('main')

@section('contentcss')
<style>
.highcharts-figure, .highcharts-data-table table {
  min-width: 310px; 
  max-width: 800px;
  margin: 1em auto;
}

#dashboard_order {
  height: 400px;
}

.highcharts-data-table table {
	font-family: Verdana, sans-serif;
	border-collapse: collapse;
	border: 1px solid #EBEBEB;
	margin: 10px auto;
	text-align: center;
	width: 100%;
	max-width: 500px;
}
.highcharts-data-table caption {
  padding: 1em 0;
  font-size: 1.2em;
  color: #555;
}
.highcharts-data-table th {
	font-weight: 600;
  padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
  padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
  background: #f8f8f8;
}
.highcharts-data-table tr:hover {
  background: #f1f7ff;
}
</style>
@endsection


@section('content')

<div class="app-main__inner">
    <div class="app-inner-layout">
        <div class="app-inner-layout__header-boxed p-0">
            <div class="app-inner-layout__header page-title-icon-rounded text-white bg-sunny-morning mb-4 text-dark">
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div class="page-title-icon">
                                <i class="pe-7s-display2 icon-gradient bg-mean-fruit"></i>
                            </div>
                            <div>Sunrise Web - Dashboard
                            <div class="page-title-subheading">Hope you can any find desired information here. Have good day !</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
        <!-- Tabs Dashboard -->
        <!-- <ul class="tabs-animated-shadow tabs-animated nav nav-justified tabs-rounded-lg">
            <li class="nav-item">
                <a role="tab" class="nav-link active" data-toggle="tab" href="javascript:void(0);" id="satu" aria-selected="true">
                <span>Order</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" data-toggle="tab" href="javascript:void(0);" id="dua" aria-selected="false">
                <span>Product</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" data-toggle="tab" href="javascript:void(0);" id="tiga" aria-selected="false">
                <span>Invoice</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" data-toggle="tab" href="javascript:void(0);" id="empat" aria-selected="false">
                <span>Customer</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" data-toggle="tab" href="javascript:void(0);" id="lima" aria-selected="false">
                <span>CustOrder</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" data-toggle="tab" href="javascript:void(0);" id="enam" aria-selected="false">
                <span>Tracking</span>
                </a>
            </li>
        </ul> -->
    

        <!------------------------------------------------------------------------------------>
        <!----------------------------Dashboard Order Privilige------------------------------->
        
    <div id ="tampil_satu">

			  @if(Session::get('GROUPID') == "DEVELOPMENT" || Session::get('GROUPID') == "KOORDINATOR" || Session::get('GROUPID') == "PRU")
			  <div class ="row">
				<div class="col-lg-12 col-xl-6">
				  <div class="mb-3 card">
					<div class="card-header-tab card-header ">
					  <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
						<i class="header-icon lnr-history mr-3 text-muted opacity-6"> 
						</i>
						Sum Order of Previous Month
					  </div>
					</div>
					<p>
					</p>
					<!-- atas prev -->
					<div class="col-md-12 col-xl-12">
					  <div class="card mb-3 widget-content bg-night-sky">
						<div class="widget-content-wrapper text-white">
						  <div class="widget-content-left">
							<div class="widget-heading">Total Order
							</div>
							<div class="widget-subheading">
							  @php
							  echo App\Http\Controllers\HomeController::getMonthName($prev_month).', '.$year;
							  @endphp
							</div>
						  </div>
						  <div class="widget-content-right">
							<div class="widget-numbers text-hov-white">
							  <small>Rp
							  </small>
							  <span>{!! number_format($order_prev_total, 2,',' , '.') !!}
							  </span>
							</div>
						  </div>
						</div>
					  </div>
					</div>
					<!-- bawah prev-->
					<div class="pt-2 pb-0 card-body">
					  <h6 class="text-muted text-uppercase font-size-md opacity-9 mb-2 font-weight-normal">Salesman
					  </h6>
					  <div class="scroll-area-md shadow-overflow">
						<div class="scrollbar-container">
						  <ul class="rm-list-borders rm-list-borders-scroll list-group list-group-flush">           
							@if(isset($order_list_sales))
							@foreach($order_list_sales as $a)
							<li class="list-group-item">
							  <div class="widget-content p-0">
								<div class="widget-content-wrapper">
								  <div class="widget-content-left mr-3">
									<img width="38" class="rounded-circle" src="{{ asset('outside/architectui/assets/images/avatars/user.png') }}">
								  </div>
								  <div class="widget-content-left">
									<div class="widget-heading">{{ $a->salesman_name }}
									</div>
								  </div>
								  <div class="widget-content-right">
									<div class="fsize-1 text-focus">
									  <small class="opacity-5 pr-1">Rp
									  </small>
									  <span>{{ number_format($a->prev_order, 2,',' , '.') }}
									  </span>
									</div>
								  </div>
								</div>
							  </div>
							</li>
							@endforeach
							@endif
						  </ul>
						</div>
					  </div>
					</div>                          
				  </div>
				</div>
				<div class="col-lg-12 col-xl-6">
				  <div class="mb-3 card">
					<div class="card-header-tab card-header">
					  <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
						<i class="header-icon lnr-database mr-3 text-muted opacity-6"> 
						</i>
						Sum Order of Current Month
					  </div>
					</div>
					<p>
					</p>
					<!-- atas curr -->
					<div class="col-md-12 col-xl-12">
					  <div class="card mb-3 widget-content bg-premium-dark">
						<div class="widget-content-wrapper text-white">
						  <div class="widget-content-left">
							<div class="widget-heading">Total Order
							</div>
							<div class="widget-subheading">
							  @php
							  echo App\Http\Controllers\HomeController::getMonthName($curr_month).', '.$year;
							  @endphp
							</div>
						  </div>
						  <div class="widget-content-right">
							<div class="widget-numbers text-hov-white">
							  @if($order_cek = 'down') 
							  <small class="opacity-8 pl-2 text-danger">
								{!! round($order_hitung, 2) !!}%
								<i class="fa fa-angle-down">
								</i>
							  </small>
							  <small>Rp
							  </small>
							  <span>{!! number_format($order_curr_total, 2,',' , '.') !!}
							  </span>
							</div>
							@else
							<small class="opacity-8 pl-2 text-success">
							  <small>{!! round($order_hitung, 2) !!} %
							  </small>
							  <i class="fa fa-angle-up">
							  </i>
							</small>
							<small>Rp
							</small>
							<span>{!! number_format($order_curr_total, 2,',' , '.') !!}
							</span>
						  </div>
						  @endif
						</div>
					  </div>
					</div>
				  </div>
				  <!-- bawah curr-->
				  <div class="pt-2 pb-0 card-body">
					<h6 class="text-muted text-uppercase font-size-md opacity-9 mb-2 font-weight-normal">Salesman
					</h6>
					<div class="scroll-area-md shadow-overflow">
					  <div class="scrollbar-container">
						<ul class="rm-list-borders rm-list-borders-scroll list-group list-group-flush">           
						  @if(isset($order_list_sales))
						  @foreach($order_list_sales as $a)
						  <li class="list-group-item">
							<div class="widget-content p-0">
							  <div class="widget-content-wrapper">
								<div class="widget-content-left mr-3">
								  <img width="38" class="rounded-circle" src="{{ asset('outside/architectui/assets/images/avatars/user.png') }}">
								</div>
								<div class="widget-content-left">
								  <div class="widget-heading">{{ $a->salesman_name }}
								  </div>
								  @if( $a->prosentase >= 0 )
								  <div class="widget-subheading mt-1 opacity-10">
									<div class="badge badge-pill badge-success">
									  +{{  $a->prosentase }}%
									</div>
								  </div>
								</div>
								<div class="widget-content-right">
								  <div class="fsize-1 text-focus">
									<small class="opacity-5 pr-1">Rp
									</small>
									<span>{{ number_format($a->curr_order, 2,',' , '.') }}
									</span>
									<small class="text-success pl-2">
									  <i class="fa fa-angle-up">
									  </i>
									</small>
								  </div>
								</div>
								@else
								<div class="widget-subheading mt-1 opacity-10">
								  <div class="badge badge-pill badge-danger">
									{{  $a->prosentase }}%
								  </div>
								</div>
							  </div>
							  <div class="widget-content-right">
								<div class="fsize-1 text-focus">
								  <small class="opacity-5 pr-1">Rp
								  </small>
								  <span>{{ number_format($a->curr_order, 2,',' , '.') }}
								  </span>
								  <small class="text-danger pl-2">
									<i class="fa fa-angle-down">
									</i>
								  </small>
								</div>
							  </div>
							  @endif
							</div>
						  </div>
						</li>
					  @endforeach
					  @endif
					  </ul>
				  </div>
				</div>
			  </div>                         
			</div>
			</div>
			</div>
			<div class="row">
			  <div class="col-lg-12">
				<div class="main-card mb-3 card">
				  <div class="card-body">
					<div id="dashboard_order">
					</div>
				  </div>
				</div>
			  </div>
			</div>
			@endif



        <!-------------------------------------------------------------------------------->
        <!----------------------------Dashboard Order Sales------------------------------->

      @if(Session::get('GROUPID') == "SALES")
        <div class ="row">
          <div class="col-md-6">
          <div class="card-header-tab card-header shadow-lg">
            <div class="card-header-title font-size-md text-capitalize font-weight-normal">
            <i class="header-icon lnr-history mr-3 text-muted opacity-6"> 
            </i>
            @if(isset($order_list_sales))
            @foreach($order_list_sales as $b)
            Sum Order of Previous Month by {{$b->salesman_name}}
            @endforeach
            @endif
            </div>
          </div>
          <div class="card mb-3 bg-primary widget-chart text-white card-border">
            <div class="icon-wrapper rounded-circle">
            <div class="icon-wrapper-bg bg-dark opacity-9">
            </div>
            <i class="lnr-indent-increase text-white">
            </i>
            </div>
            <div class="widget-numbers">
            Rp.  {!! number_format($order_prev_total, 2,',' , '.') !!}
            </div>
            <div class="widget-subheading font-size-lg">
            @php
            echo App\Http\Controllers\HomeController::getMonthName($prev_month).', '.$year;
            @endphp
            </div>
          </div>
          </div>
          <div class="col-md-6">
          <div class="card-header-tab card-header shadow-lg">
            <div class="card-header-title font-size-md text-capitalize font-weight-normal">
            <i class="header-icon lnr-database mr-3 text-muted opacity-6"> 
            </i>
            @if(isset($order_list_sales))
            @foreach($order_list_sales as $b)
            Sum Order of Current Month by {{$b->salesman_name}}
            @endforeach
            @endif
            </div>
          </div>
          <div class="card mb-3 bg-focus widget-chart text-white card-border">
            <div class="icon-wrapper rounded-circle">
            <div class="icon-wrapper-bg bg-white opacity-10">
            </div>
            <i class="lnr-line-spacing icon-gradient bg-arielle-smile">
            </i>
            </div>
            @if(isset($order_list_sales))
            @foreach($order_list_sales as $b)
            @if( $b->prosentase >= 0 )
            <div class="widget-numbers">
            <i class="fa fa-angle-up text-success">
            </i>  
            Rp.  {!! number_format($order_curr_total, 2,',' , '.') !!}
            </div>
            @else
            <div class="widget-numbers">
            <i class="fa fa-angle-down text-danger">
            </i>  
            Rp.  {!! number_format($order_curr_total, 2,',' , '.') !!}
            </div>
            @endif
            @endforeach
            @endif
            <div class="widget-subheading font-size-lg">
            @php
            echo App\Http\Controllers\HomeController::getMonthName($curr_month).', '.$year;
            @endphp
            </div>
          </div>
          </div>
          <div class="col-lg-12 col-xl-12">
          <div class="main-card mb-3 card">
            <div class="card-body">
            <div id="dashboard_order_sales">
            </div>
            </div>
          </div>
          </div>     
        </div>
      @endif

    </div> 
        <!-------------------------------------------------------------------------------->
        <!---------------------------------- id satu-------------------------------------->
    
        


        <div id = "tampil_dua">
            <div class="row">
                <div class="col-lg-6">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            
                            asdas


                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            
                        asdas


                        </div>
                    </div>
                </div>

            </div>
        </div>






</div>



@if(\Session::has('alert'))
<script>
    var error = "{{ Session::get('alert') }}"
    swal("Error", error, "error");
</script>
@endif

@endsection


@section('contentjs')
<script type="text/javascript" src="{{ asset('outside/highchart/highcharts.js') }}"></script>
<script type="text/javascript" src="{{ asset('outside/highchart/exporting.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
    
    var index = document.getElementById("indexNav");
    index.classList.add("mm-active");

    var satu =  document.getElementById("satu");
    var dua =  document.getElementById("dua");
    var tiga =  document.getElementById("tiga");
    var empat =  document.getElementById("empat");
    var lima =  document.getElementById("lima");
    var enam =  document.getElementById("enam");

    $('#tampil_dua').hide();
    $('#tampil_tiga').hide();
    $('#tampil_empat').hide();
    $('#tampil_lima').hide();
    $('#tampil_enam').hide();

    
    $('#satu').on('click', function(){
        
        dua.classList.remove("active");
        tiga.classList.remove("active");
        empat.classList.remove("active");
        lima.classList.remove("active");
        enam.classList.remove("active");
        satu.classList.add("active")

        $('#tampil_dua').hide();
        $('#tampil_tiga').hide();
        $('#tampil_empat').hide();
        $('#tampil_lima').hide();
        $('#tampil_enam').hide();
        $('#tampil_satu').show();

    });

    $('#dua').on('click', function(){
        
        satu.classList.remove("active")
        tiga.classList.remove("active");
        empat.classList.remove("active");
        lima.classList.remove("active");
        enam.classList.remove("active");
        dua.classList.add("active");
        
        $('#tampil_tiga').hide();
        $('#tampil_empat').hide();
        $('#tampil_lima').hide();
        $('#tampil_enam').hide();
        $('#tampil_satu').hide();
        $('#tampil_dua').show();

    });


    $('#tiga').on('click', function(){
        
        satu.classList.remove("active")
        dua.classList.remove("active");
        empat.classList.remove("active");
        lima.classList.remove("active");
        enam.classList.remove("active");
        tiga.classList.add("active");
        
        $('#tampil_empat').hide();
        $('#tampil_lima').hide();
        $('#tampil_enam').hide();
        $('#tampil_satu').hide();
        $('#tampil_dua').hide();
        $('#tampil_tiga').show();

    });

    $('#empat').on('click', function(){
        
        satu.classList.remove("active")
        dua.classList.remove("active");
        tiga.classList.remove("active");
        lima.classList.remove("active");
        enam.classList.remove("active");
        empat.classList.add("active");
        
        $('#tampil_lima').hide();
        $('#tampil_enam').hide();
        $('#tampil_satu').hide();
        $('#tampil_dua').hide();
        $('#tampil_tiga').hide();
        $('#tampil_empat').show();

    });

    $('#lima').on('click', function(){
        
        satu.classList.remove("active")
        dua.classList.remove("active");
        tiga.classList.remove("active");
        empat.classList.remove("active");
        enam.classList.remove("active");
        lima.classList.add("active");
        
        $('#tampil_enam').hide();
        $('#tampil_satu').hide();
        $('#tampil_dua').hide();
        $('#tampil_tiga').hide();
        $('#tampil_empat').hide();
        $('#tampil_lima').show();

    });

    $('#enam').on('click', function(){
        
        satu.classList.remove("active")
        dua.classList.remove("active");
        tiga.classList.remove("active");
        empat.classList.remove("active");
        lima.classList.remove("active");
        enam.classList.add("active");
        
        $('#tampil_satu').hide();
        $('#tampil_dua').hide();
        $('#tampil_tiga').hide();
        $('#tampil_empat').hide();
        $('#tampil_lima').hide();
        $('#tampil_enam').show();

    });

    

    //Graph
    
    @if(Session::get('GROUPID') == "DEVELOPMENT")

        Highcharts.chart('dashboard_order', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Sum of Order Comparison by All Sales (Previous Month : Current Month)'
            },
            subtitle: {
                ttext: '@php echo App\Http\Controllers\HomeController::getMonthName($prev_month).', '.$year.' : '.App\Http\Controllers\HomeController::getMonthName($curr_month).', '.$year @endphp'
            },
            xAxis: {
                categories: [ '{!! $order_kategori !!}' ],
                title: {
                text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                text: 'Sum of Order',
                align: 'high'
                },
                labels: {
                    formatter: function(){
                        return this.value/1000000 + "M"
                        },
                    },
            },
            tooltip: {
                valueSuffix: ' millions'
                },
                plotOptions: {
                    bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 80,
                floating: true,
                borderWidth: 1,
                backgroundColor:
                Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [{
                name: '@php echo App\Http\Controllers\HomeController::getMonthName($prev_month).', '.$year; @endphp',
                data: [{!! $order_prev !!}]

                }, {
                name: '@php echo App\Http\Controllers\HomeController::getMonthName($curr_month).', '.$year; @endphp',
                data: [{!! $order_curr !!}]

                }]
        });
    
    @endif

    @if(Session::get('GROUPID') == "SALES")
    
        Highcharts.chart('dashboard_order_sales', {
            chart: {
                type: 'column'
            },
            
            title: {
                
                text: 'Sum of Order Comparison'
            },
            subtitle: {
                text: '3 Months Witihin Now'
            },
            xAxis: {
                categories: [ '{!! $order_kategori !!}' ],
                crosshair: true
            },
            yAxis: {
                labels: {
                 formatter: function(){
                     return this.value/1000000 + "M"
                    },
                },
                title: {
                    text: 'Sum of Order'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>Rp. {point.y}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{

                @if(isset($order_list_sales))
                    @foreach($order_list_sales as $b)
                    name: '{{ LTRIM(RTRIM($b->salesman_name)) }}',
                    @endforeach
                @endif
                data: [{!! $order_series !!}]
            }]
        });
    
    @endif


});
</script>

@endsection