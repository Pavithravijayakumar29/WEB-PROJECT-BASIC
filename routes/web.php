<?php

use Illuminate\Support\Facades\Route;
//Login
use App\Http\Controllers\Auth\AuthController;
//Dashboard
use App\Http\Controllers\Dashboard\UserController;
//Profile
use App\Http\Controllers\profileController;
//Admin
use App\Http\Controllers\Admin\UserTypeController;
use App\Http\Controllers\Admin\UserCreationController;
use App\Http\Controllers\Admin\UserScreenMainController;
use App\Http\Controllers\Admin\UserScreenSubController;
use App\Http\Controllers\Admin\UserPermissionController;
//Masters
use App\Http\Controllers\CountryCreationController;
use App\Http\Controllers\StateCreationController;
use App\Http\Controllers\DistrictCreationController;
use App\Http\Controllers\DesignationCreationController;
use App\Http\Controllers\CategoryCreationController;
use App\Http\Controllers\GroupCreationController;
use App\Http\Controllers\TaxCreationController;
use App\Http\Controllers\ItemLitersTypeController;
use App\Http\Controllers\ItemPropertiesTypeController;
use App\Http\Controllers\ItemCreationController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\AdvanceCreationController;
use App\Http\Controllers\ExpenseTypeCreationController;
use App\Http\Controllers\SubExpenseTypeCreationController;
use App\Http\Controllers\CompanyCreationController;
use App\Http\Controllers\ShopsTypeController;
use App\Http\Controllers\DealerCreationController;
use App\Http\Controllers\WorkingDaysController;
use App\Http\Controllers\CustomerCreationController;
use App\Http\Controllers\EmployeeCreationController;
use App\Http\Controllers\SalesRepCreationController;
use App\Http\Controllers\MarketManagerCreationController;
use App\Http\Controllers\AccountLedgerController;
use App\Http\Controllers\ReturnCreationController;
//Entry
use App\Http\Controllers\Entry\SalesOrderC2DController;
use App\Http\Controllers\Entry\AttendanceEntryController;
use App\Http\Controllers\Entry\SalesorderD2SController;
use App\Http\Controllers\Entry\SalesOrderStockController;
use App\Http\Controllers\Entry\SalesOrderDeliveryController;
use App\Http\Controllers\Entry\SalesReturnD2CController;
use App\Http\Controllers\Entry\ReceiptEntryController;
use App\Http\Controllers\Entry\ExpenseCreationsController;
//Reports
use App\Http\Controllers\Reports\BeatsWiseReportController;
use App\Http\Controllers\Reports\SalesReportController;
use App\Http\Controllers\Reports\DealerOrderReport;
use App\Http\Controllers\Reports\ExcutiveLtrSalesReport;
use App\Http\Controllers\Reports\EffectiveCalls;
use App\Http\Controllers\Reports\DealersSalesReportController;
use App\Http\Controllers\Reports\ItemSalesPendingMonthWiseReportController;
use App\Http\Controllers\Reports\SalesBoxReportController;
use App\Http\Controllers\Reports\ReceiptReport;

//
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'index']);
Route::post('login-post', [AuthController::class, 'postLogin']);

Route::get('Dashboard', [UserController::class, 'dash'])->name('Dashboard');
// Route::view('Dashboard','dashboard.admin')->name('Dashboard');
// User Profile //
Route::get('/Profile',[profileController::class, 'showProfile'])->name('profile');

Route::get('/logout', function () {
    session_start();
    unset($_SESSION['user']);
    unset($_SESSION['user_type_id']);
    unset($_SESSION['staff_id']);
    return redirect('/');
});
//Admin
Route::view('User_Type', 'Admin.user_type.admin')->name('User_Type');
Route::get('user_type-db_cmd', [UserTypeController::class, 'db_cmd'])->name('User_Type_Action');

