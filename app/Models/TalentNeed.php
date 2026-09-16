<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TalentNeed extends Model
{
    use HasFactory;

    protected $fillable = [
        'talent_id', 'need_type', 'status', 'provider', 'estimated_cost', 'notes',
    ];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'estimated_cost' => 'decimal:2',
        ];
    }

    public function talent(): BelongsTo
    {
        return $this->belongsTo(Talent::class);
    }
}
