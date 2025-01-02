import { RulesType } from '@/types/form';
import { convertToCurrency, parseNested } from '@/utils/functions';
import { formatTimeZone, getStartDayOfMonth } from '@/utils/timestamp';
import ColumnActions from '@/Components/table/ColumnActions.vue';
import ColumnBasic from '@/Components/table/ColumnBasic.vue';
import ColumnBadge from '@/Components/table/ColumnBadge.vue';
import { Column, ColumnComponent } from '@/types/table';
import { IncomeExpense, ValueOfExpense, VehicleExpense } from '@/types/expenses';
import ColumnIsPaid from '@/Components/table/ColumnIsPaid.vue';

export const validation: Record<string, RulesType | Array<keyof RulesType>> = {
    password: ['required', 'min:12', 'mixedCase', 'symbol', 'has-int'],
};

const commonColumn: Column<ValueOfExpense>[] = [
    { content: 'data.name', label: 'Name', colspan: 3 },
    {
        content: {
            component: ColumnBasic as ColumnComponent<ValueOfExpense>,
            props: (obj) => ({
                value: convertToCurrency(Number(parseNested(obj, 'data.amount'))),
            }),
        },
        label: 'Amount',
        colspan: 2,
    },
    {
        content: {
            component: ColumnBadge as ColumnComponent<ValueOfExpense>,
            props: (obj) => ({ value: obj.expense?.name ?? '' }),
        },
        label: 'Type',
        colspan: 3,
    },
];

const commonSpendColumn: Column<ValueOfExpense>[] = [
    ...commonColumn,
    { content: 'data.due_date', label: 'Due Date' },
    {
        content: {
            component: ColumnActions as ColumnComponent<ValueOfExpense>,
            props: (obj) => ({ obj }),
        },
        label: '',
    },
];

const paidDateColumn: Column<ValueOfExpense> = {
    content: {
        component: ColumnBasic as ColumnComponent<ValueOfExpense>,
        props: (obj) => ({
            value: formatTimeZone('MMM d', 'UTC', parseNested(obj, 'data.paid_date')),
        }),
    },
    label: 'Paid Date',
    colspan: 2,
};

const actionsColumn: Column<ValueOfExpense> = {
    content: {
        component: ColumnActions as ColumnComponent<ValueOfExpense>,
        props: (obj) => ({ obj }),
    },
    label: '',
};

const isPaidColumn: Column<ValueOfExpense> = {
    content: {
        component: ColumnIsPaid as ColumnComponent<ValueOfExpense>,
        props: (obj) => ({ obj }),
    },
    label: '',
    colspan: 1,
};

export const columns: Record<string, Column<ValueOfExpense>[]> = {
    banks: [
        ...commonColumn,
        {
            content: {
                component: ColumnActions as ColumnComponent<ValueOfExpense>,
                props: (obj) => ({ obj }),
            },
            label: '',
        },
    ],
    childcares: commonSpendColumn,
    creditCards: [
        { content: 'data.name', label: 'Name', colspan: 3 },
        { content: 'expense.name', label: 'Type', colspan: 3 },
        { content: 'data.last_4', label: 'Last 4', colspan: 1 },
        {
            content: {
                component: ColumnBasic as ColumnComponent<ValueOfExpense>,
                props: (obj) => ({
                    value: convertToCurrency(Number(parseNested(obj, 'data.limit'))),
                }),
            },
            label: 'Limit',
            colspan: 2,
        },
        { content: 'data.due_date', label: 'Due Date', colspan: 1 },
        {
            content: {
                component: ColumnActions as ColumnComponent<ValueOfExpense>,
                props: (obj) => ({ obj }),
            },
            label: '',
        },
    ],
    education: commonSpendColumn,
    entertainments: commonSpendColumn,
    food: commonSpendColumn,
    gifts: commonSpendColumn,
    housings: commonSpendColumn,
    incomes: [
        ...commonColumn,
        {
            content: {
                component: ColumnBasic as ColumnComponent<ValueOfExpense>,
                props: (obj) => {
                    const { pay_date } = (obj as IncomeExpense).data;
                    return {
                        value: formatTimeZone('yyyy-MM-dd', 'UTC', pay_date),
                    };
                },
            },
            label: 'Pay Date',
            colspan: 2,
        },
        {
            content: {
                component: ColumnActions as ColumnComponent<ValueOfExpense>,
                props: (obj) => ({ obj }),
            },
            label: '',
        },
    ],
    investments: [
        ...commonColumn,
        {
            content: {
                component: ColumnActions as ColumnComponent<ValueOfExpense>,
                props: (obj) => ({ obj }),
            },
            label: '',
        },
    ],
    loans: commonSpendColumn,
    medicals: commonSpendColumn,
    miscellaneouses: commonSpendColumn.filter((column) => column.label !== 'Type'),
    personals: commonSpendColumn,
    shoppings: commonSpendColumn,
    subscriptions: commonSpendColumn,
    taxes: commonSpendColumn,
    travel: commonSpendColumn,
    utilities: commonSpendColumn,
    vehicles: [
        {
            content: {
                component: ColumnBasic as ColumnComponent<ValueOfExpense>,
                props: (obj) => {
                    obj = obj as VehicleExpense;
                    return {
                        value: `${obj.vehicle.year} ${obj.vehicle.make} ${obj.vehicle.model}`,
                    };
                },
            },
            label: 'Vehicle',
            colspan: 3,
        },
        ...commonColumn.filter((item) => item.label !== 'Name'),
        {
            content: {
                component: ColumnBasic as ColumnComponent<ValueOfExpense>,
                props: (obj) => ({
                    value: convertToCurrency(Number(parseNested(obj, 'data.balance'))),
                }),
            },
            label: 'Balance',
            colspan: 2,
        },
        { content: 'data.due_date', label: 'Due Date', colspan: 2 },
        {
            content: {
                component: ColumnActions as ColumnComponent<ValueOfExpense>,
                props: (obj) => ({ obj }),
            },
            label: '',
        },
    ],
};

