<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //register 
     public function showregister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|min:10|max:10|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
       $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => Hash::make($request->password),
        'type' => '1', 
        'status' => 'pending',
]);
 
        // Login the user
        Auth::login($user);
        return redirect()->route('auth.register')->with('success', 'Registration successful!');
    }

     public function showlogin()
    {
        return view('auth.login');
    }

     public function Login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors(['email' => 'Email not found.']);
    }

    if ($user->status !== 'approved') {
        return back()->withErrors(['email' => 'Your account is not active.']);
    }

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        $request->session()->regenerate();

        if ($user->type == 1) {
            return redirect()->route('dashboard.index'); 
        } elseif ($user->type == 2) {
            return redirect()->route('admin.dashboard'); 
        } else {
            Auth::logout();
            return back()->withErrors(['email' => 'Unauthorized access.']);
        }
    }

    return back()->withErrors(['email' => 'Invalid email or password']);
}

public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login');
}

}
