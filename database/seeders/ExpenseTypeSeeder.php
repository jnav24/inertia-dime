<?php

namespace Database\Seeders;

use App\Enums\ExpenseTypeEnum;
use App\Models\ExpenseType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ExpenseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ExpenseTypeEnum::BANK->value => ['Checking', 'Savings', 'Money Market Account (MMA)', 'Certificate of Deposit (CD)'],
            ExpenseTypeEnum::CHILDCARE->value => ['Babysitter', 'Nanny', 'Daycare', 'Allowance', 'Toys', 'Games', 'Child Support', 'Extracurricular Activities'],
            ExpenseTypeEnum::CREDIT_CARD->value => ['Mastercard', 'Visa', 'Discover', 'American Express', 'Store'],
            ExpenseTypeEnum::EDUCATION->value => ['Tuition', 'Books and Supplies'],
            ExpenseTypeEnum::ENTERTAINMENT->value => ['Art', 'Literature', 'Music', 'Movies', 'Performing Arts', 'Concert'],
            ExpenseTypeEnum::FOOD->value => ['Alcohol', 'Coffee', 'Grocery', 'Fast Food', 'Restaurant', 'Work Meal', 'Takeout'],
            ExpenseTypeEnum::GIFT->value => ['Gift', 'Donation', 'Charity'],
            ExpenseTypeEnum::HOUSING->value => ['Rent', 'Mortgage', 'HOA', 'Principal', 'Interest', 'Insurance', 'Student Housing', 'Donation'],
            ExpenseTypeEnum::INCOME->value => ['Weekly', 'Bi-Weekly', 'Semi-Monthly', 'Monthly', 'One Time', 'Bonus', 'Commission', 'Dividends', 'Donation', 'Fees', 'Gift', 'Grant', 'Interest', 'Passive', 'Portfolio', 'Prizes', 'Rental', 'Sales', 'Tips', 'Reimbursement'],
            ExpenseTypeEnum::INVESTMENT->value => ['Stocks', 'Crypto', '401k', 'Traditional IRA', 'Roth IRA', 'SEP IRA', 'Mutual Funds', 'Brokerage', 'Restricted Stock', 'Annuities', 'Bonds', 'Certificate of Deposit (CD)', 'Commodities', 'Exchange-Traded Fund (ETF)', 'Options'],
            ExpenseTypeEnum::LOAN->value => ['Auto', 'Personal', 'Business', 'Equity', 'Credit-Builder', 'Payday', 'Pawn', 'Student'],
            ExpenseTypeEnum::MEDICAL->value => ['Preventive', 'Doctor Visit', 'Insurance', 'Copay', 'Deductible', 'Prescription', 'Surgery', 'Emergency Room', 'Outstanding Bill', 'Therapy', 'Hospital', 'Laboratory', 'Over-the-Counter'],
            ExpenseTypeEnum::PERSONAL->value => ['Dry Cleaning', 'Gym & Fitness', 'Hair', 'Laundry', 'Manicure', 'Pedicure', 'Spa & Massage'],
            ExpenseTypeEnum::SHOPPING->value => ['Books & Literature', 'Clothing', 'Electronics', 'Furniture', 'Games', 'Media', 'Products', 'Shoes', 'Software', 'Sporting Goods'],
            ExpenseTypeEnum::SUBSCRIPTION->value => ['Auto-Ship', 'Curated', 'Access', 'Software'],
            ExpenseTypeEnum::TAX->value => ['Federal', 'State', 'Local', 'Property', 'Sales'],
            ExpenseTypeEnum::TRAVEL->value => ['Airfare', 'Bus Fare', 'Commute', 'Train Fare', 'Lodging', 'Rental', 'Excursion', 'Tour'],
            ExpenseTypeEnum::UTILITY->value => ['Electronic', 'Gas', 'Water & Sewer', 'Trash & Recycling', 'Cable', 'Internet', 'Cable & Internet', 'Cable & Phone', 'Internet & Phone', 'Cable, Internet & Phone', 'Home Phone', 'Cell Phone', 'Landscaping'],
            ExpenseTypeEnum::VEHICLE->value => ['Gas', 'Finance', 'Lease', 'Insurance', 'Repair & Maintenance', 'Registration'],
        ];

        foreach ($types as $type => $values) {
            foreach ($values as $item) {
                ExpenseType::factory()->create([
                    'type' => $type,
                    'name' => $item,
                    'slug' => Str::slug($item),
                ]);
            }
        }
    }
}
