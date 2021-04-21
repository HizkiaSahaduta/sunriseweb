@extends('main')

@section('contentcss')
<link rel="stylesheet" type="text/css" href="{{ asset('outside/material/vendors/animate-css/animate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('outside/material/vendors/materialize-stepper/materialize-stepper.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('outside/material/css/pages/form-wizard.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('outside/material/vendors/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('outside/material/vendors/select2/select2-materialize.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('outside/material/css/pages/app-invoice.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" />
<style>
.dataTables_wrapper {
    font-family: muli;
    font-size: 14px;
    position: relative;
    clear: both;
}
td.details-control {
    background: url('https://cdn.rawgit.com/DataTables/DataTables/6c7ada53ebc228ea9bc28b1b216e793b1825d188/examples/resources/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('https://cdn.rawgit.com/DataTables/DataTables/6c7ada53ebc228ea9bc28b1b216e793b1825d188/examples/resources/details_close.png') no-repeat center center;
}
</style>
@endsection

@section('content')

<!-- BEGIN: Page Main-->
<div class="row">
   <div class="content-wrapper-before gradient-45deg-green-teal"></div>
<!-- BEGIN: Breadcrumb-->
   <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
      <div class="container">
         <div class="row">
            <div class="col s10 m6 l6">
               <h5 class="breadcrumbs-title mt-0 mb-0"><span>Edit PreOrder</span></h5>
               <ol class="breadcrumbs mb-0">
                  {{-- <li class="breadcrumb-item ">
                     <a href="#">Home</a>
                  </li> --}}
                  <li class="breadcrumb-item ">
                     <a href="#">Sales Order</a>
                  </li>
                  <li class="breadcrumb-item">
                     <a href="#">Edit PreOrder</a>
                  </li>
               </ol>
            </div>
         </div>
      </div>
   </div>
<!-- End: Breadcrumb-->
<div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <div class="card-header">
            <h4 class="card-title">PreOrder Form Wizard</h4>
          </div>

            <span class="red-text" id="red-text">* required field</span>
            <input type="hidden" value="{{ $book_id }}" id="setBookId">

          <ul class="stepper linear" id="linearStepper">

            <li class="step active" id="step1">
              <div class="step-title waves-effect">Order Header</div>
              <div class="step-content">
                <div class="row" id="sel_cust">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">search</i>
                        <select class="browser-default validate" id="search_cust" name="search_cust">
                        <option value="{{ $cust_id }}" selected>{{ $cust_id." || ".$ship_to }}</option>
                        </select>
                        <label>Find Customer</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col m6 s12" id="input_id">
                        <i class="material-icons prefix">assignment_ind</i>
                        <input type="text" value="{{ $cust_id }}" class="validate" id="customerid" name="customerid" placeholder="Customer ID goes here" required readonly="readonly"/>
                        <label>Customer ID <span class="red-text">*</span></label>
                    </div>
                    <div class="input-field col m6 s12" id="input_name">
                        <i class="material-icons prefix">person_pin</i>
                        <input type="text" value="{{ $cust_name }}" class="validate" id="customername" name="customername" placeholder="Customer Name goes here" required readonly="readonly"/>
                        <label>Customer Name <span class="red-text">*</span></label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col m6 s12">
                        <i class="material-icons prefix">business</i>
                        <input type="text" value="{{ $cust_address }}" class="validate" id="customeraddress" name="customeraddress" placeholder="Customer Address goes here" required readonly="readonly"/>
                        <label>Customer Address <span class="red-text">*</span></label>
                    </div>
                    <div class="input-field col m6 s12">
                        <i class="material-icons prefix">phone</i>
                        <input type="text" value="{{ $phone }}" class="validate" id="customerphone" name="customerphone" placeholder="Customer phone goes here" required readonly="readonly"/>
                        <label>Customer Phone <span class="red-text">*</span></label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">local_shipping</i>
                        <select class="browser-default" id="consignee" name="consignee">
                        <option></option>
                        </select>
                        <label><div id="consignee_badge"></div>Consignee <span class="red-text">*</span></label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col m6 s12">
                        <i class="material-icons prefix">supervisor_account</i>
                        <select class="browser-default" id="salesid" name="salesid">
                        @if(isset($listsales))
                        @if(Session::get('GROUPID') == 'SALES')
                        @foreach($listsales as $o)
                        @if ($o->salesman_id == $salesman_id)
                        <option value='{{ $o->salesman_id }}' selected>{{ $o->salesman_name }}</option>
                        @else
                        <option value='{{ $o->salesman_id }}' selected>{{ $o->salesman_name }}</option>
                        @endif
                        @endforeach

                        @elseif(Session::get('GROUPID') == 'PRIV' || Session::get('GROUPID') == 'KOORDINATOR' || Session::get('GROUPID') == 'DEVELOPMENT')
                        <option></option>
                        @foreach($listsales as $o)
                        @if ($o->salesman_id == $salesman_id)
                        <option value='{{ $o->salesman_id }}' selected>{{ $o->salesman_name }}</option>
                        @else
                        <option value='{{ $o->salesman_id }}'>{{ $o->salesman_name }}</option>
                        @endif
                        @endforeach

                        @endif
                        @endif
                        </select>
                        <label>Salesman</label>
                    </div>
                    <div class="input-field col m6 s12">
                        <i class="material-icons prefix">settings_applications</i>
                        <select id="proj_flag" name="proj_flag">
                            @if ( $proj_flag == 'T')
                            <option value="N">Non Project</option>
                            <option value="T" selected>Project</option>
                            @else
                            <option value="N" selected>Non Project</option>
                            <option value="T">Project</option>
                            @endif
                        </select>
                        <label>Project Flag</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col m6 s12">
                        <i class="material-icons prefix">payment</i>
                        <select class="browser-default" id="payment" name="payment">
                        <option></option>
                        </select>
                        <label>Payment Terms</label>
                    </div>
                    <div class="input-field col m6 s12">
                        <i class="material-icons prefix">confirmation_number</i>
                        <input type="text" value="{{ $cust_po_num }}" class="validate" id="cust_po_num" name="cust_po_num" placeholder="Cust. PO Number goes here"/>
                        <label>Cust. PO Number</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">edit</i>
                        <textarea id="remark1" name="remark1" class="materialize-textarea" placeholder="Remark goes here">{{ $remark1 }}</textarea>
                        <label>Remark</label>
                    </div>
                </div>
                 <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">edit</i>
                        <textarea id="remark2" name="remark2" class="materialize-textarea" placeholder="Remark goes here">{{ $remark2 }}</textarea>
                        <label>Additional Remark</label>
                    </div>
                </div>
                <div class="step-actions">
                  <div class="row">
                    {{-- <div class="col m4 s12 mb-3">
                      <button class="red btn btn-reset" type="reset">
                        <i class="material-icons left">clear</i>Reset
                      </button>
                    </div> --}}
                    <div class="col m6 s12 mb-3">
                      <button class="btn btn-light previous-step" disabled>
                        <i class="material-icons left">arrow_back</i>
                        Prev
                      </button>
                    </div>
                    <div class="col m6 s12 mb-3">
                      <button id="toStep2" class="waves-effect waves dark btn btn-primary green next-step" type="submit">
                        Next
                        <i class="material-icons right">arrow_forward</i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </li>

            <li class="step" id="step2">
              <div class="step-title waves-effect" id="divToStep2">Order Items</div>
              <div class="step-content">
                {{-- step2 goes here --}}

                <div class="row">
                    <div class="row" id="divInvoiceNo">
                        <div class="col xl4 s12">
                        <span>BookId#</span>
                        <span id="InvoiceNo"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m9 s12">
                          <div class="divider show-on-small hide-on-med-and-up mb-3"></div>
                          <h6>Bill To</h6>
                          <div>
                            <span id="custName"></span>
                          </div>
                          <div>
                            <span id="custAddress"></span>
                          </div>
                          <div>
                            <span id="custPhone"></span>
                          </div>
                          <h6>Ship To</h6>
                          <div>
                            <span id="shipTo"></span>
                          </div>
                            <br>
                            <button class="btn-small green" id="add">
                            <i class="material-icons left">add_circle</i>Item</button>
                        </div>
                        {{-- <div class="col m3 s12 push-m1">
                            <br>
                            <a class="btn-small green modal-trigger" href="#searchModal">
                            <i class="material-icons left">add_circle</i>Item</a>
                        </div> --}}
                      </div>

                    <!-- Item List -->
                    <div>
                        <div class="divider mb-3 mt-3"></div>
                        {{-- <p>Item list</p> --}}
                        <div id="tableItem">
                            <h6>Your item list:</h6>
                            <table class="striped" role="grid" style="width:100%" id="orderItem">
                                <thead>
                                <tr>
                                    <th class="center">Detail</th>
                                    <th class="center">No</th>
                                    <th>Descr</th>
                                    <th class="center">Action</th>
                                </tr>
                               </thead>
                           </table>
                        </div>
                        <div class="card-alert card grey darken-3" id="infoItem" style="display: none">
                            <div class="card-content white-text">
                            <p>
                            <i class="material-icons">info_outline</i> INFO : You haven't adding item in this order yet</p>
                            </div>
                            <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                            </button>
                         </div>
                    </div>
                    <div class="divider mb-3 mt-3"></div>
                    <!-- End item list -->

                    <!-- begin search form -->
                    <div id="searchForm" style="display: none">
                        {{-- <div class="divider mb-3 mt-3"></div> --}}
                        <p>Here's form to add an item to this order using product search.</p>
                        If you wanna adding an item without searching product first, you can use <a href="javascript:void(0)" id="byremark"
                        class="green-text animated infinite flash">this</a> instead.
                        <a class="btn-flat mb-1 waves-effect right close"><i class="material-icons left">clear</i>
                        Close</a></p>
                        <br>
                        <div class="row">
                            <div class="input-field col m6 s12">
                                <i class="material-icons prefix">layers</i>
                                <select class="browser-default" id="commodity" name="commodity">
                                <option></option>
                                </select>
                                <label>Commodity</label>
                            </div>
                            <div class="input-field col m6 s12">
                                <i class="material-icons prefix">branding_watermark</i>
                                <select class="browser-default" id="brand" name="brand">
                                <option></option>
                                </select>
                                <label>Brand</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col m6 s12">
                                <i class="material-icons prefix">line_weight</i>
                                <select class="browser-default" id="coat" name="coat">
                                <option></option>
                                </select>
                                <label>BrandCoat (AS-AZ)</label>
                            </div>
                            <div class="input-field col m6 s12">
                                <i class="material-icons prefix">grade</i>
                                <select class="browser-default" id="grade" name="grade">
                                <option></option>
                                </select>
                                <label>Grade</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col m4 s12">
                                <i class="material-icons prefix">unfold_more</i>
                                <select class="browser-default" id="thick" name="thick">
                                <option></option>
                                </select>
                                <label><div id="thick_badge"></div>Thickness</label>
                            </div>
                            <div class="input-field col m4 s12">
                                <i class="material-icons prefix">swap_horiz</i>
                                <select class="browser-default" id="width" name="width" >
                                <option></option>
                                </select>
                                <label><div id="width_badge"></div>Width</label>
                            </div>
                            <div class="input-field col m4 s12">
                                <i class="material-icons prefix">color_lens</i>
                                <select class="browser-default" id="colour" name="colour">
                                <option></option>
                                </select>
                                <label><div id="colour_badge"></div>Colour</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">library_books</i>
                                <select class="browser-default" id="product" name="product">
                                <option></option>
                                </select>
                                <label><div id="product_badge">
                                    <span class="new badge red" data-badge-caption="not ready"></span>
                                </div>Product</label>
                            </div>
                        </div>
                        <div class="divider mb-3 mt-3"></div>
                    </div>
                    <!-- end search form -->

                    <!-- begin attribut form -->
                    <div id="attributForm" style="display: none">
                        <!-- Info1 -->
                        <div id="attributFormInfo1" style="display: none">
                        <p>Here's form to add an item to this order without searching product first.</p>
                        <p>If you prefer adding an item using product search, you can use <a href="javascript:void(0)" id="byproduct"
                        class="green-text animated infinite flash">this</a> instead.
                        <a class="btn-flat mb-1 waves-effect right close"><i class="material-icons left">clear</i>
                        Close</a></p>
                        <br>
                        </div>

                        <!-- Info2 -->
                        <div id="attributFormInfo2" style="display: none">
                        <p>Here's product attribute form that you might filled in for an item you've added above</p>
                        <br>
                        </div>
                        <div class="row">
                            <div class="input-field col m4 s12">
                                <i class="material-icons prefix">work</i>
                                <input type="number" min="0" step="10" onkeyup="if(this.value<0){this.value= this.value * -1};" id="weight" name="weight" placeholder="Weight goes here"/>
                                <label>Weight (KG)</label>
                            </div>
                            <div class="input-field col m4 s12">
                                <i class="material-icons prefix">account_balance_wallet</i>
                                <input type="number" min="0" step="10" onkeyup="if(this.value<0){this.value= this.value * -1};" id="price" name="price" placeholder="Price goes here"/>
                                <label>Unit Price</label>
                            </div>
                            <div class="input-field col m4 s12">
                                <i class="material-icons prefix">account_balance_wallet</i>
                                <input type="number" id="amt_gross" name="amt_gross" placeholder="Amount gross goes here" readonly/>
                                <label>Amount Gross</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col m4 s12">
                                <i class="material-icons prefix">confirmation_number</i>
                                <input type="number" min="0" step="1" onkeyup="if(this.value<0){this.value= this.value * -1};" id="pct_disc" name="pct_disc" placeholder="% discount goes here"/>
                                <label>Discount (%)</label>
                            </div>
                            <div class="input-field col m4 s12">
                                <i class="material-icons prefix">account_balance_wallet</i>
                                <input type="number" min="0" step="1" onkeyup="if(this.value<0){this.value= this.value * -1};" id="amt_disc" name="amt_disc" placeholder="Amount discount goes here"/>
                                <label>Amount Discount</label>
                            </div>
                            <div class="input-field col m4 s12">
                                <i class="material-icons prefix">account_balance_wallet</i>
                                <input type="number" id="amt_net" name="amt_net" placeholder="Amount net goes here" readonly/>
                                <label>Amount Net</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col m6 s12">
                                <i class="material-icons prefix">edit</i>
                                <textarea id="atr_remark" name="atr_remark" class="materialize-textarea" placeholder="Remark goes here"></textarea>
                                <label>Remark</label>
                            </div>
                            <div class="input-field col m6 s12">
                                <i class="material-icons prefix">apps</i>
                                <select class="browser-default" id="appl_note" name="appl_note">
                                <option></option>
                                </select>
                                <label>Appl Note</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col m3 s12">
                                <i class="material-icons prefix">date_range</i>
                                <input type="text" class="datepicker" name="req_date" id="req_date" placeholder="Req. date" readonly="readonly">
                                <label>Request Date</label>
                            </div>
                            <div class="input-field col m3 s12">
                                <i class="material-icons prefix">date_range</i>
                                <select class="browser-default" id="req_week" name="req_week">
                                <option></option>
                                <option value="1st Week">1st Week</option>
                                <option value="2nd Week">2nd Week</option>
                                <option value="3rd Week">3rd Week</option>
                                <option value="4th Week">4th Week</option>
                                <option value="5th Week">5th Week</option>
                                </select>
                                <label>Request Week</label>
                            </div>
                            <div class="input-field col m3 s12">
                                <i class="material-icons prefix">date_range</i>
                                <select class="browser-default" id="req_month" name="req_month">
                                <option></option>
                                <option value="Jan">Jan</option>
                                <option value="Feb">Feb</option>
                                <option value="Mar">Mar</option>
                                <option value="Apr">Apr</option>
                                <option value="May">May</option>
                                <option value="Jun">Jun</option>
                                <option value="Jul">Jul</option>
                                <option value="Aug">Aug</option>
                                <option value="Sep">Sep</option>
                                <option value="Oct">Oct</option>
                                <option value="Nov">Nov</option>
                                <option value="Dec">Dec</option>
                                </select>
                                <label>Request Month</label>
                            </div>
                            <div class="input-field col m3 s12">
                                <i class="material-icons prefix">date_range</i>
                                <select class="browser-default" id="req_year" name="req_year">
                                <option></option>

                                @for ($i = $year_now; $i <= $year_later; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor

                                </select>
                                <label>Request Year</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                            <button id="saveOrderItem" name="saveOrderItem" class="waves-effect waves dark btn green btn-block" type="submit">
                            Add Item</button>
                            </div>
                        </div>
                    </div>
                    <!-- end attribut form -->
                </div>
                <div class="step-actions">
                  <div class="row">
                    <div class="col m4 s12 mb-3">
                        <button class="btn green btn-light previous-step">
                           <i class="material-icons left">arrow_back</i>
                           Prev
                       </button>
                    </div>
                    <div class="col m4 s12 mb-3">
                       <button class="red btn" id="confirmLater">
                         <i class="material-icons left">settings_backup_restore</i>
                         Later
                       </button>
                    </div>
                    <div class="col m4 s12 mb-3">
                      <button id="toStep3" class="waves-effect waves dark btn btn-primary green next-step" type="submit">
                        Submit
                        <i class="material-icons right">arrow_forward</i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </li>

            {{-- <li class="step">
              <div class="step-title waves-effect" id="step3">Preview Order</div>
              <div class="step-content">

                <section class="invoice-view-wrapper section">
                    <div class="row">
                      <div class="col xl9 m8 s12">
                        <div class="card">
                          <div class="card-content invoice-print-area">
                            <div class="row invoice-date-number">
                              <div class="col xl4 s12">
                                <span class="invoice-number mr-1">Invoice#</span>
                                <span>000756</span>
                              </div>
                              <div class="col xl8 s12">
                                <div class="invoice-date display-flex align-items-center flex-wrap">
                                  <div class="mr-3">
                                    <small>Date Issue:</small>
                                    <span>08/10/2019</span>
                                  </div>
                                  <div>
                                    <small>Date Due:</small>
                                    <span>08/10/2019</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="row mt-3 invoice-logo-title">
                              <div class="col m6 s12 display-flex invoice-logo mt-1 push-m6">
                              </div>
                              <div class="col m6 s12 pull-m6">
                                <h4 class="indigo-text">Invoice</h4>
                                <span>Software Development</span>
                              </div>
                            </div>
                            <div class="divider mb-3 mt-3"></div>
                            <div class="row invoice-info">
                              <div class="col m6 s12">
                                <h6 class="invoice-from">Bill From</h6>
                                <div class="invoice-address">
                                  <span>Clevision PVT. LTD.</span>
                                </div>
                                <div class="invoice-address">
                                  <span>9205 Whitemarsh Street New York, NY 10002</span>
                                </div>
                                <div class="invoice-address">
                                  <span>hello@clevision.net</span>
                                </div>
                                <div class="invoice-address">
                                  <span>601-678-8022</span>
                                </div>
                              </div>
                              <div class="col m6 s12">
                                <h6 class="invoice-to">Bill To</h6>
                                <div class="invoice-address">
                                  <span>Pixinvent PVT. LTD.</span>
                                </div>
                                <div class="invoice-address">
                                  <span>203 Sussex St. Suite B Waukegan, IL 60085</span>
                                </div>
                                <div class="invoice-address">
                                  <span>pixinvent@gmail.com</span>
                                </div>
                                <div class="invoice-address">
                                  <span>987-352-5603</span>
                                </div>
                              </div>
                            </div>
                            <div class="divider mb-3 mt-3"></div>
                            <div class="invoice-product-details">
                              <table class="striped responsive-table">
                                <thead>
                                  <tr>
                                    <th>Item</th>
                                    <th>Description</th>
                                    <th>Cost</th>
                                    <th>Qty</th>
                                    <th class="right-align">Price</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>Frest Admin</td>
                                    <td>HTML Admin Template</td>
                                    <td>28</td>
                                    <td>1</td>
                                    <td class="indigo-text right-align">$28.00</td>
                                  </tr>
                                  <tr>
                                    <td>Apex Admin</td>
                                    <td>Anguler Admin Template</td>
                                    <td>24</td>
                                    <td>1</td>
                                    <td class="indigo-text right-align">$24.00</td>
                                  </tr>
                                  <tr>
                                    <td>Stack Admin</td>
                                    <td>HTML Admin Template</td>
                                    <td>24</td>
                                    <td>1</td>
                                    <td class="indigo-text right-align">$24.00</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                            <div class="divider mt-3 mb-3"></div>
                            <div class="invoice-subtotal">
                              <div class="row">
                                <div class="col m5 s12">
                                  <p>Thanks for your business.</p>
                                </div>
                                <div class="col xl4 m7 s12 offset-xl3">
                                  <ul>
                                    <li class="display-flex justify-content-between">
                                      <span class="invoice-subtotal-title">Subtotal</span>
                                      <h6 class="invoice-subtotal-value">$72.00</h6>
                                    </li>
                                    <li class="display-flex justify-content-between">
                                      <span class="invoice-subtotal-title">Discount</span>
                                      <h6 class="invoice-subtotal-value">- $ 09.60</h6>
                                    </li>
                                    <li class="display-flex justify-content-between">
                                      <span class="invoice-subtotal-title">Tax</span>
                                      <h6 class="invoice-subtotal-value">21%</h6>
                                    </li>
                                    <li class="divider mt-2 mb-2"></li>
                                    <li class="display-flex justify-content-between">
                                      <span class="invoice-subtotal-title">Invoice Total</span>
                                      <h6 class="invoice-subtotal-value">$ 61.40</h6>
                                    </li>
                                    <li class="display-flex justify-content-between">
                                      <span class="invoice-subtotal-title">Paid to date</span>
                                      <h6 class="invoice-subtotal-value">- $ 00.00</h6>
                                    </li>
                                    <li class="display-flex justify-content-between">
                                      <span class="invoice-subtotal-title">Balance (USD)</span>
                                      <h6 class="invoice-subtotal-value">$ 10,953</h6>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col xl3 m4 s12">
                        <div class="card invoice-action-wrapper">
                          <div class="card-content">
                            <div class="invoice-action-btn">
                              <a href="#"
                                class="btn indigo waves-effect waves-light display-flex align-items-center justify-content-center">
                                <i class="material-icons mr-4">check</i>
                                <span class="text-nowrap">Send Invoice</span>
                              </a>
                            </div>
                            <div class="invoice-action-btn">
                              <a href="#" id="print" class="btn-block btn btn-light-indigo waves-effect waves-light invoice-print">
                                <span>Print</span>
                              </a>
                            </div>
                            <div class="invoice-action-btn">
                              <a href="app-invoice-edit.html" class="btn-block btn btn-light-indigo waves-effect waves-light">
                                <span>Edit Invoice</span>
                              </a>
                            </div>
                            <div class="invoice-action-btn">
                              <a href="#" class="btn waves-effect waves-light display-flex align-items-center justify-content-center">
                                <i class="material-icons mr-3">attach_money</i>
                                <span class="text-nowrap">Add Payment</span>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>








                <div class="step-actions">
                  <div class="row">
                    </div>
                    <div class="col m6 s12 mb-1">
                      <button class="waves-effect waves-dark btn btn-primary" type="submit">Submit</button>
                    </div>
                  </div>
                </div>
              </div>
            </li> --}}

          </ul>
        </div>
      </div>
    </div>
  </div>


</div>
<!-- END: Page Main-->

@endsection

@section('contentjs')
<script src="{{ asset('outside/material/js/scripts/css-animation.js') }}"></script>
<script src="{{ asset('outside/material/vendors/materialize-stepper/materialize-stepper.min.js') }}"></script>
<script src="{{ asset('outside/material/js/scripts/form-wizard.js') }}"></script>
<script src="{{ asset('outside/material/vendors/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('outside/material/js/scripts/ui-alerts.js') }}"></script>
<script src="{{ asset('outside/material/js/scripts/app-invoice.js') }}"></script>
{{-- <script src="{{ asset('js/printThis.js') }}"></script> --}}
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">

var setBookId = $('#setBookId').val();
var cek_bottom_price;
// List Function
function listConsignee(){
    html = "<span class='new badge green' data-badge-caption='bound'>Cust.</span>";
    $('#consignee_badge').empty();
    $('#consignee_badge').append(html);

    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "{{url('order_consignee/id=')}}{{$cust_id}}",
            success: function (data) {
                $('select[name="consignee"]').empty();
                $('select[name="consignee"]').prepend('<option></option>');
                    $.each(data, function(index, element) {
                        if ( element.cons_id == '{{ $cons_id }}') {
                            $('select[name="consignee"]').append('<option value="'+element.cons_id+'" selected>'+element.cons_name+
                            ' ( '+element.address1+' )</option>');
                        }
                        else {
                            $('select[name="consignee"]').append('<option value="'+element.cons_id+'">'+element.cons_name+
                            ' ( '+element.address1+' )</option>');
                        }
                    });
            }
    });
    $('#consignee').select2({
        placeholder: 'Choose consignee below',
        allowClear: true
    });

}

