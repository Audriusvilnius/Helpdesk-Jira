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
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('upload_ticket_id')->nullable();
            $table->text('upload_file')->nullable();
            $table->text('upload_user_id')->nullable();
            $table->text('upload_dir')->nullable();
            $table->foreign('upload_ticket_id')->references('id')->on('tickets')->onDelete('cascade');
            // $table->foreign('upload_ticket_id')->references('id')->on('shares')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uploads');
    }
};
