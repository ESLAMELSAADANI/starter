<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ThirdController extends Controller
{
    public function showDiv()
    {
        return 10 / 2;
    }
}
