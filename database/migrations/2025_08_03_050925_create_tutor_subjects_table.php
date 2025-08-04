<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('tutor_subjects', function (Blueprint $table) {
        $table->id();
        $table->foreignId('tutor_id')->constrained('tutors')->onDelete('cascade');
        $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
        $table->timestamps();
        
        // Add unique constraint to prevent duplicate entries
        $table->unique(['tutor_id', 'subject_id']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutor_subjects');
    }
};
