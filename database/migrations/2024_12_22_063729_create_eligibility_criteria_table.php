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
        if (!Schema::hasTable('eligibility_criterias')) {
            Schema::create('eligibility_criterias', function (Blueprint $table) {
                $table->id();
                $table->string('name'); // Name of the criteria
                $table->integer('age_less_than')->nullable(); // Maximum age (optional)
                $table->integer('age_greater_than')->nullable(); // Minimum age (optional)
                $table->integer('last_login_days_ago')->nullable(); // Days since last login (optional)
                $table->decimal('income_less_than', 10, 2)->nullable(); // Maximum income (optional)
                $table->decimal('income_greater_than', 10, 2)->nullable(); // Minimum income (optional)
                $table->timestamps(); // Created_at and Updated_at timestamps
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eligibility_criteria');
    }
};
