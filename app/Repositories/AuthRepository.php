<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Interfaces\AuthRepositoryInterface;
use App\Models\BranchManager;
use App\Models\HeadOfficeManager;


class AuthRepository implements AuthRepositoryInterface
{
    public function register($data)
    {

        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role']
        ]);

        if ($data['role'] == 'admin') {
            Admin::create([
                'Name' => $data['username'],
                'Address' => $data['address'],
                'UserID' => $user->id
            ]);
        }

        return $user;
    }


    public function login($data)
    {
        if (Auth::attempt($data)) {
            $user = Auth::user();
            $adminOrManager = null;
            // dd($user->role);
            if ($user->role === 'admin') {
                $adminOrManager = Admin::where('UserID', $user->id)->first();
            } else if ($user->role === 'approver1') {
                $adminOrManager = BranchManager::where('UserID', $user->id)->first();
            } else if ($user->role === 'approver2') {
                $adminOrManager = HeadOfficeManager::where('UserID', $user->id)->first();
            }
            return [
                'status' => 200,
                'user' => $user,
                'adminOrManager' => $adminOrManager
            ];
        }

        return [
            'status' => 401,
            'error' => 'Unauthorized'
        ];
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
}
