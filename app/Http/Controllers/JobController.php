<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with('employer')->latest()->simplePaginate(3);

        return view('jobs.index', [
            "jobs" => $jobs
        ]);
    }

    public function show(Job $job)
    {

        if (! $job) {
            abort(404);
        }

        return view('jobs.show', ['job' => $job]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store()
    {
        //validation...
        request()->validate([
            'title' => ['required', 'min:4'],
            'salary' => ['required']
        ]);

        Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1
        ]);

        return redirect('/jobs');
    }

    public function edit(Job $job)
    {

        if (! $job) {
            abort(404);
        }

        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Job $job)
    {
        // validate...
        request()->validate([
            'title' => ['required', 'min:4'],
            'salary' => ['required']
        ]);

        // authorize (on hold...)

        $job->update([
            'title' => request('title'),
            'salary' => request('salary')
        ]);

        return redirect('/jobs/' . $job->id);
    }

    public function destroy(Job $job)
    {
        // authorize

        $job->delete();

        // redirect
        return redirect('/jobs');
    }
}
