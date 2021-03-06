<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAdminLoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm() {
        return view('admin.auth.login');
    }

    public function login(StoreAdminLoginRequest $request) {
        $validation = $request->validated();
        $remember_me = $request->has('remember') ? true : false;

        if (Auth::guard('admin')->attempt($validation, $remember_me)) {
            // using indended or guest?
            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->route('admin.login')->withErrors('Krivi Podaci, Pokušaj ponovno!')->withInput();
    }

    public function logout(Request $request) {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
