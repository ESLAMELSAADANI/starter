<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use stdClass;

class UserController extends Controller
{
    public function showUserName()
    {
        return 'Eslam Ashraf Elsaadany';
    }

    public function getDefaultPage()
    {
        return view('welcome');
    }

    public function getDefaulPage2()
    {
        $data2 = [];
        $data2['id2'] = 100;
        $data2['name2'] = 'Heba Elsaadany';
        $data2['faculty2'] = 'Education';

        return view('welcome', $data2);
    }

    public function getDefaulPage3()
    {
        //كبيرobjectلو عندي 

        $obj = new \stdClass();

        $obj->name = 'Karim mostafa';
        $obj->id = 50;
        $obj->gender = 'male';

        return view('welcome', compact('obj'));
    }
    //directives(if,elseif,foreach,forelse) with view(welcome) blade
    public function ifdirective()
    {
        return view('welcome')->with('name', 'eslam saher elsaadany');
    }
    public function foreachdirective()
    {
        $data = ['eslam', 'ahmed', 'omar'];
        return view('welcome', compact('data'));
    }
    public function forelsedirective()
    {
        $data = [];

        return view('welcome', compact('data'));
    }
}
