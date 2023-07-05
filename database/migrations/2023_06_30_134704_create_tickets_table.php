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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('user_name');
            $table->unsignedBigInteger('important_id')->nullable();
            $table->text('title');
            $table->text('request')->nullable();
            $table->text('message_json');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->unsignedBigInteger('user_group')->nullable();
            $table->text('share_user_id_json')->nullable();
            $table->text('attach_json')->nullable();
            $table->text('photo_json')->nullable();
            $table->string('photo', 500)->nullable()->nullable();
            $table->foreign('important_id')->references('id')->on('importants');
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
