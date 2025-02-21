<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

// Index
Route::get('/jobs', function () {

    $jobs = Job::with('employer')->latest()->simplePaginate(3);

    return view('jobs.index', [
        "jobs" => $jobs
    ]);
});

// Create
Route::get('/jobs/create', function () {

    return view('jobs.create');
});

// Show
Route::get('/jobs/{id}', function ($id) {

    $job =  Job::find($id);

    if (! $job) {
        abort(404);
    }

    return view('jobs.show', ['job' => $job]);
});

// Store
Route::post('/jobs', function () {
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
});

// Edit
Route::get('/jobs/{id}/edit', function ($id) {

    $job =  Job::find($id);

    if (! $job) {
        abort(404);
    }

    return view('jobs.edit', ['job' => $job]);
});

// Update
Route::patch('/jobs/{id}', function ($id) {
    // validate...
    request()->validate([
        'title' => ['required', 'min:4'],
        'salary' => ['required']
    ]);

    // authorize (on hold...)

    $job =  Job::findOrFail($id);

    $job->update([
        'title' => request('title'),
        'salary' => request('salary')
    ]);

    return redirect('/jobs/' . $job->id);
});

// Delete
Route::delete('/jobs/{id}', function ($id) {
    // authorize

    $job =  Job::findOrFail($id);

    $job->delete();

    // redirect
    return redirect('/jobs');
});

Route::get('/contact', function () {
    return view('contact');
});
