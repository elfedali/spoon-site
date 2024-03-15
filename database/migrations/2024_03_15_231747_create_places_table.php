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
            $table->string('place_type')->default('restaurant_cafe');
            $table->foreignId('street_id')->nullable()->constrained();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->text('description')->nullable();
            $table->text('excerpt')->nullable();
            $table->string('type_cuisine')->nullable();
            $table->string('type_service')->nullable();
            $table->string('type_amenity')->nullable();
            $table->integer('position')->default(0);
            $table->string('status')->default('pending');
            $table->boolean('reservation_required')->default(false);
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
