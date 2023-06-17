<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function admin() {

        $users = User::where('role_id', 2)->get();
        return view('superadmin.users.admins', ['admins' => $users]);
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('superadmin.users.update', ['user' => $user]);
    }

    public function updateUser(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|in:2,3,4',
        ]);

        $user = User::findOrFail($id);
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->role_id = $validatedData['role'];
        $user->save();

        if($validatedData['role'] == 2){
            return redirect()->route('superadmin.admins')->with('success', 'Admin updated successfully.');
        }
        elseif($validatedData['role'] == 3){
            return redirect()->route('superadmin.employees')->with('success', 'Employee updated successfully.');
        }
        elseif($validatedData['role'] == 4){
            return redirect()->route('superadmin.clients')->with('success', 'Client updated successfully.');
        }
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        if($user->role_id == 2){
            return redirect()->route('superadmin.admins')->with('success', 'Admin Deleted Successfully.');
        }
        elseif($user->role_id == 3){
            return redirect()->route('superadmin.employees')->with('success', 'Employee Deleted Successfully.');
        }
        elseif($user->role_id == 4){
            return redirect()->route('superadmin.clients')->with('success', 'Client Deleted Successfully.');
        }
    }

    public function employee() {

        $users = User::where('role_id', 3)->get();
        return view('superadmin.users.employees', ['employees' => $users]);
    }

    public function client() {

        $users = User::where('role_id', 4)->get();
        return view('superadmin.users.clients', ['clients' => $users]);
    }

    public function addUser() {
        return view('superadmin.users.add');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:2,3,4',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role,
        ]);


        if($request->role == 2){
            return redirect()->route('superadmin.admins')->with('success', 'Admin Added Successfully.');
        }
        elseif($request->role == 3){
            return redirect()->route('superadmin.employees')->with('success', 'Employee Added Successfully.');
        }
        elseif($request->role == 4){
            return redirect()->route('superadmin.clients')->with('success', 'Client Added Successfully.');
        }
    }

}
