<?php

use App\Enums\FrequencyEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dividends', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('symbol')->index();
            $table->string('company_name');
            $table->string('image')->nullable();
            $table->float('price')->default(0.00);
            $table->float('last_dividend')->default(0.00);
            $table->float('yield')->default(0.00);
            $table->string('sector')->nullable();
            $table->string('industry')->nullable();
            $table->bigInteger('market_cap')->nullable();
            $table->float('beta')->default(0.00);
            $table->string('range')->nullable();
            $table->float('change')->default(0.00);
            $table->float('change_percentage')->default(0.00);
            $table->bigInteger('volume')->nullable();
            $table->bigInteger('average_volume')->nullable();
            $table->string('currency')->nullable();
            $table->string('cik')->nullable();
            $table->string('isin')->nullable();
            $table->string('cusip')->nullable();
            $table->string('exchange')->nullable();
            $table->string('exchange_full_name')->nullable();
            $table->string('website')->nullable();
            $table->text('description')->nullable();
            $table->string('ceo')->nullable();
            $table->string('country')->nullable();
            $table->string('full_time_employees')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->date('ipo_date')->nullable();
            $table->boolean('default_image')->default(false);
            $table->boolean('is_etf')->default(false);
            $table->boolean('is_actively_trading')->default(false);
            $table->boolean('is_adr')->default(false);
            $table->boolean('is_fund')->default(false);
            $table->dateTime('declaration_date')->nullable();
            $table->dateTime('ex_date')->nullable();
            $table->dateTime('record_date')->nullable();
            $table->dateTime('payout_date')->nullable();
            $table->string('frequency')->default(FrequencyEnum::Monthly->value);
            $table->float('payout_amount')->default(0.00);
            $table->string('source')->default('fmp');
            $table->string('distribution_type')->nullable();
            $table->float('historical_adjustment_factor')->default(0.00);
            $table->float('split_adjusted_cash_amount')->default(0.00);
            $table->timestamps();
            $table->unique('symbol');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dividends');
    }
};
