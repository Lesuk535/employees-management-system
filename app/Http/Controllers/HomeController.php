<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (\Auth::user()->getRoles()->isAdmin()) {
            return redirect()->route('admin-show-managers');
        } elseif (\Auth::user()->getRoles()->isManager()) {
            return redirect()->route('show-managers');
        }

        return view('home');
    }
}
