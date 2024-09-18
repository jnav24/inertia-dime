<?php

namespace Database\Seeders;

use App\Models\BillType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BillTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BillType::factory()->create(['name' => 'Credit Cards', 'slug' => 'credit_cards']);
        BillType::factory()->create(['name' => 'Utilities', 'slug' => 'utilities']);
        BillType::factory()->create(['name' => 'Miscellaneous', 'slug' => 'miscellaneous']);
        BillType::factory()->create(['name' => 'Banks', 'slug' => 'banks']);
        BillType::factory()->create(['name' => 'Medical', 'slug' => 'medical']);
        BillType::factory()->create(['name' => 'Investments', 'slug' => 'investments']);
        BillType::factory()->create(['name' => 'Jobs', 'slug' => 'jobs']);
    }
}
