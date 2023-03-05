<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminUserController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\User\CartPageController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\WishlistController;
use App\Models\Review;
use App\Models\SiteSetting;
use App\Models\SubCategory;

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
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function () {
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
    Route::get('/logout', [AdminController::class, 'destroy'])->name('admin.logout');
});

Route::middleware('auth:admin')->group(function () {
    Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
        return view('backend.index');
    })->name('dashboard');

    // adminprofile
    Route::get('/admin/profile', [ProfileController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [ProfileController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [ProfileController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/update/change/password', [ProfileController::class, 'AdminUpdateChangePassword'])->name('update.change.password');
});


// user all rout
Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('/user/logout', [IndexController::class, 'UserLogout'])->name('user.logout');
Route::get('/user/profile', [IndexController::class, 'UserProfile'])->name('user.profile');
Route::post('/user/profile/store', [IndexController::class, 'UserProfileStore'])->name('user.profile.store');
Route::get('/user/change/password', [IndexController::class, 'UserChangePassword'])->name('change.password');
Route::post('/user/password/update', [IndexController::class, 'UserPasswordUpdate'])->name('user.password.update');

//socialite
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'HandleGoogleCallback']);


// admin brand
Route::middleware(['auth:admin'])->prefix('brand')->group(function () {
    Route::get('/view', [BrandController::class, 'BrandView'])->name('brand.view');
    Route::post('/store', [BrandController::class, 'BrandStore'])->name('brand.store');
    Route::get('/edit/{id}', [BrandController::class, 'BrandEdit'])->name('brand.edit');
    Route::post('/update', [BrandController::class, 'BrandUpdate'])->name('brand.update');
    Route::get('/delete/{id}', [BrandController::class, 'BrandDelete'])->name('brand.delete');
});


// admin categories
Route::middleware(['auth:admin'])->prefix('category')->group(function () {
    Route::get('/view', [CategoryController::class, 'CategoryView'])->name('category.view');
    Route::post('/store', [CategoryController::class, 'CategoryStore'])->name('category.store');
    Route::get('/edit{id}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');
    Route::post('/update', [CategoryController::class, 'CategoryUpdate'])->name('category.update');
    Route::get('/delete{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');


    // admin subcategori
    Route::get('/sub/view', [SubCategoryController::class, 'SubCategoryView'])->name('subcategory.view');
    Route::post('/sub/store', [SubCategoryController::class, 'SubCategoryStore'])->name('subcategory.store');
    Route::get('/sub/edit{id}', [SubCategoryController::class, 'SubCategoryEdit'])->name('subcategory.edit');
    Route::post('/sub/update', [SubCategoryController::class, 'SubCategoryUpdate'])->name('subcategory.update');
    Route::get('/sub/delete/{id}', [SubCategoryController::class, 'SubCategoryDelete'])->name('subcategory.delete');


    // sub-sub categori
    Route::get('/sub/sub/view', [SubCategoryController::class, 'SubSubCategoryView'])->name('subsubcategory.view');
    Route::get('/subcategory/ajax/{category_id}', [SubCategoryController::class, 'GetSubCategory']);
    Route::get('/sub-subcategory/ajax/{subcategory_id}', [SubCategoryController::class, 'GetSubSubCategory']);
    Route::post('/sub/sub/store', [SubCategoryController::class, 'SubSubCategoryStore'])->name('subsubcategory.store');
    Route::get('/sub/sub/edit/{id}', [SubCategoryController::class, 'SubSubCategoryEdit'])->name('subsubcategory.edit');
    Route::post('/sub/sub/update', [SubCategoryController::class, 'SubSubCategoryUpdate'])->name('subsubcategory.update');
    Route::get('/sub/sub/delete/{id}', [SubCategoryController::class, 'SubSubCategoryDelete'])->name('subsubcategory.delete');
});


// product admin allrout
Route::middleware(['auth:admin'])->prefix('product')->group(function () {
    Route::get('/add', [ProductController::class, 'AddProduct'])->name('add.product');
    Route::post('/store', [ProductController::class, 'ProductStore'])->name('product.store');
    Route::get('/manage', [ProductController::class, 'ManageProduct'])->name('manage.product');
    Route::get('/inactive/{id}', [ProductController::class, 'ProductInactive'])->name('product.inactive');
    Route::get('/active/{id}', [ProductController::class, 'ProductActive'])->name('product.active');
    Route::get('/edit{id}', [ProductController::class, 'ProductEdit'])->name('product.edit');
    Route::post('/update', [ProductController::class, 'ProductUpdate'])->name('product.update');
    Route::post('/image/update', [ProductController::class, 'ProductImageUpdate'])->name('product.image.update');
    Route::post('/gallery/update', [ProductController::class, 'ProductGalleryUpdate'])->name('product.gallery.update');
    Route::get('/image/delete{id}', [ProductController::class, 'ProductGalleryDelete'])->name('product.gallery.delete');
    Route::get('/delete{id}', [ProductController::class, 'ProductDelete'])->name('product.delete');
});

