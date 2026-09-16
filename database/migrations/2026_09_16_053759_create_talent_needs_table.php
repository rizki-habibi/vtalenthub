<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('talent_needs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('talent_id')->constrained('talents')->cascadeOnDelete();
            $table->string('need_type'); // model, rigging, background, overlay, emotes, logo, banner, bgm, schedule
            $table->string('status')->default('needed'); // needed, in_progress, completed
            $table->string('provider')->nullable();
            $table->decimal('estimated_cost', 12, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index('need_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('talent_needs');
    }
};
