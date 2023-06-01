<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function superAdminDashboard(){
        return 'Super Admin';
    }
    public function adminDashboard(){
        return 'Admin';
    }
    public function employeeDashboard(){
        return 'Employee';
    }
    public function clientDashboard(){
        return 'Client';
    }
}
