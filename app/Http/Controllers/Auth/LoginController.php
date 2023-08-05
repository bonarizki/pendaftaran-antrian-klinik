<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;


class LoginController extends Controller
{
    public function index()
    {
        return view('Auth.login');
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->except('_token'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'user') {
                return redirect('user/home');

            } elseif ($user->role === 'dokter') {

                return redirect('dokter/home');

            }else {

                return redirect('apoteker/home');
            }
            
 
            
        }
 
        return back()->withErrors([
            'login_failed' => 'Email atau Password salah',
        ]);
    }

 

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
