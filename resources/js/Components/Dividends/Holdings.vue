<script setup lang="ts">
import Settings from '@/Components/Icons/outline/Settings.vue';
import { convertToCurrency, convertToPercentage } from '@/utils/functions';
import ColumnBasic from '@/Components/table/ColumnBasic.vue';
import FormButton from '@/Components/Fields/FormButton.vue';
import Table from '@/Components/table/Table.vue';
import Typography from '@/Components/Elements/Typography.vue';
import { computed } from 'vue';
import useDividends from '@/Composables/useDividends';
import { UserDividend } from '@/types/dividends';

type Props = {
    items: UserDividend[];
};

type Emits = {
    (e: 'handle-selection', data: any): void;
};

defineEmits<Emits>();
const props = defineProps<Props>();

const { frequency, totalMarketValue } = useDividends({ items: props.items });

const highestReturn = computed(() => {
    const sorted = [...props.items].sort(
        (a, b) =>
            b.dividend.payout_amount * frequency(b.dividend.frequency) * b.quantity -
            a.dividend.payout_amount * frequency(a.dividend.frequency) * a.quantity,
    );
    return sorted[0];
});

const mostShares = computed(() => {
    const sorted = [...props.items].sort((a, b) => b.quantity - a.quantity);
    return sorted[0];
});

const totalAnnualIncome = computed(() => {
    return props.items.reduce(
        (acc, item) =>
            acc + item.dividend.payout_amount * frequency(item.dividend.frequency) * item.quantity,
        0,
    );
});

const upcomingPayoutDate = computed(() => {
    const today = new Date();
    today.setHours(0, 0, 0, 0);

    const futureDates = [...props.items]
        .map((item) => new Date(item.dividend.payout_date))
        .filter((date) => date >= today)
        .sort((a, b) => a.getTime() - b.getTime());

    return futureDates.length > 0 ? futureDates[0] : null;
});
</script>

<template>
    <div class="mb-12 grid grid-cols-6 divide-x pt-8">
        <div class="pl-4">
            <Typography variant="caption">Total Market Value</Typography>
            <Typography variant="body1">
                {{ convertToCurrency(totalMarketValue) }}
            </Typography>
        </div>
        <div class="pl-4">
            <Typography variant="caption">Dividend Yield</Typography>
            <Typography variant="body1">
                {{ convertToPercentage(totalAnnualIncome / totalMarketValue, true) }}
            </Typography>
        </div>
        <div class="pl-4">
            <Typography variant="caption">Most Shares</Typography>
            <Typography variant="body1">
                {{ mostShares.dividend.symbol }} - {{ mostShares.quantity }}
            </Typography>
        </div>
        <div class="pl-4">
            <Typography variant="caption">Highest Return</Typography>
            <Typography variant="body1">
                {{ highestReturn.dividend.symbol }} -
                {{
                    convertToCurrency(
                        highestReturn.dividend.payout_amount *
                            frequency(highestReturn.dividend.frequency) *
                            highestReturn.quantity,
                    )
                }}
            </Typography>
        </div>
        <div class="pl-4">
            <Typography variant="caption">Total Annual Income</Typography>
            <Typography variant="body1">
                {{ convertToCurrency(totalAnnualIncome) }}
            </Typography>
        </div>
        <div class="pl-4">
            <Typography variant="caption">Next Payout Date</Typography>
            <Typography variant="body1">
                {{ upcomingPayoutDate ? new Date(upcomingPayoutDate).toLocaleDateString() : 'N/A' }}
            </Typography>
        </div>
    </div>

    <Table :items="items">
        <ColumnBasic :colspan="3" header="Name">
            <template v-slot:default="{ data }">
                <div class="flex items-center space-x-2">
                    <img :src="data.dividend.image" alt="" class="h-12 w-12" />
                    <div>
                        <Typography variant="body1">
                            {{ data.dividend.name }}
                        </Typography>
                        <Typography variant="caption">
                            {{ data.dividend.symbol }}
                        </Typography>
                    </div>
                </div>
            </template>
        </ColumnBasic>
        <ColumnBasic :colspan="1" header="Price">
            <template v-slot:default="{ data }">
                {{ convertToCurrency(data.dividend.price) }}
            </template>
        </ColumnBasic>
        <ColumnBasic :colspan="1" header="% of Portfolio">
            <template v-slot:default="{ data }">
                {{
                    convertToPercentage(
                        (data.dividend.price * data.quantity) / totalMarketValue,
                        true,
                    )
                }}
            </template>
        </ColumnBasic>
        <ColumnBasic :colspan="1" header="Shares">
            <template v-slot:default="{ data }">
                {{ data.quantity }}
            </template>
        </ColumnBasic>
        <ColumnBasic header="Yield">
            <template v-slot:default="{ data }">
                {{ convertToPercentage(data.dividend.yield) }}
            </template>
        </ColumnBasic>
        <ColumnBasic :colspan="2" header="Market Value">
            <template v-slot:default="{ data }">
                {{ convertToCurrency(data.dividend.price * data.quantity) }}
            </template>
        </ColumnBasic>
        <ColumnBasic :colspan="1" header="Annual Income">
            <template v-slot:default="{ data }">
                {{
                    convertToCurrency(
                        data.dividend.payout_amount *
                            frequency(data.dividend.frequency) *
                            data.quantity,
                    )
                }}
            </template>
        </ColumnBasic>
        <ColumnBasic :colspan="1" header="">
            <template v-slot:default="{ data }">
                <div class="flex justify-end">
                    <FormButton
                        @click="$emit('handle-selection', data)"
                        :icon="Settings"
                        fab
                    ></FormButton>
                </div>
            </template>
        </ColumnBasic>
    </Table>
</template>
