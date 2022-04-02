<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    /**
     * Log out account user.
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function __construct()
    {
    }

    public function perform()
    {
        Session::flush();

        Auth::logout();

        return redirect('login')->with('success','Logged out successfully.');;
    }
}
