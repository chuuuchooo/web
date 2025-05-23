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
        Schema::table('family_plannings', function (Blueprint $table) {
            // Add intended_fp_method column
            $table->string('intended_fp_method')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('family_plannings', function (Blueprint $table) {
            // Drop the column when rolling back
            $table->dropColumn('intended_fp_method');
        });
    }
};
