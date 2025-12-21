<script setup lang="ts">
import { computed, provide } from 'vue';
import { TableRowContext, type TableRowContextType } from '@/types/table';

interface Props {
    data: { row: any };
}

const props = defineProps<Props>();

const item = computed(() => props.data);

const parseValue = (value: string) => {
    return value.split('.').reduce((result, current) => {
        return result[current] ?? '';
    }, props.data?.row);
};

const getContent = (header: string, notation: string | undefined = undefined) => {
    if (notation) {
        return parseValue(notation);
    }

    return props.data?.row?.[header] ?? props.data?.row?.[header.toLowerCase()];
};

provide<TableRowContextType>(TableRowContext, { data: item, getContent, parseValue });
</script>

<template>
    <slot></slot>
</template>
