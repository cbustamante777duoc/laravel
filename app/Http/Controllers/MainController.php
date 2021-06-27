<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
     public function index()
    {
        /*$name = config('app.undefined');
        
        dd($name);

        return View($name);*/

        return View('welcome');
    }


}
