import { RulesType } from '@/types/form';

export const validation: Record<string, RulesType | Array<keyof RulesType>> = {
    password: ['required', 'min:12', 'mixedCase', 'symbol', 'has-int'],
};
