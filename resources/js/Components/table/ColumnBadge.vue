<script setup lang="ts">
import { computed, inject, useSlots } from 'vue';
import {
    ColumnBadgeColor,
    type ColumnProps,
    TableContext,
    type TableContextType,
    TableRowContext,
    type TableRowContextType,
} from '@/types/table';
import Typography from '@/Components/Elements/Typography.vue';

interface Props extends ColumnProps {
    color:
        | ColumnBadgeColor
        | Record<string, ColumnBadgeColor>
        | ((obj: Record<string, any>) => ColumnBadgeColor);
}

const colors = {
    [ColumnBadgeColor.DANGER]: {
        inner: 'text-danger',
        outer: 'border-danger bg-danger/20',
    },
    [ColumnBadgeColor.GRAY]: {
        inner: 'text-gray-500',
        outer: 'border-gray-400 bg-gray-100',
    },
    [ColumnBadgeColor.INFO]: {
        inner: 'text-info',
        outer: 'border-info bg-info/20',
    },
    [ColumnBadgeColor.PRIMARY]: {
        inner: 'text-primary',
        outer: 'border-primary bg-gray-100',
    },
    [ColumnBadgeColor.SUCCESS]: {
        inner: 'text-success',
        outer: 'border-success bg-success/20',
    },
    [ColumnBadgeColor.WARNING]: {
        inner: 'text-warning',
        outer: 'border-warning bg-warning/20',
    },
};

const props = withDefaults(defineProps<Props>(), { colspan: 1 });

const slots = useSlots();

const tableContext = inject<TableContextType>(TableContext);
const tableRowContext = inject<TableRowContextType>(TableRowContext);

const badgeColor = computed(() => {
    switch (typeof props.color) {
        case 'string':
            return colors[props.color];
        case 'object':
            const index = props.color[columnValue.value ?? ''] ?? ColumnBadgeColor.GRAY;
            return colors[index];
        case 'function':
            return colors[props.color(tableRowContext?.data ?? {})];
    }

    return colors[ColumnBadgeColor.GRAY];
});

const columnValue = computed(() => tableRowContext?.getContent(props.header, props.notation));
const columnGutter = computed(() => tableContext?.getGutter.value);
const columnWidth = computed(() => tableContext?.getColSpan(props.colspan));
</script>

<template>
    <div :class="[columnGutter, columnWidth]">
        <div class="inline-block w-full rounded-lg border p-2" :class="badgeColor.outer">
            <Typography variant="caption">
                <span class="block text-center" :class="badgeColor.inner">
                    <slot v-if="slots.default" :data="tableRowContext?.data ?? {}" />
                    <span v-else>{{ columnValue }}</span>
                </span>
            </Typography>
        </div>
    </div>
</template>
