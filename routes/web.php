<?php

use App\Http\Controllers\Admin\MiddlewareController;
use App\Http\Controllers\Front\FirstController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\UserController;
use App\Http\Controllers\Admin\SecondController;
use App\Http\Controllers\Admin\ThirdController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Auth;

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

//standard route
/* 
Route::get('/', function () {
    return view('welcome');
});
*/

//make new route (/test1 ) => return welcome
Route::get('/test1', function () {
    return 'welcome';
});

//route parameters

// 1-> required parameter (must be passed with route *'/test2/{id}')

Route::get('/test2/{id}', function ($id) {
    return $id;
});
// 2-> optional parameters (can pass parameters or not with routes -> في الحالتين هيشتغل ويرجعلي ريسبونس) *'/test3/{id?}'*

Route::get('/test3/{id?}', function () {
    return 'welcome eslam';
});

//route names

Route::get('/test4/{id}', function ($id) {
    return $id;
})->name('test.4');

Route::get('/test5/{id?}', function () {
    return 'welcome eslam';
})->name('test.5');

//Group of routes in one namespace(folder)

Route::namespace('Front')->group(function () {
    //all route only access controllers or methods in Admin namespace(folder).

    Route::get('users', [UserController::class, 'showUserName']);
});

//route prefixes
Route::prefix('customers')->group(function () {
    Route::get('show', [UserController::class, 'showUserName']); //instead of cstomers/show
    Route::delete('delete', [UserController::class, 'showUserName']); //instead of customers/delete
    Route::get('edit', [UserController::class, 'showUserName']); //instead of customers/edit
    Route::put('update', [UserController::class, 'showUserName']); //instead of customers/update
});

//another form to write group

Route::group(['prefix' => 'orders'], function () {
    //set of routes
    Route::get('/', function () { //بس وممعهاش اي بارمتر تاني وميرجعليش ايرورordersكلمة urlدا عشان اكتب في ال 
        return 'Route work';
    });

    Route::get('show', [UserController::class, 'showUserName']); //instead of orders/show
    Route::delete('delete', [UserController::class, 'showUserName']); //instead of orders/delete
    Route::get('edit', [UserController::class, 'showUserName']); //instead of orders/edit
    Route::put('update', [UserController::class, 'showUserName']); //instead of orders/update

});

//Route with middleware => authorization to block any one not authorized to visit this route (url)

#1
Route::get('check', function () {
    return 'middleware';
})->middleware('auth');

#2 -> middleware with group


Route::group(['prefix' => 'numbers', 'middleware' => 'auth'], function () {
    //set of routes

    Route::get('/', function () {
        return 'Route work';
    });

    Route::get('show', [UserController::class, 'showUserName']); //instead of numbers/show
    Route::delete('delete', [UserController::class, 'showUserName']); //instead of numbers/delete
    Route::get('edit', [UserController::class, 'showUserName']); //instead of numbers/edit
    Route::put('update', [UserController::class, 'showUserName']); //instead of numbers/update

});

//calling method in (FirstController) in namespace (Front) 
Route::namespace('Front')->group(function () {

    Route::get('First', [FirstController::class, 'showResult']);
});
//calling method in (SecondController) in namespace(Admin)
Route::get('second', [SecondController::class, 'showMul']);
//calling method in (ThirdController) in namespace(Admin)
Route::namespace('Admin')->group(function () {
    Route::get('third', [ThirdController::class, 'showDiv']);
});
// make route login
Route::get('login', function () {
    return 'You must be authorized to access';
})->name('login');

Route::get('middleware', [MiddlewareController::class, 'showColor2'])->middleware('auth'); // على الروت دا بسmiddlewareكدا بعمل 
Route::get('middleware1', [MiddlewareController::class, 'showColor3']);

//Route resource

Route::resource('news', NewsController::class); //لكن لو عايز استخدم راوت واحد بيستدعيلي ميثود معينه مش كله بعمله لوحدهshow,create,update,delete دا بيوفر عليا بدل م اقعد اعمل راوت لكل 

//دا الطريقه التانيه لو حبيت استخدم مثلا راوت واحد بيعملي ميثود معينه جوا الكنترولر بدل م اعمل كنترولر جواه الميثودز كلها
Route::get('news', [NewsController::class, 'index']);
Route::get('news/create', [NewsController::class, 'create']);
Route::get('news/{id}', [NewsController::class, 'show']);
Route::get('news/{id}/edit', [NewsController::class, 'edit']);


// to call view inside controller من جوا كنترولرviewعشان انادي على 

Route::namespace('Front')->group(function () {
    Route::get('view', [UserController::class, 'getDefaultPage']);
});

/*
علطول من غير ميثود جوا كنترولرviewعشان انادي على ال 


Route::get('/', function () {
    return view('welcome');
});

*/

//to pass data to view by route


Route::get('/', function () {
    return view('welcome')->with('data', 'Eslam elsaadany'); //عشان اباصي نوع واحد بس من الداتا
});

Route::get('/', function () {
    return view('welcome')->with(['string' => 'Eslam El-saadany', 'age' => 22]); //عشان اباصي كذا نوع من الداتا
});

Route::get('/', function () {
    $data1 = [];
    $data1['id'] = 10;
    $data1['name'] = 'eslam elsaadany';
    $data1['faculty'] = 'computer & information science';

    return view('welcome', $data1); //دا عشان لو هباصي كذا نوع من الداتا السطر ميطولش معايا زي ال فوق كدا فهعرهم في متغير
});

//to pass data to view by controller

Route::namespace('Front')->group(function () {

    Route::get('view2', [UserController::class, 'getDefaulPage2']);
});


Route::namespace('Front')->group(function () {

    Route::get('view3', [UserController::class, 'getDefaulPage3']);
});

// create new view(bootstrap.blade.php)=>بأماكنهمbladeوناديت عليهم جوا الpublicجوا ال  jsو ال cssحطيت ملفات ال 

Route::get('/landing', function () {
    return view('landing');
});

Route::get('/about', function () {
    return view('about');
});

Route::namespace('Front')->group(function () {
    Route::get('ifdirective', [UserController::class, 'ifdirective']);
});

Route::namespace('Front')->group(function () {
    Route::get('foreachdirective', [UserController::class, 'foreachdirective']);
});

Route::namespace('Front')->group(function () {
    Route::get('forelsedirective', [UserController::class, 'forelsedirective']);
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');


Route::get('/', function () {
    return 'Home Page';
});

Route::get('/dashboard', function () {
    return 'dashboard';
});
