<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('innovations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('category'); // 'asset_tech', 'monetization', 'ai_interaction', 'event_format', 'fan_experience'
            $table->text('problem_statement');
            $table->text('proposed_solution');
            $table->text('monetization_potential')->nullable();
            $table->string('target_audience')->nullable();
            $table->string('status')->default('concept'); // concept, research, prototyping, ready_to_pitch, launched
            $table->boolean('generated_by_ai')->default(false);
            $table->unsignedInteger('upvotes')->default(0);
            $table->timestamps();

            $table->index('category');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('innovations');
    }
};
