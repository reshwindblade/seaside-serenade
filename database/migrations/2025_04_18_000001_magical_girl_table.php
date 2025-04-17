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
        Schema::create('magical_girls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Basic Information
            $table->string('character_name');
            $table->string('magical_name');
            $table->string('signature_color');
            $table->string('animation_spirit');
            $table->text('transformation_phrase');
            
            // Attributes
            $table->integer('focus')->default(6);
            $table->integer('daring')->default(6);
            $table->integer('insight')->default(6);
            $table->integer('presence')->default(6);
            $table->integer('might')->default(6);
            
            // Skills (stored as JSON arrays)
            $table->json('proficient_skills');
            $table->json('mastered_skills');
            
            // Derived Stats
            $table->integer('stress')->default(0);
            $table->integer('harm')->default(0);
            $table->integer('physical_defense')->default(0);
            $table->integer('magical_defense')->default(0);
            
            // Additional Information
            $table->text('bio')->nullable();
            $table->string('portrait_url')->nullable();
            
            $table->timestamps();
        });
        
        // Skills table for reference
        Schema::create('magical_skills', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('attribute');
            $table->text('description')->nullable();
            $table->timestamps();
        });
        
        // Talents table for reference
        Schema::create('magical_talents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->text('description');
            $table->text('effect');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('magical_girls');
        Schema::dropIfExists('magical_skills');
        Schema::dropIfExists('magical_talents');
    }
};