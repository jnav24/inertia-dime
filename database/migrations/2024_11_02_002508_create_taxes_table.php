<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('taxes', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('budget_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('expense_type_id')->constrained(table: 'expense_types', column: 'uuid')->cascadeOnDelete();
            $table->text('data');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('taxes');
    }
};
