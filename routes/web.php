<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductDetail;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;

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

Route::get('/', [HomeController::class, 'home']);

Route::get('/home', [HomeController::class, 'home']);
Route::get('/shop', [HomeController::class, 'shop']);


// login
Route::get('/login-customer', [HomeController::class, 'login']);
Route::post('/check-login', [HomeController::class, 'check_login']);
Route::get('/registration', [HomeController::class, 'registration']);
Route::post('/check-registration', [HomeController::class, 'check_registration']);
Route::get('/logout', [HomeController::class, 'logout']);

Route::get('/my-account', [HomeController::class, 'my_account']);
Route::post('/update-account', [HomeController::class, 'update_account']);
//Login facebook
Route::get('/login-facebook', [HomeController::class, 'login_facebook']);
Route::get('/login-customer/callback', [HomeController::class, 'callback_facebook']);
Route::get('/login-google', [HomeController::class, 'login_google']);
Route::get('/login-customer/google/callback', [HomeController::class, 'callback_google']);
//
Route::get('/category/{category_slug}', [HomeController::class, 'category']);
Route::get('/brand/{brand_slug}', [HomeController::class, 'brand']);
Route::get('/product-detail/{product_slug}', [ProductDetail::class, 'product_detail']);
Route::get('/tag/{tag}', [HomeController::class, 'tag']);

// blog
Route::get('/blog', [PostController::class, 'blog']);
Route::get('/blog-detail/{post_slug}', [PostController::class, 'blog_detail']);
// comment post
Route::post('/add-post-cmt', [PostController::class, 'add_post_comment']);
// cart
Route::post('/add-cart', [CartController::class, 'add_cart_w_qty']);
Route::post('/add-cart-ajax', [CartController::class, 'add_cart_ajax']);
Route::get('/cart', [CartController::class, 'show_cart']);
Route::post('/delete-cart', [CartController::class, 'delete_cart']);
Route::post('/update-cart', [CartController::class, 'update_cart_test']);
Route::post('/check-coupon', [CartController::class, 'check_coupon']);

// check-out
Route::get('/check-out', [CheckOutController::class, 'check_out']);
Route::post('/savecheckout', 'App\Http\Controllers\CheckOutController@save_checkout');
Route::get('/check-out-success', [CheckOutController::class, 'check_out_success']);
Route::post('/select', [CheckOutController::class, 'select']);


// comment
Route::post('/add-comment', [ProductDetail::class, 'add_comment']);
Route::post('/reply-comment', [ProductDetail::class, 'reply_comment']);

// search
Route::post('/search-ajax', [HomeController::class, 'search_ajax']);
Route::post('/search', [HomeController::class, 'search']);
// paginate
Route::post('/paginate', [HomeController::class, 'paginate']);
// rating
Route::post('/add-rating', [ProductDetail::class, 'add_rating']);
// your-order
Route::get('/your-order', [CheckOutController::class, 'your_order']);
Route::get('/cancel-order/{order_id}', [CheckOutController::class, 'cancel_your_order']);
// contact
Route::get('/contact', [HomeController::class, 'contact']);
// faq
Route::get('/faq', [HomeController::class, 'faq']);


