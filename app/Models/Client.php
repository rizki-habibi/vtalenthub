<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'name', 'contact_person', 'email', 'phone', 'company',
        'status', 'type', 'deal_value', 'talent_id', 'deadline', 'notes',
        'proposal_url',
    ];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'deal_value' => 'decimal:2',
            'deadline' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function talent(): BelongsTo
    {
        return $this->belongsTo(Talent::class);
    }
}
