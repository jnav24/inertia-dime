export const ucFirst = (val: string): string => val.charAt(0).toUpperCase() + val.slice(1);

export const toTitleCase = (value: string, casing = '-'): string => {
    return value
        .split(casing)
        .map((word) => ucFirst(word))
        .join(' ');
};

export const parseNested = <R extends object>(item: R, value: string): string => {
    return value.split('.').reduce((result: string | R, current: string) => {
        if (typeof result !== 'string' && result[current as keyof R]) {
            return result[current as keyof R] as R;
        }

        return '';
    }, item) as string;
};
