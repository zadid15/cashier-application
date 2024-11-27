<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerStore(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password'=> 'required|min:8|same:password_confirmation',
        ]);

        $validate['password'] = bcrypt($validate['password']);
        $simpan = User::create($validate);
        if ($simpan) {
            return redirect()->route('login')->with('success', 'Registrasi Berhasil');
        }else{
            return redirect()->route('register ')->with('error', 'Registrasi Gagal');
        }
    }

    public function loginCheck(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($validate)){
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }else{
            return back()->with('error', 'Login Gagal Username/Password Salah!');
        }
    }

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $userFromGoogle = Socialite::driver('google')->user();
        $userFromDb = User::where('google_id', $userFromGoogle->getId())->first();

        if(!$userFromDb){
            $userFromDb = new User();
            $userFromDb->email = $userFromGoogle->getEmail();
            $userFromDb->google_id = $userFromGoogle->getId();
            $userFromDb->name = $userFromGoogle->getName();

            $userFromDb->save();

            auth('web')->login($userFromDb);
            session()->regenerate();
            return redirect('/dashboard');
        }
        
        auth('web')->login($userFromDb);
        session()->regenerate();
        return redirect('/dashboard');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout Berhasil');
    }
}
