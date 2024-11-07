<script setup lang="ts">
import Typography from '@/Components/Elements/Typography.vue';
import type { ColumnBadgeProps } from '@/types/table';

withDefaults(defineProps<ColumnBadgeProps>(), { color: 'default' });
</script>

<template>
    <div
        class="inline-block rounded-lg border p-2"
        :class="{
            'border-danger bg-danger/20': color === 'danger',
            'border-success bg-success/20': color === 'success',
            'border-gray-400 bg-gray-100': color === 'default',
        }"
    >
        <Typography variant="caption">
            <span
                :class="{
                    'text-danger': color === 'danger',
                    'text-success': color === 'success',
                    'text-gray-500': color === 'default',
                }"
            >
                {{ value }}
            </span>
        </Typography>
    </div>
</template>
