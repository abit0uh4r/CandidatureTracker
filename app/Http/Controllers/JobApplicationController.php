<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobApplicationRequest;
use App\Http\Requests\UpdateJobApplicationRequest;
use App\Models\JobApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class JobApplicationController extends Controller
{
    public function index(): View
    {
        $jobApplications = auth()->user()
            ->jobApplications()
            ->latest('applied_at')
            ->paginate(10);

        return view('job-applications.index', [
            'jobApplications' => $jobApplications,
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', JobApplication::class);

        return view('job-applications.create', [
            'statuses' => JobApplication::STATUSES,
            'priorities' => JobApplication::PRIORITIES,
        ]);
    }

    public function store(StoreJobApplicationRequest $request): RedirectResponse
    {
        $jobApplication = auth()->user()
            ->jobApplications()
            ->create($request->validated());

        return redirect()
            ->route('job-applications.show', $jobApplication)
            ->with('success', 'Candidature creee avec succes.');
    }

    public function show(JobApplication $jobApplication): View
    {
        $this->authorize('view', $jobApplication);

        $jobApplication->load([
            'interviews' => fn ($query) => $query->latest('scheduled_at'),
        ]);

        return view('job-applications.show', [
            'jobApplication' => $jobApplication,
        ]);
    }

    public function edit(JobApplication $jobApplication): View
    {
        $this->authorize('update', $jobApplication);

        return view('job-applications.edit', [
            'jobApplication' => $jobApplication,
            'statuses' => JobApplication::STATUSES,
            'priorities' => JobApplication::PRIORITIES,
        ]);
    }

    public function update(UpdateJobApplicationRequest $request, JobApplication $jobApplication): RedirectResponse
    {
        $jobApplication->update($request->validated());

        return redirect()
            ->route('job-applications.show', $jobApplication)
            ->with('success', 'Candidature mise a jour avec succes.');
    }

    public function destroy(JobApplication $jobApplication): RedirectResponse
    {
        $this->authorize('delete', $jobApplication);

        $jobApplication->delete();

        return redirect()
            ->route('job-applications.index')
            ->with('success', 'Candidature archivee avec succes.');
    }
}
