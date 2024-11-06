import { Expenses } from '@/types/expenses';

enum BudgetAggregationEnum {
    EARNED = 'earned',
    SAVED = 'saved',
    SPENT = 'spent',
}

export type Budget = {
    id: uuid;
    name: string;
    budget_cycle: string;
    expenses: Expenses;
};

export type BudgetAggregation = Record<
    string,
    Record<string, Record<BudgetAggregationEnum, number>>
>;
