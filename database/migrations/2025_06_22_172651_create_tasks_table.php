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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('production_schedule_id');
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->string('status')->default('pending');
            $table->dateTime('due_date');
            $table->integer('priority')->default(1);
            $table->timestamps();
            
            $table->foreign('production_schedule_id')->references('id')->on('production_schedules')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
