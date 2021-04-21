<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('home');
});

Auth::routes([
    'register' => false,
    'reset' => false,
    'password' => false,
    'verify' => false,
  ]);

Route::get('ChangeDefaultPassword', 'ChangeDefaultPasswordController@index');
Route::get('ChangePass', 'ChangeDefaultPasswordController@ChangePass');


/*---------------------------------------------------------------------------------------------------------------------------------------------*/
//--Dasboard
Route::get('home', 'HomeController@index')->name('home');
Route::post('getDashboard', 'HomeController@getDashboard');
Route::post('updateSpeed', 'HomeController@updateSpeed');

Route::get('home2', 'Home2Controller@index')->name('home2');
Route::post('getBlockSchedule', 'BlockScheduleController@getBlockSchedule')->name('getBlockSchedule');
// Route::post('getBlockSchedule2', 'BlockScheduleController@getBlockSchedule2')->name('getBlockSchedule2');
Route::post('getBlockScheduleDetail1', 'BlockScheduleController@getBlockScheduleDetail1')->name('getBlockScheduleDetail1');
Route::post('getBlockScheduleDetail2', 'BlockScheduleController@getBlockScheduleDetail2')->name('getBlockScheduleDetail2');
Route::get('getDashboardProduction', 'Home2Controller@getDashboardProduction');

/*---------------------------------------------------------------------------------------------------------------------------------------------*/
//-- Activity Report
Route::get('ActivityReport', 'ActivityReportController@index')->name('ActivityReport');
Route::post('getActivityReport', 'ActivityReportController@getActivityReport');
// Route::get('getActivityReport/id={id}&start={start}&end={end}', 'ActivityReportController@getActivityReport');
Route::get('getRemarkAll/id={id}', 'ActivityReportController@getRemarkAll');

/*---------------------------------------------------------------------------------------------------------------------------------------------*/
//-- Customer Visit
Route::get('CustomerVisit', 'CustomerVisitController@index')->name('CustomerVisit');
Route::get('autocompletecustomer', 'CustomerVisitController@autocompletecustomer')->name('autocompletecustomer');
Route::get('getCustDetails/id={id}', 'CustomerVisitController@getCustDetails');
Route::post('storeActivity', 'CustomerVisitController@storeActivity')->name('storeActivity');
/*---------------------------------------------------------------------------------------------------------------------------------------------*/

//-- Today Visit
Route::get('TodayVisit', 'TodayVisitController@index')->name('TodayVisit');
Route::get('getTodayVisit/id={salesid}', 'TodayVisitController@getTodayVisit');
Route::get('getRemark/id={id}', 'TodayVisitController@getRemark');
/*---------------------------------------------------------------------------------------------------------------------------------------------*/


//-- Change Password
Route::get('ChangePassword', 'ChangePassController@index')->name('ChangePassword');
Route::post('changePass', 'ChangePassController@changePass')->name('changePass');

/*---------------------------------------------------------------------------------------------------------------------------------------------*/

//-- Pru
Route::get('PruApp', 'PruAppController@index')->name('PruApp');
Route::get('search_pic', 'PruAppController@search_pic')->name('search_pic');
Route::get('getPicDetail/id={id}&mill={mill}', 'PruAppController@getPicDetail');
Route::post('getPruHdr', 'PruAppController@getPruHdr');
Route::post('getDetailRawYes', 'PruAppController@getDetailRawYes');
Route::post('getDetailRawNo', 'PruAppController@getDetailRawNo');
Route::post('setApprove', 'PruAppController@setApprove')->name('setApprove');
Route::post('setReject', 'PruAppController@setReject')->name('setReject');
Route::post('setReset', 'PruAppController@setReset')->name('setReset');

/*---------------------------------------------------------------------------------------------------------------------------------------------*/

//-- PreOrder
Route::get('CreatePreOrder', 'CreatePreOrderController@index')->name('CretePreOrder');
Route::get('order_autocompletecustomer', 'CreatePreOrderController@order_autocompletecustomer')->name('order_autocompletecustomer');
Route::get('order_getCustDetails/id={id}', 'CreatePreOrderController@order_getCustDetails');
Route::get('order_consignee/id={id}', 'CreatePreOrderController@order_consignee');

//-- PreOrder - OrderTransaction
Route::post('saveOrderItem', 'CreatePreOrderController@saveOrderItem');
Route::get('getOrderHeader/id={id}', 'CreatePreOrderController@getOrderHeader');
Route::post('updateOrderHeader', 'CreatePreOrderController@updateOrderHeader');
Route::post('getItemDetail', 'CreatePreOrderController@getItemDetail');
Route::post('deleteOrderItem', 'CreatePreOrderController@deleteOrderItem');
Route::get('editOrderItem/id={id}', 'CreatePreOrderController@editOrderItem');
Route::post('saveEditOrderItem', 'CreatePreOrderController@saveEditOrderItem');
Route::post('submitOrder', 'CreatePreOrderController@submitOrder');
Route::post('confirmOrder', 'CreatePreOrderController@confirmOrder');
Route::post('deleteOrder', 'CreatePreOrderController@deleteOrder');

//-- PreOrder - CekHarga
Route::get('cekHarga/id={id}', 'CreatePreOrderController@cekHarga');

//-- PreOrder - ListOrder
Route::get('ListPreOrder', 'ListPreOrderController@index')->name('ListPreOrder');
Route::post('getListOrder', 'ListPreOrderController@getListOrder');
Route::post('detailHdr', 'ListPreOrderController@detailHdr');
Route::post('detailDtl', 'ListPreOrderController@detailDtl');

//-- PreOrder - PrintPreview
Route::get('PrintPreview/id={id}', 'PrintPreviewController@index');

