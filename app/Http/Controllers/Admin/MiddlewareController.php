<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MiddlewareController extends Controller
// controller with middleware 
{
    public function __construct()
    {
        $this->middleware('auth')->except('showColor3'); //showColor3على كل الراوتس دي ماعدا الميثود بتاع middlewareكدا هيعملي 
    }
    public function showColor1()
    {
        return 'red';
    }
    public function showColor2()
    {
        return 'blue';
    }
    public function showColor3()
    {
        return 'orange';
    }
    public function showColor4()
    {
        return 'black';
    }
    public function showColor5()
    {
        return 'white';
    }
}
