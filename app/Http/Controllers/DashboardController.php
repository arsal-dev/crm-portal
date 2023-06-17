<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function superAdminDashboard(){
        $projects = Project::all();
        return view('superadmin.dashboard', compact('projects'));
    }
    public function adminDashboard(){
        return view('dashboard');
    }
    public function employeeDashboard(){
        return view('dashboard');
    }
    public function clientDashboard(){
        return view('dashboard');
    }
}
