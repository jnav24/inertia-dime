<script setup lang="ts">
import Typography from '@/Components/Elements/Typography.vue';

defineProps<{ value: string }>();
</script>

<template>
    <div class="inline-block rounded-lg border border-gray-400 bg-gray-100 p-2">
        <Typography variant="caption">
            <span class="text-gray-500">{{ value }}</span>
        </Typography>
    </div>
</template>
