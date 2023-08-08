<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegisterController extends Controller
{
    function __construct()
    {
        $this->middleware('guest')->except([
            'logput', 'dashboard'
        ]);
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function register()
    {
        return view('registrationForm');
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:250|string',
            'email' => 'required|max:250|email',
            'password' => 'required|min:2|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $credential = $request->only('email', 'password');
        Auth::attempt($credential);
        $request->session()->regenerate();
        print_r($request->getSession());
        return redirect()->route('welcome')
        ->withSuccess('You have successfully registered & logged in!');
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function dashboard()
    {
        if(Auth::check()) {
            return view('welcome');
        }

        return redirect()->route('login')->withErrors([
            'email' => 'Please login to access the dashboard.',
            ])->onlyInput('email');
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function login()
    {
        return view('login');
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function authentication(Request $request)
    {
        # code...
    }
}
