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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->can('patient')) {
            return redirect('/patients/home');
        } elseif (auth()->user()->can('docter')) {
            return redirect('/docters/home');
        } elseif (auth()->user()->can('admin')) {
            return redirect('/admins/home');
        } else {
            abort(500);
        }

        return view('home');
    }
}
