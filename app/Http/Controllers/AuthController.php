<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function showLoginForm()
    {
        if (Auth::check()) {
            if (Session::get('adminOrManager') == 'admin') {
                return redirect('/dashboard');
            } else {
                return redirect('/approval');
            }
        }
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'role' => 'required|string',
            'address' => 'required|string'
        ]);

        $user = $this->authService->register($data);

        return response()->json($user, 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        $response = $this->authService->login($credentials);
        // dd($response);
        if ($response['status'] == 200) {
            Session::put('user', $response['user']);
            Session::put('adminOrManager', $response['adminOrManager']);

            if (Auth::user()->role == 'admin') {
                return redirect('/dashboard');
            } else if (Auth::user()->role == 'approver1' || Auth::user()->role == 'approver2') {
                return redirect('/approval');
            }
        }

        return redirect("/login")->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        $this->authService->logout();

        return redirect("/login")->with('success', 'Logged out successfully');
    }
}
