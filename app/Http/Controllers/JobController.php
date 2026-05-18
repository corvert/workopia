<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
     //Show all job listings
    //@route GET /jobs
    public function index(): View
    {
        $jobs = Job::all();
        return view('jobs.index')->with('jobs', $jobs);
    }

    //Show create job form
    //@route GET /jobs/create
    public function create(): View
    {
        return view('jobs.create');
    }

     //Save job to database
    //@route POST /jobs
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote' => 'required|boolean',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'required|string',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string',
            'company_name' => 'required|string',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'company_website' => 'nullable|url',
        ]);

        //hardcode user id
        $validatedData['user_id'] = 1;

        //check for image
        if ($request->hasFile('company_logo')) {
            //store the file and get path
            $path = $request->file('company_logo')->store('logos', 'public');

            //Add path to validated data
            $validatedData['company_logo'] = $path;
        }

        // Create a new job listing with the validated data
        Job::create($validatedData);

        return redirect()->route('jobs.index')->with('success', 'Job listing created successfully!');
    }


   //Show a single job listing
    //@route GET /jobs/{$id}
    public function show(Job $job): View
    {
        return view('jobs.show')->with('job', $job);
    }

   //Show edit form for a job listing
    //@route GET /jobs/{$id}/edit
    public function edit(Job $job): View
    {
        return view('jobs.edit')->with('job', $job);
    }

    //Update a job listing
    //@route PUT /jobs/{$id}
    public function update(Request $request, Job $job): string
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote' => 'required|boolean',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'required|string',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string',
            'company_name' => 'required|string',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'company_website' => 'nullable|url',
        ]);


        //check for image
        if ($request->hasFile('company_logo')) {
            //Delte old logo if exists
            Storage::delete('public/logos/' . basename($job->company_logo));
            //store the file and get path
            $path = $request->file('company_logo')->store('logos', 'public');

            //Add path to validated data
            $validatedData['company_logo'] = $path;
        }

        // Create a new job listing with the validated data
        $job->update($validatedData);

        return redirect()->route('jobs.index')->with('success', 'Job listing updated successfully!');
    }

   //Delete a job listing
    //@route DELETE /jobs/{$id}
    public function destroy(Job $job): string
    {
            //Delete logo if exists
            if ($job->company_logo) {
                Storage::delete('public/logos/' . basename($job->company_logo));
            }
        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Job listing deleted successfully!');
    }
}
