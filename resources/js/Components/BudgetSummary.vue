<script setup lang="ts">
import BudgetTotal from '@/Components/BudgetTotal.vue';
import Cash from '@/Components/Icons/outline/Cash.vue';
import ShoppingBag from '@/Components/Icons/outline/ShoppingBag.vue';
import Library from '@/Components/Icons/outline/Library.vue';
import { Aggregation } from '@/types/budget';
import { convertToCurrency } from '@/utils/functions';

type Props = {
    aggregation: Aggregation;
};

defineProps<Props>();
</script>

<template>
    <section class="flex items-center justify-between">
        <BudgetTotal
            :icon="Cash"
            title="Total Income"
            :amount="convertToCurrency(aggregation.data.earned)"
        />
        <BudgetTotal
            :icon="ShoppingBag"
            title="Total Spent"
            :amount="convertToCurrency(aggregation.data.spent)"
        />
        <BudgetTotal
            :icon="Library"
            title="Total Saved"
            :amount="convertToCurrency(aggregation.data.saved)"
        />
    </section>
</template>
