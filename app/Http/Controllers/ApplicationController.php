<?php

namespace App\Http\Controllers;

use App\Models\ThoGioiApplication;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function print(ThoGioiApplication $application)
    {
        $template = match($application->ordination_level) {
            'Tỳ kheo'    => 'print.tn17',
            default      => 'print.application',
        };

        return view($template, compact('application'));
    }
}
