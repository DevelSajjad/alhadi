<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyInfoController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SideBannerController;
use App\Http\Controllers\SocialsController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
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

Route::get('/maintenance', function (){
    return view('maintenance');
  })->name('maintenance');
  Route::get('/product/new-arrivals',[HomeController::class,'new_arrivals'])->name('product.new_arrivals');
  Route::get('/product/special-discount', [HomeController::class,'special_discount'])->name('product.special_discount');
  Route::get('/product/clearance-sale', [HomeController::class,'clearance_sale'])->name('product.clearance_sale');
//  Route::get('/product/special-discount', function (){
//    return 'hello';
//  })->name('product.special_discount');

  Route::get('/subcat-api/{slug}', [HomeController::class,'subcatApi'])->name('subcat-api');
  Route::get('/brand-api/{slug}', [HomeController::class,'brandApi'])->name('brand-api');
  Route::get('/', [HomeController::class,'index'])->name('home');
  Route::get('/return-refund', [HomeController::class,'returnRefund'])->name('return.refund');
  Route::get('/return-refundBN', [HomeController::class,'returnRefundBN'])->name('return.refundBN');
  Route::get('/privacy-policy', [HomeController::class,'privacy_policy'])->name('privacy.policy');
  Route::get('/terms-and-conditions', [HomeController::class,'terms_and_conditions'])->name('terms.and.conditions');
  Route::post('/send-feedback', [HomeController::class,'send_feedback'])->name('send.feedback');

  Route::get('/contact-us', [HomeController::class,'contactus'])->name('contactus');
  Route::get('/aboutus', [HomeController::class,'aboutus'])->name('aboutus');
  Route::get('/product/{slug}', [HomeController::class,'product_details'])->name('product.details');
  Route::get('/products', [HomeController::class,'product_search'])->name('product');
  Route::post('/ajax/search/product/name', [HomeController::class,'ajax_search_product_name'])->name('ajax.search.product.name');

  Route::get('/login', [UserController::class,'login'])->name('login');
  Route::post('/login', [UserController::class,'login'])->name('login');
  Route::get('/registration', [UserController::class,'registration'])->name('registration');
  Route::post('/registration', [UserController::class,'registration'])->name('registration');
  Route::get('/registration/verify', [UserController::class,'reg_verify_otp'])->name('verify.regOTP');
  Route::post('/registration/verify', [UserController::class,'reg_verify_otp'])->name('verify.regOTP');
  Route::get('/forgot-password', [UserController::class,'forgot_password'])->name('forgotPassword');
  Route::post('/forgot-password', [UserController::class,'forgot_password'])->name('forgotPassword');
  Route::get('/forgot-password/verify', [UserController::class,'forgot_password_verify_otp'])->name('verify.forgotPasswordOTP');
  Route::post('/forgot-password/verify',[UserController::class,'forgot_password_verify_otp'])->name('verify.forgotPasswordOTP');
  Route::get('/reset-password', [UserController::class,'reset_password'])->name('resetPassword');
  Route::post('/reset-password', [UserController::class,'reset_password'])->name('resetPassword');

  Route::prefix('cart')->name('cart.')->group(function () {
    Route::post('/add', [CartController::class,'add_to_cart'])->name('add');
    Route::get('/remove/{id}', [CartController::class,'remove_cart_item'])->name('remove');
    Route::post('/update', [CartController::class,'update_cart'])->name('update');
  });

  //Gallery
  Route::prefix('gallery')->name('gallery.')->group(function () {
    Route::get('/', [GalleryController::class,'index'])->name('index');
    Route::get('/{id}', [GalleryController::class,'show'])->name('show');
  });

  Route::get('customer/checkout', [CartController::class,'index'])->name('customer.checkout');
  Route::prefix('customer')->name('customer.')->middleware(['is_customer'])->group(function () {

    Route::get('/logout', [UserController::class,'customer_logout'])->name('logout');
    Route::get('/dashboard', [CustomerController::class,'index'])->name('dashboard');
    Route::get('/profile', [UserController::class,'customer_profile'])->name('profile');
    Route::get('/update-profile', [UserController::class,'customer_update_profile'])->name('updateProfile');
    Route::post('/update-profile', [UserController::class,'customer_update_profile'])->name('updateProfile');
    Route::get('/change-password', [UserController::class,'customer_change_password'])->name('changePassword');
    Route::post('/change-password', [UserController::class,'customer_change_password'])->name('changePassword');

    Route::get('/orders', [OrderController::class,'customer_orderlist'])->name('orders');
    Route::get('/order/{id}', [OrderController::class,'customer_order_details'])->name('orderDetails');

    Route::post('/proceed-to-payment', [OrderController::class,'proceed_to_payment'])->name('proceed.to.payment');

    /*wishlist*/
    Route::get('/wishlist', [WishlistController::class,'customer_wishlist'])->name('wishlist');
    Route::get('/wishlist/add/{product_id}', [WishlistController::class,'add_to_wishlist'])->name('wishlist.add');
    Route::get('/wishlist/remove/{id}', [WishlistController::class,'remove_to_wishlist'])->name('wishlist.remove');

    /*Review*/
//  Route::get('/review', [WishlistController::class,'customer_review'])->name('review');
    Route::post('/review/add/{product_id}', [ReviewController::class,'add_review'])->name('review.add');

    /*compare*/


  });
  Route::get('/compare/add/{product_id}', [ReviewController::class,'add_compare'])->name('compare.add');
  Route::get('/compare/remove/{product_id}', [ReviewController::class,'remove_from_compare'])->name('compare.remove');
  Route::get('/compare', [ReviewController::class,'compare'])->name('compare');


  Route::match(['get', 'post'], '/thankyou', [OrderController::class,'thankyou'])->name('thankyou');
  Route::get('/cancel-payment', [OrderController::class,'cancel_payment'])->name('cancel.payment');
  Route::post('/cancel-payment', [OrderController::class,'cancel_payment'])->name('cancel.payment');

  Route::get('/notice', [NoticeController::class,'notice'])->name('notice');


