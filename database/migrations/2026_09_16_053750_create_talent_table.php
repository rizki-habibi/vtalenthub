<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('talents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('real_name')->nullable();
            $table->string('slug')->unique();
            $table->string('platform')->default('youtube');
            $table->string('status')->default('onboarding'); // active, onboarding, inactive
            $table->unsignedBigInteger('subscribers')->default(0);
            $table->string('model_type')->default('none'); // live2d, 3d, png, none
            $table->string('genre')->nullable();
            $table->string('language')->default('ID');
            $table->text('bio')->nullable();
            $table->string('avatar_url')->nullable();
            $table->string('banner_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('twitch_url')->nullable();
            $table->string('tiktok_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('discord_url')->nullable();
            $table->json('tags')->nullable();
            $table->decimal('monthly_revenue', 15, 2)->default(0);
            $table->date('debut_date')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('status');
            $table->index('platform');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('talents');
    }
};
