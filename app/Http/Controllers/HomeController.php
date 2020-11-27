<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user) {
            return Inertia::render('Dashboard');
        } else {
            return view('auth.login');
        }
    }
}