function listPayment(){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "{{url('listPay')}}",
        success: function (data) {
            $('select[name="payment"]').empty();
            $('select[name="payment"]').prepend('<option></option>');
            $.each(data, function(index, element) {
                if ( element.pay_term_id == '{{ $pay_term_id }}') {
                    $('select[name="payment"]').append('<option value="'+element.pay_term_id+'" selected>'+element.pay_term_desc+'</option>');
                }
                else {
                    $('select[name="payment"]').append('<option value="'+element.pay_term_id+'">'+element.pay_term_desc+'</option>');
                }
            });
        }
    });

    $('#payment').select2({
        placeholder: 'Choose payment below',
        allowClear: true
    });

}

function listCommodity(){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "{{url('listCommodity')}}",
        success: function (data) {
            $('select[name="commodity"]').empty();
            $('select[name="commodity"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="commodity"]').append('<option value="'+element.commodity_id+'">'+element.descr+'</option>');
            });
        }
    });

    $('#commodity').select2({
        placeholder: 'Choose commodity below',
        allowClear: true
    });

}

function listBrand(){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "{{url('listBrand')}}",
        success: function (data) {
            $('select[name="brand"]').empty();
            $('select[name="brand"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="brand"]').append('<option value="'+element.brand_id+'">'+element.descr+'</option>');
            });
        }
    });

    $('#brand').select2({
        placeholder: 'Choose brand below',
        allowClear: true
    });

}

