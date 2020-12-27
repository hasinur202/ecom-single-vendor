<?php

use Illuminate\Support\Facades\Route;

Route::group(["namespace"=>"Backend"],function() {
    Route::group(['middleware' =>'guest'], function () {
        Route::get('/admin', 'LoginController@login_index')->name('login');
        Route::get('/register', 'LoginController@register_index')->name('register');
        Route::post('/register-store', 'LoginController@store')->name('user.store');
        Route::post('/login', 'LoginController@login')->name('user.login');
        Route::get('/verify/{token}', 'LoginController@user_verify')->name('verify');

         //login with google account
         Route::get('login/google', 'LoginController@redirect');
         Route::get('callback/google', 'LoginController@callback');

         //login with facebook account
         Route::get('/login/facebook', 'LoginController@redirectToProvider');
         Route::get('/login/facebook/callback', 'LoginController@handleProviderCallback');
    });

    Route::group(['middleware' => ['auth','user.role']], function () {

        //used by Hasin
        Route::get('new-shareholder', 'ShareHolderController@new_shareholderList')->name('new.shareholder');
        Route::get('all-shareholder', 'ShareHolderController@index')->name('all.shareholder');
        Route::get('generate-token/{id}/{name}', 'ShareHolderController@tokenGenerate');
        Route::get('deactive-token/{id}', 'ShareHolderController@tokenDeactive');
        Route::get('delete-shareholder/{id}', 'ShareHolderController@delete');
        Route::post('pay/share-holder-money', 'ShareHolderController@pay')->name('pay.shareHolder.money');
        Route::get('share-holder-payment-list', 'ShareHolderController@payment_list')->name('shareHolder.payment.list');
        Route::get('share-holder-payment-history/delete/{id}', 'ShareHolderController@payment_delete')->name('payment.history.delete');

        Route::get('/logout', 'LoginController@logout')->name('logout');
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        //Route::get('level', 'ShareHolderLevelController@index')->name('level');
        Route::post('level-store', 'ShareHolderLevelController@store')->name('level.store');
        Route::post('level-update', 'ShareHolderLevelController@update')->name('level.update');
        Route::post('level-delete', 'ShareHolderLevelController@destroy')->name('level.delete');

        Route::get('commision-shareholder', 'ShareHolderLevelController@index')->name('commision.shareholder');
        Route::post('store-commision', 'ShareHolderLevelController@storeCommision')->name('commision.store');

        Route::get('delete_commision/{id}', 'ShareHolderLevelController@deleteCommisionHistory');

        Route::get('user-list', 'DashboardController@user_list')->name('user.list');
        Route::post('update-user', 'loginController@update')->name('update.user');
        Route::post('delete-user', 'loginController@destroy')->name('delete.user');
        Route::get('user-role', 'RoleController@create')->name('user.role');
        Route::post('user-role-store', 'RoleController@store')->name('store.role');
        Route::get('role-edit/{id}', 'RoleController@edit')->name('role.edit');
        Route::post('role-update', 'RoleController@update')->name('update.role');
        Route::post('role-delete/{id}', 'RoleController@destroy')->name('role.delete');
        //banar
        Route::get('banar-list', 'BanarController@index')->name('banar.list');
        Route::get('banar', 'BanarController@index_banar')->name('banar');
        Route::post('banar-update', 'BanarController@update')->name('banar.update');
        Route::post('banar-upload', 'BanarController@upload')->name('banar.upload');
        Route::post('delete-banar', 'BanarController@delete')->name('banar.delete');
        //category
        Route::get('categories', 'CategoryController@index')->name('categories');
        Route::post('create-category', 'CategoryController@store')->name('category.add');
        Route::post('update-category', 'CategoryController@update')->name('category.update');
        Route::post('delete-category', 'CategoryController@destroy')->name('category.delete');
        //sub cat
        Route::get('sub-categories', 'ChildCategoryController@index')->name('child.category');
        Route::post('sub-category-create', 'ChildCategoryController@store')->name('child.add');
        Route::post('sub-category-update', 'ChildCategoryController@update')->name('update.child');
        Route::post('sub-category-delete/{id}', 'ChildCategoryController@destroy')->name('delete.child');
        //sub sub-cat
        Route::get('sub-sub-categories', 'SubChildCategoryController@index')->name('sub.child.category');
        Route::post('sub-sub-category-create', 'SubChildCategoryController@store')->name('sub.child.add');
        Route::post('sub-sub-category-update', 'SubChildCategoryController@update')->name('update.sub.child');
        Route::post('sub-sub-category-delete/{id}', 'SubChildCategoryController@destroy')->name('delete.sub.child');

        //product attribute route
        Route::get('product-attributes', 'AttributeController@index')->name('attributes');
        Route::post('product-attribute-update', 'AttributeController@update')->name('update.attribute');
        Route::post('product-attribute-create', 'AttributeController@store')->name('store.attribute');

        //Brand
        Route::get('products', 'ProductController@index')->name('products');
        Route::post('brand-create', 'BrandController@store')->name('brand.add');
        Route::get('brand-list', 'BrandController@index')->name('brand.brand_list');
        Route::post('get-cat-subCat', 'BrandController@getCatSubCat')->name('get.cat.subCat');
        Route::post('brand-update', 'BrandController@update')->name('brand.update');

        //product
        Route::get('products', 'ProductController@index')->name('products');
        Route::post('product-create', 'ProductController@store')->name('product.add');
        Route::get('product-edit/{slug}', 'ProductController@edit')->name('product.edit');
        Route::post('product-update/{slug}', 'ProductController@update')->name('product.update');
        Route::post('product-delete/{id}', 'ProductController@destroy')->name('product.delete');
        Route::post('product-flash-update', 'ProductController@flash_update')->name('product.flash.update');
        Route::post('product-status', 'ProductController@product_status')->name('product.status');
        Route::post('product-add-to-flash', 'ProductController@add_to_flash')->name('add.to.flash');
        
        //product avatars
        Route::get('products/avatars', 'ProductAvatarController@index')->name('avatars');
        Route::get('products/avatars/{slug}', 'ProductAvatarController@show')->name('product.avatars');
        Route::post('product-avatar-create', 'ProductAvatarController@store')->name('avatar.upload');
        Route::post('product-avatar-update', 'ProductAvatarController@update')->name('avatar.update');

         //ads manager
        Route::get('ads', 'AdManagerController@index')->name('ads');
        Route::get('all-ads', 'AdManagerController@get_ads')->name('ads-all');
        Route::post('update-ads', 'AdManagerController@update')->name('ads.update');
        Route::post('ads-create', 'AdManagerController@store')->name('ads.upload');
        // Route::post('product-avatar-update', 'ProductAvatarController@update')->name('avatar.update');
        Route::post('ads-delete/{id}', 'AdManagerController@destroy')->name('ads.delete');

        //orders
        Route::get('product-sales-history', 'OrdersController@sales_history')->name('sales.history');
        Route::post('order/{id}', 'OrdersController@delete_single_order')->name('single.order.delete');
        Route::get('order-refunds', 'OrdersController@refundView')->name('refund.view');
        Route::post('order-refunded', 'OrdersController@refund')->name('order.refunded');
        Route::post('order-by-product', 'OrdersController@order_by_product')->name('orderBy.product');
        Route::post('product-delivered', 'OrdersController@delivery')->name('product.delivery');

        //invoice
        Route::post('order-invoice', 'OrdersController@invoice')->name('order.invoice');

        //table data search daily,weekly,monthly,yearly
        Route::post('product-sales-history', 'OrdersController@table_search')->name('table.search');
        //sales pdf
        Route::post('product-sales-pdf', 'OrdersController@sales_history_pdf')->name('sales.pdf');

        //Subscription
        Route::get('subscribers', 'SubscriberController@index')->name('subscribers');
        Route::get('update-subscriber-status/{id}/{status}', 'SubscriberController@updateSubscriberStatus');
        Route::get('delete-subscriber/{id}', 'SubscriberController@deleteSubscriber');
        Route::get('export-subscriber-list','SubscriberController@exportSubscriber');

        //Settings
        Route::post('save-settings', 'SettingsController@store')->name('settings.save');
        Route::get('setup-settings', 'SettingsController@index')->name('setup-settings');

        Route::get('/setup/about', 'AboutController@index')->name('about.view');
        Route::post('/store/about', 'AboutController@store')->name('about.store');

        Route::get('/get-contacts', 'ContactController@index')->name('contact.list');
        Route::get('/delete-contact/{id}', 'ContactController@destroy');
        Route::get('export-contact-list','ContactController@exportContact');

    });

});


