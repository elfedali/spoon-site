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
        Schema::disableForeignKeyConstraints();

        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('uploader_id')->constrained('users');
            $table->string('title');
            $table->string('path')->unique();
            $table->string('path_thumbnail')->nullable();
            $table->string('path_medium')->nullable();
            $table->string('path_large')->nullable();
            $table->string('mime_type');
            $table->integer('size');
            $table->integer('position')->default(0);
            $table->morphs('attachmentable');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
