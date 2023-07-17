<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\user\AjaxController;
use App\Http\Controllers\user\UserController;
use App\Models\Contact;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard');

    Route::middleware(['admin_auth'])->group(function(){
         // admin category
        Route::prefix('category')->group(function(){
            Route::get('list',[CategoryController::class,'list'])->name('category#list');
            Route::get('createpage',[CategoryController::class,'category'])->name('category#createpage');
            Route::post('create',[CategoryController::class,'create'])->name('category#create');
            Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
            Route::get('editpage/{id}',[CategoryController::class,'edit'])->name('category#editpage');
            Route::post('update',[CategoryController::class,'update'])->name('category#update');
        });
        // product
        Route::prefix('product')->group(function(){
            Route::get('list',[ProductController::class,'list'])->name('product#list');
            Route::get('createpage',[ProductController::class,'createpage'])->name('product#createpage');
            Route::post('create',[ProductController::class,'create'])->name('product#create');
            Route::get('detail/{id}',[ProductController::class,'detail'])->name('product#detail');
            Route::get('edit/{id}',[ProductController::class,'edit'])->name('product#edit');
            Route::post('update',[ProductController::class,'update'])->name('product#update');
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
        });
        // order
        Route::prefix('order')->group(function(){
            Route::get('list',[OrderController::class,'orderlist'])->name('order#listpage');
            Route::get('orderfilter',[OrderController::class,'orderstatusfilter'])->name('order#statusfilter');
            Route::get('orderdetail/{code}',[OrderController::class,'orderdetail'])->name('order#detail');
        });

        // ajax
        Route::prefix('ajax')->group(function(){
            Route::get('status',[AjaxController::class,'status'])->name('Ajax#status');
            Route::get('statusupdate',[AjaxController::class,'statusupdate'])->name('Ajax#statusupdate');
        });

        Route::prefix('admin')->group(function(){
            // Password
            Route::get('changepasswordpage',[AdminController::class,'changepasswordpage'])->name('admin#changepasswordpage');
            Route::post('changepassword',[AdminController::class,'changepassword'])->name('admin#changepassword');

            // Account detail
            Route::get('account',[AdminController::class,'accountpage'])->name('account#page');
            Route::get('accountedit',[AdminController::class,'accountedit'])->name('account#edit');
            Route::post('accountupdate',[AdminController::class,'accountupdate'])->name('account#update');

            Route::get('contact',[AdminController::class,'contact'])->name('admin#contact');

            // Admin Account
            Route::get('list',[AdminController::class,'list'])->name('admin#list');
            Route::get('change/{id}',[AdminController::class,'change'])->name('admin#change');
            Route::post('update',[AdminController::class,'update'])->name('admin#update');
            Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
            Route::get('ajaxadminrolechange',[AjaxController::class,'adminrolechange'])->name('Ajax#adminrolechange');


            // user account
            Route::get('userlist',[AdminController::class,'userlist'])->name('admin#userlist');
            Route::get('ajaxrolechange',[AjaxController::class,'userrolechange'])->name('Ajax#userrolechange');
            Route::get('deleteuser/{id}',[UserController::class,'delete'])->name('user#delete');

        });
    });


    // user
    Route::group(['prefix' => 'user','middleware' => 'user_auth'],function(){
        // Route::get('home',function(){
        //     return view('user.home');
        // })->name('userhome');
        Route::get('/homePage',[UserController::class,'home'])->name('userhome');
        Route::get('/profile',[UserController::class,'profile'])->name('user#profile');
        Route::post('/profileedit',[UserController::class,'profileedit'])->name('user#profileedit');
        Route::get('/filter/{id}',[UserController::class,'filter'])->name('user#catfilter');
        Route::get('pizzalist{id}',[UserController::class,'pizzalist'])->name('user#pizzalist');
        Route::get('history',[UserController::class,'history'])->name('user#history');
        Route::get('viewcount',[AjaxController::class,'viewcount'])->name('Ajax#viewcount');

        Route::prefix('contact')->group(function(){
            Route::get('contactpage',[ContactController::class,'contact'])->name('user#contactpage');
            Route::post('contactcreate',[ContactController::class,'contactcreate'])->name('user#contactcreate');
        });
        // password
        Route::prefix('password')->group(function(){
            Route::get('changepage',[UserController::class,'changepasswordpage'])->name('userpassword#changepage');
            Route::post('change',[UserController::class,'changepassword'])->name('userpassword#change');
        });

        // cart
        Route::prefix('cart')->group(function(){
            Route::get('cart',[UserController::class,'cartpage'])->name('User#cartPage');
        });

        // ajax
        Route::prefix('ajax')->group(function(){
            Route::get('product',[AjaxController::class,'productdata'])->name('Ajax#product');
            Route::get('cart',[AjaxController::class,'cart'])->name('Ajax#cart');
            Route::get('order',[AjaxController::class,'order'])->name('Ajax#order');
            Route::get('clearcart',[AjaxController::class,'clearcart'])->name('Ajax#clearcart');
            Route::get('removecart',[AjaxController::class,'removecart'])->name('Ajax#removecart');
        });
    });

});

Route::middleware('admin_auth')->group(function(){
    // Home
Route::redirect('/', 'loginpage');

// register
Route::get('registerpage',[AuthController::class,'registerpage'])->name('auth#registerPage');

// login
Route::get('loginpage',[AuthController::class,'loginpage'])->name('auth#loginPage');


});
