<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// トップページ
    Route::get('/', 'IndexController@index');

// メニューページ
    Route::get('/menu', 'MenusController@index');

// カートページ
    Route::get('/cart', 'CartsController@index')->name('cart');
    Route::post('/cart/store', 'CartsController@store');
    Route::post('/cart/clear/{id}', 'CartsController@pop');
    Route::post('/cart/edit', 'CartsController@edit');
    Route::post('/cart/clear', 'CartsController@clear');

//　注文
    Route::get('/order/confirm', 'OrdersController@index')->name('order');
    Route::post('/order/confirm/insert', 'OrdersController@insert');
    Route::get('/order/complete', 'OrdersController@complete')->name('complete');
    Route::any('/order/confirm/coupon', 'OrdersController@coupon');

// etc..
    Route::get('/company', 'PagesController@company');
    Route::get('/privacypolicy', 'PagesController@privacypolicy');
    Route::get('/agreement', 'PagesController@agreement');
    Route::get('/faq', 'PagesController@faq');

Route::group(['middleware' => ['userauth']], function () {

//マイページ
    Route::get('/mypage/order/history', 'MypagesController@orderHistory');
    Route::get('/mypage/order/detail/{id}', 'MypagesController@orderDetail');
    Route::get('/mypage/detail', 'MypagesController@detail');
    Route::get('/mypage/edit', 'MypagesController@edit');
    Route::post('/mypage/confirm', 'MypagesController@confirm');
    Route::post('/mypage/update', 'MypagesController@update');

//お客様用ログアウト
    Route::post('/logout', 'auth\LoginController@logout');

});

//トピック
    Route::get('/topic', 'CampaignesController@index');
    Route::get('/topicdetail', 'CampaignesController@campaignDetail');

// コンタクト
    Route::get('/contact', 'ContactController@index');
    Route::post('/contact', 'ContactController@send');

// API
    Route::get('/app/countCartContents', 'ApisController@countCartContents');



//
// --------------------------- 管理者用 ---------------------------------------
//

