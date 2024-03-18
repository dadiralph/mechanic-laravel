<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the admin landing page.
    */
    public function ViewDashboard()
    {
        return view('admin.index');
    }
}