// Back end
Route::post('/load-statistic', [AdminController::class, 'load_statistic']);
Route::post('/load-chart', [AdminController::class, 'load_chart']);
Route::group(['prefix' => 'admin'], function () {
    Route::get('/dashboard', [AdminController::class, 'index']);
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/checklogin', [AuthController::class, 'check_login']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/statistic', [AdminController::class, 'statistic']);
    Route::get('/customer', [AdminController::class, 'customer']);
    Route::get('/delete-customer/{customer_id}', [AdminController::class, 'customer_user']);
    Route::get('/lock-customer/{customer_id}', [AdminController::class, 'customer_user']);

    // User
    Route::group(['prefix' => 'user'], function () {
        Route::group(['middleware' => 'roles'], function () {
            Route::get('/all-user', [UserController::class, 'index']);
            Route::post('/assign-roles', [UserController::class, 'assign_roles']);
            Route::get('/delete-user/{user_id}', [UserController::class, 'delete_user']);
        });
    });
    // Category
    Route::group(['prefix' => 'category'], function () {
        Route::group(['middleware' => 'roles'], function () {
            Route::get('/add-category', [CategoryController::class, 'add_category']);
            Route::post('/save-category', [CategoryController::class, 'save_category']);
            Route::get('/edit-category/{category_id}', [CategoryController::class, 'edit_category']);
            Route::post('/update-category', [CategoryController::class, 'update_category']);
            Route::get('/delete-category/{category_id}', [CategoryController::class, 'delete_category']);
            Route::get('/active-category/{category_id}', [CategoryController::class, 'active_category']);
            Route::get('/unactive-category/{category_id}', [CategoryController::class, 'unactive_category']);
        });
        Route::get('/all-category', [CategoryController::class, 'all_category']);
    });
    // Brand
    Route::group(['prefix' => 'brand'], function () {
        Route::group(['middleware' => 'roles'], function () {
            Route::get('/add-brand', [BrandController::class, 'add_brand']);
            Route::post('/save-brand', [BrandController::class, 'save_brand']);
            Route::get('/edit-brand/{brand_id}', [BrandController::class, 'edit_brand']);
            Route::post('/update-brand', [BrandController::class, 'update_brand']);
            Route::get('/delete-brand/{brand_id}', [BrandController::class, 'delete_brand']);
            Route::get('/active-brand/{brand_id}', [BrandController::class, 'active_brand']);
            Route::get('/unactive-brand/{brand_id}', [BrandController::class, 'unactive_brand']);
        });
        Route::get('/all-brand', [BrandController::class, 'all_brand']);
    });
    // Product
    Route::group(['prefix' => 'product'], function () {
        Route::group(['middleware' => 'roles'], function () {
            Route::get('/add-product', [ProductController::class, 'add_product']);
            Route::post('/save-product', [ProductController::class, 'save_product']);
            Route::get('/edit-product/{product_id}', [ProductController::class, 'edit_product']);
            Route::post('/update-product', [ProductController::class, 'update_product']);
            Route::get('/delete-product/{product_id}', [ProductController::class, 'delete_product']);
            Route::get('/product_status/{product_id}', [ProductController::class, 'product_status']);
            // gallery
            Route::post('/add-gallery', [GalleryController::class, 'add_gallery']);
            Route::get('/delete-ga/{gallery_id}', [GalleryController::class, 'delete_ga']);
            // arrange
            Route::post('/arrange-product', [ProductController::class, 'arrange_product']);
            // comment
            Route::get('/delete-comment/{product_id}', [ProductController::class, 'delete_comment']);
        });
        Route::get('/all-product', [ProductController::class, 'all_product']);
        Route::post('/search-product', [ProductController::class, 'search_product']);
        // gallery
        Route::get('/gallery/{product_id}', [GalleryController::class, 'gallery']);
        // comment
        Route::get('/comment/{product_id}', [ProductController::class, 'comment']);
    });
    Route::group(['prefix' => 'comment'], function () {
        Route::group(['middleware' => 'roles'], function () {
            Route::get('/show-comment', [CommentController::class, 'show_comment']);
            Route::get('/show-reply/{comment_id}', [CommentController::class, 'show_reply']);
            Route::post('/add-reply', [CommentController::class, 'add_reply']);
        });
    });
    // order
    Route::group(['prefix' => 'order'], function () {
        Route::group(['middleware' => 'roles'], function () {
            Route::get('/agree-order/{order_id}', [CheckOutController::class, 'agree_order']);
            Route::get('/xoa-order/{order_id}', [CheckOutController::class, 'xoa_order']);
        });
        Route::get('/confirm-order', [CheckOutController::class, 'confirm_order']);
        Route::get('/success-order', [CheckOutController::class, 'success_order']);
        Route::get('/cancel-order', [CheckOutController::class, 'cancel_order']);
        Route::get('/all-order', [CheckOutController::class, 'all_order']);
        Route::get('/detail-order/{order_id}', [CheckOutController::class, 'detail_order']);
    });
    // coupon
    Route::group(['prefix' => 'coupon'], function () {
        Route::group(['middleware' => 'roles'], function () {
            Route::get('/add-coupon', [CouponController::class, 'add_coupon']);
            Route::get('/all-coupon', [CouponController::class, 'all_coupon']);
            Route::post('/save-coupon', [CouponController::class, 'save_coupon']);
            Route::get('/edit-coupon/{coupon}', [CouponController::class, 'edit_coupon']);
            Route::post('/update-coupon', [CouponController::class, 'update_coupon']);
            Route::get('/delete-coupon/{brand_id}', [CouponController::class, 'delete_coupon']);
        });
    });
    // category post
    Route::group(['prefix' => 'category_post'], function () {
        Route::group(['middleware' => 'roles'], function () {
            Route::get('/add-category-post', [PostController::class, 'add_category_post']);
            Route::post('/save-category-post', [PostController::class, 'save_category_post']);
            Route::get('/edit-category-post/{category_post_id}', [PostController::class, 'edit_category_post']);
            Route::post('/update-category-post', [PostController::class, 'update_category_post']);
            Route::get('/delete-category-post/{category_post_id}', [PostController::class, 'delete_category_post']);
            Route::get('/status-category-post/{category_post_id}', [PostController::class, 'status_category_post']);
        });
        Route::get('/all-category-post', [PostController::class, 'all_category_post']);
    });
    //post
    Route::group(['prefix' => 'post'], function () {
        Route::group(['middleware' => 'roles'], function () {
            Route::get('/add-post', [PostController::class, 'add_post']);
            Route::post('/save-post', [PostController::class, 'save_post']);
            Route::get('/edit-post/{post_id}', [PostController::class, 'edit_post']);
            Route::post('/update-post', [PostController::class, 'update_post']);
            Route::get('/delete-post/{post_id}', [PostController::class, 'delete_post']);
            Route::get('/status-post/{post_id}', [PostController::class, 'status_post']);
        });
        Route::get('/all-post', [PostController::class, 'all_post']);
    });
    // slider
    Route::group(['prefix' => 'slider'], function () {
        Route::group(['middleware' => 'roles'], function () {
            Route::get('/add-slider', [PageController::class, 'add_slider']);
            Route::post('/save-slider', [PageController::class, 'save_slider']);
            Route::get('/edit-slider/{slider_id}', [PageController::class, 'edit_slider']);
            Route::post('/update-slider', [PageController::class, 'update_slider']);
            Route::get('/delete-slider/{slider_id}', [PageController::class, 'delete_slider']);
            Route::get('/status-slider/{slider_id}', [PageController::class, 'status_slider']);
        });
        Route::get('/all-slider', [PageController::class, 'all_slider']);
    });
    // contact
    Route::get('/contact', [AdminController::class, 'contact']);
    Route::post('/update-contact', [AdminController::class, 'update_contact']);
    // faq
    Route::group(['prefix' => 'faq'], function () {
        Route::group(['middleware' => 'roles'], function () {
            Route::get('/add-faq', [PageController::class, 'add_faq']);
            Route::post('/save-faq', [PageController::class, 'save_faq']);
            Route::get('/edit-faq/{faq_id}', [PageController::class, 'edit_faq']);
            Route::post('/update-faq', [PageController::class, 'update_faq']);
            Route::get('/delete-faq/{faq_id}', [PageController::class, 'delete_faq']);
        });
        Route::get('/all-faq', [PageController::class, 'all_faq']);
    });
    // sale
    Route::group(['prefix' => 'sale'], function () {
        Route::group(['middleware' => 'roles'], function () {
            Route::get('/add-sale', [PageController::class, 'add_sale']);
            Route::post('/save-sale', [PageController::class, 'save_sale']);
            Route::get('/edit-sale/{sale_id}', [PageController::class, 'edit_sale']);
            Route::post('/update-sale', [PageController::class, 'update_sale']);
            Route::get('/delete-sale/{sale_id}', [PageController::class, 'delete_sale']);
        });
        Route::get('/all-sale', [PageController::class, 'all_sale']);
    });
});
Route::get('/te', [PageController::class, 'te']);
