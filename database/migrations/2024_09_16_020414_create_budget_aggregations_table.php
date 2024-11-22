<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('budget_aggregations', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->text('data');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('budget_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['user_id', 'budget_id', 'user_budget_unique']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('budget_aggregations');
    }
};