function listCoat(){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "{{url('listCoat')}}",
        success: function (data) {
            $('select[name="coat"]').empty();
            $('select[name="coat"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="coat"]').append('<option value="'+element.coat_mass+'">AS'+element.coat_mass+' | '+element.brand_name+'</option>');
            });
        }
    });

    $('#coat').select2({
        placeholder: 'Choose coat below',
        allowClear: true
    });

}

function listGrade(){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "{{url('listGrade')}}",
        success: function (data) {
            $('select[name="grade"]').empty();
            $('select[name="grade"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="grade"]').append('<option value="'+element.grade_id+'">'+element.grade_id+'</option>');
            });
        }
    });

    $('#grade').select2({
        placeholder: 'Choose grade below',
        allowClear: true
    });

}

function listAppl(){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "{{url('listAppl')}}",
        success: function (data) {
            $('select[name="appl_note"]').empty();
            $('select[name="appl_note"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="appl_note"]').append('<option value="'+element.appl_name+'">'+element.appl_name+'</option>');
            });
        }
    });

    $('#appl_note').select2({
        placeholder: 'Choose appl below',
        allowClear: true
    });

}

function listReqWeek(){
    $('#req_week').select2({
        placeholder: "Choose week",
    });
}

function listReqMonth(){
    $('#req_month').select2({
        placeholder: "Choose month",
    });
}

