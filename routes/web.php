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

// Show
Route::get('/jobs/{job}', function (Job $job) {

    if (! $job) {
        abort(404);
    }

    return view('jobs.show', ['job' => $job]);
});

// Create
Route::get('/jobs/create', function () {

    return view('jobs.create');
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
Route::get('/jobs/{job}/edit', function (Job $job) {

    if (! $job) {
        abort(404);
    }

    return view('jobs.edit', ['job' => $job]);
});

// Update
Route::patch('/jobs/{job}', function (Job $job) {
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
});

// Delete
Route::delete('/jobs/{job}', function (Job $job) {
    // authorize

    $job->delete();

    // redirect
    return redirect('/jobs');
});

Route::get('/contact', function () {
    return view('contact');
});
