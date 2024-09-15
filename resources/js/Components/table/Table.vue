<script setup lang="ts">
import { computed, reactive, ref, watchEffect } from 'vue';
import TableEmpty, { Props as TableEmptyProps } from '@/Components/table/TableEmpty.vue';
import FormCheckbox from '@/Components/Fields/FormCheckbox.vue';
import TableRow from '@/Components/table/TableRow.vue';
import TablePagination from '@/Components/table/TablePagination.vue';
import Typography from '@/Components/Elements/Typography.vue';
import { parseNested } from '@/utils/functions';

type Column<T> = {
    content: string | ((item: T) => ReactNode); // @todo
    label: string;
    searchable?: boolean;
    colspan?: number;
    sortable?: boolean;
};

type Emits = {
    (e: 'on-action', v: { type: 'delete'; ids: string[] }): void;
};

type Props<T> = {
    columns: Column<T>[];
    items: T[];
    paginate?: { current: number; options: number[]; selected: number };
    selectable?: boolean;
    title?: string;
    empty?: TableEmptyProps;
};

defineEmits<Emits>();
const props = withDefaults(defineProps<Props>(), {
    paginate: { current: 1, options: [10, 25, 50], selected: 10 },
});

const allChecked = ref(false);
const checkedItems = ref<string[]>([]);
const paginateState = reactive({ ...props.paginate });

watchEffect(() => {
    if (allChecked.value) {
        checkedItems.value = [];
    }
});

const hasData = computed(() => !!(props.columns.length && props.items.length));
const paginateItems = computed(() =>
    props.items.slice(
        (paginateState.current - 1) * paginateState.selected,
        paginateState.current * paginateState.selected,
    ),
);

const getColSpan = (col?: number) => {
    const widthClasses = {
        '1': 'w-1/12',
        '2': 'w-2/12',
        '3': 'w-3/12',
        '4': 'w-4/12',
        '5': 'w-5/12',
        '6': 'w-6/12',
        '7': 'w-7/12',
        '8': 'w-8/12',
        '9': 'w-9/12',
        '10': 'w-10/12',
        '11': 'w-11/12',
        '12': 'w-full',
    };
    const idx = `${col || 1}` as keyof typeof widthClasses;
    return widthClasses[idx] || 'w-full';
};
</script>

<template>
    <TableEmpty v-if="!hasData" v-bind="empty" />

    <div
        class="border-lm-stroke bg-lm-secondary dark:border-dm-stroke rounded-xl border dark:bg-dm-secondary"
        v-else
    >
        <div
            class="border-lm-stroke text-lm-text-hover dark:border-dm-stroke dark:text-dm-text-hover flex flex-row items-center justify-between space-x-4 border-b px-4 py-4"
        >
            <FormCheckbox
                :defaultChecked="allChecked"
                @handleUpdate="allChecked.value = $event"
                label=""
                v-if="selectable"
            />

            <template v-for="(column, index) in columns" :key="index">
                {{ column.sortable }}
                <div :class="getColSpan(column.colspan)">{{ column.label }}</div>
            </template>
        </div>

        <TableRow
            v-for="(item, index) in paginateItems"
            :key="(item as T & { id: string }).id ?? index"
            class="contact-row justify-between"
        >
            <FormCheckbox
                v-if="selectable"
                :defaultChecked="
                    allChecked || checkedItems.includes((item as T & { id: string }).id ?? index)
                "
                @handleUpdate="toggleCheckedItem((item as T & { id: string })?.id ?? index)"
                label=""
            />
            <div :class="getColSpan(column.colspan)" v-for="(column, int) in columns" :key="int">
                <template v-if="typeof column.content === 'string'">
                    <Typography variant="body1">{{ parseNested(item, column.content) }}</Typography>
                </template>
                <template v-else> pizza </template>
            </div>
        </TableRow>

        <TablePagination
            :options="paginateState.options"
            :page="paginateState.current"
            :selected="paginateState.selected"
            :total="items.length"
            @pageChange="paginateState.current = $event"
            @selection="paginateState.selected = $event"
        />
    </div>
</template>
