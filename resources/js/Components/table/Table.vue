<script setup lang="ts">
import { computed, reactive, ref, watchEffect } from 'vue';
import TableEmpty, { Props as TableEmptyProps } from '@/Components/table/TableEmpty.vue';
import FormCheckbox from '@/Components/Fields/FormCheckbox.vue';
import TableRow from '@/Components/table/TableRow.vue';
import TablePagination from '@/Components/table/TablePagination.vue';
import { parseNested } from '@/utils/functions';
import ColumnBasic from '@/Components/table/ColumnBasic.vue';
import { Column } from '@/types/table';

type Emits<T> = {
    (e: 'on-action', v: { type: 'delete'; ids: string[] }): void;
    (e: 'column-event', v: { type: string; obj: T }): void;
};

type Props<T> = {
    columns: Column<T>[];
    items: T[];
    paginate?: { current: number; options: number[]; selected: number };
    selectable?: boolean;
    title?: string;
    empty?: TableEmptyProps;
};

defineEmits<Emits<any>>();
const props = defineProps<Props<any>>();

const allChecked = ref(false);
const checkedItems = ref<string[]>([]);
const paginateState = reactive({
    current: props.paginate?.current ?? 1,
    options: props.paginate?.options ?? [10, 25, 50],
    selected: props.paginate?.selected ?? 10,
});

watchEffect(() => {
    if (allChecked.value) {
        checkedItems.value = [];
    }
});

const hasData = computed(() => !!(props.columns?.length && props.items?.length));
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

const setAllChecked = (v: boolean) => (allChecked.value = v);

const toggleCheckedItem = (v: number) => {
    // @todo
};
</script>

<template>
    <TableEmpty v-if="!hasData" v-bind="empty" />

    <div
        class="rounded-xl border border-lm-stroke bg-lm-secondary dark:border-dm-stroke dark:bg-dm-secondary"
        v-else
    >
        <div
            class="flex flex-row items-center justify-between space-x-4 border-b border-lm-stroke px-4 py-4 text-lm-text-hover dark:border-dm-stroke dark:text-dm-text-hover"
        >
            <FormCheckbox
                :defaultChecked="allChecked"
                @handleUpdate="setAllChecked($event)"
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
            :key="item?.id ?? index"
            class="contact-row justify-between"
        >
            <FormCheckbox
                v-if="selectable"
                :defaultChecked="allChecked || checkedItems.includes(item?.id ?? index)"
                @handleUpdate="toggleCheckedItem(item?.id ?? index)"
                label=""
            />
            <div :class="getColSpan(column.colspan)" v-for="(column, int) in columns" :key="int">
                <template v-if="typeof column.content === 'string'">
                    <ColumnBasic :value="parseNested(item, column.content)" />
                </template>
                <template v-else>
                    <component
                        :is="column.content.component"
                        v-bind="column.content.props(item)"
                        @action-event="$emit('column-event', $event)"
                    />
                </template>
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