Route::view('User_Creation', 'Admin.user_creation.admin')->name('User_Creation');
Route::get('user_creation-db_cmd', [UserCreationController::class, 'db_cmd'])->name('User_Creation_Action');

Route::view('User_Screen_Main','Admin.user_screen_main.admin')->name('User_Screen_Main');
Route::get('user_screen_main-db_cmd', [UserScreenMainController::class, 'db_cmd'])->name('User_Screen_Main_Action');

Route::view('User_Screen_Sub','Admin.user_screen_sub.admin')->name('User_Screen_Sub');
Route::get('user_screen_sub-db_cmd', [UserScreenSubController::class, 'db_cmd'])->name('User_Screen_Sub_Action');

Route::get('User_Permission', [UserPermissionController::class, 'user_permission'])->name('User_Permission');
Route::post('user_permission-db_cmd', [UserPermissionController::class, 'db_cmd'])->name('User_Permission_Action');

//Masters
Route::view('Country_Creation', 'Masters.country_creation.admin')->name('Country_Creation');
Route::get('country_creation-db_cmd', [CountryCreationController::class, 'db_cmd'])->name('Country_Creation_Action');

Route::view('State_Creation', 'Masters.state_creation.admin')->name('State_Creation');
Route::get('state_creation-db_cmd', [StateCreationController::class, 'db_cmd'])->name('State_Creation_Action');

Route::view('Market_Creation', 'Masters.market_creation.admin')->name('Market_Creation');
Route::get('market_creation-db_cmd', [MarketController::class, 'db_cmd'])->name('Market_Creation_Action');

Route::view('Sales_Rep_Creation', 'Masters.sales_rep_creation.admin')->name('Sales_Rep_Creation');
Route::post('sales_rep_creation-db_cmd', [SalesRepCreationController::class, 'db_cmd'])->name('Sales_Rep_Creation_Action');

Route::view('District_Creation', 'Masters.district_creation.admin')->name('District_Creation');
Route::get('district_creation-db_cmd', [DistrictCreationController::class, 'db_cmd'])->name('District_Creation_Action');

Route::view('Designation_Creation', 'Masters.designation_creation.admin')->name('Designation_Creation');
Route::get('designation_creation-db_cmd', [DesignationCreationController::class, 'db_cmd'])->name('Designation_Creation_Action');

Route::view('Category_Creation', 'Masters.category_creation.admin')->name('Category_Creation');
Route::get('category_creation-db_cmd', [CategoryCreationController::class, 'db_cmd'])->name('Category_Creation_Action');

Route::view('Group_Creation', 'Masters.group_creation.admin')->name('Group_Creation');
Route::get('group_creation-db_cmd', [GroupCreationController::class, 'db_cmd'])->name('Group_Creation_Action');

Route::view('Tax_Creation', 'Masters.tax_creation.admin')->name('Tax_Creation');
Route::get('tax_creation-db_cmd', [TaxCreationController::class, 'db_cmd'])->name('Tax_Creation_Action');

Route::view('Item_Liters_Type','Masters.item_liters_type.admin')->name('Item_Liters_Type');
Route::get('item_liters_type-db_cmd', [ItemLitersTypeController::class, 'db_cmd'])->name('Item_Liters_Type_Action');

Route::view('Item_Properties_Type','Masters.item_properties_type.admin')->name('Item_Properties_Type');
Route::get('item_properties_type-db_cmd', [ItemPropertiesTypeController::class, 'db_cmd'])->name('Item_Properties_Type_Action');

Route::view('Item_Creation', 'Masters.item_creation.admin')->name('Item_Creation');
Route::get('item_creation-db_cmd', [ItemCreationController::class, 'db_cmd'])->name('Item_Creation_Action');

Route::view('Market_Manager_Creation','Masters.market_manager_creation.admin')->name('Market_Manager_Creation');
Route::post('market_manager_creation-db_cmd', [MarketManagerCreationController::class, 'db_cmd'])->name('Market_Manager_Creation_Action');

