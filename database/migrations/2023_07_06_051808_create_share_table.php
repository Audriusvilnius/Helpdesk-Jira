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
        Schema::create('shares', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('share_ticket_id')->nullable();
            $table->unsignedBigInteger('user')->nullable();
            $table->unsignedBigInteger('share_user_id')->nullable();
            $table->unsignedBigInteger('share_status_id')->nullable();
            $table->unsignedBigInteger('share_important_id')->nullable();
            $table->foreign('share_ticket_id')->references('id')->on('tickets')->onDelete('cascade');
            $table->foreign('share_user_id')->references('id')->on('users');
            $table->foreign('share_status_id')->references('id')->on('statuses')->onUpdate('cascade');
            $table->foreign('share_important_id')->references('id')->on('importants')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('share');
    }
};
