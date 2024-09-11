<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientPageController extends Controller
{
    public function home()
    {
        return view('client.home');
    }
}
