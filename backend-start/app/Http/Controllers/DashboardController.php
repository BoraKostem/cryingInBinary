<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

    	if(Auth::session('userJob') == 'bilkenter'){
    		return view('home');
    	}
        
    	return view('dashboard');
    }
}
