<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('signature_abilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('effect')->nullable();
            $table->string('cooldown')->nullable();
            $table->integer('power_rating');
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('signature_abilities');
    }
};