Route::view('advance_creation', 'Masters.advance_creation.admin')->name('advance_creation');
Route::get('advance_creation-db_cmd', [advanceCreationController::class, 'db_cmd'])->name('advance_creation_Action');

Route::view('expense_type_creation', 'Masters.expense_type_creation.admin')->name('expense_type_creation');
Route::get('expense_type_creation-db_cmd', [ExpenseTypeCreationController::class, 'db_cmd'])->name('expense_type_creation_Action');

Route::view('sub_expense_type_creation', 'Masters.sub_expense_type_creation.admin')->name('sub_expense_type_creation');
Route::get('sub_expense_type_creation-db_cmd', [SubExpenseTypeCreationController::class, 'db_cmd'])->name('sub_expense_type_creation_Action');

Route::view('Company_Creations','Masters.company_creation.admin')->name('Company_Creations');
Route::get('company_creation-db_cmd', [CompanyCreationController::class, 'db_cmd'])->name('Company_Creations_Action');

Route::view('Shops_Type','Masters.shops_type.admin')->name('Shops_Type');
Route::get('shops_type-db_cmd', [ShopsTypeController::class, 'db_cmd'])->name('Shops_Type_Action');

Route::view('Dealer_Creation','Masters.dealer_creation.admin')->name('Dealer_Creation');
Route::post('Dealer_Creation', [DealerCreationController::class, 'import'])->name('Dealer_Creation.import');
Route::post('dealer_creation-db_cmd', [DealerCreationController::class, 'db_cmd'])->name('Dealer_Creation_Action');

Route::view('Working_Days','Masters.working_days.admin')->name('Working_Days');
Route::get('working_days-db_cmd', [WorkingDaysController::class, 'db_cmd'])->name('Working_Days_Action');

Route::view('Customer_Creation','Masters.customer_creation.admin')->name('Customer_Creation');
Route::get('customer_creation-db_cmd', [CustomerCreationController::class, 'db_cmd'])->name('Customer_Creation_Action');

Route::view('Employee_Creation','Masters.employee_creation.admin')->name('Employee_Creation');
Route::get('employee_creation-db_cmd', [EmployeeCreationController::class, 'db_cmd'])->name('Employee_Creation_Action');

Route::view('account_ledger_creation', 'Masters.account_ledger_creation.admin')->name('account_ledger_creation');
Route::get('account_ledger_creation-db_cmd', [AccountLedgerController::class, 'db_cmd'])->name('account_ledger_creation_action');

Route::view('return_creation', 'Masters.return_creation.admin')->name('return_creation');
Route::get('return_creation-db_cmd', [ReturnCreationController::class, 'db_cmd'])->name('return_creation_action');

//Entry
Route::get('Sales_Order-COMPANY_TO_DEALER', [SalesOrderC2DController::class, 'sales_order_c2d'])->name('Sales_Order_C2D');
Route::get('sales_order_c2d-db_cmd', [SalesOrderC2DController::class, 'db_cmd'])->name('Sales_Order_C2D_Action');

Route::view('Attendance_Entry','Entry.attendance_entry.admin')->name('Attendance_Entry');
Route::get('attendance_entry-db_cmd', [AttendanceEntryController::class, 'db_cmd'])->name('Attendance_Entry_Action');

Route::get('Sales_Order-DEALER_TO_SHOP',[SalesorderD2SController::class, 'sales_order_d2s'])->name('Sales_Order_D2S');
Route::post('sales_order_d2s-db_cmd', [SalesorderD2SController::class, 'db_cmd'])->name('Sales_Order_D2S_Action');

Route::get('Sales_Order_Stock',[SalesOrderStockController::class, 'sales_order_stock'])->name('Sales_Order_Stock');
Route::get('sales_order_stock-db_cmd', [SalesOrderStockController::class, 'db_cmd'])->name('Sales_Order_Stock_Action');

