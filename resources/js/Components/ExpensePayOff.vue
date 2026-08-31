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
    return convertToPercentage(props.total / props.balance, true);
});
</script>

<template>
    <div class="flex items-center justify-end mb-2">
        <Typography variant="caption">Debt Progress</Typography>
        <Typography variant="caption">{{ percentage }}</Typography>
    </div>

    <div class="relative h-2 w-full">
        <div class="absolute left-0 top-0 bg-primary rounded-md h-2" :style="`width: ${percentage}`" />
        <div class="absolute left-0 top-0 bg-gray-100 rounded-md w-full h-2" />
    </div>
</template>
