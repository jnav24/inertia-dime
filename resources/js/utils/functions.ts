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
    return (cents || 0)?.toFixed(2);
};

export const convertToCurrency = (val: number, currency = 'USD') => {
    const formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency,
    });

    return formatter.format(convertToDollar(val));
};
