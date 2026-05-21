<?php

namespace App\Policies;

use App\Models\Interview;
use App\Models\JobApplication;
use App\Models\User;

class InterviewPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Interview $interview): bool
    {
        return $this->ownsParentApplication($user, $interview);
    }

    public function create(User $user, JobApplication $jobApplication): bool
    {
        return $jobApplication->user_id === $user->id;
    }

    public function update(User $user, Interview $interview): bool
    {
        return $this->ownsParentApplication($user, $interview);
    }

    public function delete(User $user, Interview $interview): bool
    {
        return $this->ownsParentApplication($user, $interview);
    }

    public function restore(User $user, Interview $interview): bool
    {
        return $this->ownsParentApplication($user, $interview);
    }

    public function forceDelete(User $user, Interview $interview): bool
    {
        return $this->ownsParentApplication($user, $interview);
    }

    private function ownsParentApplication(User $user, Interview $interview): bool
    {
        return $interview->jobApplication()
            ->where('user_id', $user->id)
            ->exists();
    }
}