function listReqYear(){
    $('#req_year').select2({
        placeholder: "Choose year",
    });
}

function allThickness(){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "{{url('allThickness')}}",
        success: function (data) {
            $('select[name="thick"]').empty();
            $('select[name="thick"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="thick"]').append('<option value="'+parseFloat(element.thick).toFixed(2)+'">'
            +parseFloat(element.thick).toFixed(2)+'</option>');
            });
        }
    });

    $('#thick').select2({
        placeholder: 'Choose thickness below',
        allowClear: true
    });

}

function commodityThickness(id){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "{{url('commodityThickness/id=')}}"+id,
        success: function (data) {
            $('select[name="thick"]').empty();
            $('select[name="thick"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="thick"]').append('<option value="'+parseFloat(element.thick).toFixed(2)+'">'
            +parseFloat(element.thick).toFixed(2)+'</option>');
            });
        }
    });

    $('#thick').select2({
        placeholder: 'Choose thickness below',
        allowClear: true
    });

}

function brandThickness(id){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "{{url('brandThickness/id=')}}"+id,
        success: function (data) {
            $('select[name="thick"]').empty();
            $('select[name="thick"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="thick"]').append('<option value="'+parseFloat(element.thick).toFixed(2)+'">'
            +parseFloat(element.thick).toFixed(2)+'</option>');
            });
        }
    });

    $('#thick').select2({
        placeholder: 'Choose thickness below',
        allowClear: true
    });

}

function getThickness(a, b){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "{{url('getThickness/a=')}}"+a+ "&b=" +b,
        success: function (data) {
            $('select[name="thick"]').empty();
            $('select[name="thick"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="thick"]').append('<option value="'+parseFloat(element.thick).toFixed(2)+'">'
            +parseFloat(element.thick).toFixed(2)+'</option>');
            });
        }
    });

    $('#thick').select2({
        placeholder: 'Choose thickness below',
        allowClear: true
    });

}

function allWidth(){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "{{url('allWidth')}}",
        success: function (data) {
            $('select[name="width"]').empty();
            $('select[name="width"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="width"]').append('<option value="'+parseFloat(element.width).toFixed(2)+'">'
            +parseFloat(element.width).toFixed(2)+'</option>');
            });
        }
    });

    $('#width').select2({
        placeholder: 'Choose width below',
        allowClear: true
    });

}

function commodityWidth(id){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "{{url('commodityWidth/id=')}}"+id,
        success: function (data) {
            $('select[name="width"]').empty();
            $('select[name="width"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="width"]').append('<option value="'+parseFloat(element.width).toFixed(2)+'">'
            +parseFloat(element.width).toFixed(2)+'</option>');
            });
        }
    });

    $('#width').select2({
        placeholder: 'Choose width below',
        allowClear: true
    });

}

