<?php

namespace App\Policies;

use App\Models\ApplicationDocument;
use App\Models\JobApplication;
use App\Models\User;

class ApplicationDocumentPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, ApplicationDocument $applicationDocument): bool
    {
        return $this->ownsParentApplication($user, $applicationDocument);
    }

    public function create(User $user, JobApplication $jobApplication): bool
    {
        return $jobApplication->user_id === $user->id;
    }

    public function update(User $user, ApplicationDocument $applicationDocument): bool
    {
        return $this->ownsParentApplication($user, $applicationDocument);
    }

    public function delete(User $user, ApplicationDocument $applicationDocument): bool
    {
        return $this->ownsParentApplication($user, $applicationDocument);
    }

    public function restore(User $user, ApplicationDocument $applicationDocument): bool
    {
        return $this->ownsParentApplication($user, $applicationDocument);
    }

    public function forceDelete(User $user, ApplicationDocument $applicationDocument): bool
    {
        return $this->ownsParentApplication($user, $applicationDocument);
    }

    private function ownsParentApplication(User $user, ApplicationDocument $applicationDocument): bool
    {
        return $applicationDocument->jobApplication()
            ->where('user_id', $user->id)
            ->exists();
    }
}
