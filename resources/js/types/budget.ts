import { Expenses } from '@/types/expenses';

export enum BudgetAggregationEnum {
    EARNED = 'earned',
    SAVED = 'saved',
    SPENT = 'spent',
}

export type Aggregation = {
    id: string;
    budget_cycle?: string;
    data: Record<BudgetAggregationEnum, number>;
};

export type Budget = {
    id: string;
    name: string;
    budget_cycle: string;
    aggregation: Aggregation;
    expenses: Expenses;
};

export type SortedAggregation = {
    [year: string]: {
        [month: string]: Required<Aggregation>;
    };
};
