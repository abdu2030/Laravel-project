<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployerController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Employer::class, 'employer');
    }

    public function create()
    {
        //
        return view('employer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1️⃣ Validate request
        $data = $request->validate([
            'company_name' => 'required|min:3|unique:employers,company_name'
        ]);

        // 2️⃣ Create employer linked to authenticated user
        Auth::user()?->employer()->create($data);

        // 3️⃣ Redirect with success message
        return redirect()->route('jobs.index')
            ->with('success', 'Your employer account was created.');
    }

}
