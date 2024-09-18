<?php

namespace App\Http\Controllers;

use App\Enums\ApplicationStatusEnum;
use App\Http\Requests\JobRequest;
use App\Http\Requests\StoreJobRequest;
use App\Models\Application;
use App\Models\Category;
use App\Models\Job;
use Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class EmployerController extends Controller
{
    /**
     * Show the employer dashboard
     *
     * @return Response
     */
    public function index()
    {
        $jobs = auth()->user()->jobs()->latest()->withCount(['applications'])->paginate();

        return view('dashboard', compact('jobs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param JobRequest $request
     * @return RedirectResponse
     */
    public function store(JobRequest $request): RedirectResponse
    {

        $job = Job::create(array_merge($request->safe()->except('skills'), ['employer_id' => auth()->id()]));
        $job->skills()->createMany(array_map(fn($x) => ['name' => $x], explode(',', $request->skills)));
        return redirect()->route('employer.dashboard')->with('success', 'Job has been created.');
    }

    public function create()
    {
        $categories = Category::all();
        return view('jobs.create', compact('categories'));
    }

    public function edit(Job $job)
    {
        Gate::authorize('update', $job);
        $categories = Category::all();
        return view('jobs.edit', compact('categories', 'job'));

    }

    public function update(JobRequest $request, Job $job)
    {
        Gate::authorize('update', $job);
        $job->update($request->safe()->except('skills'));
        $job->skills()->delete();
        $job->skills()->createMany(array_map(fn($x) => ['name' => $x], explode(',', $request->skills)));
        return redirect()->route('employer.dashboard')->with('success', 'Job has been updated.');
    }


    public function destroy(Job $job)
    {
        Gate::authorize('delete', $job);

        $job->delete();
        return redirect()->route('employer.dashboard')->with('success', 'Job has been deleted.');
    }

    public function applications(Job $job)
    {
        $applications = $job->applicants()->paginate();
        return view('jons.applications', compact('applications', 'job'));
    }

    public function accept(Application $application)
    {
        $application->update(['status' => ApplicationStatusEnum::Accepted]);
        return back()->with('success', 'Application has been accepted.');
    }
    public function reject(Application $application)
    {
        $application->update(['status' => ApplicationStatusEnum::Cancel]);
        return back()->with('success', 'Application has been rejected.');
    }
}

