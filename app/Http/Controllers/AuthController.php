<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
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
        return view('Auth.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            return redirect()->intended('/');
        } else {
            return redirect()->back()
                ->with('error', 'Invlid credential');
        }
    }


    public function destroy()
    {
        Auth::logout();

        request()->session()->invalidate();
        // Ends the current user session.
        // Deletes all session data from storage.
        // Changes the session ID so the old one can’t be reused
           
        request()->session()->regenerateToken();
        //Generates a new CSRF token for the next request.
        // Ensures that any previously issued CSRF token becomes invalid.
        // Protects against Cross-Site Request Forgery after logout or sensitive operations.
        
        return redirect('/');
    }
}
