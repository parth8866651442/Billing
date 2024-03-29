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

Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');

Auth::routes([
    'register' => false,
]);

Route::group(['middleware' => ['auth:web']], function () {
    
    // -------- Home -------- //
    Route::group(['prefix' => 'home'], function () {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    });
    
    // -------- Profile -------- //
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
        Route::post('/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('updateProfile');
        Route::post('/check_user_phone', [App\Http\Controllers\ProfileController::class,'checkuserPhoneNoRepeat'])->name('checkUserPhoneNoRepeat');
        Route::get('/change_password', [App\Http\Controllers\ProfileController::class, 'changePassword'])->name('passwordChange');
        Route::post('/update_password', [App\Http\Controllers\ProfileController::class, 'passworUpdate'])->name('passwordUpdate');
        Route::post('/check_user_current_psw', [App\Http\Controllers\ProfileController::class,'checkUserCurrentPassword'])->name('checkUserPassword');
    });
    
    // -------- Users -------- //
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [App\Http\Controllers\UsersController::class,'index'])->name('userList');
        Route::get('/add', [App\Http\Controllers\UsersController::class,'form'])->name('addUser');
        Route::post('/store', [App\Http\Controllers\UsersController::class,'store'])->name('storeUser');
        Route::get('/edit/{id}', [App\Http\Controllers\UsersController::class,'form'])->name('editUser');
        Route::post('/update/{id}', [App\Http\Controllers\UsersController::class,'update'])->name('updateUser');
        Route::get('/delete/{id}', [App\Http\Controllers\UsersController::class,'destroy'])->name('deleteUser');
        Route::post('/check_user_email', [App\Http\Controllers\UsersController::class,'checkuserEmailRepeat'])->name('checkUserEmailRepeat');
    });

    // -------- Clients -------- //
    Route::group(['prefix' => 'clients'], function () {
        Route::get('/', [App\Http\Controllers\ClientsController::class,'index'])->name('clientList');
        Route::get('/add', [App\Http\Controllers\ClientsController::class,'form'])->name('addClient');
        Route::post('/store', [App\Http\Controllers\ClientsController::class,'store'])->name('storeClient');
        Route::get('/view/{id}', [App\Http\Controllers\ClientsController::class,'view'])->name('viewClient');
        Route::get('/edit/{id}', [App\Http\Controllers\ClientsController::class,'form'])->name('editClient');
        Route::post('/update/{id}', [App\Http\Controllers\ClientsController::class,'update'])->name('updateClient');
        Route::get('/delete/{id}', [App\Http\Controllers\ClientsController::class,'destroy'])->name('deleteClient');
        Route::post('/check_client_email', [App\Http\Controllers\ClientsController::class,'checkClientEmailRepeat'])->name('checkClientEmailRepeat');
    });

    // -------- Category -------- //
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [App\Http\Controllers\CategoriesController::class,'index'])->name('categoryList');
        Route::get('/add', [App\Http\Controllers\CategoriesController::class,'form'])->name('addCategory');
        Route::post('/store', [App\Http\Controllers\CategoriesController::class,'store'])->name('storeCategory');
        Route::get('/edit/{id}', [App\Http\Controllers\CategoriesController::class,'form'])->name('editCategory');
        Route::post('/update/{id}', [App\Http\Controllers\CategoriesController::class,'update'])->name('updateCategory');
        Route::get('/delete/{id}', [App\Http\Controllers\CategoriesController::class,'destroy'])->name('deleteCategory');
        Route::post('/check_category_name', [App\Http\Controllers\CategoriesController::class,'checkCategoryNameRepeat'])->name('checkCategoryNameRepeat');
    });
    
    // -------- Products -------- //
    Route::group(['prefix' => 'products'], function () {
        Route::get('/', [App\Http\Controllers\ProductsController::class,'index'])->name('productList');
        Route::get('/add', [App\Http\Controllers\ProductsController::class,'form'])->name('addProduct');
        Route::post('/store', [App\Http\Controllers\ProductsController::class,'store'])->name('storeProduct');
        Route::get('/edit/{id}', [App\Http\Controllers\ProductsController::class,'form'])->name('editProduct');
        Route::post('/update/{id}', [App\Http\Controllers\ProductsController::class,'update'])->name('updateProduct');
        Route::get('/delete/{id}', [App\Http\Controllers\ProductsController::class,'destroy'])->name('deleteProduct');
        Route::post('/check_product_name', [App\Http\Controllers\ProductsController::class,'checkProductNameRepeat'])->name('checkProductNameRepeat');
    });

    // -------- Orders -------- //
    Route::group(['prefix' => 'orders'], function () {
        Route::get('/', [App\Http\Controllers\OrdersController::class,'index'])->name('orderList');
        Route::get('/add', [App\Http\Controllers\OrdersController::class,'form'])->name('addOrder');
        Route::post('/store', [App\Http\Controllers\OrdersController::class,'store'])->name('storeOrder');
        Route::get('/edit/{id}', [App\Http\Controllers\OrdersController::class,'form'])->name('editOrder');
        Route::post('/update/{id}', [App\Http\Controllers\OrdersController::class,'update'])->name('updateOrder');
        Route::get('/delete/{id}', [App\Http\Controllers\OrdersController::class,'destroy'])->name('deleteOrder');
        Route::get('/remove_item/{id}', [App\Http\Controllers\OrdersController::class,'removeItem'])->name('orderItemRemove');
        Route::get('/item_price/{id}', [App\Http\Controllers\OrdersController::class,'productPrice'])->name('findItemPrice');
        Route::get('/client_orders/{id}', [App\Http\Controllers\OrdersController::class,'clientOrders'])->name('clientOrders');
        Route::get('/search_orders', [App\Http\Controllers\OrdersController::class,'getOrders'])->name('searchOrders');
    });

    // -------- Orders Estimates -------- //
    Route::group(['prefix' => 'estimates'], function () {
        Route::get('/', [App\Http\Controllers\EstimatesController::class,'index'])->name('estimateList');
        Route::get('/add', [App\Http\Controllers\EstimatesController::class,'form'])->name('addEstimate');
        Route::post('/store', [App\Http\Controllers\EstimatesController::class,'store'])->name('storeEstimate');
        Route::get('/edit/{id}', [App\Http\Controllers\EstimatesController::class,'form'])->name('editEstimate');
        Route::post('/update/{id}', [App\Http\Controllers\EstimatesController::class,'update'])->name('updateEstimate');
        Route::get('/delete/{id}', [App\Http\Controllers\EstimatesController::class,'destroy'])->name('deleteEstimate');
        Route::get('/remove_item/{id}', [App\Http\Controllers\EstimatesController::class,'removeItem'])->name('estimateItemRemove');
        Route::get('/item_price/{id}', [App\Http\Controllers\EstimatesController::class,'productPrice'])->name('findItemPriceEstimate');
        Route::get('/get_invoice_no/{type}', [App\Http\Controllers\EstimatesController::class,'invoiceNo'])->name('invoiceNo');
    });

    // -------- settings -------- //
    Route::group(['prefix' => 'settings'], function () {
        Route::get('/', [App\Http\Controllers\SettingsController::class,'index'])->name('settingForm');
        Route::post('/update', [App\Http\Controllers\SettingsController::class,'update'])->name('updateSetting');
    });

    // -------- invoices -------- //
    Route::group(['prefix' => 'invoices'], function () {
        Route::get('/{id}', [App\Http\Controllers\InvoicesController::class,'index'])->name('invoice');
        Route::get('/invoice_view/{id}', [App\Http\Controllers\InvoicesController::class,'view'])->name('invoiceView');
    });

    // -------- payments -------- //
    Route::group(['prefix' => 'payments'], function () {
        Route::get('/', [App\Http\Controllers\PaymentsController::class,'index'])->name('paymentsList');
        Route::get('/receive_payment_detail', [App\Http\Controllers\PaymentsController::class,'receivePaymentDetails'])->name('receivePaymentsDetails');
        Route::post('/receive_payment', [App\Http\Controllers\PaymentsController::class,'receivePayment'])->name('receivePayments');
    });

    // -------- Panel Masters -------- //
    Route::group(['prefix' => 'panel_masters'], function () {
        Route::get('/', [App\Http\Controllers\PanelMastersController::class,'index'])->name('panelMasterList');
        Route::get('/add', [App\Http\Controllers\PanelMastersController::class,'form'])->name('addPanelMaster');
        Route::post('/store', [App\Http\Controllers\PanelMastersController::class,'store'])->name('storePanelMaster');
        Route::get('/edit/{id}', [App\Http\Controllers\PanelMastersController::class,'form'])->name('editPanelMaster');
        Route::post('/update/{id}', [App\Http\Controllers\PanelMastersController::class,'update'])->name('updatePanelMaster');
        Route::get('/delete/{id}', [App\Http\Controllers\PanelMastersController::class,'destroy'])->name('deletePanelMaster');
        Route::post('/check_menu_name', [App\Http\Controllers\PanelMastersController::class,'checkMenuNameRepeat'])->name('checkMenuNameRepeat');
    });

    // -------- Module Masters -------- //
    Route::group(['prefix' => 'module_masters'], function () {
        Route::get('/', [App\Http\Controllers\ModuleMastersController::class,'index'])->name('moduleMasterList');
        Route::get('/add', [App\Http\Controllers\ModuleMastersController::class,'form'])->name('addModuleMaster');
        Route::post('/store', [App\Http\Controllers\ModuleMastersController::class,'store'])->name('storeModuleMaster');
        Route::get('/edit/{id}', [App\Http\Controllers\ModuleMastersController::class,'form'])->name('editModuleMaster');
        Route::post('/update/{id}', [App\Http\Controllers\ModuleMastersController::class,'update'])->name('updateModuleMaster');
        Route::get('/delete/{id}', [App\Http\Controllers\ModuleMastersController::class,'destroy'])->name('deleteModuleMaster');
        Route::post('/check_submenu_name', [App\Http\Controllers\ModuleMastersController::class,'checkSubMenuNameRepeat'])->name('checkSubMenuNameRepeat');
    });

    // -------- Module Masters -------- //
    Route::group(['prefix' => 'permission_masters'], function () {
        Route::get('/assign_module', [App\Http\Controllers\PermissionMastersController::class,'assignModule'])->name('assignModuleForm');
        Route::post('/save_assign_module', [App\Http\Controllers\PermissionMastersController::class,'saveAssignModule'])->name('saveAssignModule');
    });

});