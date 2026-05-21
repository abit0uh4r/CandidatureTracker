<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterJobApplicationsRequest;
use App\Http\Requests\StoreJobApplicationRequest;
use App\Http\Requests\UpdateJobApplicationRequest;
use App\Models\JobApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class JobApplicationController extends Controller
{
    public function index(FilterJobApplicationsRequest $request): View
    {
        $filters = $request->validated();

        $jobApplications = auth()->user()
            ->jobApplications()
            ->withCount('interviews')
            ->when($filters['search'] ?? null, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('company_name', 'like', "%{$search}%")
                        ->orWhere('position_title', 'like', "%{$search}%");
                });
            })
            ->when($filters['status'] ?? null, fn ($query, $status) => $query->where('status', $status))
            ->when($filters['priority'] ?? null, fn ($query, $priority) => $query->where('priority', $priority))
            ->latest('applied_at')
            ->paginate(10)
            ->appends($filters);

        return view('job-applications.index', [
            'jobApplications' => $jobApplications,
            'filters' => $filters,
            'statuses' => JobApplication::STATUSES,
            'priorities' => JobApplication::PRIORITIES,
        ]);
    }

    public function archives(): View
    {
        $jobApplications = auth()->user()
            ->jobApplications()
            ->onlyTrashed()
            ->withCount('interviews')
            ->latest('deleted_at')
            ->paginate(10);

        return view('job-applications.archives', [
            'jobApplications' => $jobApplications,
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', JobApplication::class);

        return view('job-applications.create', [
            'jobApplication' => new JobApplication([
                'status' => 'draft',
                'priority' => 'medium',
                'applied_at' => now(),
            ]),
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
            ->with('success', 'Candidature créée avec succès.');
    }

    public function show(JobApplication $jobApplication): View
    {
        $this->authorize('view', $jobApplication);

        $jobApplication->load([
            'documents' => fn ($query) => $query->latest(),
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
            ->with('success', 'Candidature mise à jour avec succès.');
    }

    public function destroy(JobApplication $jobApplication): RedirectResponse
    {
        $this->authorize('delete', $jobApplication);

        $jobApplication->delete();

        return redirect()
            ->route('job-applications.index')
            ->with('success', 'Candidature archivée avec succès.');
    }

    public function restore(JobApplication $jobApplication): RedirectResponse
    {
        $this->authorize('restore', $jobApplication);

        $jobApplication->restore();

        return redirect()
            ->route('job-applications.archives')
            ->with('success', 'Candidature restaurée avec succès.');
    }
}
