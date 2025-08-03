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
    Schema::create('sessions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('tutor_id')->constrained('tutors')->onDelete('cascade');
        $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
        $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
        $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled']);
        $table->date('date');
        $table->time('time');
        $table->integer('duration');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
