import {
    format,
    addHours,
    addMonths,
    endOfMonth,
    startOfMonth,
    addYears,
    getUnixTime,
} from 'date-fns';
import { toZonedTime } from 'date-fns-tz';

const getDateObject = (timestamp = '') => (timestamp.length ? new Date(timestamp) : new Date());

export const formatDate = (pattern = 'yyyy-MM-dd hh:mm a', timestamp = ''): string => {
    return format(getDateObject(timestamp), pattern);
};

export const formatTimeZone = (pattern = 'yyyy-MM-dd hh:mm', zone = 'UTC', timestamp = '') => {
    const zonedDate = toZonedTime(getDateObject(timestamp), zone);
    return formatDate(pattern, zonedDate.toLocaleString());
};

export const addHour = (addition: number, timestamp = '') => {
    return addHours(getDateObject(timestamp), addition);
};

export const addMonth = (addition: number, timestamp = '') => {
    return addMonths(getDateObject(timestamp), addition);
};

export const addYear = (addition: number, timestamp = '') => {
    return addYears(getDateObject(timestamp), addition);
};

export const setDoubleDigits = (int: number): string => {
    if (int < 10) {
        return '0' + int;
    }

    return int.toString();
};

export const getEndDayOfMonth = (timestamp = '') => {
    return endOfMonth(getDateObject(timestamp));
};

export const getStartDayOfMonth = (timestamp = '') => {
    return startOfMonth(getDateObject(timestamp));
};

export const unix = (timestamp = ''): number => {
    return getUnixTime(getDateObject(timestamp));
};

export const generateUnixId = (): number => {
    return unix() * Math.round(Math.random() * 100) + 1;
};

export const generateTempId = (): string => {
    return 'temp_' + generateUnixId();
};

export const isTempId = (id: number | string): boolean => {
    return id.toString().includes('temp_');
};

export const getAllMonths = (
    formatType: 'abbr' | 'full' | 'num' | string,
): Array<Record<'value' | 'label', string>> => {
    return Array.from(Array(12).keys()).map((int) => {
        let label = '';
        const month = int + 1 < 10 ? '0' + (int + 1).toString() : (int + 1).toString();
        const year = formatDate('yyyy');

        switch (formatType) {
            case 'abbr':
                label = formatDate('MMM', `${year}-${month}-01 00:00:00`);
                break;
            case 'full':
                label = formatDate('MMMM', `${year}-${month}-01 00:00:00`);
                break;
            case 'num':
            default:
                label = month;
                break;
        }

        return {
            label,
            value: month,
        };
    });
};

export const getSetAmountOfYears = (amount: number) => {
    const currentYear = +formatDate('yyyy');
    return [...Array(amount).keys()].map((year) => {
        return {
            label: currentYear - year,
            value: currentYear - year,
        };
    });
};
