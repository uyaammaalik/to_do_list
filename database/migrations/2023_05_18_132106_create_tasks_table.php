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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('to_do_list_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('to_do_list_id')->references('id')->on('to_do_lists')->onDelete('cascade');
            $table->string('name');
            $table->date('due_date');
            $table->date('planningToDo')->nullable();
            $table->time('due_time');
            $table->boolean('is_complete')->default(false)->nullable();
            $table->timestamps();
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