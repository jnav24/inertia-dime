export const ucFirst = (val: string): string => val.charAt(0).toUpperCase() + val.slice(1);

export const toTitleCase = (value: string, casing = '-'): string => {
    return value
        .replace(/[_-]/g, ' ')
        .replace(/\s+/g, ' ')
        .replace(/([a-z])([A-Z])/g, '$1 $2')
        .toLowerCase()
        .replace(/(?:^|\s)\S/g, (a) => a.toUpperCase());
};

export const parseNested = <R extends object>(item: R, value: string): string => {
    return value.split('.').reduce((result: string | R, current: string) => {
        if (typeof result !== 'string' && result[current as keyof R]) {
            return result[current as keyof R] as R;
        }

        return '';
    }, item) as string;
};

export const convertToDollar = (cents?: number) => {
    return (cents || 0)?.toFixed(2) ?? '0.00';
};

export const convertToCurrency = (val: number, currency = 'USD') => {
    const formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency,
    });

    return formatter.format(Number(convertToDollar(val)));
};

export const convertToPercentage = (val: number, convert: boolean = false) => {
    return `${(val * (convert ? 100 : 1)).toFixed(2)}%`;
};

export const toKebabCase = (value: string) => value.toLowerCase().replace(/\s+/g, '-');

export const debounce = (fn: Function, delay = 300) => {
    let timeout: NodeJS.Timeout | undefined = undefined;
    return (...args: any[]) => {
        clearTimeout(timeout);
        timeout = setTimeout(() => fn(...args), delay);
    };
};

export const simulatePayoff = (balance: number, rate: number, monthlyPayment: number) => {
    if (monthlyPayment <= 0) {
        return {
            finalBalance: balance,
            months: 0,
            totalInterest: 0,
            totalPaid: 0,
            years: 0,
        };
    }

    const monthlyRate = (rate >= 1 ? rate / 100 : rate) / 12;
    let months = 0;
    let totalInterest = 0;
    let totalPaid = 0;
    const maxIterations = 600; // 50 years safety limit

    while (balance > 0 && months < maxIterations) {
        const interest = balance * monthlyRate;
        const payment = Math.min(monthlyPayment, balance + interest);

        balance += interest;
        balance -= payment;

        totalInterest += interest;
        totalPaid += payment;
        months++;
    }

    return {
        finalBalance: balance,
        months,
        totalInterest,
        totalPaid,
        years: months / 12,
    };
};
