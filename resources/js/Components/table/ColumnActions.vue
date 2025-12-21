<script setup lang="ts">
import { computed, inject } from 'vue';
import FormButton from '@/Components/Fields/FormButton.vue';
import Pencil from '@/Components/Icons/outline/Pencil.vue';
import Trash from '@/Components/Icons/outline/Trash.vue';
import {
    type ColumnProps,
    TableContext,
    type TableContextType,
    TableRowContext,
    type TableRowContextType,
} from '@/types/table';

interface Props extends ColumnProps {
    hide?: string | ((obj: Record<string, any>) => boolean);
}

defineEmits<{ (e: 'action-event', v: { type: string; obj: Record<string, any> }): void }>();
const props = withDefaults(defineProps<Props>(), { colspan: 1 });

const tableContext = inject<TableContextType>(TableContext);
const tableRowContext = inject<TableRowContextType>(TableRowContext);

const rowData = computed(() => tableRowContext?.data?.value.row ?? {});

const columnWidth = computed(() => tableContext?.getColSpan(props.colspan));

const showActions = computed(() => {
    switch (typeof props.hide) {
        case 'function':
            return props.hide(rowData);
        case 'string':
            return Boolean(tableRowContext?.getContent(props.hide));
    }

    return true;
});
</script>

<template>
    <div class="flex space-x-2" :class="columnWidth">
        <template v-if="showActions">
            <FormButton
                :icon="Pencil"
                fab
                @click="$emit('action-event', { type: 'edit', obj: rowData })"
            ></FormButton>
            <FormButton
                :icon="Trash"
                fab
                @click="$emit('action-event', { type: 'delete', obj: rowData })"
            ></FormButton>
        </template>
    </div>
</template>