Route::get('Expense_creations',[ExpenseCreationsController::class, 'expense_creations'])->name('Expense_Creations');
Route::get('Expense_creations-db_cmd', [ExpenseCreationsController::class, 'db_cmd'])->name('Expense_Creations_Action');

Route::get('Sales_Order_Delivery', [SalesOrderDeliveryController::class, 'sales_order_delivery'])->name('Sales_Order_Delivery');
Route::get('sales_order_delivery-db_cmd', [SalesOrderDeliveryController::class, 'db_cmd'])->name('Sales_Order_Delivery_Action');

Route::get('Sales_Return-DEALER_TO_COMPANY',[SalesReturnD2CController::class, 'sales_return_d2c'])->name('Sales_Return_D2C');
Route::get('sales_return_d2c-db_cmd', [SalesReturnD2CController::class, 'db_cmd'])->name('Sales_Return_D2C_Action');

Route::get('Receipt_Entry', [ReceiptEntryController::class, 'receipt_entry_admin'])->name('Receipt_Entry');
Route::get('Receipt_Entry-db_cmd', [ReceiptEntryController::class, 'db_cmd'])->name('Receipt_Entry_action');

//Reports
Route::get('Beats_Wise_Report', [BeatsWiseReportController::class, 'beats_wise_report'])->name('Beats_Wise_Report');
Route::get('beats_wise_report-db_cmd', [BeatsWiseReportController::class, 'db_cmd'])->name('Beats_Wise_Report_Action');

Route::get('Sales_Order_Report_c2d', [SalesReportController::class, 'sales_order_report_c2d'])->name('Sales_Order_report_C2D');
Route::get('sales_order_Report_c2d-db_cmd', [SalesReportController::class, 'db_cmd'])->name('Sales_Order_Report_C2D_Action');

Route::get('Dealer_Order_Report', [DealerOrderReport::class, 'dealer_order_report'])->name('d_o_report');
Route::get('Dealer_Order_Report-db_cmd', [DealerOrderReport::class, 'db_cmd'])->name('dealer_order_report_action');

Route::get('excutive_sales_report', [ExcutiveLtrSalesReport::class, 'excutive_report'])->name('excutive_sales_report');
Route::get('excutive_sales_report-db_cmd', [ExcutiveLtrSalesReport::class, 'db_cmd'])->name('Excutive_Sales');

Route::get('Effective_Calls_Report', [EffectiveCalls::class, 'effective_calls_Report'])->name('e_c_report');
Route::get('Effective_calls_Report-db_cmd', [EffectiveCalls::class, 'db_cmd'])->name('Effective_calls_Report_action');

Route::get('dealer_sales_report', [DealersSalesReportController::class, 'dealer_sales_report'])->name('dealer_sales_report_1');
Route::get('dealer_sales_report-db_cmd', [DealersSalesReportController::class, 'db_cmd'])->name('dealer_sales_report_Action');

Route::get('Item_Sales_pending_Month_Wise_Report', [ItemSalesPendingMonthWiseReportController::class, 'item_sales_pending_month_wise_report'])->name('Item_Sales_Pending_Month_Wise_Report');
Route::get('item_sales_pending_month_wise_report-db_cmd', [ItemSalesPendingMonthWiseReportController::class, 'db_cmd'])->name('Item_Sales_Pending_Month_Wise_Report_Action');

Route::get('Sales_Box_Report', [SalesBoxReportController::class, 'sales_box_report'])->name('Sales_Box_Report');
Route::get('sales_box_report-db_cmd', [SalesBoxReportController::class, 'db_cmd'])->name('Sales_Box_Report_Action');

Route::get('Receipt_Report', [ReceiptReport::class, 'receipt_Report'])->name('receipt_report');
Route::get('Receipt_Report-db_cmd', [ReceiptReport::class, 'db_cmd'])->name('Receipt_Report_action');