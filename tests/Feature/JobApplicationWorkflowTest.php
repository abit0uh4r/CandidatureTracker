<?php

use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

function validJobApplicationData(array $overrides = []): array
{
    return array_merge([
        'company_name' => 'Acme Agency',
        'position_title' => 'Developpeur Laravel',
        'offer_url' => 'https://example.com/jobs/laravel',
        'status' => 'applied',
        'priority' => 'high',
        'notes' => 'Relancer dans une semaine.',
        'applied_at' => now()->toDateString(),
    ], $overrides);
}

it('blocks unauthorized access through the job application policy', function () {
    $owner = User::factory()->create();
    $otherUser = User::factory()->create();

    $jobApplication = JobApplication::create(validJobApplicationData([
        'user_id' => $owner->id,
    ]));

    expect($owner->can('update', $jobApplication))->toBeTrue()
        ->and($otherUser->can('view', $jobApplication))->toBeFalse()
        ->and($otherUser->can('update', $jobApplication))->toBeFalse()
        ->and($otherUser->can('delete', $jobApplication))->toBeFalse();
});

it('creates a job application with valid data', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->post(route('job-applications.store'), validJobApplicationData([
            'company_name' => 'Startup Atlas',
        ]));

    $jobApplication = JobApplication::where('company_name', 'Startup Atlas')->first();

    $response->assertRedirect(route('job-applications.show', $jobApplication));

    $this->assertDatabaseHas('job_applications', [
        'user_id' => $user->id,
        'company_name' => 'Startup Atlas',
        'position_title' => 'Developpeur Laravel',
        'status' => 'applied',
        'priority' => 'high',
    ]);
});

it('rejects invalid job application data', function () {
    $user = User::factory()->create();

    $this
        ->actingAs($user)
        ->post(route('job-applications.store'), validJobApplicationData([
            'company_name' => '',
            'position_title' => '',
            'offer_url' => 'not-a-url',
            'status' => 'unknown',
            'priority' => 'urgent',
            'applied_at' => '',
        ]))
        ->assertSessionHasErrors([
            'company_name',
            'position_title',
            'offer_url',
            'status',
            'priority',
            'applied_at',
        ]);

    $this->assertDatabaseCount('job_applications', 0);
});

it('archives a job application with soft deletes', function () {
    $user = User::factory()->create();
    $jobApplication = JobApplication::create(validJobApplicationData([
        'user_id' => $user->id,
    ]));

    $this
        ->actingAs($user)
        ->delete(route('job-applications.destroy', $jobApplication))
        ->assertRedirect(route('job-applications.index'));

    expect(JobApplication::withTrashed()->find($jobApplication->id)->trashed())->toBeTrue();
});

it('restores an archived job application', function () {
    $user = User::factory()->create();
    $jobApplication = JobApplication::create(validJobApplicationData([
        'user_id' => $user->id,
    ]));
    $jobApplication->delete();

    $this
        ->actingAs($user)
        ->patch(route('job-applications.restore', $jobApplication))
        ->assertRedirect(route('job-applications.archives'));

    expect(JobApplication::withTrashed()->find($jobApplication->id)->trashed())->toBeFalse();
});

it('prevents users from accessing another user job application', function () {
    $owner = User::factory()->create();
    $otherUser = User::factory()->create();
    $jobApplication = JobApplication::create(validJobApplicationData([
        'user_id' => $owner->id,
    ]));

    $this
        ->actingAs($otherUser)
        ->get(route('job-applications.show', $jobApplication))
        ->assertForbidden();

    $this
        ->actingAs($otherUser)
        ->put(route('job-applications.update', $jobApplication), validJobApplicationData())
        ->assertForbidden();

    $this
        ->actingAs($otherUser)
        ->delete(route('job-applications.destroy', $jobApplication))
        ->assertForbidden();
});
