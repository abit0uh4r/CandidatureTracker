<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInterviewRequest;
use App\Http\Requests\UpdateInterviewRequest;
use App\Models\Interview;
use App\Models\JobApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class InterviewController extends Controller
{
    public function create(JobApplication $jobApplication): View
    {
        $this->authorize('create', [Interview::class, $jobApplication]);

        return view('interviews.create', [
            'jobApplication' => $jobApplication,
        ]);
    }

    public function store(StoreInterviewRequest $request, JobApplication $jobApplication): RedirectResponse
    {
        $jobApplication->interviews()->create($request->validated());

        return redirect()
            ->route('job-applications.show', $jobApplication)
            ->with('success', 'Entretien ajoute avec succes.');
    }

    public function edit(JobApplication $jobApplication, Interview $interview): View
    {
        $this->ensureInterviewBelongsToJobApplication($jobApplication, $interview);
        $this->authorize('update', $interview);

        return view('interviews.edit', [
            'jobApplication' => $jobApplication,
            'interview' => $interview,
        ]);
    }

    public function update(UpdateInterviewRequest $request, JobApplication $jobApplication, Interview $interview): RedirectResponse
    {
        $this->ensureInterviewBelongsToJobApplication($jobApplication, $interview);

        $interview->update($request->validated());

        return redirect()
            ->route('job-applications.show', $jobApplication)
            ->with('success', 'Entretien mis a jour avec succes.');
    }

    public function destroy(JobApplication $jobApplication, Interview $interview): RedirectResponse
    {
        $this->ensureInterviewBelongsToJobApplication($jobApplication, $interview);
        $this->authorize('delete', $interview);

        $interview->delete();

        return redirect()
            ->route('job-applications.show', $jobApplication)
            ->with('success', 'Entretien supprime avec succes.');
    }

    private function ensureInterviewBelongsToJobApplication(JobApplication $jobApplication, Interview $interview): void
    {
        abort_unless($interview->job_application_id === $jobApplication->id, 404);
    }
}