// admin slider allrout
Route::middleware(['auth:admin'])->prefix('slider')->group(function () {
    Route::get('/view', [SliderController::class, 'SliderView'])->name('manage.slider');
    Route::post('/store', [SliderController::class, 'SliderStore'])->name('slider.store');
    Route::get('/nonaktif/{id}', [SliderController::class, 'SliderNonaktif'])->name('slider.nonaktif');
    Route::get('/aktif/{id}', [SliderController::class, 'SliderAktif'])->name('slider.aktif');
    Route::get('/edit{id}', [SliderController::class, 'SliderEdit'])->name('slider.edit');
    Route::post('/update', [SliderController::class, 'SliderUpdate'])->name('slider.update');
    Route::get('/delete{id}', [SliderController::class, 'SliderDelete'])->name('slider.delete');
});

// admin coupon allrout
Route::middleware(['auth:admin'])->prefix('coupon')->group(function () {
    Route::get('/view', [CouponController::class, 'CouponView'])->name('manage.coupon');
    Route::post('/store', [CouponController::class, 'CouponStore'])->name('coupon.store');
    Route::get('/edit{id}', [CouponController::class, 'CouponEdit'])->name('coupon.edit');
    Route::post('/update{id}', [CouponController::class, 'CouponUpdate'])->name('coupon.update');
    Route::get('/delete{id}', [CouponController::class, 'CouponDelete'])->name('coupon.delete');
});

// admin province allroute
Route::middleware(['auth:admin'])->prefix('shipping')->group(function () {
    Route::get('/province/view', [ShippingAreaController::class, 'ProvinceView'])->name('manage.province');
    Route::post('/province/store', [ShippingAreaController::class, 'ProvinceStore'])->name('province.store');
    Route::get('/province/edit{id}', [ShippingAreaController::class, 'ProvinceEdit'])->name('province.edit');
    Route::post('/province/update{id}', [ShippingAreaController::class, 'ProvinceUpdate'])->name('province.update');
    Route::get('/province/delete{id}', [ShippingAreaController::class, 'ProvinceDelete'])->name('province.delete');


    // admin city allrout
    Route::get('/city/view', [ShippingAreaController::class, 'CityView'])->name('manage.city');
    Route::post('/city/store', [ShippingAreaController::class, 'CityStore'])->name('city.store');
    Route::get('/city/edit{id}', [ShippingAreaController::class, 'CityEdit'])->name('city.edit');
    Route::post('/city/update/{id}', [ShippingAreaController::class, 'CityUpdate'])->name('city.update');
    Route::get('/city/delete/{id}', [ShippingAreaController::class, 'CityDelete'])->name('city.delete');

    // admin district allrout
    Route::get('/district/view', [ShippingAreaController::class, 'DistrictView'])->name('manage.district');
    Route::post('/district/store', [ShippingAreaController::class, 'DistrictStore'])->name('district.store');
    Route::get('/district/edit{id}', [ShippingAreaController::class, 'DistrictEdit'])->name('district.edit');
    Route::post('/district/update{id}', [ShippingAreaController::class, 'DistrictUpdate'])->name('district.update');
    Route::get('/district/delete{id}', [ShippingAreaController::class, 'DistrictDelete'])->name('district.delete');
});

// frontend allrout
// product detail page url
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);

// product tags page
Route::get('/product/tag/{tag}', [IndexController::class, 'TagWiseProduct']);

//produk subcategory page
Route::get('/subcategory/product/{subcat_id}/{slug}', [IndexController::class, 'SubCatWiseProduct']);


//produk subcategory page
Route::get('/subsubcategory/product/{subsubcat_id}/{slug}', [IndexController::class, 'SubSubCatWiseProduct']);


// produk search
Route::post('/search', [IndexController::class, 'search'])->name('search.view');

// route untuk menampoilkan view modl with ajax
Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);

// add do cart store data
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);


// add to minicart product
Route::get('/product/mini/cart/', [CartController::class, 'AddMiniCart']);
Route::get('/minicart/product-remove/{rowId}', [CartController::class, 'RemoveMiniCart']);

// add to wishlist
Route::post('/add-to-wishlist/{product_id}', [WishlistController::class, 'addToWishlist']);

