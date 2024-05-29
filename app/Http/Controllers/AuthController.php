<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
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
            return redirect("/dashboard");
        }

        return redirect("/login")->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        $this->authService->logout();

        return redirect("/login")->with('success', 'Logged out successfully');
    }
}
