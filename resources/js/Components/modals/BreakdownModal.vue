<script setup lang="ts">
import Modal from '@/Components/modals/Modal.vue';
import DoughnutChart from '@/Components/Charts/DoughnutChart.vue';
import { ChartDatasetCustomTypesPerDataset } from 'chart.js/auto';
import { ValueOfExpense } from '@/types/expenses';
import { computed } from 'vue';
import Typography from '@/Components/Elements/Typography.vue';
import { convertToCurrency } from '@/utils/functions';

type Props = {
    expenses: ValueOfExpense[];
    show: boolean;
};

type ExpenseItem = {
    amount: number;
    color: string;
    name: string;
};

const emit = defineEmits<{ (e: 'update:show', v: boolean): void }>();
const props = defineProps<Props>();

const getRandomRGBColor = () => {
    const r = Math.floor(Math.random() * 256);
    const g = Math.floor(Math.random() * 256);
    const b = Math.floor(Math.random() * 256);
    return `rgb(${r}, ${g}, ${b})`;
};

const items = computed(() => {
    return (props.expenses ?? []).reduce(
        (result, expense) => {
            return {
                ...result,
                [expense.expense.slug]: {
                    name: expense.expense.name,
                    amount: (result[expense.expense.slug]?.amount ?? 0) + expense.data.amount,
                    color: result[expense.expense.slug]?.color ?? getRandomRGBColor(),
                },
            };
        },
        {} as Record<string, ExpenseItem>,
    );
});

const itemValues = computed(() => Object.values(items.value));

const amounts = computed(() => {
    return itemValues.value.map((item) => {
        return item.amount.toFixed(2);
    });
});

const colors = computed(() => {
    return itemValues.value.map((item) => {
        return item.color;
    });
});

const datasets = computed(() => {
    return [
        {
            label: 'Expenses Breakdown',
            data: amounts.value,
            backgroundColor: colors.value,
            hoverOffset: 4,
        },
    ] as unknown as ChartDatasetCustomTypesPerDataset[];
});

const labels = computed(() => {
    return itemValues.value.map((item) => {
        return item.name;
    });
});

const closeModal = () => emit('update:show', false);
</script>

<template>
    <Modal :show="show" @close-modal="closeModal()" hide-close-button>
        <div class="w-200 space-y-4 p-4">
            <Typography variant="h2">Breakdown by Type</Typography>
            <div class="flex">
                <div class="h-96 w-1/2">
                    <DoughnutChart
                        v-if="amounts.length && colors.length && labels.length"
                        :labels="labels"
                        :data="datasets"
                        hide-legend
                    />
                </div>
                <div class="w-1/2 pl-4">
                    <div class="flex w-full items-center">
                        <div class="flex flex-1 items-center justify-between">
                            <Typography variant="body1">Expense Type</Typography>
                            <Typography variant="caption"> Expense Amount </Typography>
                        </div>
                    </div>
                    <div
                        class="flex w-full items-center border-t border-gray-200 py-2"
                        v-for="(item, index) in itemValues"
                        :key="index"
                    >
                        <div class="mr-3 size-3" :style="`background-color: ${item.color};`" />
                        <div class="flex flex-1 items-center justify-between">
                            <Typography variant="caption">{{ item.name }}</Typography>
                            <Typography variant="caption">
                                {{ convertToCurrency(item.amount) }}
                            </Typography>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Modal>
</template>
