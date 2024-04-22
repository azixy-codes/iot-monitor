<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class CommandController extends Controller
{
    public function execute()
    {
        // Regénration d'état des modules
        Artisan::call('module:generate-status');

        return redirect()->back();
    }
}
