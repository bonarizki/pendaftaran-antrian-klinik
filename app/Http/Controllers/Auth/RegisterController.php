<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;
use Throwable;

class RegisterController extends Controller
{
    public function index()
    {
        return view('Auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $user = null;

        try {
            DB::transaction(function() use($request, &$user) {
                $user = User::create($request->except([
                    "_token",
                    "verify_password"
                ]));
            });
        } catch (Throwable $e) {
            return back()->withErrors([
                'register_failed' => 'silahkan coba lagi',
            ]);
        }
        return redirect('/')->with('register_success', 'Register Success, Please Login');

    }
}
