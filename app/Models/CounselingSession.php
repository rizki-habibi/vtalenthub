<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CounselingSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'talent_id', 'topic', 'question', 'answer', 'status', 'rating',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function talent(): BelongsTo
    {
        return $this->belongsTo(Talent::class);
    }
}