//-- PreOrder - Upload Image
Route::get('UploadImg/id={id}', 'UploadImgController@index');
Route::post('ImgUpload', 'UploadImgController@upload')->name('ImgUpload');
Route::get('ImgFetch', 'UploadImgController@fetch')->name('ImgFetch');
Route::get('ImgDelete', 'UploadImgController@delete')->name('ImgDelete');

//-- JSONController
Route::get('getVendor', 'JSONController@getVendor')->name('getVendor');
Route::get('getCustomer', 'JSONController@getCustomer')->name('getCustomer');
Route::get('listPay', 'JSONController@listPay');
Route::get('listCommodity', 'JSONController@listCommodity');
Route::get('listBrand', 'JSONController@listBrand');
Route::get('listCoat', 'JSONController@listCoat');
Route::get('listGrade', 'JSONController@listGrade');
Route::get('listAppl', 'JSONController@listAppl');
Route::get('allThickness', 'JSONController@allThickness');
Route::get('commodityThickness/id={id}', 'JSONController@commodityThickness');
Route::get('brandThickness/id={id}', 'JSONController@brandThickness');
Route::get('getThickness/a={a}&b={b}', 'JSONController@getThickness');
Route::get('allWidth', 'JSONController@allWidth');
Route::get('commodityWidth/id={id}', 'JSONController@commodityWidth');
Route::get('brandWidth/id={id}', 'JSONController@brandWidth');
Route::get('getWidth/a={a}&b={b}', 'JSONController@getWidth');
Route::get('allColour', 'JSONController@allColour');
Route::get('getColour/id={id}', 'JSONController@getColour');
Route::post('getProduct', 'JSONController@getProduct');
Route::get('allQuality', 'JSONController@allQuality');
Route::post('getQuality', 'JSONController@getQuality');
Route::get('listCoilOrigin', 'JSONController@listCoilOrigin');
Route::get('listCrcCommodity', 'JSONController@listCrcCommodity');
Route::get('listCrcThickness', 'JSONController@listCrcThickness');
Route::get('listCrcWidth', 'JSONController@listCrcWidth');

//-- Report - Purchase Order
Route::get('POReport', 'POReportController@index')->name('POReport');
Route::post('getPOReport', 'POReportController@getPOReport');

//-- Report - Hutang
Route::get('Hutang', 'HutangController@index')->name('Hutang');
Route::post('getSummaryHutang', 'HutangController@getSummaryHutang');
Route::post('getOverviewHutang', 'HutangController@getOverviewHutang');
Route::post('getAllSummaryHutang', 'HutangController@getAllSummaryHutang');

//-- Report - Piutang
Route::get('Piutang', 'PiutangController@index')->name('Piutang');
Route::post('getSummaryPiutang', 'PiutangController@getSummaryPiutang');
Route::post('getOverviewPiutang', 'PiutangController@getOverviewPiutang');
Route::post('getAllSummaryPiutang', 'PiutangController@getAllSummaryPiutang');

//-- Report - Purchase Order
Route::get('Cashflow', 'CashflowController@index')->name('Cashflow');
Route::get('CashflowGraph', 'CashflowController@CashflowGraph');


//-- Mill Data Analysis- Production Analysys
Route::get('ProductionAnalysis', 'ProductionAnalysisController@index')->name('ProductionAnalysis');
Route::post('getProductAnalysis', 'ProductionAnalysisController@getProductAnalysis');
Route::post('getProductAnalysisDetail', 'ProductionAnalysisController@getProductAnalysisDetail');


//-- Sales Marketing Data Analysis- Production Analysys
Route::get('ScShipmentAnalysis', 'ScShipmentAnalysisController@index')->name('ScShipmentAnalysis');
Route::post('getScShipmentAnalysis', 'ScShipmentAnalysisController@getScShipmentAnalysis');
Route::post('getScShipmentAnalysisDetailbySC', 'ScShipmentAnalysisController@getScShipmentAnalysisDetailbySC');
Route::post('getScShipmentAnalysisDetailbyDeliv', 'ScShipmentAnalysisController@getScShipmentAnalysisDetailbyDeliv');

//-- Production Report
Route::get('FreeCoilReport', 'FreeCoilReportController@index')->name('FreeCoilReport');
Route::get('CRCAvailability', 'CRCAvailabilityController@index')->name('CRCAvailability');
Route::post('getFreeCoilReport', 'FreeCoilReportController@getFreeCoilReport');
Route::post('getCRCAvailability', 'CRCAvailabilityController@getCRCAvailability');

//-- Block Schedule
Route::get('BlockSchedule', 'BlockScheduleController@index')->name('BlockSchedule');

//-- MPF 


Route::get('CreateMPF', 'CreateMPFController@index')->name('CreateMPF');
Route::get('needOrderID', 'CreateMPFController@needOrderID');
Route::get('fillReceiver', 'CreateMPFController@fillReceiver');
Route::post('saveApprovalForm', 'CreateMPFController@saveApprovalForm');
Route::post('checkOrder', 'CreateMPFController@checkOrder');

Route::get('ListMPF', 'ListMPFController@index')->name('ListMPF');
Route::post('getListMPF', 'ListMPFController@getListMPF')->name('getListMPF');
Route::post('detailMPF', 'ListMPFController@detailMPF')->name('detailMPF');
Route::post('acceptApproval', 'ListMPFController@acceptApproval')->name('acceptApproval');
Route::post('rejectApproval', 'ListMPFController@rejectApproval')->name('rejectApproval');


Route::get('CcBccMPF', 'CcBccMPFController@index')->name('CcBccMPF');
Route::post('getListCcMPF', 'CcBccMPFController@getListCcMPF')->name('getListCcMPF');







