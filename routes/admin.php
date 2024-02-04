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

//دي صفحه خاصه بالأدمن او الباك اند غير الصفحه التانيه الخاصه بالفرونت ال بعرض فيها اللينكات والحاجات دي 
// واحط فيها الروت بتاعي(app->providers->RouteServiceProvider)عشان لارفل تشوف الروت دا لازم اروح ل 

Route::get('/admin', function () {
    return 'welcome admin';
});