export const budgetColumns: Record<string, Column<ValueOfExpense>[]> = {
    banks: [
        ...commonColumn,
        {
            content: {
                component: ColumnActions as ColumnComponent<ValueOfExpense>,
                props: (obj) => ({ obj }),
            },
            label: '',
        },
    ],
    childcares: [isPaidColumn, ...commonColumn, paidDateColumn, actionsColumn],
    creditCards: [
        isPaidColumn,
        { content: 'data.name', label: 'Name', colspan: 3 },
        { content: 'expense.name', label: 'Type', colspan: 3 },
        {
            content: {
                component: ColumnBasic as ColumnComponent<ValueOfExpense>,
                props: (obj) => ({
                    value: convertToCurrency(Number(parseNested(obj, 'data.amount'))),
                }),
            },
            label: 'Amount',
            colspan: 2,
        },
        {
            content: {
                component: ColumnBasic as ColumnComponent<ValueOfExpense>,
                props: (obj) => ({
                    value: convertToCurrency(Number(parseNested(obj, 'data.balance'))),
                }),
            },
            label: 'Balance',
            colspan: 2,
        },
        paidDateColumn,
        {
            content: {
                component: ColumnActions as ColumnComponent<ValueOfExpense>,
                props: (obj) => ({ obj }),
            },
            label: '',
        },
    ],
    education: [isPaidColumn, ...commonColumn, paidDateColumn, actionsColumn],
    entertainments: [isPaidColumn, ...commonColumn, paidDateColumn, actionsColumn],
    food: [isPaidColumn, ...commonColumn, paidDateColumn, actionsColumn],
    gifts: [isPaidColumn, ...commonColumn, paidDateColumn, actionsColumn],
    housings: [isPaidColumn, ...commonColumn, paidDateColumn, actionsColumn],
    incomes: [
        ...commonColumn,
        {
            content: {
                component: ColumnBasic as ColumnComponent<ValueOfExpense>,
                props: (obj) => {
                    const { pay_date } = (obj as IncomeExpense).data;
                    return {
                        value: formatTimeZone('MMM d', 'UTC', pay_date),
                    };
                },
            },
            label: 'Pay Date',
            colspan: 2,
        },
        {
            content: {
                component: ColumnActions as ColumnComponent<ValueOfExpense>,
                props: (obj) => ({ obj }),
            },
            label: '',
        },
    ],
    investments: [
        ...commonColumn,
        {
            content: {
                component: ColumnActions as ColumnComponent<ValueOfExpense>,
                props: (obj) => ({ obj }),
            },
            label: '',
        },
    ],
    loans: [isPaidColumn, ...commonColumn, paidDateColumn, actionsColumn],
    medicals: [isPaidColumn, ...commonColumn, paidDateColumn, actionsColumn],
    miscellaneouses: [isPaidColumn, ...commonColumn, paidDateColumn, actionsColumn].filter(
        (column) => column.label !== 'Type',
    ),
    personals: [isPaidColumn, ...commonColumn, paidDateColumn, actionsColumn],
    shoppings: [isPaidColumn, ...commonColumn, paidDateColumn, actionsColumn],
    subscriptions: [isPaidColumn, ...commonColumn, paidDateColumn, actionsColumn],
    taxes: [isPaidColumn, ...commonColumn, paidDateColumn, actionsColumn],
    travel: [isPaidColumn, ...commonColumn, paidDateColumn, actionsColumn],
    utilities: [isPaidColumn, ...commonColumn, paidDateColumn, actionsColumn],
    vehicles: [
        isPaidColumn,
        {
            content: {
                component: ColumnBasic as ColumnComponent<ValueOfExpense>,
                props: (obj) => {
                    obj = obj as VehicleExpense;
                    return {
                        value: `${obj.vehicle.year} ${obj.vehicle.make} ${obj.vehicle.model}`,
                    };
                },
            },
            label: 'Vehicle',
            colspan: 3,
        },
        ...commonColumn.filter((item) => item.label !== 'Name'),
        {
            content: {
                component: ColumnBasic as ColumnComponent<ValueOfExpense>,
                props: (obj) => ({
                    value: convertToCurrency(Number(parseNested(obj, 'data.balance'))),
                }),
            },
            label: 'Balance',
            colspan: 2,
        },
        paidDateColumn,
        actionsColumn,
    ],
};

export const dueDates = Array.from(Array(31).keys()).map((num: number) => ({
    label: num + 1,
    value: num + 1,
}));

export const getDefaultDate = (dateTime: string, budgetDateTime?: string) => {
    const commonFormat = 'yyyy-MM-dd';
    const comparisonFormat = 'yyyy-MM';

    if (dateTime) {
        return formatTimeZone(commonFormat, 'UTC', dateTime);
    }

    if (
        budgetDateTime &&
        formatTimeZone(comparisonFormat, 'UTC', dateTime) ===
            formatTimeZone(comparisonFormat, 'UTC', budgetDateTime)
    ) {
        return formatTimeZone(commonFormat, 'UTC', getStartDayOfMonth(dateTime).toISOString());
    }

    return formatTimeZone(commonFormat);
};
