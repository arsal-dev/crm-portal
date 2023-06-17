<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgreementController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\NotificationController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\CheckRole;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Super admin dashboard route
Route::middleware([Authenticate::class, CheckRole::class . ':super admin'])->group(function () {
    // Route::middleware(['auth', 'role:super admin'])->group(function () {

Route::name(('superadmin.'))->group(function () {
    Route::get('/superadmin/dashboard', [DashboardController::class, 'superAdminDashboard'])->name('dashboard');


    // users
    Route::get('/superadmin/admins', [AdminController::class, 'admin'])->name('admins');
    Route::get('/superadmin/admins/{id}/edit', [AdminController::class, 'editUser'])->name('admins.edit');
    Route::put('/superadmin/admins/{admin}', [AdminController::class, 'updateUser'])->name('admins.update');
    Route::delete('/superadmin/admins/{admin}', [AdminController::class, 'deleteUser'])->name('admins.delete');
    Route::get('/superadmin/employees', [AdminController::class, 'employee'])->name('employees');
    Route::get('/superadmin/clients', [AdminController::class, 'client'])->name('clients');
    Route::get('/superadmin/admins/add', [AdminController::class, 'addUser'])->name('admins.add');
    Route::post('/superadmin/admins', [AdminController::class, 'storeUser'])->name('admins.store');
});

    // projects
    Route::get('/projects/all', [ProjectController::class, 'index'])->name('projects.all');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

    // inventory
    Route::get('/inventory/add', [InventoryController::class, 'create'])->name('inventory.create');
    Route::post('/inventory', [InventoryController::class, 'store'])->name('inventory.store');
    Route::get('inventory/all', [InventoryController::class, 'all'])->name('inventory.all');
    Route::get('/inventory/{id}/edit', [InventoryController::class, 'edit'])->name('inventory.edit');
    Route::put('/inventory/{id}', [InventoryController::class, 'update'])->name('inventory.update');
    Route::delete('/inventory/{id}', [InventoryController::class, 'destroy'])->name('inventory.destroy');

    // agreements
    Route::get('/agreement/all', [AgreementController::class, 'all'])->name('agreement.all');
    Route::get('/agreement/create', [AgreementController::class, 'create'])->name('agreement.create');
    Route::post('/agreements', [AgreementController::class, 'store'])->name('agreements.store');
    Route::delete('/agreements/{id}', [AgreementController::class, 'destroy'])->name('agreements.destroy');

    // notification
    Route::put('/notifications/{notification}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::get('/notifications/all-notifications', [NotificationController::class, 'showAll'])->name('notifications.all-notifications');

    // Send notification to all users
    Route::post('/superadmin/send-notification/all-users', [NotificationController::class, 'sendNotification'])->name('superadmin.send.notification.allUsers');

    // Send notification to all admins
    Route::post('/superadmin/send-notification/all-admins', [NotificationController::class, 'sendNotification'])->name('superadmin.send.notification.allAdmins');

    // Send notification to all employees
    Route::post('/superadmin/send-notification/all-employees', [NotificationController::class, 'sendNotification'])->name('superadmin.send.notification.allEmployees');

    // Send notification to all clients
    Route::post('/superadmin/send-notification/all-clients', [NotificationController::class, 'sendNotification'])->name('superadmin.send.notification.allClients');

    // Send notification to a single user
    Route::post('/superadmin/send-notification/user/{userId}', [NotificationController::class, 'sendNotification'])->name('superadmin.send.notification.user');

    // Send notification to a single admin
    Route::post('/superadmin/send-notification/admin/{adminId}', [NotificationController::class, 'sendNotification'])->name('superadmin.send.notification.admin');

    // Send notification to a single employee
    Route::post('/superadmin/send-notification/employee/{employeeId}', [NotificationController::class, 'sendNotification'])->name('superadmin.send.notification.employee');

    // Send notification to a single client
    Route::post('/superadmin/send-notification/client/{clientId}', [NotificationController::class, 'sendNotification'])->name('superadmin.send.notification.client');
});

// Admin dashboard route
Route::middleware([Authenticate::class, 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
});

// Employee dashboard route
Route::middleware([Authenticate::class, 'role:employee'])->group(function () {
    Route::get('/employee/dashboard', [DashboardController::class, 'employeeDashboard'])->name('employee.dashboard');
});

// Client dashboard route
Route::middleware([Authenticate::class, 'role:client'])->group(function () {
    Route::get('/client/dashboard', [DashboardController::class, 'clientDashboard'])->name('client.dashboard');
});
