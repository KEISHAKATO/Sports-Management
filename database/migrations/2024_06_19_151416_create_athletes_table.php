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
        Schema::create('athletes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->date('dob')->nullable();
            $table->string('address')->nullable();
            $table->unsignedBigInteger('guardian_id')->nullable();
            $table->unsignedBigInteger('coach_id')->nullable();
            $table->text('training_plans')->nullable();
            $table->text('health_tips')->nullable();
            $table->text('objectives')->nullable();
            $table->text('awards')->nullable();
            $table->text('schedule')->nullable();
            $table->text('performance')->nullable();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('guardian_id')->references('id')->on('guardians');
            $table->foreign('coach_id')->references('id')->on('coaches');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('athletes');
    }
};
