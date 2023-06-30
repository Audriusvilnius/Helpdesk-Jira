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
            $table->string('title');
            $table->text('body');
            $table->text('user_group')->nullable();
            $table->text('share_user_id')->nullable();
            $table->text('user_id')->nullable();
            $table->text('status')->nullable();
            $table->text('rest_json')->nullable();
            $table->text('photo_json')->nullable();
            $table->string('photo', 500)->nullable()->nullable();
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
