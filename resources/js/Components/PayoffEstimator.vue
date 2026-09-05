<script setup lang="ts">
import { ref, watchEffect } from 'vue';
import Typography from '@/Components/Elements/Typography.vue';
import ExpensePayOff from '@/Components/ExpensePayOff.vue';
import { convertToCurrency, simulatePayoff } from '@/utils/functions';

interface Props {
    amount: number;
    apr: number;
    balance: number;
    limit: number;
    showCostSummary?: boolean;
    showPayoffPanel?: boolean;
    showPayoffSummary?: boolean;
}

const props = withDefaults(defineProps<Props>(), {
    showCostSummary: true,
    showPayoffPanel: true,
    showPayoffSummary: true,
});

const months = ref(0);
const payoffInterest = ref(0);
const totalInterest = ref(0);
const payoffPaid = ref(0);
const totalPaid = ref(0);

watchEffect(() => {
    const payoff = simulatePayoff(props.balance, props.apr, props.amount);
    const total = simulatePayoff(props.limit, props.apr, props.amount);
    months.value = payoff.months;
    payoffInterest.value = payoff.totalInterest;
    payoffPaid.value = payoff.totalPaid;
    totalInterest.value = total.totalInterest;
    totalPaid.value = total.totalPaid;
});
</script>

<template>
    <div class="flex space-x-4">
        <div class="w-150 flex-1">
            <slot />
        </div>

        <div
            v-if="showPayoffPanel"
            class="w-96 space-y-4 rounded-lg border border-gray-200 bg-gray-50 p-4"
        >
            <Typography variant="h4">Payoff Estimator</Typography>

            <div class="pb-2">
                <ExpensePayOff :balance="balance" :total="limit" />
            </div>

            <div class="h-0.5 w-full rounded-md bg-gray-200" />

            <div>
                <Typography tag="p" variant="h5"> Payoff Summary </Typography>

                <div class="mt-4">
                    <Typography tag="p" variant="h4">
                        <span class="font-bold">{{ months }}</span>
                    </Typography>
                    <Typography variant="caption">Months to payoff</Typography>
                </div>

                <div v-if="showPayoffSummary" class="mt-4 grid grid-cols-2 gap-4">
                    <div>
                        <Typography tag="p" variant="h4">
                            <span class="font-bold">{{ convertToCurrency(payoffInterest) }}</span>
                        </Typography>
                        <Typography variant="caption">Interest Amount</Typography>
                    </div>

                    <div>
                        <Typography tag="p" variant="h4">
                            <span class="font-bold">{{ convertToCurrency(payoffPaid) }}</span>
                        </Typography>
                        <Typography variant="caption">Payoff Amount</Typography>
                    </div>
                </div>
            </div>

            <template v-if="showCostSummary">
                <div class="h-0.5 w-full rounded-md bg-gray-200" />

                <div>
                    <Typography tag="p" variant="h5"> Cost Summary </Typography>

                    <div class="mt-4 grid grid-cols-2 gap-4">
                        <div>
                            <Typography tag="p" variant="h4">
                                <span class="font-bold">{{
                                    convertToCurrency(totalInterest)
                                }}</span>
                            </Typography>
                            <Typography variant="caption">Total Interest Amount</Typography>
                        </div>

                        <div>
                            <Typography tag="p" variant="h4">
                                <span class="font-bold">{{ convertToCurrency(totalPaid) }}</span>
                            </Typography>
                            <Typography variant="caption">Total Payoff Amount</Typography>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</template>
