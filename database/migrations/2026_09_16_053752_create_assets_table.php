<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('talent_id')->nullable()->constrained('talents')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('name');
            $table->string('type'); // background, overlay, wallpaper, emotes, logo, banner, schedule, model, rigging
            $table->string('theme')->nullable();
            $table->string('color')->nullable();
            $table->string('resolution')->nullable();
            $table->string('file_path')->nullable();
            $table->string('preview_url')->nullable();
            $table->text('notes')->nullable();
            $table->string('status')->default('draft'); // draft, generated, published, sold
            $table->decimal('price', 12, 2)->default(0);
            $table->unsignedInteger('downloads')->default(0);
            $table->timestamps();

            $table->index('type');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
