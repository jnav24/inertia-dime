<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('miscellaneous_templates', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->text('data');
            $table->foreignId('budget_template_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('miscellaneous_templates');
    }
};
