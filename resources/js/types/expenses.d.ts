export type ExpenseFormEmits = {
    (e: 'close'): void;
};

export type ExpenseFormProps = {
    isTemplate?: boolean;
    types: ExpenseType[];
};

export type ExpenseFormActionProps = {
    confirmation?: string;
    paid_date?: string;
    notes?: string;
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
        data: ExpenseFormActionProps & {
            name: string;
            amount: number;
            due_date?: number;
        };
        expense: ExpenseType;
    };
};

export type CreditCardExpenseFormProps = ExpenseFormProps & {
    expense?: {
        id: string;
        data: ExpenseFormActionProps & {
            name: string;
            amount: number;
            balance: number;
            limit: number;
            apr: number;
            last_4: number;
            exp_month: number;
            exp_year: number;
            due_date?: number;
        };
        expense: ExpenseType;
    };
};

export type IncomeExpenseFormProps = ExpenseFormProps & {
    expense?: {
        id: string;
        data: {
            name: string;
            amount: number;
            pay_date: string;
        };
        expense: ExpenseType;
    };
};

export type UserVehicleExpenseFormProps = ExpenseFormProps & {
    expense?: {
        id: string;
        data: ExpenseFormActionProps & {
            amount: number;
            balance: number;
            due_date?: number;
            mileage: number;
        };
        expense: ExpenseType;
        vehicle: UserVehicle;
    };
};

type UserVehicle = {
    color: string;
    id: string;
    is_active: boolean;
    license: string | null;
    make: string;
    model: string;
    year: number;
};

type ExpenseType = {
    id: string;
    name: string;
    slug: string;
};
