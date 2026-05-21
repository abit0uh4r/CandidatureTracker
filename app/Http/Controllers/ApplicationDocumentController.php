<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationDocumentRequest;
use App\Models\ApplicationDocument;
use App\Models\JobApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ApplicationDocumentController extends Controller
{
    public function index(): View
    {
        $documents = ApplicationDocument::query()
            ->with('jobApplication')
            ->whereHas('jobApplication', fn ($query) => $query->where('user_id', auth()->id()))
            ->latest()
            ->paginate(12);

        return view('documents.index', [
            'documents' => $documents,
        ]);
    }

    public function store(StoreApplicationDocumentRequest $request, JobApplication $jobApplication): RedirectResponse
    {
        $file = $request->file('document');
        $path = $file->store("application-documents/{$jobApplication->id}", 'public');

        $jobApplication->documents()->create([
            'original_name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'mime_type' => $file->getMimeType() ?? 'application/octet-stream',
            'size' => $file->getSize(),
        ]);

        return redirect()
            ->route('job-applications.show', $jobApplication)
            ->with('success', 'Document ajouté avec succès.');
    }

    public function download(JobApplication $jobApplication, ApplicationDocument $document): StreamedResponse
    {
        $this->ensureDocumentBelongsToJobApplication($jobApplication, $document);
        $this->authorize('view', $document);

        return Storage::disk('public')->download($document->file_path, $document->original_name);
    }

    public function destroy(JobApplication $jobApplication, ApplicationDocument $document): RedirectResponse
    {
        $this->ensureDocumentBelongsToJobApplication($jobApplication, $document);
        $this->authorize('delete', $document);

        $document->deleteStoredFile();
        $document->delete();

        return redirect()
            ->route('job-applications.show', $jobApplication)
            ->with('success', 'Document supprimé avec succès.');
    }

    private function ensureDocumentBelongsToJobApplication(JobApplication $jobApplication, ApplicationDocument $document): void
    {
        abort_unless($document->job_application_id === $jobApplication->id, 404);
    }
}
