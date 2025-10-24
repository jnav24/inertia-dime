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

export type Expenses = {
    banks: GainExpense;
    childcares: CommonExpense;
    creditCards: CreditCardExpense;
    education: CommonExpense;
    entertainments: CommonExpense;
    food: CommonExpense;
    gifts: CommonExpense;
    housings: CommonExpense;
    incomes: IncomeExpense;
    investments: CommonExpense;
    loans: CommonExpense;
    medicals: CommonExpense;
    miscellaneouses: CommonExpense;
    personals: CommonExpense;
    shoppings: CommonExpense;
    subscriptions: CommonExpense;
    taxes: CommonExpense;
    travel: CommonExpense;
    utilities: CommonExpense;
    vehicles: VehicleExpense;
};

export type GainExpenseFormProps = ExpenseFormProps & {
    expense?: GainExpense;
};

export type CommonExpenseFormProps = ExpenseFormProps & {
    expense?: CommonExpense;
};

export type CreditCardExpenseFormProps = ExpenseFormProps & {
    expense?: CreditCardExpense;
};

export type IncomeExpenseFormProps = ExpenseFormProps & {
    expense?: IncomeExpense;
};

export type UserVehicleExpenseFormProps = ExpenseFormProps & {
    expense?: VehicleExpense;
};

export type UserVehicle = {
    color: string;
    id: string;
    is_active: boolean;
    license: string | null;
    make: string;
    model: string;
    year: number;
};

export type ExpenseType = {
    id: string;
    name: string;
    slug: string;
};

type CreditCardExpense = {
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
        confirmation?: string;
        notes?: string;
        paid_date?: string;
    };
    expense: ExpenseType;
};

type GainExpense = {
    id: string;
    data: {
        name: string;
        amount: number;
    };
    expense: ExpenseType;
};

export type IncomeExpense = {
    id: string;
    data: {
        name: string;
        amount: number;
        pay_date: string;
    };
    expense: ExpenseType;
};

type CommonExpense = {
    id: string;
    data: ExpenseFormActionProps & {
        name: string;
        amount: number;
        due_date?: number;
        confirmation?: string;
        notes?: string;
        paid_date?: string;
    };
    expense: ExpenseType;
};

export type VehicleExpense = {
    id: string;
    data: ExpenseFormActionProps & {
        id?: string;
        amount: number;
        balance: number;
        due_date?: number;
        mileage: number;
        confirmation?: string;
        notes?: string;
        paid_date?: string;
    };
    expense: ExpenseType;
    vehicle: UserVehicle;
};

export type ValueOfExpense =
    | GainExpense
    | CommonExpense
    | CreditCardExpense
    | IncomeExpense
    | VehicleExpense;