// allrout halamaknkeranajng
// route menampilkan halaman keranjang
Route::group(['prefix' => 'user', 'middleware' => ['user', 'auth'], 'namespace' => 'User'], function () {
    // all route cart
    Route::get('/mycart', [CartPageController::class, 'MyCart'])->name('mycart');
    Route::get('/get-cart-product', [CartPageController::class, 'GetCartProduct']);
    Route::get('/user/cart-remove/{rowId}', [CartPageController::class, 'RemoveCartProduct']);
    Route::get('/user/cart-increment/{rowId}', [CartPageController::class, 'CartIncrement']);
    Route::get('/user/cart-decrement/{rowId}', [CartPageController::class, 'CartDecrement']);

    // allrout kupon
    Route::post('/coupon-apply', [CartPageController::class, 'CouponApply']);
    Route::get('/coupon-calculation', [CartPageController::class, 'CouponCalculation']);
    Route::get('/coupon-remove', [CartPageController::class, 'CouponRemove']);

    // wishlist page
    Route::get('/wishlist', [WishlistController::class, 'WishlistView'])->name('wishlist');
    Route::get('/get-wishlist-product', [WishlistController::class, 'GetWishlistProduct']);
    Route::get('/wishlist-remove/{id}', [WishlistController::class, 'RemoveWishlistProduct']);

    // indoregion
    Route::post('/getkabupaten', [CheckoutController::class, 'getkabupaten'])->name('getkabupaten');
    Route::post('/getkecamatan', [CheckoutController::class, 'getkecamatan'])->name('getkecamatan');


    // checkout
    Route::get('/checkout', [CheckoutController::class, 'CheckoutCreate'])->name('checkout');
    Route::get('/city-get/ajax/{province_id}', [CheckoutController::class, 'CityGetAjax']);
    Route::get('/district-get/ajax/{city_id}', [CheckoutController::class, 'DistrictGetAjax']);
    Route::post('/checkout/store', [CheckoutController::class, 'CheckoutStore'])->name('checkout.store');

    // payment
    Route::post('/payment/stripe', [PaymentController::class, 'PayStripe'])->name('pay.stripe');
    Route::post('/payment/cash', [PaymentController::class, 'PaymentCash'])->name('pay.cash');
    Route::post('/payment/manual', [PaymentController::class, 'PaymentManual'])->name('pay.manual');

    // orders
    Route::get('/orders', [AllUserController::class, 'MyOrders'])->name('my.orders');
    Route::get('/order-details/{order_id}', [AllUserController::class, 'OrderDetails']);
    Route::get('/invoice-download/{order_id}', [AllUserController::class, 'InvoiceDownload']);
    Route::post('/cancel/{order_id}', [AllUserController::class, 'CancelOrder'])->name('cancel.order');
    Route::get('/cancel/list', [AllUserController::class, 'CancelOrderList'])->name('cancel.order.list');
    // proses untuk mengembalian pesanan
    Route::post('/return/{order_id}', [AllUserController::class, 'ReturnOrder'])->name('return.order');

    // proses untuk menampilkan data pengembalian pesanan
    Route::get('return/list', [AllUserController::class, 'ReturnOrderList'])->name('return.order.list');

// Review
    //proses untuk menambahkan review pada produk
    Route::post('/review/store', [ReviewController::class, 'ReviewStore'])->name('review.store');

    // order traking
    Route::post('/order/tracking', [AdminUserController::class, 'OrderTracking'])->name('order.tracking');
});

//all admin orders
Route::middleware(['auth:admin'])->prefix('orders')->group(function () {
    // menampilkan halaman orders
    Route::get('/pending', [OrderController::class, 'PendingOrders'])->name('pending.orders');

    // menampilkan halaman order detail transaksi
    Route::get('/pending/details/{order_id}', [OrderController::class, 'PendingOrdersDetails'])->name('pending.order.details');

    // menampilkan halaman konfirmasi transaksi pesanan
    Route::get('/confirmed', [OrderController::class, 'ConfirmedOrders'])->name('confirmed.orders');

    // proses untuk update status konfirmasi pesanan
    Route::get('/pending/confirm/{order_id}', [OrderController::class, 'PendingToConfirm'])->name('pending.confirm');

    // menampilkan halaman kemasan pesanan
    Route::get('/picked', [OrderController::class, 'PickedOrders'])->name('picked.orders');

    // proses untuk update  status halaman kemasan
    Route::get('/confirm/picked/{order_id}', [OrderController::class, 'ConfirmToPicked'])->name('confirm.picked');

    // menampilkan halaman kirim pesanan
    Route::get('/shipped', [OrderController::class, 'ShippedOrders'])->name('shipped.orders');

    // proses untuk update  status halaman kemasan
    Route::get('/confirm/shipped/{order_id}', [OrderController::class, 'PickedToShipped'])->name('picked.shipped');

    // menampilkan halaman pesanan dalam perjalanan
    Route::get('/otw', [OrderController::class, 'OnTheWayOrders'])->name('otw.orders');

    // proses untuk update status halaman dalam perjalanan
    Route::get('/shipped/otw/{order_id}', [OrderController::class, 'ShippedToOtw'])->name('shipped.otw');

    // menampilkan halaman pesanan selesai
    Route::get('/delivered', [OrderController::class, 'DeliveredOrders'])->name('delivered.orders');

    // proses untuk update status halaman pesanan selesai
    Route::get('/otw/delivered/{order_id}', [OrderController::class, 'OtwToDelivered'])->name('otw.delivered');
});

