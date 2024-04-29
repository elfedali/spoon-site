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

        Schema::create('places', function (Blueprint $table) {
            $table->id();

            $table->foreignId('owner_id')->constrained('users');
            $table->foreignId('approver_id')->nullable()->constrained('users');
            // $table->string('place_type')->default('place_cafe');
            $table->string('place_service')->default('place_cafe');
            $table->string('place_kitchen')->default('place_cafe');

            $table->foreignId('street_id')->nullable()->constrained();
            $table->string('title');
            $table->string('slug')->unique();

            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('country')->nullable()->default('Maroc');

            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('phone_secondary')->nullable();
            $table->string('phone_tertiary')->nullable();
            $table->string('website')->nullable();
            $table->text('description')->nullable();
            $table->text('excerpt')->nullable();

            $table->string('status')->default('pending');
            $table->boolean('reservation_required')->default(false);
            //opening_hours
            $table->string('opening_hours')->nullable();

            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
