<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Add is_primary field to the magical_girls table to indicate the primary character
        // This is optional but helpful for maintaining compatibility with existing code
        Schema::table('magical_girls', function (Blueprint $table) {
            $table->boolean('is_primary')->default(false)->after('user_id');
        });
        
        // For each user, mark their first magical girl as primary
        DB::statement('
            UPDATE magical_girls mg1
            JOIN (
                SELECT user_id, MIN(id) as first_id
                FROM magical_girls
                GROUP BY user_id
            ) mg2 ON mg1.user_id = mg2.user_id AND mg1.id = mg2.first_id
            SET mg1.is_primary = 1
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('magical_girls', function (Blueprint $table) {
            $table->dropColumn('is_primary');
        });
    }
};