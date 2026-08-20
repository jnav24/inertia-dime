<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_dividend_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('transaction_type');
            $table->float('quantity');
            $table->float('price');
            $table->dateTime('transaction_date');
            $table->foreignId('user_dividend_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_dividend_transactions');
    }
};