function brandWidth(id){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "{{url('brandWidth/id=')}}"+id,
        success: function (data) {
            $('select[name="width"]').empty();
            $('select[name="width"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="width"]').append('<option value="'+parseFloat(element.width).toFixed(2)+'">'
            +parseFloat(element.width).toFixed(2)+'</option>');
            });
        }
    });

    $('#width').select2({
        placeholder: 'Choose width below',
        allowClear: true
    });

}

function getWidth(a, b){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "{{url('getWidth/a=')}}"+a+ "&b="+b,
        success: function (data) {
            $('select[name="width"]').empty();
            $('select[name="width"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="width"]').append('<option value="'+parseFloat(element.width).toFixed(2)+'">'
            +parseFloat(element.width).toFixed(2)+'</option>');
            });
        }
    });

    $('#width').select2({
        placeholder: 'Choose width below',
        allowClear: true
    });

}

function allColour(){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "{{url('allColour')}}",
        success: function (data) {
            $('select[name="colour"]').empty();
            $('select[name="colour"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="colour"]').append('<option value="'+element.color_id+'">'+element.descr+'</option>');
            });
        }
    });

    $('#colour').select2({
        placeholder: 'Choose colour below',
        allowClear: true
    });

}

function getColour(id){
    $.ajax({
        type: "GET",
        dataType: "json",
        async: true,
        url: "{{url('getColour/id=')}}"+id,
        success: function (data) {
            $('select[name="colour"]').empty();
            $('select[name="colour"]').prepend('<option></option>');
            $.each(data, function(index, element) {
            $('select[name="colour"]').append('<option value="'+element.color_id+'">'+element.descr+'</option>');
            });
        }
    });

    $('#colour').select2({
        placeholder: 'Choose colour below',
        allowClear: true
    });

}

function listProduct(){
    $('#product').select2({
        placeholder: "Choose parameter first",
    });
}

