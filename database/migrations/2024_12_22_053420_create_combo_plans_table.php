<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasTable('combo_plans')) {
            Schema::create('combo_plans', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->decimal('price', 8, 2);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('combo_plan_plan')) {
            Schema::create('combo_plan_plan', function (Blueprint $table) {
                $table->id();
                $table->foreignId('combo_plan_id')->constrained('combo_plans')->onDelete('cascade');
                $table->foreignId('plan_id')->constrained('plans')->onDelete('cascade');
            });
        }
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('combo_plans');
    }
};
