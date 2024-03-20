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
        Schema::create('user_basic_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob');
            $table->string('address');
            $table->string('phone');
            $table->string('profile_picture')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.`
     */
    public function down(): void
    {
        Schema::dropIfExists('user_basic_information');
    }
};
