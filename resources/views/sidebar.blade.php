<!-- BEGIN: SideNav-->
<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square" id="sidenav">
    <div class="brand-sidebar">
        <h1 class="logo-wrapper">
        <a class="brand-logo darken-1" href="index.html">
            <img class="hide-on-med-and-down" src="{{ asset('img/logo/sunrise-logo.png') }}" style="width: 200px; height: 75px" alt="Sunrise Logo" />
            {{-- <img class="show-on-medium-and-down hide-on-med-and-up" src="{{ asset('img/logo/sunrise-logo.png') }}" alt="Sunrise logo" /> --}}
            {{-- <span class="logo-text hide-on-med-and-down">Materialize</span> --}}
        </a>
        </h1>
    </div>
    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
        <li class="bold" id="Dashboard">
            <a class="collapsible-header waves-effect waves-cyan" href="javascript:void(0)">
                <i class="material-icons">dashboard</i>
                <span class="menu-title">Dashboard</span>
            </a>
            <div class="collapsible-body" id="DashboardCSS">
                <ul class="collapsible collapsible-sub DashboardTree" data-collapsible="accordion">
                    <li>
                        <a href="{{ url('home') }}" id="LiveDataProd">
                            <i class="material-icons">radio_button_unchecked</i>
                            <span>Live Data Production</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('home2') }}" id="ProdSum">
                            <i class="material-icons">radio_button_unchecked</i>
                            <span>Production Summary</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('BlockSchedule') }}" id="BlockSchedule">
                            <i class="material-icons">radio_button_unchecked</i>
                            <span>Block Schedule</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="navigation-header" id="MillProductionHeader">
            <a class="navigation-header-text">Mill Production</a>
        </li>
        <li id="SunriseSystem" class="bold">
            <a class="collapsible-header waves-effect waves-cyan" href="javascript:void(0)">
                <i class="material-icons">insert_chart</i>
                <span class="menu-title">Mill Data Analysis</span>
            </a>
            <div class="collapsible-body" id="SunriseSystemCSS">
                <ul class="collapsible collapsible-sub SunriseSystemTree" data-collapsible="accordion">
                    @if(session()->has('mnuProdAnalysis'))
                    <li>
                        <a href="{{ url('ProductionAnalysis') }}" id="ProductionAnalysis">
                            <i class="material-icons">radio_button_unchecked</i>
                            <span>Production Anaylisis</span>
                        </a>
                    </li>
                    @endif

                    {{-- @if(session()->has('mnuProdAnalysis')) --}}
                    {{-- <li>
                        <a href="{{ url('BlockSchedule') }}" id="BlockSchedule">
                            <i class="material-icons">radio_button_unchecked</i>
                            <span>Block Schedule</span>
                        </a>
                    </li> --}}
                    {{-- @endif --}}
                </ul>
            </div>
        </li>
        <li id="ProductionReport" class="bold">
            <a class="collapsible-header waves-effect waves-cyan" href="javascript:void(0)">
                <i class="material-icons">library_books</i>
                <span class="menu-title">Production Report</span>
            </a>
            <div class="collapsible-body" id="ProductionReportCSS">
                <ul class="collapsible collapsible-sub ProductionReportTree" data-collapsible="accordion">
                    @if(session()->has('mnuFreeCoilReport'))
                    <li>
                        <a href="{{ url('FreeCoilReport') }}" id="FreeCoilReport">
                            <i class="material-icons">radio_button_unchecked</i>
                            <span>Free Coil Report</span>
                        </a>
                    </li>
                    @endif
                    
                    @if(session()->has('mnuCRCAvailability'))
                    <li>
                        <a href="{{ url('CRCAvailability') }}" id="CRCAvailability">
                            <i class="material-icons">radio_button_unchecked</i>
                            <span>CRC Availability</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </li>

        <li class="navigation-header" id="SalesMarketingHeader">
            <a class="navigation-header-text">Sales Marketing</a>
        </li>
        <li id="SalesDataAnalysis" class="bold">
            <a class="collapsible-header waves-effect waves-cyan" href="javascript:void(0)">
                <i class="material-icons">insert_chart</i>
                <span class="menu-title">Sales Marketing Analysis</span>
            </a>
            <div class="collapsible-body" id="SalesDataAnalysisCSS">
                <ul class="collapsible collapsible-sub SalesDataAnalysisTree" data-collapsible="accordion">
                    @if(session()->has('mnuSCShipmentAnalysis'))
                    <li>
                        <a href="{{ url('ScShipmentAnalysis') }}" id="ScShipmentAnalysis">
                            <i class="material-icons">radio_button_unchecked</i>
                            <span>SC & Dispatch Anaylisis</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </li>
        <li id="SalesActivity">
            <a class="collapsible-header waves-effect waves-cyan" href="javascript:void(0)">
                <i class="material-icons">accessibility</i>
                <span class="menu-title">Sales Activity</span>
            </a>
            <div class="collapsible-body" id="SalesActivityCSS">
                <ul class="collapsible collapsible-sub SalesActivityTree" data-collapsible="accordion">
                    @if(session()->has('mnuTodayVisit'))
                    <li>
                        <a href="{{ url('TodayVisit') }}" id="TodayVisit">
                            <i class="material-icons">radio_button_unchecked</i>
                            <span>Today Visit</span>
                        </a>
                    </li>
                    @endif
                    @if(session()->has('mnuCustomerVisit'))
                    <li>
                        <a href="{{ url('CustomerVisit') }}" id="CustomerVisit">
                            <i class="material-icons">radio_button_unchecked</i>
                            <span>Customer Visit</span>
                        </a>
                    </li>
                    @endif
                    @if(session()->has('mnuActivityReport'))
                    <li>
                        <a href="{{ url('ActivityReport') }}" id="ActivityReport">
                            <i class="material-icons">radio_button_unchecked</i>
                            <span>Activity Report</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </li>

        <li class="navigation-header" id="FinanceHeader">
            <a class="navigation-header-text">Finance</a>
        </li>
        <li id="Report" class="bold">
            <a class="collapsible-header waves-effect waves-cyan" href="javascript:void(0)">
                <i class="material-icons">receipt</i>
                <span class="menu-title">Finance Report</span>
            </a>
            <div class="collapsible-body" id="ReportCSS">
                <ul class="collapsible collapsible-sub ReportTree" data-collapsible="accordion">
                    @if(session()->has('mnuPOReport') or Session::get('FIN_REPORT') == 'Y')
                    <li>
                        <a href="{{ url('POReport') }}" id="POReport">
                            <i class="material-icons">radio_button_unchecked</i>
                            <span>Purchase Order</span>
                        </a>
                    </li>
                    @endif
                    @if(session()->has('mnuHutang') or Session::get('FIN_REPORT') == 'Y')
                    <li>
                        <a href="{{ url('Hutang') }}" id="Hutang">
                            <i class="material-icons">radio_button_unchecked</i>
                            <span>Hutang</span>
                        </a>
                    </li>
                    @endif
                    @if(session()->has('mnuPiutang') or Session::get('FIN_REPORT') == 'Y')
                    <li>
                        <a href="{{ url('Piutang') }}" id="Piutang">
                            <i class="material-icons">radio_button_unchecked</i>
                            <span>Piutang</span>
                        </a>
                    </li>
                    @endif
                    @if(session()->has('mnuCashFlow') or Session::get('FIN_REPORT') == 'Y')
                    <li>
                        <a href="{{ url('Cashflow') }}" id="Cashflow">
                            <i class="material-icons">radio_button_unchecked</i>
                            <span>Cash Flow</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </li>
        <li id="Purchase" class="bold">
            <a class="collapsible-header waves-effect waves-cyan" href="javascript:void(0)">
                <i class="material-icons">playlist_add_check</i>
                <span class="menu-title">Finance Approval</span>
            </a>
            <div class="collapsible-body" id="PurchaseCSS">
                <ul class="collapsible collapsible-sub PurchaseTree" data-collapsible="accordion" >
                    @if(session()->has('mnuPruApproval'))
                    <li>
                        <a href="{{ url('PruApp') }}" id="PruApp">
                            <i class="material-icons">radio_button_unchecked</i>
                            <span>PRU Approval</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </li>

        <li class="navigation-header" id="EApprovalHeader">
            <a class="navigation-header-text">E-Approval</a>
        </li>
        <li id="MPF" class="bold">
            <a class="collapsible-header waves-effect waves-cyan" href="javascript:void(0)">
                <i class="material-icons">format_list_bulleted</i>
                <span class="menu-title">Multi-Purpose Form</span>
            </a>
            <div class="collapsible-body" id="MPFCSS">
                <ul class="collapsible collapsible-sub MPFTree" data-collapsible="accordion">
                   
                    <li>
                        <a href="{{ url('CreateMPF') }}" id="CreateMPF">
                            <i class="material-icons">radio_button_unchecked</i>
                            <span>Create MPF</span>
                        </a>
                    </li>
                   
                    <li>
                        <a href="{{ url('ListMPF') }}" id="ListMPF">
                            <i class="material-icons">radio_button_unchecked</i>
                            <span>MPF List</span>
                        </a>
                    </li>
                   
                    <li>
                        <a href="{{ url('CcBccMPF') }}" id="CcMPF">
                            <i class="material-icons">radio_button_unchecked</i>
                            <span>MPF Cc/Bcc</span>
                        </a>
                    </li> 
                </ul>
            </div>
        </li>
        

        {{-- <li class="navigation-header" id="PreOrderHeader">
            <a class="navigation-header-text">Sales Order</a>
        </li>
        <li id="PreOrder" class="bold">
            <a class="collapsible-header waves-effect waves-cyan" href="javascript:void(0)">
                <i class="material-icons">add_shopping_cart</i>
                <span class="menu-title">Pre order</span>
            </a>
            <div class="collapsible-body" id="PreOrderCSS">
                <ul class="collapsible collapsible-sub PreOrderTree" data-collapsible="accordion" >
                    @if(session()->has('mnuCreateOrder'))
                    <li>
                        <a href="{{ url('CreatePreOrder') }}" id="CreatePreOrder">
                            <i class="material-icons">radio_button_unchecked</i>
                            <span id="PreOrderSpan">Create Pre Order</span>
                        </a>
                    </li>
                    @endif
                    @if(session()->has('mnuListOrder'))
                    <li>
                        <a href="{{ url('ListPreOrder') }}" id="ListPreOrder">
                            <i class="material-icons">radio_button_unchecked</i>
                            <span id="ListPreOrderSpan">List PreOrder</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </li> --}}

       

        <li class="navigation-header" id="UsrManageHeader">
            <a class="navigation-header-text">User</a>
        </li>
        <li id="UsrManage">
            <a class="collapsible-header waves-effect waves-cyan" href="javascript:void(0)">
                <i class="material-icons">group</i>
                <span class="menu-title">User Management</span>
            </a>
            <div class="collapsible-body" id="UsrManageCSS">
                <ul class="collapsible collapsible-sub UsrManageTree" data-collapsible="accordion">
                    @if(session()->has('mnuChangePass'))
                    <li>
                        <a href="{{ url('ChangePassword') }}" id="changepass">
                            <i class="material-icons">radio_button_unchecked</i>
                            <span>Change Password</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </li>


    </ul>
        <div class="navigation-background"></div>
        <a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium
        teal gradient-shadow waves-effect waves-light hide-on-large-only"
        href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
    </aside>
<!-- END: SideNav-->
