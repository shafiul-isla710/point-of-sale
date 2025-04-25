<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    
    public function dashboardPage(){
        return Inertia::render('UserDashboardPage');
    }
    public function profilePage(){
        return Inertia::render('profilePage');
    }


}
