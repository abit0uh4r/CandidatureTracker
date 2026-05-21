<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobApplication extends Model
{
    use HasFactory, SoftDeletes;

    public const STATUSES = [
        'draft' => 'Brouillon',
        'applied' => 'Candidature envoyee',
        'waiting' => 'En attente',
        'interview' => 'Entretien prevu',
        'offer' => 'Offre recue',
        'rejected' => 'Refusee',
        'accepted' => 'Acceptee',
    ];

    public const PRIORITIES = [
        'low' => 'Basse',
        'medium' => 'Moyenne',
        'high' => 'Haute',
    ];

    /**
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'company_name',
        'position_title',
        'offer_url',
        'status',
        'priority',
        'notes',
        'applied_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function interviews(): HasMany
    {
        return $this->hasMany(Interview::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(ApplicationDocument::class);
    }

    public function statusLabel(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    public function priorityLabel(): string
    {
        return self::PRIORITIES[$this->priority] ?? $this->priority;
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'applied_at' => 'date',
        ];
    }
}
