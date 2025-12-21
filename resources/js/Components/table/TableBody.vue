<script setup lang="ts">
import { computed, inject, type Slots, useSlots, type VNode, watchEffect } from 'vue';
import { TableContext, type TableContextType } from '@/types/table';
import FormCheckbox from '@/Components/Fields/FormCheckbox.vue';
import { randomString } from '@/types/helpers';

const tableContext = inject<TableContextType>(TableContext);

const slots = useSlots();

watchEffect(() => {
    if (slots.default) {
        const slot = slots.default()[0] as unknown as VNode;
        const children = ((slot.children as Slots)?.default?.()?.[0]?.children ??
            []) as unknown as VNode[];

        tableContext?.resetHeaders();

        (children as unknown as VNode[]).map((child, index) => {
            if (child?.props && typeof child?.type === 'object') {
                const label = child.props.header ?? '';
                const id = label ? label.toLowerCase().replace(/\s+/g, '_') : randomString(12);

                if (
                    child?.props?.hasOwnProperty('searchable') &&
                    child?.props.searchable !== false
                ) {
                    const item = child?.props.notation ?? child?.props.header?.toLowerCase();
                    tableContext?.setSearchable(item);
                }

                tableContext?.setHeaders({
                    [id]: {
                        colspan: Number(child?.props?.colspan ?? 1),
                        label,
                    },
                });
            }
        });
    }
});

const items = computed(() => tableContext?.data.value ?? []);
</script>

<template>
    <div
        v-for="(row, idx) in items"
        :key="row?.id ?? idx"
        :class="[
            idx === (items.length ?? 0) - 1 ? 'border-0' : 'border-b',
            `flex flex-row items-center space-x-4 border-lm-stroke px-4 py-6 shadow-sm dark:border-dm-stroke`,
            'bg-lm-secondary hover:bg-gray-100 dark:bg-dm-secondary dark:hover:bg-dm-primary/25',
        ]"
        class="justify-between"
    >
        <FormCheckbox
            v-if="tableContext?.selectable"
            :is-checked="
                tableContext.allChecked.value ||
                tableContext.checkedItems.value.includes(row?.id ?? idx)
            "
            @handleUpdate="tableContext.toggleCheckedItem($event, row?.id ?? idx)"
            label=""
        />
        <div class="flex grow flex-row items-center justify-between">
            <slot :row="row" />
        </div>
    </div>
</template>
