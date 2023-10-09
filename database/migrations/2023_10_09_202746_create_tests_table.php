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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('test_link');
            $table->date('test_date');
            $table->time('test_time');
            $table->string('status');
            $table->integer('eligibility_score');
            $table->integer('obtained_score');
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('candidate_id');
            $table->timestamps();
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->foreign('candidate_id')->references('id')->on('candidates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
