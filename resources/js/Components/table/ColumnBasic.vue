<script setup lang="ts">
import { computed, inject, useSlots } from 'vue';
import {
    type ColumnProps,
    TableContext,
    type TableContextType,
    TableRowContext,
    type TableRowContextType,
} from '@/types/table';
import Typography from '@/Components/Elements/Typography.vue';

const props = withDefaults(defineProps<ColumnProps>(), { colspan: 1 });

const slots = useSlots();

const tableContext = inject<TableContextType>(TableContext);
const tableRowContext = inject<TableRowContextType>(TableRowContext);

const rowData = computed(() => tableRowContext?.data?.value.row ?? {});
const columnValue = computed(() => tableRowContext?.getContent(props.header, props.notation));
const columnGutter = computed(() => tableContext?.getGutter.value);
const columnWidth = computed(() => tableContext?.getColSpan(props.colspan));
</script>

<template>
    <div :class="[columnGutter, columnWidth]">
        <Typography variant="body2">
            <slot v-if="slots.default" :data="rowData" />
            <span v-else>{{ columnValue }}</span>
        </Typography>
    </div>
</template>
