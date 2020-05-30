<?php

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
Route::get('/', ['as' => 'user.login', 'uses' => 'backend\UserController@index']);
Route::post('/admin-panel', ['as' => 'user.check', 'uses' => 'backend\UserController@login']);
Route::get('/session-al-safa', ['as' => 'session.al_safa', 'uses' => 'backend\DashboardController@al_safa']);
Route::get('/session-pioneer', ['as' => 'session.pioneer', 'uses' => 'backend\DashboardController@pioneer']);
Route::get('/session-safa', ['as' => 'session.safa', 'uses' => 'backend\DashboardController@safa']);
 Route::get('/backup-download/{file_name}', ['as' => 'backup.download', 'uses' => 'BackupController@download']);
   Route::get('/backup-delete/{file_name}', ['as' => 'backup.delete', 'uses' => 'BackupController@delete']);
      Route::get('/backup-create', ['as' => 'backup.create', 'uses' => 'BackupController@create']);
//Route::get('/', function () {
//    return view('welcome');
//});
        Route::group(['middleware' => 'Revalidate'],function() {
        Route::group(['middleware' => 'Authenticate'], function () {

        Route::get('/database-backup', ['as' => 'database.backup', 'uses' => 'BackupController@index']);

               
        Route::get('/dashboard-panel', ['as' => 'user.dashboard', 'uses' => 'backend\DashboardController@index']);

        Route::get('/user-register', ['as' => 'user.register', 'uses' => 'backend\UserController@create']);
        Route::post('/user-save', ['as' => 'user.store', 'uses' => 'backend\UserController@store']);
        Route::get('/change-password', ['as' => 'change.password', 'uses' => 'backend\UserController@changepassword']);
        Route::post('/change-save', ['as' => 'change.save', 'uses' => 'backend\UserController@changesave']);
        Route::get('/reset-password', ['as' => 'reset.password', 'uses' => 'backend\ForgotPasswordController@showLinkRequestForm']);
        Route::post('password/email', ['as' => 'reset.password.send', 'uses' => 'backend\ForgotPasswordController@sendResetLinkEmail']);
        Route::get('password/reset/{token}', ['as' => 'reset.password.token', 'uses' => 'backend\ResetPasswordController@showResetForm']);
        Route::post('password/reset', ['as' => 'reset.password.save', 'uses' => 'backend\ResetPasswordController@reset']);


        Route::get('/logout', ['as' => 'user.logout', 'uses' => 'backend\UserController@logout']);

        Route::get('/module-create', ['as' => 'module.create', 'uses' => 'backend\ModuleController@create']);
        Route::post('/module-store', ['as' => 'module.store', 'uses' => 'backend\ModuleController@store']);
        Route::get('/module-list', ['as' => 'module.list', 'uses' => 'backend\ModuleController@index']);
        Route::get('/module-edit/{id}', ['as' => 'module.edit', 'uses' => 'backend\ModuleController@edit']);
        Route::post('/module-update/{id}', ['as' => 'module.update', 'uses' => 'backend\ModuleController@update']);
        Route::delete('/module-delete/{id}', ['as' => 'module.delete', 'uses' => 'backend\ModuleController@destroy']);

        Route::get('/customer-create', ['as' => 'customer.create', 'uses' => 'backend\CustomerController@create']);
        Route::post('/customer-store', ['as' => 'customer.store', 'uses' => 'backend\CustomerController@store']);
        Route::get('/customers-list', ['as' => 'customer.list', 'uses' => 'backend\CustomerController@index']);
        Route::get('/customer-edit/{id}', ['as' => 'customer.edit', 'uses' => 'backend\CustomerController@edit']);
        Route::post('/customer-update/{id}', ['as' => 'customer.update', 'uses' => 'backend\CustomerController@update']);
        Route::delete('/customer-delete/{id}', ['as' => 'customer.delete', 'uses' => 'backend\CustomerController@destroy']);

        Route::get('/employee-create', ['as' => 'employee.create', 'uses' => 'backend\EmployeeController@create']);
        Route::post('/employee-store', ['as' => 'employee.store', 'uses' => 'backend\EmployeeController@store']);
        Route::get('/employee-list', ['as' => 'employee.list', 'uses' => 'backend\EmployeeController@index']);
        Route::get('/employee-edit/{id}', ['as' => 'employee.edit', 'uses' => 'backend\EmployeeController@edit']);
        Route::post('/employee-update/{id}', ['as' => 'employee.update', 'uses' => 'backend\EmployeeController@update']);
        Route::delete('/employee-delete/{id}', ['as' => 'employee.delete', 'uses' => 'backend\EmployeeController@destroy']);

        Route::get('/dealer-create', ['as' => 'dealer.create', 'uses' => 'backend\DealerController@create']);
        Route::post('/dealer-store', ['as' => 'dealer.store', 'uses' => 'backend\DealerController@store']);
        Route::get('/dealer-list', ['as' => 'dealer.list', 'uses' => 'backend\DealerController@index']);
        Route::get('/dealer-edit/{id}', ['as' => 'dealer.edit', 'uses' => 'backend\DealerController@edit']);
        Route::post('/dealer-update/{id}', ['as' => 'dealer.update', 'uses' => 'backend\DealerController@update']);
        Route::delete('/dealer-delete/{id}', ['as' => 'dealer.delete', 'uses' => 'backend\DealerController@destroy']);
        Route::get('/dealer-bonus/{id}', ['as' => 'dealer.bonus', 'uses' => 'backend\DealerController@bonus']);
        Route::post('/dealer-store_bonus/{id}', ['as' => 'dealer.store_bonus', 'uses' => 'backend\DealerController@store_bonus']);

        Route::get('/role-create', ['as' => 'role.create', 'uses' => 'backend\RoleController@create']);
        Route::post('/role-store', ['as' => 'role.store', 'uses' => 'backend\RoleController@store']);
        Route::get('/role-list', ['as' => 'role.list', 'uses' => 'backend\RoleController@index']);



        Route::get('/permission-create', ['as' => 'permission.create', 'uses' => 'backend\PermissionController@create']);
        Route::post('/permission-store', ['as' => 'permission.store', 'uses' => 'backend\PermissionController@store']);
        Route::get('/permission-list', ['as' => 'permission.list', 'uses' => 'backend\PermissionController@index']);
        Route::delete('/permission-delete/{id}', ['as' => 'permission.delete', 'uses' => 'backend\PermissionController@destroy']);
        Route::get('/permission-edit/{id}', ['as' => 'permission.edit', 'uses' => 'backend\PermissionController@edit']);
        Route::post('/permission-update/{id}', ['as' => 'permission.update', 'uses' => 'backend\PermissionController@update']);
        Route::get('/permission/asign/{id}', ['as' => 'permission.asign', 'uses' => 'backend\PermissionController@asign']);
        Route::post('/permission/permissionasign/{id}', ['as' => 'permission.permissionasign', 'uses' => 'backend\PermissionController@permissionasign']);


        Route::get('/productcategory-create', ['as' => 'productcategory.create', 'uses' => 'backend\ProductcategoryController@create']);
        Route::get('/productcategory-list', ['as' => 'productcategory.list', 'uses' => 'backend\ProductcategoryController@index']);
        Route::post('/productcategory-save', ['as' => 'productcategory.store', 'uses' => 'backend\ProductcategoryController@store']);
        Route::delete('/productcategory-delete/{id}', ['as' => 'productcategory.delete', 'uses' => 'backend\ProductcategoryController@destroy']);
        Route::get('/productcategory-edit/{id}/edit', ['as' => 'productcategory.edit', 'uses' => 'backend\ProductcategoryController@edit']);
        Route::post('/productcategory-update/{id}', ['as' => 'productcategory.update', 'uses' => 'backend\ProductcategoryController@update']);


        Route::get('/product-create', ['as' => 'product.create', 'uses' => 'backend\ProductController@create']);
        Route::get('/product-list', ['as' => 'product.list', 'uses' => 'backend\ProductController@index']);
        Route::get('/expiry-dates', ['as' => 'product.expiredlist', 'uses' => 'backend\ExpiredProductController@index']);
        Route::post('/product-save', ['as' => 'product.store', 'uses' => 'backend\ProductController@store']);
        Route::delete('/product-delete/{id}', ['as' => 'product.delete', 'uses' => 'backend\ProductController@destroy']);
        Route::get('/product-edit/{id}/edit', ['as' => 'product.edit', 'uses' => 'backend\ProductController@edit']);
        Route::post('/product-update/{id}', ['as' => 'product.update', 'uses' => 'backend\ProductController@update']);
        Route::get('/stock-edit/{id}/edit', ['as' => 'stock.edit', 'uses' => 'backend\ProductController@stockedit']);
        Route::post('/stock-update/{id}', ['as' => 'stock.update', 'uses' => 'backend\ProductController@stockupdate']);

        Route::get('/sales',  ['as' => 'sales.index', 'uses' => 'backend\SalesController@index']);
        Route::post('/add_cash_sale', 'backend\SalesController@add_cash_sale');
        Route::post('/add_credit_sale', 'backend\SalesController@add_credit_sale');
        Route::get('/sales-create',  ['as' => 'sales.create', 'uses' => 'backend\SalesController@create']);
        Route::post('/sales-store', ['as' => 'sales.store', 'uses' => 'backend\SalesController@store']);
        Route::post('/credit-sales-store', ['as' => 'credit.sales.store', 'uses' => 'backend\SalesController@credit_store']);
         Route::get('/creditsale-edit/{id}', ['as' => 'creditsale.edit', 'uses' => 'backend\SalesController@credit_edit']);
        Route::post('/creditsale-update/{id}', ['as' => 'creditsale.update', 'uses' => 'backend\SalesController@credit_update']);
         
         Route::get('/sales-edit/{id}', ['as' => 'sales.edit', 'uses' => 'backend\SalesController@edit']);
        Route::post('/sales-update/{id}', ['as' => 'sales.update', 'uses' => 'backend\SalesController@update']);
        Route::delete('/sales-delete/{id}', ['as' => 'sales.delete', 'uses' => 'backend\SalesController@destroy']);
        Route::get('/creditsale-paydue/{id}', ['as' => 'creditsale.paydue', 'uses' => 'backend\SalesController@paydue']);
        Route::post('/creditsale-storepaydue/{id}', ['as' => 'creditsale.storepaydue', 'uses' => 'backend\SalesController@storepaydue']);
        Route::get('/sales-list', ['as' => 'sales.list', 'uses' => 'backend\SalesController@sales_report']);
        Route::get('/ajaxsales-list', ['as' => 'ajaxsales.list', 'uses' => 'backend\SalesController@ajaxlist']);
        Route::get('/ajax-form', ['as' => 'ajax.form', 'uses' => 'backend\SalesController@ajaxform']);
        Route::get('/refresh-product', ['as' => 'refresh.product', 'uses' => 'backend\SalesController@refreshproduct']);
        Route::get('/refresh-sale', ['as' => 'refresh.sale', 'uses' => 'backend\SalesController@refreshsale']);
        Route::get('/refresh-customer', ['as' => 'refresh.customer', 'uses' => 'backend\SalesController@refreshcustomer']);
        Route::get('/sales-allpdf', ['as' => 'sales.printall', 'uses' => 'backend\SalesController@getallpdf']);
        Route::post('/date-report', ['as' => 'date.report', 'uses' => 'backend\SalesController@getdatereport']);
        Route::post('/customer-report', ['as' => 'customer.report', 'uses' => 'backend\SalesController@getcustomerreport']);
        Route::post('/product-report', ['as' => 'product.report', 'uses' => 'backend\SalesController@getproductreport']);
        Route::post('/getquantity', ['as' => 'sales.getquantity', 'uses' => 'backend\SalesController@getquantity']);
        Route::post('/getquantityedit', ['as' => 'sales.getquantityedit', 'uses' => 'backend\SalesController@getquantityedit']);
        Route::post('/getprice', ['as' => 'sales.getprice', 'uses' => 'backend\SalesController@getprice']);
        Route::post('/getcustomerdue', ['as' => 'sales.getcustomerdue', 'uses' => 'backend\SalesController@getcustomerdue']);
        Route::post('/getsaleprice', ['as' => 'sales.getsaleprice', 'uses' => 'backend\SalesController@getsaleprice']);

        Route::post('/savetosales', ['as' => 'save.sales', 'uses' => 'backend\SalesController@savetosales']);
        Route::delete('/delete-salescart/{id}/{pid}', ['as' => 'salescart.delete', 'uses' => 'backend\SalesController@deletecart']);
        Route::get('/sales_return', ['as' => 'sales.return', 'uses' => 'backend\SalesController@sales_return']);
        Route::post('/product-exchange', ['as' => 'sales.product_exchange', 'uses' => 'backend\SalesController@product_exchange']);
        Route::post('/return-payment', ['as' => 'sales.return_payment', 'uses' => 'backend\SalesController@return_payment']);
        Route::post('/pay-due', ['as' => 'sales.pay_due', 'uses' => 'backend\SalesController@pay_due']);





        Route::get('/expenses-create', ['as' => 'expenses.create', 'uses' => 'backend\ExpensesController@create']);
        Route::get('/expenses-list', ['as' => 'expenses.list', 'uses' => 'backend\ExpensesController@index']);
        Route::post('/expenses-save', ['as' => 'expenses.store', 'uses' => 'backend\ExpensesController@store']);
        Route::delete('/expenses-delete/{id}', ['as' => 'expenses.delete', 'uses' => 'backend\ExpensesController@destroy']);
        Route::get('/expenses-edit/{id}/edit', ['as' => 'expenses.edit', 'uses' => 'backend\ExpensesController@edit']);
        Route::post('/expenses-update/{id}', ['as' => 'expenses.update', 'uses' => 'backend\ExpensesController@update']);
        Route::get('/expensesheading-create', ['as' => 'expensesheading.create', 'uses' => 'backend\ExpensesController@expensesheadingcreate']);
        Route::post('/expensesheading-save', ['as' => 'expensesheading.store', 'uses' => 'backend\ExpensesController@expensesheadingstore']);
        Route::get('/expenses-report', ['as' => 'expenses.report', 'uses' => 'backend\ExpensesController@export']);


        Route::get('/purchase-create', ['as' => 'purchase.create', 'uses' => 'backend\PurchaseController@create']);
        Route::get('/purchase-list', ['as' => 'purchase.list', 'uses' => 'backend\PurchaseController@index']);
        Route::post('/purchase-save', ['as' => 'purchase.store', 'uses' => 'backend\PurchaseController@store']);
        //Route::delete('/purchase-delete/{id}', ['as' => 'purchase.delete', 'uses' => 'backend\PurchaseController@destroy']);
        //Route::get('/purchase-edit/{id}/edit', ['as' => 'purchase.edit', 'uses' => 'backend\PurchaseController@edit']);
        Route::get('/purchase-paydue/{id}', ['as' => 'purchase.edit', 'uses' => 'backend\PurchaseController@edit']);

        Route::post('/purchase-update/{id}', ['as' => 'purchase.update', 'uses' => 'backend\PurchaseController@update']);
        Route::post('/purchase-report', ['as' => 'purchase.report', 'uses' => 'backend\PurchaseController@purchasereport']);

        Route::get('/transaction-create', ['as' => 'transaction.create', 'uses' => 'backend\TransactionController@create']);
        Route::get('/transaction-list', ['as' => 'transaction.list', 'uses' => 'backend\TransactionController@index']);
        Route::post('/transaction-save', ['as' => 'transaction.store', 'uses' => 'backend\TransactionController@store']);
        Route::get('/transaction-update/{id}', ['as' => 'transaction.update', 'uses' => 'backend\TransactionController@update']);
        Route::get('/transaction-report', ['as' => 'transaction.report', 'uses' => 'backend\TransactionController@export']);

    });
});
