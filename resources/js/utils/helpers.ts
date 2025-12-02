import { RulesType } from '@/types/form';
import { convertToCurrency, parseNested } from '@/utils/functions';
import { formatTimeZone, getStartDayOfMonth } from '@/utils/timestamp';
import { IncomeExpense, ValueOfExpense, VehicleExpense } from '@/types/expenses';

export const validation: Record<string, RulesType | Array<keyof RulesType>> = {
    password: ['required', 'min:12', 'mixedCase', 'symbol', 'has-int'],
};

export const dueDates = Array.from(Array(31).keys()).map((num: number) => ({
    label: String(num + 1),
    value: String(num + 1),
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
