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
        Schema::create('rules', function (Blueprint $table) {
            $table->collation('utf8mb4_0900_ai_ci');
            $table->id();
            $table->string('name');
            $table->unsignedInteger('agency_id');
            $table->text('text');
            $table->boolean('is_active');
            $table->timestamps();

            $table->foreign('agency_id', 'fk_agency_id')
                ->references('id')
                ->on('agencies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rules');
    }
};
