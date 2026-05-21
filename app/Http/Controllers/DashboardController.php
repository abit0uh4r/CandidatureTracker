<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        $activeApplicationsCount = $user->jobApplications()->count();
        $waitingApplicationsCount = $user->jobApplications()->where('status', 'waiting')->count();
        $archivedApplicationsCount = $user->jobApplications()->onlyTrashed()->count();

        $upcomingInterviewsQuery = Interview::query()
            ->with('jobApplication')
            ->whereHas('jobApplication', fn ($query) => $query->where('user_id', $user->id))
            ->where('scheduled_at', '>=', now())
            ->orderBy('scheduled_at');

        return view('dashboard', [
            'activeApplicationsCount' => $activeApplicationsCount,
            'waitingApplicationsCount' => $waitingApplicationsCount,
            'archivedApplicationsCount' => $archivedApplicationsCount,
            'upcomingInterviewsCount' => (clone $upcomingInterviewsQuery)->count(),
            'recentJobApplications' => $user->jobApplications()
                ->withCount('interviews')
                ->latest('applied_at')
                ->take(5)
                ->get(),
            'upcomingInterviews' => $upcomingInterviewsQuery
                ->take(4)
                ->get(),
        ]);
    }
}
