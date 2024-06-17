<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocaleController extends Controller
{
    public function locale(Request $request)
    {
        Session::put('locale', $request->get('locale'));
        App::setLocale($request->get('locale'));
        return back();
    }
}