Route::group(["namespace"=>"Frontend"],function() {
    Route::get('/', 'HomeController@index')->name('home');
    // Route::post('category/load-category', 'HomeController@load_category');

    //wish list routes
    Route::post('{params?}/wishlist/store', 'WishListController@store');
    Route::post('/wishlist/delete/{id}', 'WishListController@destroy')->name('wishlist.delete');
    Route::get('/wishlist', 'WishListController@index')->name('wishlist');
    Route::post('wishlist/store', 'WishListController@store')->name('wishlist.store');

    //cart routes..
    Route::get('cart', 'CartController@index')->name('cart');
    Route::post('/cart/store', 'CartController@store')->name('cart.store');
    Route::post('{params?}/cart/store', 'CartController@store');
    // Route::get('/cart/billing-address', 'CartController@billing_index')->name('cart.bill');
    Route::post('/cart/update', 'CartController@update')->name('cart.update');
    Route::post('/cart/update-by-shipping', 'CartController@update_by_shipping')->name('cart.update.by.shipp');
    Route::post('/cart/item/delete', 'CartController@destroy')->name('cart.item.delete');

    //product details routes...
    Route::get('/product-details/{slug}', 'HomeController@quick_view')->name('quick');
    Route::POST('/product-details/price-by-size', 'HomeController@priceBySize')->name('price.by.size');

    //user profile routes...
    Route::get('/user/logout', 'UserController@logout')->name('user.logout');
    Route::get('/profile', 'UserController@user_profile')->name('user.profile');
    Route::post('/profile-update', 'UserController@update')->name('update.user.info');
    Route::post('share_holder-product', 'UserController@getUserProduct')->name('sharedUser.product');
    Route::get('order-refund/{id}', 'UserController@refundOrder');
    Route::post('ordered-product_info', 'UserController@orderedProductInfo')->name('order.product_info');
    Route::get('get-shipp-des', 'UserController@get_shipp_des')->name('get.shipp.des');

    Route::post('product-shipp-update', 'HomeController@updateProductShipp')->name('product.shipp.des');
    Route::get('/view/{slug}', 'HomeController@product_quick_view')->name('product.quick');

    //search product
    Route::post('search', 'HomeController@search')->name('search');
    Route::post('load/{item}', 'HomeController@load')->name('load');

    //shop more route...
    Route::get('shop-more/{data}', 'HomeController@shop_more')->name('shop.more');
    Route::post('load-more-products', 'HomeController@load_more')->name('load.more');

    //product show by brand routes....
    Route::get('products/{data}', 'HomeController@product_by_brand')->name('product.by.brand');
    // Route::post('load-more-products', 'HomeController@load_more')->name('load.more');

    //Subscriber
    Route::post('check-subscriber-email','NewsletterController@checkSubscriber');
    Route::post('add-subscriber','NewsletterController@addSubscriber');

    Route::get('login', 'UserController@index');
    Route::get('user-register', 'UserController@registerIndex');
    Route::get('shareholder-registration', 'UserController@shareholderRegister')->name('shareholder.register');

    Route::post('shareholder-store', 'UserController@shareholderFormStore')->name('shareholder.store');

    // Route::get('cart', 'HomeController@viewCart');
    Route::get('/cart/billing-address', 'HomeController@billing_index')->name('cart.bill');
    Route::get('confirm_pay', 'HomeController@confirmPayment')->name('confirm.pay');

    // Route::get('product-details', 'HomeController@productDetails');
    Route::get('/{slug}', 'HomeController@productByCategory')->name('category.product');
    Route::post('product-search', 'HomeController@productSearch')->name('search.product');
    
    //Contact us
    Route::get('/contact/us', 'ContactController@index')->name('user.contact');
    Route::post('/contact/store', 'ContactController@storeContact')->name('contact.store');

    //about us
    Route::get('/about/us', 'AboutController@index')->name('about.us');
});

// SSLCOMMERZ Start
Route::get('/example1', 'SslCommerzPaymentController@exampleEasyCheckout');
Route::get('/example2', 'SslCommerzPaymentController@exampleHostedCheckout');

Route::post('/pay', 'SslCommerzPaymentController@index');

Route::post('/success', 'SslCommerzPaymentController@success');
Route::post('/fail', 'SslCommerzPaymentController@fail');
Route::post('/cancel', 'SslCommerzPaymentController@cancel');

Route::post('/ipn', 'SslCommerzPaymentController@ipn');
//SSLCOMMERZ END


