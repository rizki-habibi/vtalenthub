<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Talent extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'talents';

    protected $fillable = [
        'user_id', 'name', 'real_name', 'slug', 'platform', 'status',
        'subscribers', 'model_type', 'genre', 'language', 'bio',
        'avatar_url', 'banner_url', 'youtube_url', 'twitch_url',
        'tiktok_url', 'twitter_url', 'discord_url', 'tags',
        'monthly_revenue', 'debut_date',
    ];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'tags' => 'array',
            'subscribers' => 'integer',
            'monthly_revenue' => 'decimal:2',
            'debut_date' => 'date',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Talent $talent) {
            if (empty($talent->slug)) {
                $talent->slug = Str::slug($talent->name).'-'.Str::random(5);
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function assets(): HasMany
    {
        return $this->hasMany(Asset::class);
    }

    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }

    public function needs(): HasMany
    {
        return $this->hasMany(TalentNeed::class);
    }

    public function counselingSessions(): HasMany
    {
        return $this->hasMany(CounselingSession::class);
    }
}
