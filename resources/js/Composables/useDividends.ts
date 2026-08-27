import { computed } from 'vue';
import { UserDividend } from '@/types/dividends';

type Props = {
    items: UserDividend[];
};

export default function useDividends({ items }: Props) {
    const totalMarketValue = computed(() => {
        return items.reduce((acc, item) => acc + item.dividend.price * item.quantity, 0);
    });

    const frequency = (value: string) => {
        const options: Record<string, number> = {
            annually: 1,
            semiannual: 2,
            quarterly: 4,
            monthly: 12,
        };
        return options[value] ?? 1;
    };

    return { frequency, totalMarketValue };
}
