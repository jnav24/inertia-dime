enum BudgetAggregationEnum {
    EARNED = 'earned',
    SAVED = 'saved',
    SPENT = 'spent',
}

export type Budget = {
    id: uuid;
    name: string;
    budget_cycle: string;
};

export type BudgetAggregation = Record<
    string,
    Record<string, Record<BudgetAggregationEnum, number>>
>;
