<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
        public function Authregister()
    {
        return view('authdashboard.signup');
    }

    public function RegisterForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:login',
            'phone' => 'required|string|min:10|max:10|unique:login',
            'password' => 'required|string|min:6|confirmed',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
       $login = Login::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => Hash::make($request->password),
        'type' => '1', 
        'status' => 'pending',
]);
 
        // Login the user
        Auth::login($login);
        return redirect()->route('authdashboard.signup')->with('success', 'Registration successful!');
    }

     public function Authlogin()
    {
        return view('authdashboard.signin');
    }

 public function LoginForm(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    // Check if user exists first
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors(['email' => 'Email not found.']);
    }

    // Check if user is approved
    if ($user->status !== 'approved') {
        return back()->withErrors(['email' => 'Your account is not approved yet.']);
    }

    // Try login
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        $request->session()->regenerate();

        // Get the logged in user
        $authUser = Auth::user();

        // Redirect based on type
        if ($authUser->type == 1) {
            return redirect()->route('user.home2');
        } elseif ($authUser->type == 2) {
            return redirect()->route('admin.home2');
        } else {
            Auth::logout();
            return back()->withErrors(['email' => 'Unauthorized access.']);
        }
    }

    return back()->withErrors(['email' => 'Invalid email or password']);
}

}