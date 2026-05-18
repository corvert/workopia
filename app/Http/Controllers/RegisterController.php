<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\RedirectResponse;

class RegisterController extends Controller
{
    //Show registration form
    //@route GET /register
    public function register():View{
        return view('auth.register');
    }
}
