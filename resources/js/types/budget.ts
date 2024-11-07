import { Expenses } from '@/types/expenses';

export enum BudgetAggregationEnum {
    EARNED = 'earned',
    SAVED = 'saved',
    SPENT = 'spent',
}

export type Aggregation = {
    id: string;
    data: { value: number; type: BudgetAggregationEnum }[];
};

export type Budget = {
    id: string;
    name: string;
    budget_cycle: string;
    aggregation: Aggregation;
    expenses: Expenses;
};

export type BudgetAggregation = Record<string, Record<'data', Aggregation[]>>;