Route::middleware(['auth:admin'])->prefix('cancel')->group(function() {

    // menampilkan halaman pembatalan
    Route::get('/request', [OrderController::class, 'CancelRequest'])->name('cancel.request');

    // proses untuk menyetujui pembatalan pesanan
    Route::get('/request/approve/{order_id}', [OrderController::class, 'CancelRequestApprove'])->name('cancel.approve');

    // proses  untuk menampilkan halaman data pembatalan
    Route::get('all/request', [OrderController::class, 'CancelAllRequest'])->name('cancel.all.request');
});

Route::middleware(['auth:admin'])->prefix('return')->group(function(){

    // menampilkan halaman pengembalian
    Route::get('/request', [OrderController::class, 'ReturnRequest'])->name('return.request');

    // proses untuk menyetujui pengembalian pesanan
    Route::get('/request/approve/{order_id}', [OrderController::class, 'ReturnRequestApprove'])->name('return.approve');

    //  menampilkan halaman data pengembalian
    Route::get('/all/request', [OrderController::class, 'ReturnAllRequest'])->name('return.all.request');
});

Route::middleware(['auth:admin'])->prefix('review')->group(function() {
    // menampilkan untuk menampilkan halaman ulasan yang masuk
    Route::get('/request', [ReviewController::class, 'ReviewRequest'])->name('review.request');

    // proses untuk membuat proses konfirmasi ulasan
    Route::get('/request/approve/{id}', [ReviewController::class, 'ReviewApprove'])->name('review.approve');

    // menampilkan halaman data ulasan
    Route::get('/publish', [ReviewController::class, 'PublishReview'])->name('review.all.request');

    // Proses untuk proses hapus data ulasan
    Route::get('/delete/{id}', [ReviewController::class, 'DeleteReview'])->name('delete.review');
});

// Admin Manage Stock
Route::middleware(['auth:admin'])->prefix('stock')->group(function(){
    Route::get('/product', [ProductController::class, 'ProductStock'])->name('product.stock');
});

// Admin Report
Route::middleware(['auth:admin'])->prefix('report')->group(function(){
    // menampilkan halaman laporan
    Route::get('/view', [ReportController::class, 'ReportView'])->name('report.view');

    // proses untuk menampilkan halaman lapora n berdasarkan tanggal
    Route::post('search/bydate', [ReportController::class, 'ReportByDate'])->name('search.bydate');

    // proses untuk menampilkan halaman lapora n berdasarkan bulan
    Route::post('search/bymonth', [ReportController::class, 'ReportByMonth'])->name('search.bymonth');

    // proses untuk menampilkan halaman lapora n berdasarkan tahun
    Route::post('search/byyear', [ReportController::class, 'ReportByYear'])->name('search.byyear');
});

Route::middleware(['auth:admin'])->prefix('setting')->group(function () {
    // menampilkan halaman pengaturan websate
    Route::get('/site', [SiteSettingController::class, 'SiteSetting'])->name('site.setting');
    // proses untuk update pengaturan websate
    Route::post('/site/update', [SiteSettingController::class, 'SiteSettingUpdate'])->name('update.sitesetting');
    // menampilkan halaman seo setting
    Route::get('/seo', [SiteSettingController::class, 'SeoSetting'])->name('seo.setting');
    //proses untuk update pengaturan seo
    Route::post('/seo/update', [SiteSettingController::class, 'SeoSettingUpdate'])->name('update.seosetting');
});

Route::middleware(['auth:admin'])->prefix('alluser')->group(function () {
    // menampilkan halaman data user
    Route::get('/view', [ProfileController::class, 'AllUsers'])->name('all.users');
});

Route::middleware(['auth:admin'])->prefix('adminrole')->group(function () {
    // menampilkan halaman data user
    Route::get('/all', [AdminUserController::class, 'AllAdminRole'])->name('admin.view');
    // menampilkan halaman tambah admin
    Route::get('/add', [AdminUserController::class, 'AddAdminRole'])->name('add.admin');
    // proses untuk tambah admin
    Route::post('/store', [AdminUserController::class, 'StoreAdminRole'])->name('admin.role.store');
    // menampilkan halaman edit admin
    Route::get('/edit/{id}', [AdminUserController::class, 'EditAdminRole'])->name('edit.admin');
    // proses untuk update admin
    Route::post('/update', [AdminUserController::class, 'UpdateAdminRole'])->name('admin.update');
    // proses untuk delete admin
    Route::get('/delete/{id}', [AdminUserController::class, 'DeleteAdminRole'])->name('delete.admin');

});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
