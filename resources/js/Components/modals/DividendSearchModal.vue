<script setup lang="ts">
import Modal from '@/Components/modals/Modal.vue';
import Typography from '@/Components/Elements/Typography.vue';
import { convertToCurrency, toTitleCase } from '@/utils/functions';
import { formatTimeZone } from '@/utils/timestamp';
import { computed, ref } from 'vue';
import BudgetForm from '@/Components/Fields/BudgetForm.vue';
import FormInput from '@/Components/Fields/FormInput.vue';
import FormSelect from '@/Components/Fields/FormSelect.vue';
import FormButton from '@/Components/Fields/FormButton.vue';
import ChevronRight from '@/Components/Icons/outline/ChevronRight.vue';

interface Props {
    dividend: any;
    show: boolean;
}

const props = defineProps<Props>();

const format = 'yyyy-MM-dd';
const frequency = {
    monthly: 12,
    quarterly: 4,
    annually: 1,
    semiannual: 2,
};
const maxLength = 350;
const tz = 'UTC';
const transactionTypes = [
    { label: 'Buy', value: 'buy' },
    { label: 'Sell', value: 'sell' },
];

const showFullDescription = ref(false);

const isGain = computed(() => {
    return props.dividend.change_percentage > 0;
});

const change = computed(() => {
    const symbol = isGain.value ? '+' : '';
    return symbol + props.dividend.change;
});

const changePercentage = computed(() => {
    const symbol = isGain.value ? '+' : '';
    return symbol + props.dividend.change_percentage.toFixed(2) + '%';
});

const dividendPayout = computed(() => {
    const total = `(${convertToCurrency(props.dividend.payout_amount * (frequency[props.dividend.frequency as keyof typeof frequency] ?? 1))} annually)`;
    return `${convertToCurrency(props.dividend.payout_amount)} ${total}`;
});

const stats = computed(() => {
    return [
        { label: 'Sector', value: props.dividend.sector },
        { label: 'Frequency', value: toTitleCase(props.dividend.frequency) },
        { label: 'Yield', value: props.dividend.yield.toFixed(2) + '%' },
        { label: 'Payout Amount', value: dividendPayout.value },
        {
            label: 'Declaration Date',
            value: formatTimeZone(format, tz, props.dividend.declaration_date),
            tooltip:
                'The date the company’s board officially announces the dividend (and usually sets the dividend amount and the other key dates like ex-dividend and payment).',
        },
        {
            label: 'Ex Date',
            value: formatTimeZone(format, tz, props.dividend.ex_date),
            tooltip:
                'The cutoff for eligibility based on share ownership. On/after this date, a new buyer does not get the upcoming dividend; only shareholders who owned the shares before the ex-date are entitled.',
        },
        {
            label: 'Record Date',
            value: formatTimeZone(format, tz, props.dividend.record_date),
            tooltip:
                'The date the company checks its official shareholder records to determine who is eligible. In practice, it’s usually set so that investors who were still holders on the ex-date will be the ones recorded.',
        },
        { label: 'Payout Date', value: formatTimeZone(format, tz, props.dividend.payout_date) },
    ];
});

// the total $ amount holding value; $20,030
// number of holdings
// percentage of portfolio
// projected annual dividend income for specific holding

const holdings = computed(() => {
    return [
        { label: 'Shares', value: '3,584.75' },
        { label: 'Market Value', value: convertToCurrency(165382.49) },
        { label: '% of Portfolio', value: '4.17%' },
        { label: 'Annual Income', value: convertToCurrency(7827.59) },
    ];
});

const truncateDescription = computed(() => props.dividend.description.length > maxLength);
</script>

<template>
    <Modal :show="show" @close-modal="$emit('update:show', false)" hide-close-button persistent>
        <div class="flex w-300 p-4">
            <div class="flex-1 pr-4">
                <div class="mb-4 flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <div class="bg-gray-200">
                            <img :src="dividend.image" alt="" class="h-16 w-16" />
                        </div>

                        <div>
                            <Typography variant="h2">{{ dividend.company_name }}</Typography>
                            <Typography variant="caption">{{ dividend.symbol }}</Typography>
                        </div>
                    </div>

                    <div class="text-right">
                        <Typography variant="h3">
                            {{ convertToCurrency(dividend.price) }}
                        </Typography>
                        <Typography variant="caption">
                            <span
                                class="flex space-x-1"
                                :class="{ 'text-success': isGain, 'text-danger': !isGain }"
                            >
                                <span>{{ change }}</span>
                                <span>({{ changePercentage }})</span>
                            </span>
                        </Typography>
                    </div>
                </div>

                <div class="mb-6 flex-col space-y-2">
                    <Typography variant="h5">
                        <span class="font-bold">Holdings</span>
                    </Typography>

                    <div class="grid grid-cols-4 gap-4 rounded-lg border p-4">
                        <div v-for="holding in holdings">
                            <Typography variant="body2">
                                <div class="font-bold">{{ holding.label }}</div>
                            </Typography>
                            <Typography variant="caption">{{ holding.value }}</Typography>
                        </div>
                    </div>
                </div>

                <div class="flex-col space-y-2">
                    <Typography variant="h5">
                        <span class="font-bold">Key Stats</span>
                    </Typography>

                    <div class="grid grid-cols-4 gap-4 rounded-lg border p-4">
                        <div v-for="stat in stats">
                            <Typography variant="body2">
                                <div class="font-bold">{{ stat.label }}</div>
                            </Typography>
                            <Typography variant="caption">{{ stat.value }}</Typography>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <Typography variant="body1">
                        <span v-if="!showFullDescription">
                            {{ dividend.description.slice(0, maxLength) }}
                            <span v-if="truncateDescription">...</span>
                        </span>
                        <span v-else>{{ dividend.description }}</span>
                    </Typography>
                    <button
                        v-if="truncateDescription"
                        @click="showFullDescription = !showFullDescription"
                        class="mt-4 flex items-center space-x-2 text-primary"
                    >
                        <span>View {{ !showFullDescription ? 'More' : 'Less' }}</span>
                        <ChevronRight classes="size-4" />
                    </button>
                </div>
            </div>

            <div class="w-1/3 border-l pl-4">
                <Typography variant="h4">Add Transaction</Typography>
                <BudgetForm>
                    <div class="mt-6 flex-col space-y-4">
                        <FormInput label="Quantity" :rules="['required', 'float:2']" value="0" />
                        <FormInput
                            label="Price"
                            :rules="['required', 'float:2']"
                            :value="dividend.price"
                        />
                        <FormSelect
                            label="Transaction Type"
                            :items="transactionTypes"
                            :rules="['required']"
                            item-label="label"
                            item-value="value"
                            value="buy"
                        />
                        <FormButton block color="primary" submit>Submit</FormButton>
                        <FormButton @click="$emit('update:show', false)" block>Cancel</FormButton>
                    </div>
                </BudgetForm>
            </div>
        </div>
    </Modal>
</template>
