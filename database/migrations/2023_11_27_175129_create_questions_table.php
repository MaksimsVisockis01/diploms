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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // $table->bigInteger('user_id')->unsigned();//user's id from table "users"
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            $table->string('title');
            $table->text('content');

            $table->timestamp('published_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
