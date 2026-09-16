<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('contact_person')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->string('status')->default('lead'); // lead, negotiation, active, completed, cancelled
            $table->string('type')->default('sponsorship'); // sponsorship, commission, talent-hire, event, merch, other
            $table->decimal('deal_value', 15, 2)->default(0);
            $table->foreignId('talent_id')->nullable()->constrained('talents')->nullOnDelete();
            $table->date('deadline')->nullable();
            $table->text('notes')->nullable();
            $table->text('proposal_url')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('status');
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
