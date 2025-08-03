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
    Schema::create('feedback', function (Blueprint $table) {
        $table->id();
        $table->foreignId('session_id')->constrained('sessions')->onDelete('cascade');
        $table->foreignId('from_user_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('to_tutor_id')->constrained('tutors')->onDelete('cascade');
        $table->integer('rating');
        $table->text('comment')->nullable();
        $table->timestamp('created_at');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
