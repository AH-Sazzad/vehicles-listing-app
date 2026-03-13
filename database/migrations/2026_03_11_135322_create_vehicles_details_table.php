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
        Schema::create('vehicles_details', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->foreignId('category_id')->constrained()->cascadeOnDelete();

    $table->string('title');
    $table->string('slug')->unique();

    $table->string('brand');
    $table->string('model');
    $table->year('year');

    $table->decimal('price', 10, 2);

    $table->enum('condition', ['new', 'used']);

    $table->integer('mileage')->nullable();
    $table->string('fuel_type'); // petrol, diesel, electric
    $table->string('transmission'); // manual, automatic
    $table->string('body_type')->nullable();

    $table->string('color')->nullable();
    $table->string('engine_capacity')->nullable();
    $table->string('image')->nullable();

    $table->string('location');

    $table->boolean('featured')->default(false);
    $table->integer('views')->default(0);

    $table->text('description')->nullable();

    $table->enum('status', ['available', 'sold'])->default('available');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles_details');
    }
};