Route::group(['middleware' => ['adminauth']], function () {

//従業員（管理者限定）
    Route::get('/pizzzzza/employee', 'EmployeesController@index')->name('employees'); //従業員一覧
    Route::get('/pizzzzza/employee/history', 'EmployeesController@history')->name('historyEmployees'); //従業員一覧
    Route::get('/pizzzzza/employee/{id}/show', 'EmployeesController@show'); //従業員詳細
    Route::post('/pizzzzza/employee/{id}/delete', 'EmployeesController@destroy'); //従業員削除
    Route::get('/pizzzzza/employee/{id}/edit', 'EmployeesController@edit'); //従業員編集
    Route::get('/pizzzzza/employee/add', 'EmployeesController@add'); //従業員追加
    Route::post('/pizzzzza/employee/add/store', 'EmployeesController@store'); //従業員追加処理
    Route::post('/pizzzzza/employee/{id}/update', 'EmployeesController@update'); //従業員更新処理

//クーポン
    Route::get('/pizzzzza/coupon/add','CouponsController@couponNew'); //クーポン種別選択ページ
    Route::get('/pizzzzza/coupon','CouponsController@couponNowList'); //開催中クーポン一覧ページ
    Route::get('/pizzzzza/coupon/{id}/show', 'CouponsController@show')->name('showCoupon'); //クーポン詳細
    Route::get('/pizzzzza/coupon/{id}/edit','CouponsController@edit')->name('editCoupon');  //クーポン編集
    Route::post('/pizzzzza/coupon/{id}/update','CouponsController@update');  //クーポン更新
    Route::post('/pizzzzza/coupon/{id}/delete','CouponsController@delete');  //クーポン削除
    Route::get('/pizzzzza/coupon/add/discount/input','CouponsController@couponNewDiscount')->name('newCouponDiscount'); //クーポン値引き入力ページ
    Route::post('/pizzzzza/coupon/add/discount/do','CouponsController@couponNewDiscountDo'); //クーポン追加処理（値引き）
    Route::get('/pizzzzza/coupon/add/gift/input','CouponsController@couponNewGift'); //プレゼントクーポン条件入力ページ
    Route::post('/pizzzzza/coupon/add/gift/do','CouponsController@couponNewGiftDo'); //クーポン追加処理（プレゼント）
    Route::get('/pizzzzza/coupon/history','CouponsController@couponHistory'); //過去のクーポン一覧ページ

//従業員用キャンペーン
    Route::get('/pizzzzza/campaign/','AdminCampaignsController@index')->name('adminCampIndex');    // 管理者クーポン一覧
    Route::get('/pizzzzza/campaign/{id}/show','AdminCampaignsController@show')->name('adminCampShow');    // 管理者クーポン詳細
    Route::get('/pizzzzza/campaign/{id}/add','AdminCampaignsController@add');   // 管理者クーポン追加
    Route::get('/pizzzzza/campaign/{id}/update','AdminCampaignsController@update');   // 管理者クーポン更新
    Route::get('/pizzzzza/campaign/{id}/delete','AdminCampaignsController@delete');   // 管理者クーポン削除
    Route::get('/pizzzzza/campaign/store','AdminCampaignsController@store');   // 管理者クーポン処理
    Route::get('/pizzzzza/campaign/history','AdminCampaignsController@history');   // 管理者クーポン履歴

//メニュー
    Route::get('/pizzzzza/menu', 'AdminMenusController@index')->name('AdminMenu'); //従業員用メニュー一覧
    Route::get('/pizzzzza/menu/history', 'AdminMenusController@history'); //従業員用メニュー履歴一覧
    Route::get('/pizzzzza/menu/{id}/show', 'AdminMenusController@show'); //従業員用メニュー詳細
    Route::get('/pizzzzza/menu/{id}/edit', 'AdminMenusController@edit'); //従業員用メニュー編集
    Route::post('/pizzzzza/menu/{id}/delete', 'AdminMenusController@destroy'); //従業員用メニュー編集
    Route::post('/pizzzzza/menu/{id}/update', 'AdminMenusController@update'); //従業員用メニュー更新処理
    Route::get('/pizzzzza/menu/add', 'AdminMenusController@add'); //従業員用メニュー追加画面
    Route::post('/pizzzzza/menu/store', 'AdminMenusController@store'); //従業員用メニュー追加処理

//注文確認
    Route::get('/pizzzzza/order', 'AdminController@orderIndex')->name('orderTop'); //注文確認ページ
    Route::get('/pizzzzza/order/history', 'AdminController@history')->name('orderHistory'); //注文履歴
    Route::get('/pizzzzza/order/{id}/show', 'AdminController@show');  //注文詳細
    Route::get('/pizzzzza/order/get', 'AdminController@orderGet'); //注文確認ページ処理用
    Route::post('pizzzzza/order/destroy', 'AdminController@destroy');
    Route::post('pizzzzza/order/success', 'AdminController@success');

//電話注文
    Route::post('/pizzzzza/order/accept/customer/handler', 'PhoneOrdersController@handler'); // POSTデータの処理振り分け
    Route::get('/pizzzzza/order/accept/input', 'PhoneOrdersController@index')->name('telSearch'); //電話番号入力
    Route::post('/pizzzzza/order/accept/customer/check', 'PhoneOrdersController@input'); //電話番号検索＞ajax
    Route::get('/pizzzzza/order/accept/customer/{id}/show', 'PhoneOrdersController@show')->name('telShow');  //会員情報・注文情報
    Route::get('/pizzzzza/order/accept/customer/{id}/edit', 'PhoneOrdersController@edit')->name('telEdit'); //会員情報編集
    Route::post('/pizzzzza/order/accept/customer/{id}/update/phone', 'PhoneOrdersController@updatePhone'); //会員情報編集＞更新処理＞PHONE
    Route::post('/pizzzzza/order/accept/customer/{id}/update/web', 'PhoneOrdersController@updateWeb'); //会員情報編集＞更新処理＞WEB
    Route::get('/pizzzzza/order/accept/customer/input', 'PhoneOrdersController@newCustomer')->name('newCustomer'); //新規登録
    Route::post('/pizzzzza/order/accept/customer/input/add', 'PhoneOrdersController@newCustomerInsert'); //新規登録＞DB追加処理
    Route::post('/pizzzzza/order/accept/customer/cart','PhoneOrdersController@orderCart'); //商品入力ページ・カート処理

//電話注文　注文処理
    Route::get('/pizzzzza/order/accept/item/{id}/select', 'PhoneOrdersController@orderSelect')->name('telOrderSelect'); //商品入力・選択ページ
    Route::get('/pizzzzza/order/accept/item/confirm', 'PhoneOrdersController@orderConfirm'); //注文情報確認ページ

//売上・売れ筋
    Route::get('/pizzzzza/analysis/populer', 'AnalysisController@analysisPopuler');
    Route::get('/pizzzzza/analysis/earning', 'AnalysisController@index');

//Auth
    Route::post('/pizzzzza/logout', 'auth\AdminLoginController@logout'); //管理者用ログアウトページ

});

Route::get('/pizzzzza/login', 'auth\AdminLoginController@form'); //管理画面ログインページ
Route::post('/pizzzzza/order/top', 'auth\AdminLoginController@login'); //管理画面トップ


//
// --------------------------- Auth ---------------------------------------
//

Auth::routes();

Route::post('/register','auth\RegisterController@register'); //登録処理
Route::get('/register','auth\RegisterController@getregister'); //登録ページ
Route::post('/register/complete','auth\RegisterController@complete');
Route::post('/register/confirm', 'auth\RegisterController@confirm');
Route::get('password/input' ,'auth\ResetPasswordController@input'); //パスワードリセットメール入力ページ
