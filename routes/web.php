<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function () {

    $jobs = Job::with('employer')->latest()->simplePaginate(3);

    return view('jobs.index', [
        "jobs" => $jobs
    ]);
});


Route::get('/jobs/create', function () {
    
    return view('jobs.create');
});

Route::get('/jobs/{id}', function ($id) {
    
    $job =  Job::find($id);
    
    if (! $job) {
        abort(404);
    }
    
    return view('jobs.show', ['job' => $job]);
});

Route::get('/contact', function () {
    return view('contact');
});

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