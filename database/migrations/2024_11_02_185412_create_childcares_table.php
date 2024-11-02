<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('childcares', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->text('data');
            $table->foreignId('budget_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('expense_type_id')->constrained(table: 'expense_types', column: 'uuid')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('childcares');
    }
};
