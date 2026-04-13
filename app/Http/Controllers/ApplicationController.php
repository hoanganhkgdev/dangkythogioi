<?php

namespace App\Http\Controllers;

use App\Models\ThoGioiApplication;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function print(ThoGioiApplication $application)
    {
        return view('print.application', compact('application'));
    }
}