function getProduct(){

    var commodity = $('#commodity').val();
    var brand= $('#brand').val();
    var coat = $('#coat').val();
    var grade = $('#grade').val();
    var thick = $('#thick').val();
    var width = $('#width').val();
    var colour = $('#colour').val();
    var descr = $('#prodDescr').val();
    var allreq = '';

    if (commodity) {

        allreq = allreq+'&commodity='+commodity.trim();
    }

    if (brand) {

        allreq = allreq+'&brand='+brand.trim();
    }

    if (coat) {

        allreq = allreq+'&coat='+coat.trim();
    }

    if (grade) {

        allreq = allreq+'&grade='+grade.trim();
    }

    if (thick) {

        allreq = allreq+'&thick='+thick.trim();
    }

    if (width) {

        allreq = allreq+'&width='+width.trim();
    }

    if (colour) {

        allreq = allreq+'&colour='+colour.trim();
    }

        // if (descr) {

        //     allreq = allreq+'&descr='+descr.trim();
        // }

        // if (!descr && !allreq) {

        //     swal('Oops!','At least write product descr, if you not choosing any parameters ','error');

        // }

    if (!allreq) {

        setBadgeNotReady();
        listProduct();

    }

    else if (allreq) {

        $.ajax({
            'headers': {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: "POST",
            dataType: "json",
            async: true,
            url: '{!!url("getProduct")!!}'+'?'+allreq,
                success: function (data) {
                    if (data.length < 1 ){

                        html = "<span class='new badge red' data-badge-caption='N/A'></span>";
                        $('#product_badge').empty();
                        $('#product_badge').append(html);
                        $('select[name="product"]').empty();
                        $('select[name="product"]').prepend('<option></option>');
                        // console.log(data.length);

                        $.each(data, function(index, element) {
                            $('select[name="product"]').append('<option value="'+element.prod_code+'">'+element.prod_code+' | '+element.descr+'</option>');
                        });

                    }
                    else {

                        html = "<span class='new badge green' data-badge-caption='found'>"+data.length+"</span>";
                        $('#product_badge').empty();
                        $('#product_badge').append(html);
                        $('select[name="product"]').empty();
                        $('select[name="product"]').prepend('<option></option>');
                        // console.log(data.length);

                            $.each(data, function(index, element) {
                                $('select[name="product"]').append('<option value="'+element.prod_code+'">'+element.prod_code+' | '+element.descr+'</option>');
                            });
                    }

                }
            });

            $('#product').select2({
                placeholder: 'Choose product below',
                allowClear: true
            });


        }
}

function setBadgeNotReady(){

    $('select[name="product"]').empty();
    html = "<span class='new badge red' data-badge-caption='not ready'></span>";
    $('#product_badge').empty();
    $('#product_badge').append(html);
}

function updateOrderHeader(){

    var mill_id = 'SR';
    var cust_id = $('#customerid').val();
    var cust_name = $('#customername').val();
    var cust_address = $('#customeraddress').val();
    var phone = $('#customerphone').val();
    var e = document.getElementById("consignee");
    var cons_id = e.options[e.selectedIndex].value;
    var ship_to = e.options[e.selectedIndex].text;
    var salesman_id = $('#salesid').val();
    var remark1 = $('#remark1').val();
    var remark2 = $('#remark2').val();
    var pay_term_id = $('#payment').val();
    var proj_flag = $('#proj_flag').val();
    var cust_po_num = $('#cust_po_num').val();
    var check_consignee = $('#consignee').val();

    if (!cust_id){
        swal("Whops", "Make sure you've choose customer first" , "error");
    }
    else {

        if (setBookId) {

            $.ajax({
                type: "GET",
                dataType: "json",
                async: true,
                url: "{{url('getOrderHeader/id=')}}"+setBookId,
                success: function (data) {

                   var db_cust_id = data['cust_id'];
                   var db_cons_id = data['cons_id'];
                   var db_salesman_id = data['salesman_id'];
                   var db_proj_flag= data['proj_flag'];
                   var db_pay_term_id = data['pay_term_id'];
                   var db_cust_po_num = data['cust_po_num'];
                   var db_remark1 = data['remark1'];
                   var db_remark2 = data['remark2'];

                   if ( (cust_id != db_cust_id) || (cons_id != db_cons_id) || (salesman_id != db_salesman_id) || (proj_flag != db_proj_flag) || (pay_term_id != db_pay_term_id) || (cust_po_num != db_cust_po_num) || (remark1 != db_remark1) || (remark2 != db_remark2) ){

                    $.ajax({
                        type:"POST",
                        url:"{{ url('updateOrderHeader') }}",
                        data:{
                        '_token': '{{ csrf_token() }}',
                        'book_id': setBookId,
                        'mill_id': mill_id,
                        'cust_id': cust_id,
                        'cust_name': cust_name,
                        'cust_address': cust_address,
                        'phone': phone,
                        'cons_id': cons_id,
                        'ship_to': ship_to,
                        'salesman_id': salesman_id,
                        'remark1': remark1,
                        'remark2': remark2,
                        'pay_term_id': pay_term_id,
                        'proj_flag': proj_flag,
                        'cust_po_num': cust_po_num
                        },
                        success:function(data) {

                            if((data['response']) == 'Order Updated'){
                                swal("Success", (data['response']) , "success");

                                $('#custName').text(cust_name);
                                $('#custAddress').text(cust_address);
                                $('#custPhone').text(phone);
                                $('#shipTo').text(ship_to);

                            }
                            else{
                                swal("Error", (data['response']) , "error");
                            }
                        }
                    });

                   }
                   else {
                    $('#custName').text(cust_name);
                    $('#custAddress').text(cust_address);
                    $('#custPhone').text(phone);
                    $('#shipTo').text(ship_to)
                    }
                }
            });
        }
        else {
            swal("Error", "BookId not found", "error");
        }
    }

}

function setNullProduct(){

    var product = $('#product').val();

    if (product){
        attributForm.style.display = "block";
        attributFormInfo2.style.display = "block";

        $('html, body').animate({
            scrollTop: $("#attributForm").offset().top
        }, 1200);
    }
    else {
        attributForm.style.display = "none";
        attributFormInfo2.style.display = "none";
        setBadgeNotReady();
    }
}

function setEmpty(){
    $('#commodity').val('').trigger('change');
    $('#brand').val('').trigger('change');
    $('#coat').val('').trigger('change');
    $('#grade').val('').trigger('change');
    $('#thick').val('').trigger('change');
    $('#width').val('').trigger('change');
    $('#colour').val('').trigger('change');
    // $('#product').val('').trigger('change');
    $('#weight').val('');
    $('#price').val('');
    $('#amt_gross').val('');
    $('#pct_disc').val('');
    $('#amt_disc').val('');
    $('#amt_net').val('');
    $('#atr_remark').val('');
    $('#appl_note').val('').trigger('change');
    $('#req_date').val('').trigger('change');
    $('#req_week').val('').trigger('change');
    $('#req_month').val('').trigger('change');
    $('#req_year').val('').trigger('change');
}

function calc(){

    var weight = $('#weight').val();
    var price = $('#price').val();
    var amt_gross = $('#amt_gross').val();
    var pct_disc = $('#pct_disc').val();
    var amt_disc = $('#amt_disc').val();

    if(weight && price) {

        $('#amt_gross').val(weight*price);
        var amt_gross = $('#amt_gross').val();
        if (amt_disc) {
            $('#amt_net').val(amt_gross-amt_disc);
        }
        if (!pct_disc){
            $('#amt_disc').val('');
            $('#amt_net').val('');
        }
        else {

            $('#amt_disc').val(parseFloat((pct_disc/100)*amt_gross).toFixed(2));
            var amt_disc = $('#amt_disc').val();
            $('#amt_net').val(parseFloat(amt_gross-amt_disc).toFixed(2));

        }
        if (!amt_disc){
            $('#pct_disc').val('');
            $('#amt_net').val('');
        }
        else {

            $('#pct_disc').val((parseFloat((amt_disc/amt_gross)*100)).toFixed(2));
            $('#amt_net').val(parseFloat(amt_gross-amt_disc).toFixed(2));

        }

    }

    else {
        $('#amt_gross').val('');
        $('#amt_net').val('');
    }


    var pct_disc = $('#pct_disc').val();
        var amt_gross = $('#amt_gross').val();

        if (!pct_disc){
            $('#amt_disc').val('');
            $('#amt_net').val('');
        }
        else {

            $('#amt_disc').val(parseFloat((pct_disc/100)*amt_gross).toFixed(2));
            var amt_disc = $('#amt_disc').val();
            $('#amt_net').val(parseFloat(amt_gross-amt_disc).toFixed(2));

        }

        var amt_disc = $('#amt_disc').val();
        var amt_gross = $('#amt_gross').val();

        if (!amt_disc){
            $('#pct_disc').val('');
            $('#amt_net').val('');
        }
        else {

            $('#pct_disc').val((parseFloat((amt_disc/amt_gross)*100)).toFixed(2));
            $('#amt_net').val(parseFloat(amt_gross-amt_disc).toFixed(2));

        }

}

function addCommas(nStr){
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}

function format(d) {
    // `d` is the original data object for the row
    return '<table class="table">' +
        '<tr>' +
        '<td>Weight:</td>' +
        '<td>' + addCommas(parseFloat(d.wgt).toFixed(2)) + ' KG</td>' +
        '</tr>' +
        '<td>Price:</td>' +
        '<td>IDR ' + addCommas(parseFloat(d.unit_price).toFixed(2)) + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Amt.Gross:</td>' +
        '<td>IDR ' +  addCommas(parseFloat(d.amt_gross).toFixed(2)) + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Disc(%):</td>' +
        '<td>' + addCommas(parseFloat(d.pct_disc).toFixed(2)) + '%</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Amt.Disc:</td>' +
        '<td>IDR ' + addCommas(parseFloat(d.amt_disc).toFixed(2)) + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Amt.Net:</td>' +
        '<td>IDR ' + addCommas(parseFloat(d.amt_net).toFixed(2)) + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Remark:</td>' +
        '<td>' + d.remark + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Dt.ReqShip:</td>' +
        '<td>' + d.dt_req_ship + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Req.Week:</td>' +
        '<td>' + d.req_week + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Req.Month:</td>' +
        '<td>' + d.req_month + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Req.Year:</td>' +
        '<td>' + d.req_year + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>ApplNote:</td>' +
        '<td>' + d.aplikasi_note + '</td>' +
        '</tr>' +
        '<tr>' +
        '</table>';
}

function listOrderItem() {

    // setBookId = $('#setBookId').val();
    $('#orderItem').DataTable().ajax.url("{{url('getItemDetail?id=')}}"+setBookId).load();
    tableItem.style.display = "block";
    infoItem.style.display = "none";


}

function submitOrder() {

    setBookId = $('#setBookId').val();

    swal({
    title: "Are you sure",
    text: "Submit Order "+setBookId+" ?",
    icon: "warning",
    buttons: true
    })
    .then((willGo) => {
    if (willGo) {

        if (setBookId) {

            $.ajax({
                type:"POST",
                url:"{{ url('submitOrder') }}",
                data:{
                '_token': '{{ csrf_token() }}',
                'book_id': setBookId
                },
                success:function(data) {

                    if((data['response']) == 'Order Submitted'){

                        swal("Success", (data['response']) , "success")
                            .then(function(){
                                $(location).attr("href", "{{ url('ListPreOrder') }}");
                            }
                            );
                    }
                    else if((data['response']) == "There's something error when submitting order"){
                        swal("error", (data['response']) , "error");
                    }
                    else if((data['response']) == "Book Id not found"){
                        swal("error", (data['response']) , "error");
                    }
                    else{
                        swal("Error", (data['response']) , "error");
                    }
                }
            });

        }
        else {
            swal("Whops", "Book Id havent set yet", "error");
        }
    }
    else {
        swal("Canceling submit order "+book_id);
    }
    });
}

// Document Ready
$(document).ready(function() {

    listPayment();listConsignee();listCommodity();listBrand();listCoat();
    listGrade();allThickness();allWidth();allColour();listProduct();listAppl();
    listReqWeek();listReqMonth();listReqYear();

    // $('#PreOrder').addClass('active open');
    // $('#PreOrderCSS').css('display','block');
    // $('#PreOrderNav').addClass('active');
    // $('#CreatePreOrder').addClass('active gradient-45deg-green-teal gradient-shadow');
    // $('#PreOrderSpan').text('Edit PreOrder');
    $('#InvoiceNo').text(setBookId);
    var divInvoiceNo = document.getElementById('divInvoiceNo');
    var tableItem = document.getElementById('tableItem');
    var infoItem = document.getElementById('infoItem');
    var searchForm = document.getElementById('searchForm');
    var attributForm = document.getElementById('attributForm');
    var attributFormInfo1 = document.getElementById('attributFormInfo1');
    var attributFormInfo2 = document.getElementById('attributFormInfo2');

    //alert($('#setBookId').val());

    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoClose: true,
        showClearBtn: true,
    });

    $('#salesid').select2({
        placeholder: "Choose salesman",
        allowClear: true
    });

    $('#search_cust').select2({
      placeholder: "Type any existing custid or custname . . .",
      allowClear: true,
	    minimumInputLength: 3,
        ajax: {
            url: "{{url('order_autocompletecustomer')}}",
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
            return {
                results:  $.map(data, function (item) {
                return {
                    text: item.cust_id + " || " + item.cust_name,
                    id: item.cust_id,
                }
                })
            };

            },
            cache: false
        }
    });

    $('#search_cust').change(function(){

        var id = $( "#search_cust" ).val();
        $('select[name="consignee"]').empty();

        if (!id){

            $('#consignee_badge').empty();
            listConsignee();
        }
        else {

            $.ajax({
                type: "GET",
                dataType: "json",
                async: true,
                url: "{{url('order_consignee/id=')}}"+id,
                success: function (data) {

                    if (data.length < 1) {

                        html = "<span class='new badge red' data-badge-caption='N/A'></span>";
                        $('#consignee_badge').empty();
                        $('#consignee_badge').append(html);
                        $('select[name="consignee"]').empty();
                        $('select[name="consignee"]').prepend('<option></option>');
                            $.each(data, function(index, element) {
                                $('select[name="consignee"]').append('<option value="'+element.cons_id+'">'+element.cons_name+
                            ' ( '+element.address1+' )</option>');
                            });
                    }
                    else {

                        html = "<span class='new badge green' data-badge-caption='found'>"+data.length+"</span>";
                        $('#consignee_badge').empty();
                        $('#consignee_badge').append(html);
                        $('select[name="consignee"]').empty();
                        $('select[name="consignee"]').prepend('<option></option>');
                            $.each(data, function(index, element) {
                                $('select[name="consignee"]').append('<option value="'+element.cons_id+'">'+element.cons_name+
                                ' ( '+element.address1+' )</option>');
                            });

                    }
                }
            });

            $('#consignee').select2({
                placeholder: 'Choose consignee below',
                allowClear: true
            });

        }

        $.ajax({
            url: "{{url('order_getCustDetails/id=')}}"+id,
            type: "GET",
            dataType: 'json',
            success: function(data){
                $('#customerid').val(data.cust_id);
                $('#customername').val(data.cust_name);
                $('#customeraddress').val(data.address1+" "+data.address2+", "+data.city+", "+data.prov);
                $('#customerphone').val(data.phone);
            }
        });

    });

    $('#commodity').change(function(){

        setBadgeNotReady();
        setNullProduct();
        var commodity = $('#commodity').val();
        var brand = $('#brand').val();
        $('select[name="thick]').empty();
        $('select[name="width"]').empty();


        if (!commodity && !brand){

            $('#thick_badge').empty();
            $('#width_badge').empty();
            allThickness();
            allWidth();
        }

        else if (commodity && !brand){

            html1 = "<span class='new badge green' data-badge-caption='bound'>"+commodity+"</span>";
            $('#thick_badge').empty();
            $('#thick_badge').append(html1);

            html2 = "<span class='new badge green' data-badge-caption='bound'>"+commodity+"</span>";
            $('#width_badge').empty();
            $('#width_badge').append(html2);

            commodityThickness(commodity);
            commodityWidth(commodity);

        }

        else if (!commodity  && brand){

            html1 = "<span class='new badge green' data-badge-caption='bounded'>"+brand+"</span>";
            $('#thick_badge').empty();
            $('#thick_badge').append(html1);

            html2 = "<span class='new badge green' data-badge-caption='bounded'>"+brand+"</span>";
            $('#width_badge').empty();
            $('#width_badge').append(html2);

            brandThickness(brand);
            brandWidth(brand);

        }

        else{

            html1 = "<span class='new badge green' data-badge-caption='bound'>"+commodity+'-'+brand+"</span>";
            $('#thick_badge').empty();
            $('#thick_badge').append(html1);

            html2 = "<span class='new badge green' data-badge-caption='bound'>"+commodity+'-'+brand+"</span>";
            $('#width_badge').empty();
            $('#width_badge').append(html2);

            getThickness(commodity, brand);
            getWidth(commodity, brand);

        }

        getProduct();

    });

    $('#brand').change(function(){

        setBadgeNotReady();
        setNullProduct();
        var commodity = $('#commodity').val();
        var brand = $('#brand').val();
        $('select[name="thick]').empty();
        $('select[name="width"]').empty();
        $('select[name="colour"]').empty();

        if (!brand){

            $('#colour_badge').empty();
            allColour();
        }

        else {

            html = "<span class='new badge green' data-badge-caption='bound'>"+brand+"</span>";
            $('#colour_badge').empty();
            $('#colour_badge').append(html);
            getColour(brand);
        }

        if (!commodity && !brand){

            $('#thick_badge').empty();
            $('#width_badge').empty();
            allThickness();
            allWidth();
        }

        else if (commodity && !brand){

            html1 = "<span class='new badge green' data-badge-caption='bound'>"+commodity+"</span>";
            $('#thick_badge').empty();
            $('#thick_badge').append(html1);

            html2 = "<span class='new badge green' data-badge-caption='bound'>"+commodity+"</span>";
            $('#width_badge').empty();
            $('#width_badge').append(html2);

            commodityThickness(commodity);
            commodityWidth(commodity);

        }

        else if (!commodity && brand){

            html1 = "<span class='new badge green' data-badge-caption='bounded'>"+brand+"</span>";
            $('#thick_badge').empty();
            $('#thick_badge').append(html1);

            html2 = "<span class='new badge green' data-badge-caption='bounded'>"+brand+"</span>";
            $('#width_badge').empty();
            $('#width_badge').append(html2);

            brandThickness(brand);
            brandWidth(brand);

        }

        else{

            html1 = "<span class='new badge green' data-badge-caption='bound'>"+commodity+'-'+brand+"</span>";
            $('#thick_badge').empty();
            $('#thick_badge').append(html1);

            html2 = "<span class='new badge green' data-badge-caption='bound'>"+commodity+'-'+brand+"</span>";
            $('#width_badge').empty();
            $('#width_badge').append(html2);

            getThickness(commodity, brand);
            getWidth(commodity, brand);

        }

        getProduct();

    });

    $('#coat').change(function(){
        setBadgeNotReady();
        setNullProduct();
        getProduct();
    });

    $('#grade').change(function(){
        setBadgeNotReady();
        setNullProduct();
        getProduct();
    });

    $('#thick').change(function(){
        setBadgeNotReady();
        setNullProduct();
        getProduct();
    });

    $('#width').change(function(){
        setBadgeNotReady();
        setNullProduct();
        getProduct();
    });

    $('#colour').change(function(){
        setBadgeNotReady();
        setNullProduct();
        getProduct();
    });

    $('#product').change(function(){

        setNullProduct();

    });

    $('#byremark').on('click', function() {
        setEmpty();
        setBadgeNotReady();
        attributForm.style.display = "block";
        searchForm.style.display = "none";
        attributFormInfo1.style.display = "block";
        attributFormInfo2.style.display = "none";
    });

    $('#byproduct').on('click', function() {
        setEmpty();
        setBadgeNotReady();
        attributForm.style.display = "none";
        searchForm.style.display = "block";
        attributFormInfo1.style.display = "none";
        attributFormInfo2.style.display = "none";
    });

    $('#add').on('click', function() {
        event.preventDefault();
        searchForm.style.display = 'block';

        $('html, body').animate({
            scrollTop: $("#searchForm").offset().top
        }, 1200);

    });

    $('.close').on('click', function() {
        event.preventDefault();
        searchForm.style.display = 'none';
        attributForm.style.display = 'none';
        setEmpty();
        setBadgeNotReady();

    });

    $('#toStep2').on('click', function() {
        updateOrderHeader();
    });

    $('#confirmLater').on('click', function() {
        event.preventDefault();
        $(location).attr("href", "{{ url('ListPreOrder') }}");
    });

    $('#toStep3').on('click', function() {
        submitOrder();
    });

    $('#divToStep2').on('click', function() {
        updateOrderHeader();
    });

    $('#weight').on('keyup change',function(){
		calc();
	});

    $('#price').on('change',function(){

        var id = $('#product').val();
        var bottom_price = $(this).val();

        if (id) {

            $.ajax({
                type: "GET",
                dataType: "json",
                async: true,
                url: "{{url('cekHarga/id=')}}"+id,
                success: function (data) {
                    cek_bottom_price = data['hasil'];
                    if (bottom_price < cek_bottom_price){
                        swal("Whoops", "Price cannot be under bottom price", "error")
                        $('#price').val('');
                        $('#amt_gross').val('');
                        $('#pct_disc').val('');
                        $('#amt_disc').val('');
                        $('#amt_net').val('');
                        $('#price').focus();
                    }
                    else{
                        calc();
                    }

                }
            });
        }
        else {
            calc();
        }


	});

    $('#pct_disc').on('keyup change',function(){

        var pct_disc = $('#pct_disc').val();
        var amt_gross = $('#amt_gross').val();

        if (!pct_disc){
            $('#amt_disc').val('');
            $('#amt_net').val('');
        }
        else {

            $('#amt_disc').val(parseFloat((pct_disc/100)*amt_gross).toFixed(2));
            var amt_disc = $('#amt_disc').val();
            $('#amt_net').val(parseFloat(amt_gross-amt_disc).toFixed(2));

        }

	});

    $('#amt_disc').on('keyup change',function(){

        var amt_disc = $('#amt_disc').val();
        var amt_gross = $('#amt_gross').val();

        if (!amt_disc){
            $('#pct_disc').val('');
            $('#amt_net').val('');
        }
        else {

            $('#pct_disc').val((parseFloat((amt_disc/amt_gross)*100)).toFixed(2));
            $('#amt_net').val(parseFloat(amt_gross-amt_disc).toFixed(2));

        }


    });

    var table = $('#orderItem').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        searching: false,
        paging: false,
        info: false,
        fixedHeader: true,
        "order": [
            [1, "asc"]
        ],
        dom: 'Pfrtip',
        ajax: {
            'url': '{!!url("getItemDetail")!!}' + '?id=' +setBookId,
            'type': 'post',
            'headers': {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        },
        columns: [{
                "className": 'details-control',
                "orderable": false,
                "searchable": false,
                "data": null,
                "defaultContent": ''
            },
            {
                data: 'item_num',
                name: 'item_num',
                sClass: "center"
            },
            {
                data: 'descr',
                name: 'descr'
            },
            {
                data: 'Action',
                name: 'Action',
                orderable:false,
                searchable:false,
                sClass: "center"
            }
        ],
        initComplete: function(settings, json) {

            if (table.rows().data().length) {

                tableItem.style.display = "block";
                infoItem.style.display = "none";

            } else if (!table.rows().data().length) {

                tableItem.style.display = "none";
                infoItem.style.display = "block";
            } else {

                swal("Oops!", "Something error", "error");
            }
        },
    });

    $('#orderItem tbody').on('click', 'td.details-control', function() {
        var tr = $(this).closest('tr');
        var row = $('#orderItem').DataTable().row(tr);
        // var data = table.row(this).data();
        // console.log(table.row(tr));

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });

    $('#saveOrderItem').on('click', function() {

        event.preventDefault();
        //header
        var prod_code = $('#product').val();
        var mill_id = 'SR';
        var cust_id = $('#customerid').val();
        var cust_name = $('#customername').val();
        var cust_address = $('#customeraddress').val();
        var phone = $('#customerphone').val();
        var e = document.getElementById("consignee");
        var cons_id = e.options[e.selectedIndex].value;
        var ship_to = e.options[e.selectedIndex].text;
        var salesman_id = $('#salesid').val();
        var remark1 = $('#remark1').val();
        var remark2 = $('#remark2').val();
        var pay_term_id = $('#payment').val();
        var proj_flag = $('#proj_flag').val();
        var cust_po_num = $('#cust_po_num').val();
        //item_attribute
        var weight = $('#weight').val();
        var unit_price = $('#price').val();
        var amt_gross = $('#amt_gross').val();
        var amt_disc = $('#amt_disc').val();
        var pct_disc = $('#pct_disc').val();
        var amt_net = $('#amt_net').val();
        var atr_remark = $('#atr_remark').val();
        var appl_note = $('#appl_note').val();
        var req_date = $('#req_date').val();
        var req_week = $('#req_week').val();
        var req_month = $('#req_month').val();
        var req_year = $('#req_year').val();
        //function saveOrderItem
        function saveOrderItem(){

            $.ajax({
                type: "POST",
                url: "{{ url('saveEditOrderItem') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'prod_code': prod_code,
                    'mill_id': mill_id,
                    'book_id': setBookId,
                    'cust_id': cust_id,
                    'cust_name': cust_name,
                    'cust_address': cust_address,
                    'phone': phone,
                    'cons_id': cons_id,
                    'ship_to': ship_to,
                    'salesman_id': salesman_id,
                    'remark1': remark1,
                    'remark2': remark2,
                    'pay_term_id': pay_term_id,
                    'proj_flag': proj_flag,
                    'cust_po_num': cust_po_num,
                    'weight': weight,
                    'unit_price': unit_price,
                    'amt_gross': amt_gross,
                    'amt_disc': amt_disc,
                    'pct_disc': pct_disc,
                    'amt_net': amt_net,
                    'atr_remark': atr_remark,
                    'appl_note': appl_note,
                    'req_date': req_date,
                    'req_week': req_week,
                    'req_month': req_month,
                    'req_year': req_year
                },
                success: function(data) {
                    if ((data['response']) == 'Item Added') {
                        swal("Success", (data['response']), "success");
                        listOrderItem();
                        searchForm.style.display = "none";
                        setEmpty();
                        setBadgeNotReady();
                    } else {
                        swal("Error", (data['response']), "error");
                        searchForm.style.display = "none";
                        setEmpty();
                        setBadgeNotReady();
                    }
                }
            });
        }

        if(!prod_code && !atr_remark){
            swal('Whoops', 'If you not choose any product, at least describe your order at remark field', 'error');
        }

        else {

            if (unit_price && prod_code){
                if (unit_price < cek_bottom_price){
                    swal("Whoops", "Price cannot be under bottom price", "error");
                    $('#price').val('');
                    $('#amt_gross').val('');
                    $('#amt_gross').val('');
                    $('#pct_disc').val('');
                    $('#amt_disc').val('');
                    $('#amt_net').val('');
                    $('#price').focus();
                }
                else{
                    saveOrderItem();
                }

            }
            else if (unit_price && atr_remark){
                saveOrderItem();
            }
            else if (!unit_price && atr_remark){
                saveOrderItem();
            }
            else if (!unit_price && prod_code){
                saveOrderItem();
            }
        }

    });

    $('body').on('click', '#deleteItem', function(e) {
      e.preventDefault();
      var book_id = $(this).data('id1');
      var item_num = $(this).data('id2');

      swal({
      title: "Are you sure",
      text: "Delete Item Num "+item_num+", from Book Number "+book_id+" ?",
      icon: "warning",
      buttons: true
      })
      .then((willGo) => {
      if (willGo) {

        $.ajax({
        type: "POST",
        url: "{{ url('deleteOrderItem') }}",
        data: {
            '_token': '{{ csrf_token() }}',
            'book_id': book_id,
            'item_num': item_num
            },
                success: function(data) {
                    if ((data['response']) == 'Item Deleted') {
                        swal("Success", (data['response']), "success");
                        listOrderItem();
                    }
                    else if ((data['response']) == 'All item has been deleted, order canceled'){
                        swal("Info", (data['response']), "info")
                        .then(function(){
                            $(location).attr("href", "{{ url('CreatePreOrder') }}");
                        }
                        );
                    }
                    else {
                        swal("Error", (data['response']), "error");
                    }
                }
            });
      }
      else {
        swal("Canceling delete Item Num "+item_num+", from Book Number "+book_id);
      }
      });
    });


});
</script>

@endsection
