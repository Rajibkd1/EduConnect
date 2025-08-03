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
        Schema::create('tutors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('name')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('university_name')->nullable();
            $table->string('university_id')->nullable();
            $table->string('department')->nullable();
            $table->string('semester')->nullable();
            $table->text('address')->nullable();
            $table->string('university_id_image')->nullable();
            $table->string('bio')->nullable();
            $table->text('qualifications')->nullable();
            $table->integer('experience_years')->nullable();
            $table->decimal('rating', 3, 2)->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutors');
    }
};
