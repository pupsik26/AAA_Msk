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
        Schema::create('rules_condition', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('condition_id');
            $table->unsignedBigInteger('rule_id');

            $table->foreign('rule_id', 'fk_rules_id')
                ->references('id')
                ->on('rules');

            $table->foreign('condition_id', 'fk_condition_id')
                ->references('id')
                ->on('conditions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rules_conditions');
    }
};
