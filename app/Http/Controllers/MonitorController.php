<?php

namespace App\Http\Controllers;

use App\Models\Poly;
use App\Models\Websitesetting;
use Illuminate\Http\Request;

class MonitorController extends Controller
{
    public function index()
    {
        $poly = Poly::paginate(4);
        $link = Websitesetting::all()->first();

        return view('Monitor.welcome', compact('poly', 'link'));
    }
}