//});

Route::get('/isvalidCoupon/{coupon}', [CouponController::class,'isvalidCoupon'])->name('isvalidCoupon');









# Admin Routes
Route::match(['get', 'post'], '/xadmin', [UserController::class,'admin_login'])->name('admin.login');

Route::prefix('dashboard')->name('admin.')->middleware(['is_admin_or_mod'])->group(function () {

  Route::get('/logout', [AdminController::class,'logout'])->name('logout');
  Route::get('/', [AdminController::class,'index'])->name('dashboard');

  Route::get('/stock-out-product', [AdminController::class,'stock_out_product'])->name('stock_out_product');
  Route::get('/available-product', [AdminController::class,'available_product'])->name('available_product');
  Route::get('/customer-active', [AdminController::class,'active_customer'])->name('active_customer');
  Route::get('/customer-inactive', [AdminController::class,'inactive_customer'])->name('inactive_customer');
  Route::get('/customer-view', [AdminController::class,'view_customer'])->name('view_customer');
  Route::get('/pending-order', [AdminController::class,'pending_orders'])->name('pending_orders');
  Route::get('/new-order', [AdminController::class,'new_orders'])->name('new_orders');
  Route::get('/processing-order', [AdminController::class,'processing_orders'])->name('processing_orders');
  Route::get('/delivered-order', [AdminController::class,'delivered_orders'])->name('delivered_orders');
  Route::get('/completed-order', [AdminController::class,'completed_orders'])->name('completed_orders');
  Route::get('/canceled-order', [AdminController::class,'canceled_orders'])->name('canceled_orders');
  Route::get('/total-order-this-month', [AdminController::class,'total_orders_this_month'])->name('total_orders_this_month');
  Route::get('/completed-order-this-month', [AdminController::class,'completed_orders_this_month'])->name('completed_orders_this_month');
  Route::get('/pending-order-this-month', [AdminController::class,'pending_orders_this_month'])->name('pending_orders_this_month');
  Route::get('/processing-order-this-month', [AdminController::class,'processing_orders_this_month'])->name('processing_orders_this_month');
  Route::get('/delivered-order-this-month', [AdminController::class,'delivered_orders_this_month'])->name('delivered_orders_this_month');
  Route::get('/canceled-order-this-month', [AdminController::class,'canceled_orders_this_month'])->name('canceled_orders_this_month');


  Route::get('/profile', [AdminController::class,'admin_profile'])->name('profile');
  Route::get( '/contact', [AdminController::class,'admin_contact'])->name('contact');
  Route::post( '/update/contact1', [AdminController::class,'admin_update_contact1'])->name('update.contact1');
  Route::post( '/update/contact2', [AdminController::class,'admin_update_contact2'])->name('update.contact2');

  Route::get('/update-profile', [AdminController::class,'admin_update_profile'])->name('updateProfile');
  Route::post('/update-profile', [AdminController::class,'admin_update_profile'])->name('updateProfile');
  Route::get('/change-password', [AdminController::class,'admin_change_password'])->name('changePassword');
  Route::post('/change-password', [AdminController::class,'admin_change_password'])->name('changePassword');

  # brand
  Route::get('/brand/view', [CategoryController::class,'view_brand'])->name('brand.view');
  Route::get('/brand/add', [CategoryController::class,'add_brand'])->name('brand.add');
  Route::post('/brand/add', [CategoryController::class,'add_brand'])->name('brand.add');
  Route::get('/brand/edit/{slug}', [CategoryController::class,'edit_brand'])->name('brand.edit');
  Route::post('/brand/edit/{slug}', [CategoryController::class,'edit_brand'])->name('brand.edit');
  Route::delete('/brand/delete', [CategoryController::class,'delete_brand'])->name('brand.delete');

  # category
  Route::get('/category/view', [CategoryController::class,'view_category'])->name('category.view');
  Route::get('/category/add', [CategoryController::class,'add_category'])->name('category.add');
  Route::post('/category/add', [CategoryController::class,'add_category'])->name('category.add');
  Route::get('/category/edit/{slug}', [CategoryController::class,'edit_category'])->name('category.edit');
  Route::post('/category/edit/{slug}', [CategoryController::class,'edit_category'])->name('category.edit');
  Route::delete('/category/delete', [CategoryController::class,'delete_category'])->name('category.delete');

  # Sub Category
  Route::get('/sub-category/view', [CategoryController::class,'view_sub_category'])->name('sub-category.view');
  Route::get('/sub-category/add', [CategoryController::class,'add_sub_category'])->name('sub-category.add');
  Route::post('/sub-category/add', [CategoryController::class,'add_sub_category'])->name('sub-category.add');
  Route::get('/sub-category/edit/{slug}', [CategoryController::class,'edit_sub_category'])->name('sub-category.edit');
  Route::post('/sub-category/edit/{slug}', [CategoryController::class,'edit_sub_category'])->name('sub-category.edit');
  Route::delete('/sub-category/delete', [CategoryController::class,'delete_sub_category'])->name('sub-category.delete');

  Route::post('/ajax/category-to-subcategory', [CategoryController::class,'category_sub_category'])->name('ajax.category.to.subcategory');
  Route::post('/ajax/subcategory-to-brand', [CategoryController::class,'sub_category_to_brand'])->name('ajax.subcategory.to.brand');


  # Product
  Route::get('/product/view', [ProductController::class,'view_product'])->name('product.view');
  Route::get('/product/add', [ProductController::class,'add_product'])->name('product.add');
  Route::post('/product/add', [ProductController::class,'add_product'])->name('product.add');
  Route::get('/product/edit/{slug}', [ProductController::class,'edit_product'])->name('product.edit');
  Route::post('/product/edit/{slug}', [ProductController::class,'edit_product'])->name('product.edit');
  Route::delete('/product/delete', [ProductController::class,'delete_product'])->name('product.delete');

  Route::post('/product/image/delete', [ProductController::class,'delete_product_image'])->name('product.delete_image');

  # Banners
  Route::get('/banner/view', [BannerController::class,'view_banner'])->name('banner.view');
  Route::get('/banner/add', [BannerController::class,'add_banner'])->name('banner.add');
  Route::post('/banner/add', [BannerController::class,'add_banner'])->name('banner.add');
  Route::get('/banner/edit/{id}', [BannerController::class,'edit_banner'])->name('banner.edit');
  Route::post('/banner/edit/{id}', [BannerController::class,'edit_banner'])->name('banner.edit');
  Route::delete('/banner/delete', [BannerController::class,'delete_banner'])->name('banner.delete');

  #
  Route::get('/order/view', [OrderController::class,'admin_view_order'])->name('order.view');
  Route::get('/order/unpaid', [OrderController::class,'admin_unpaid_order'])->name('order.unpaid');
  Route::get('/order/details/{id}', [OrderController::class,'admin_view_order_details'])->name('order.details');
  Route::post('/order/change/status', [OrderController::class,'admin_change_order_status'])->name('order.change.status');
  Route::post('/order/delivered-by', [OrderController::class,'admin_add_delevered_by'])->name('order.add.deliveredby');

  Route::post('/ajax/change/banner/status', [BannerController::class,'change_banner_status'])->name('ajax.banner.change_banner_status');


  #rating
  Route::get('/rating/view/{product_id}', [ReviewController::class,'admin_view_review'])->name('rating.view');


  #Modrator
  Route::get('/moderator/view', [ModeratorController::class,'view_moderator'])->middleware(['is_admin'])->name('moderator.view');
  Route::get('/moderator/add', [ModeratorController::class,'add_moderator'])->middleware(['is_admin'])->name('moderator.add');
  Route::post('/moderator/add', [ModeratorController::class,'add_moderator'])->middleware(['is_admin'])->name('moderator.add');
  Route::get('/moderator/edit/{id}', [ModeratorController::class,'edit_moderator'])->middleware(['is_admin'])->name('moderator.edit');
  Route::post('/moderator/edit/{id}', [ModeratorController::class,'edit_moderator'])->middleware(['is_admin'])->name('moderator.edit');
  Route::delete('/moderator/delete', [ModeratorController::class,'delete_moderator'])->middleware(['is_admin'])->name('moderator.delete');


  # logs
  Route::get('/logs', [LogController::class,'view_logs'])->middleware(['is_admin'])->name('logs');

  # Messages
  Route::get('/messages', [AdminController::class,'adminMessageView'])->middleware(['is_admin'])->name('messages');
  Route::get('/customer', [AdminController::class,'adminCustomerView'])->middleware(['is_admin'])->name('customer');


  # notice
  Route::get('/notice/view', [NoticeController::class,'view_notice'])->name('notice.view');
  Route::get('/notice/add', [NoticeController::class,'add_notice'])->name('notice.add');
  Route::post('/notice/add', [NoticeController::class,'add_notice'])->name('notice.add');
  Route::get('/notice/edit/{id}', [NoticeController::class,'edit_notice'])->name('notice.edit');
  Route::post('/notice/edit/{id}', [NoticeController::class,'edit_notice'])->name('notice.edit');
  Route::delete('/notice/delete', [NoticeController::class,'delete_notice'])->name('notice.delete');

  // Gallery
  Route::prefix('gallery')->name('gallery.')->group(function(){
    Route::match(['get', 'post'], '/add',[GalleryController::class,'add'])->name('add');
    Route::match(['get', 'post'], '/edit/{id}',[GalleryController::class,'edit'])->name('edit');
    Route::get('/view',[GalleryController::class,'view'])->name('view');
    Route::delete('/delete',[GalleryController::class,'lete'])->name('delete');
  });

  //Clients
  Route::prefix('clients')->name('clients.')->group(function(){
    Route::match(['get', 'post'], '/add',[ClientController::class,'add'])->name('add');
    Route::match(['get', 'post'], '/edit/{id}',[ClientController::class,'edit'])->name('edit');
    Route::get('/view',[ClientController::class,'view'])->name('view');
    Route::delete('/delete',[ClientController::class,'delete'])->name('delete');
  });

  //SideBanner
  Route::prefix('sidebanner')->name('sidebanner.')->group(function(){
    Route::match(['get', 'post'], '/add',[SideBannerController::class,'add'])->name('add');
    Route::get('/view',[SideBannerController::class,'view'])->name('view');
    Route::delete('/delete',[SideBannerController::class,'delete'])->name('delete');
    Route::match(['get', 'post'], '/edit/{id}',[SideBannerController::class,'edit'])->name('edit');
  });

  //Message
  Route::prefix('message')->name('message.')->group(function(){
    Route::match(['get', 'post'], '/add',[MessageController::class,'add'])->name('add');
  });

  //Coupon
  Route::prefix('coupon')->name('coupon.')->group(function(){
    Route::match(['get','post'], '/add', [CouponController::class,'add'])->name('add');
    Route::get('/delete/{id}', [CouponController::class,'delete'])->name('delete');

  });

    //Report
  Route::prefix('report')->name('report.')->group(function(){

    Route::get('/index', [ReportController::class,'index'])->name('index');
    Route::post('/data', [ReportController::class,'data'])->name('data');

  });

    //Return and Refund
    Route::prefix('policy')->name('policy.')->group(function(){

        Route::get('/create', [PolicyController::class,'create'])->name('create');
        Route::post('/store', [PolicyController::class,'store'])->name('store');
        Route::get('/view', [PolicyController::class,'view'])->name('view');
        Route::get('/viewBN', [PolicyController::class,'viewBN'])->name('viewBN');
        Route::get('/update', [PolicyController::class,'update'])->name('update');
    });

    //Privacy and Policy
    Route::prefix('privacy-and-policy')->name('privacy.')->group(function(){

        Route::get('/create', [PrivacyController::class,'create'])->name('create');
        Route::post('/store', [PrivacyController::class,'store'])->name('store');
        Route::get('/view', [PrivacyController::class,'view'])->name('view');
        Route::get('/viewBN', [PrivacyController::class,'viewBN'])->name('viewBN');
        Route::get('/update', [PrivacyController::class,'update'])->name('update');
    });

    //Term and Condition
    Route::prefix('terms')->name('term.')->group(function(){

        Route::get('/create', [TermController::class,'create'])->name('create');
        Route::post('/store', [TermController::class,'store'])->name('store');
        Route::get('/view', [TermController::class,'view'])->name('view');
        Route::get('/viewBN', [TermController::class,'viewBN'])->name('viewBN');
        Route::get('/update', [TermController::class,'update'])->name('update');
    });

    //Socials
    Route::prefix('socials')->name('socials.')->group(function(){

        Route::get('/view', [SocialsController::class,'view_socials'])->name('view');
        Route::get('/add', [SocialsController::class,'add_socials'])->name('add');
        Route::post('/add', [SocialsController::class,'add_socials'])->name('add');
        Route::get('/edit/{id}', [SocialsController::class,'edit_socials'])->name('edit');
        Route::post('/edit/{id}', [SocialsController::class,'edit_socials'])->name('edit');
        Route::delete('/delete', [SocialsController::class,'delete_socials'])->name('delete');
    });

  //Company Info
  Route::prefix('company-info')->name('companyInfo.')->group(function(){

    Route::get('/create', [CompanyInfoController::class,'create'])->name('create');
    Route::post('/store', [CompanyInfoController::class,'store'])->name('store');
    Route::get('/edit', [CompanyInfoController::class,'edit'])->name('edit');
    Route::post('/update', [CompanyInfoController::class,'update'])->name('update');
  });

});

// invoice
Route::get('/invoice',function(){
  return view('site.invoice');
});

Route::post('/subscribe', [WishlistController::class,'subscribe'])->name('subscribe');
