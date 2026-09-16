<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Innovation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'category',
        'problem_statement',
        'proposed_solution',
        'monetization_potential',
        'target_audience',
        'status',
        'generated_by_ai',
        'upvotes',
    ];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'generated_by_ai' => 'boolean',
            'upvotes' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
