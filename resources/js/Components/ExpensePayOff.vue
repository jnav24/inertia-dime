<script setup lang="ts">
import { computed } from 'vue';
import Typography from '@/Components/Elements/Typography.vue';
import { convertToPercentage } from '@/utils/functions';

type Props = {
    balance: number;
    total: number;
};

const props = defineProps<Props>();

const percentage = computed(() => {
    return convertToPercentage((props.total - props.balance) / props.total, true);
});
</script>

<template>
    <div class="mb-2 flex items-center justify-between">
        <Typography variant="caption">Debt Progress</Typography>
        <Typography variant="caption">{{ percentage }}</Typography>
    </div>

    <div class="relative mb-4 h-2 w-full">
        <div
            class="absolute left-0 top-0 h-2 rounded-md bg-primary"
            :style="`width: ${percentage}; z-index: 2`"
        />
        <div class="absolute left-0 top-0 h-2 w-full rounded-md bg-gray-200" style="z-index: 1" />
    </div>
</template>
