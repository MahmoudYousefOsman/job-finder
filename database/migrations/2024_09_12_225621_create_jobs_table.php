<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jobss', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('responsibilities');
            $table->string('location');
            $table->float('salary_start');
            $table->boolean('work_type')->default(1);
            $table->dateTime('expired_at');
            $table->boolean('experience_leve')->default(1);
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('employer_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
