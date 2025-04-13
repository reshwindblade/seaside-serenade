<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add combat suit to characters
        Schema::table('characters', function (Blueprint $table) {
            $table->foreignId('combat_suit_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('signature_ability_id')->nullable()->constrained()->nullOnDelete();
        });
        
        // Create pivot tables for many-to-many relationships
        Schema::create('character_talent', function (Blueprint $table) {
            $table->id();
            $table->foreignId('character_id')->constrained()->onDelete('cascade');
            $table->foreignId('talent_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
        
        Schema::create('character_weakness', function (Blueprint $table) {
            $table->id();
            $table->foreignId('character_id')->constrained()->onDelete('cascade');
            $table->foreignId('weakness_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->dropConstrainedForeignId('combat_suit_id');
            $table->dropConstrainedForeignId('signature_ability_id');
        });
        
        Schema::dropIfExists('character_talent');
        Schema::dropIfExists('character_weakness');
    }
};