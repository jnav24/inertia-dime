<script setup lang="ts">
import TrendUp from '@/Components/Icons/outline/TrendUp.vue';
import TrendDown from '@/Components/Icons/outline/TrendDown.vue';
import Fire from '@/Components/Icons/outline/Fire.vue';
import { ColumnTrendProps } from '@/types/table';
import { computed } from 'vue';
import { BudgetAggregationEnum } from '@/types/budget';

const props = defineProps<ColumnTrendProps>();

const saved = computed(() => {
    return props.aggregation.data[BudgetAggregationEnum.SAVED] ?? 0;
});
</script>

<template>
    <div class="flex">
        <TrendDown v-if="saved < 0" classes="text-danger size-8" />
        <TrendUp v-else classes="text-success size-8" />
        <Fire v-if="saved === highestSaved" classes="text-orange-500 size-8" />
    </div>
</template>
