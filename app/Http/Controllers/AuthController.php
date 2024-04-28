<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        $credentials = [
            'f_username' => $validated['username'],
            'password' => $validated['password']
        ];

        $role = $validated['role'];

        switch ($role) {
            case 'admin':
                $adminAcc = Admin::where("f_username", $validated['username'])->first();
                if (!$adminAcc) {
                    return back()->withErrors([
                        'invalid' => 'Username Atau Password Salah'
                    ]);
                } else if ($adminAcc->f_level != "Admin") {
                    return back()->withErrors([
                        'invalid' => 'Username Atau Password Salah'
                    ]);
                }
                if (Auth::guard('admin')->attempt($credentials)) {
                    if (Auth::guard('admin')->user()->f_status === 'Tidak Aktif') {
                        Auth::guard('admin')->logout();
                        return back()->withErrors([
                            'invalid' => "Akun Tidak Aktif"
                        ]);
                    }
                    $request->session()->regenerate();
                    return redirect()->intended('/dashboard');
                }
                break;
            case 'pustakawan':
                $librarianAcc = Admin::where("f_username", $validated['username'])->first();
                if (!$librarianAcc) {
                    return back()->withErrors([
                        'invalid' => 'Username Atau Password Salah'
                    ]);
                } else if ($librarianAcc->f_level != 'Pustakawan') {
                    return back()->withErrors([
                        'invalid' => 'Username Atau Password Salah'
                    ]);
                }
                if (Auth::guard('admin')->attempt($credentials)) {
                    if (Auth::guard('admin')->user()->f_status === 'Tidak Aktif') {
                        Auth::guard('admin')->logout();
                        return back()->withErrors([
                            'invalid' => "Akun Tidak Aktif"
                        ]);
                    }
                    $request->session()->regenerate();
                    return redirect()->intended('/dashboard');
                }
                break;

            case 'member':
                if (Auth::guard('member')->attempt($credentials)) {
                    $request->session()->regenerate();
                    return redirect()->intended('/');
                }
                break;
        }

        // if (Auth::guard('member')->attempt($credentials)) {
        //     $request->session()->regenerate();
        //     return redirect()->intended('/memberhome');
        // }

        return back()->withErrors([
            'invalid' => "Username Atau Password Salah"
        ]);
    }

    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } else if (Auth::guard('member')->check()) {
            Auth::guard('member')->logout();
        }

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect('/');
    }
}
