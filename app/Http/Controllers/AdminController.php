<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('pages.dashboard');
    }

    public function viewUser()
    {
        return view('admin.user.index');
    }
    public function viewDoktor()
    {
        return view('admin.doktor.index');
    }
    public function viewPoli()
    {
        return view('admin.poli.index');
    }
}
