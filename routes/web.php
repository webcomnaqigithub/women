<?php

use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\FacebookSocialiteController;
use App\Http\Controllers\Front\NewsLetterController;
use App\Http\Controllers\GoogleSocialiteController;
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

// if( env( 'SHOP_MULTILOCALE' ) )
// {
//     $locale = ['prefix' => '{locale}', 'where' => ['locale' => '[a-zA-Z]{2}(\_[a-zA-Z]{2})?']];

//     Route::get('/', function () {
//         return redirect(app()->getLocale());
//     });
// }
require __DIR__.'/aimeos.php';
 
    $params = [];
    $conf = ['prefix' => '', 'where' => []];

    // if( env( 'SHOP_MULTILOCALE' ) )
    // {
        $conf['prefix'] .= '{locale}';
        $conf['where']['locale'] = '[a-z]{2}(\_[A-Z]{2})?';
        $params = ['locale' => app()->getLocale()];
    // }

    if( $conf['prefix'] )
    {
        Route::get('/', function () use ($params) {
            return redirect(airoute('aimeos_home', $params));
        });
    }



Route::group($conf ?? [], function() {

    require __DIR__.'/auth.php';

    // Route::get('/', '\Aimeos\Shop\Controller\CatalogController@homeAction')->name('aimeos_home');
    Route::get('', 'App\Http\Controllers\Front\Marketplace\HomeController@index')->name('aimeos_home');
    Route::get('stores', 'App\Http\Controllers\Front\StoreController@index')->name('front.store.index');
    Route::get('stores/{id}', 'App\Http\Controllers\Front\StoreController@show')->name('front.store.show');
    Route::get('blog', 'App\Http\Controllers\Front\Blog\BlogController@index')->name('front.blog.index');
    Route::get('blog/{id}', 'App\Http\Controllers\Front\Blog\BlogController@show')->name('front.blog.show');
    Route::get('contactus', 'App\Http\Controllers\Front\ContactUsController@index')->name('front.contactus.index');
    Route::post('contactus', 'App\Http\Controllers\Front\ContactUsController@store')->name('front.contactus.store');
    Route::get('product', 'App\Http\Controllers\Front\Marketplace\ShoppingController@ProductShopping')->name('front.product_shopping');
    Route::get('ournews', 'App\Http\Controllers\Front\Marketplace\OurnewsController@index')->name('front.ournews');
    Route::get('category/product/{code}', 'App\Http\Controllers\Front\Marketplace\ShoppingController@CategoryShopping')->name('front.product.category_shopping');
    Route::get('category/{code}', 'App\Http\Controllers\Front\Marketplace\ShoppingController@CategoryList')->name('front.category_list');
    Route::get('notification', 'App\Http\Controllers\Front\Marketplace\NotificationController@index')->name('front.notification');


    Route::group(['middleware' => ['web', 'auth']], function () {
        Route::get('profile/product/{id}/edit', 'App\Http\Controllers\Front\Merchant\ProductController@edit')->name('product.edit');
        Route::get('profile/address/add', 'App\Http\Controllers\Front\Marketplace\CheckoutController@AddAddress')->name('profile.address.add');
        Route::get('profile/address/{id}/edit', 'App\Http\Controllers\Front\Marketplace\CheckoutController@EditAddress')->name('profile.address.edit');

        Route::group(['middleware' => ['CheckOrder']], function () {
            Route::get('order/{id}', 'App\Http\Controllers\Front\Merchant\OrderController@show')->name('front.mrchnt.order.show');
            Route::post('order/{id}/update_status', 'App\Http\Controllers\Front\Merchant\OrderController@update_status')->name('front.mrchnt.order.update_status');
            Route::post('order/{id}/product_rating', 'App\Http\Controllers\Front\Merchant\OrderController@ProductRating')->name('front.mrchnt.order.product_rating');
            Route::post('order/{id}/vendor_rating', 'App\Http\Controllers\Front\Merchant\OrderController@VendorRating')->name('front.mrchnt.order.vendor_rating');
        });
        
        Route::group(['middleware' => ['CheckContext']], function () {
            Route::post('mrchnt/{site}/store/{resource}', 'App\Http\Controllers\Front\Merchant\ProductController@store')->name('front.mrchnt.product.store');
            Route::delete('mrchnt/{site}/{resource}/destroy/{id?}', 'App\Http\Controllers\Front\Merchant\ProductController@destroy')->name('front.mrchnt.product.destroy');
        });
        
        Route::group(['middleware' => ['CheckUser']], function () {
            Route::post('usr/profile', 'App\Http\Controllers\Auth\RegisteredUserController@updateProfile')->name('front.usr.updateProfile');
            Route::get('usr/{usid}/profile/favorite', 'App\Http\Controllers\Front\Merchant\ProfileController@favorite')->name('front.usr.favorite');
            Route::post('usr/profile/store_favorite', 'App\Http\Controllers\Front\Merchant\ProfileController@StoreFavorite')->name('front.usr.store_favorite');
            Route::post('usr/profile/update_background', 'App\Http\Controllers\Front\Merchant\ProfileController@UpdateProfileBackground')->name('front.usr.update_background');
            Route::post('mrchnt/profile', 'App\Http\Controllers\Auth\RegisteredMerchantController@updateProfile')->name('front.mrchnt.updateProfile');
            Route::post('profile/store_address', 'App\Http\Controllers\Front\Marketplace\CheckoutController@StoreAddress')->name('front.store_address');
            Route::post('profile/destroy_address', 'App\Http\Controllers\Front\Marketplace\CheckoutController@DestroyAddress')->name('front.destroy_address');
        });
        Route::post('blog/store', 'App\Http\Controllers\Admin\BlogController@store')->name('admin.blog.store');
        Route::post('blog/delete', 'App\Http\Controllers\Admin\BlogController@destroy')->name('admin.blog.delete');
        Route::post('slider/store', 'App\Http\Controllers\Admin\SliderController@store')->name('admin.slider.store');
        Route::post('slider/delete', 'App\Http\Controllers\Admin\SliderController@destroy')->name('admin.slider.delete');
        Route::post('setting/store', 'App\Http\Controllers\Admin\SettingController@store')->name('admin.setting.store');
        Route::post('customerreview/activate', 'App\Http\Controllers\Admin\SettingController@ActivateCustomerReview')->name('admin.review.activate');
    });
    Route::match(['GET', 'POST'], 'p/{path?}', '\Aimeos\Shop\Controller\PageController@indexAction')->where( 'path', '.*' );
    Route::post('mrchnt/subcat/{id}', 'App\Http\Controllers\Front\Merchant\ProductController@getSubCategory')->name('front.mrchnt.product.get_sub_category');

});




Route::middleware(['web'])->group(function () {
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.update');

    Route::post('subscribe', [NewsLetterController::class, 'store'])->name('newsletter.subscribe');

});
 


Route::get('auth/facebook', [FacebookSocialiteController::class, 'redirectToFB']);
Route::get('callback/facebook', [FacebookSocialiteController::class, 'handleCallback']);

Route::get('auth/google', [GoogleSocialiteController::class, 'redirectToGoogle']);
Route::get('callback/google', [GoogleSocialiteController::class, 'handleCallback']);