<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     * Evaluates query filters and eager-loads the employer relation to avoid N+1 issues.
     */
    public function index()
    {
        $this->authorize('viewAny', Job::class);
        
        // Extract only the allowed filters from the request
        $filters = request()->only(
            'search',
            'min_salary',
            'max_salary',
            'experiance',
            'category'
        );

        // Fetch jobs: Eager load the employer to optimize database queries. 
        // Apply local filter scopes and sort by latest.
        return view(
            'job.index',
            ['jobs' => Job::with('employer')->latest()->filter($filters)->get()]
        );
    }

    /**
     * Display the specified resource.
     * Loads the job and eager-loads the employer along with the employer's other jobs.
     */
    public function show(Job $job)
    {
        $this->authorize('view', $job);
        
        // Lazy eager load the employer and its jobs relation to display them on the show page efficiently
        return view(
            'job.show',
            ['job' => $job->load('employer.jobs')]
        );
    }
}
