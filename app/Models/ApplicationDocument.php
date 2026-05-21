<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ApplicationDocument extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'job_application_id',
        'original_name',
        'file_path',
        'mime_type',
        'size',
    ];

    public function jobApplication(): BelongsTo
    {
        return $this->belongsTo(JobApplication::class);
    }

    public function deleteStoredFile(): void
    {
        Storage::disk('public')->delete($this->file_path);
    }
}
