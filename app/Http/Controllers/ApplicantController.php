<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\JobApplied;
use Illuminate\Support\Facades\Mail;

class ApplicantController extends Controller
{
    //desc Store new job application
    //route POST /jobs/{job}/apply
    public function store(Request $request, Job $job): RedirectResponse
    {
    //check if user has already applied
        $existingApplication = Applicant::where('job_id', $job->id)
            ->where('user_id', Auth::id())
            ->exists();


        if( $existingApplication ) {
            return redirect()->back()->with('error', 'You have already applied for this job.');
        }

        //validate incoming data
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'contact_phone' => 'string',
            'contact_email' => 'required|string|email|max:255',
            'message' => 'string',
            'location' => 'string',
            'resume' => 'required|file|mimes:pdf|max:2048',
        ]);

        //handle resume upload
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
            $validatedData['resume_path'] = $resumePath;
        }
        //store the application
        $application = new Applicant($validatedData);
        $application->job_id = $job->id;
        $application->user_id = Auth::id();
        $application->save();

        // Send email notification
         Mail::to($job->user->email)->send(new JobApplied($application, $job));

        return redirect()->back()->with('success', 'Application submitted successfully.');
    }

    //desc Delete a job application
    //route DELETE /applicants/{applicant}
    public function destroy($id): RedirectResponse
    {
        $applicant = Applicant::findOrFail($id);
        $applicant->delete();
        return redirect()->route('dashboard')->with('success', 'Applicant deleted successfully.');
    }
}
