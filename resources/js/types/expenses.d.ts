export type ExpenseFormEmits = {
    (e: 'close'): void;
};

export type ExpenseFormProps = {
    isTemplate?: boolean;
    types: ExpenseType[];
};

export type GainExpenseFormProps = ExpenseFormProps & {
    expense?: {
        id: string;
        data: {
            name: string;
            amount: number;
        };
        expense: ExpenseType;
    };
};

export type CommonExpenseFormProps = ExpenseFormProps & {
    expense?: {
        id: string;
        data: {
            name: string;
            amount: number;
            due_date: number;
        };
        expense: ExpenseType;
    };
};

type ExpenseType = {
    id: string;
    name: string;
    slug: string;
};
