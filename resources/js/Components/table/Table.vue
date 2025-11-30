<script setup lang="ts" generic="T extends Object">
import { computed, type ConcreteComponent, provide, ref } from 'vue';
import { type TableColumn, TableContext, type TableContextType } from '@/types/table';
import TablePagination from '@/components/table/TablePagination.vue';
import TableHeaders from '@/components/table/TableHeaders.vue';
import TableBody from '@/components/table/TableBody.vue';
import { Optional } from '@/types';
import TableRow from '@/components/table/TableRow.vue';
import TableOptions from '@/components/table/TableOptions.vue';
import TableEmpty from '@/Components/table/TableEmpty.vue';

interface EmptyTable {
    button?: {
        label: string;
        icon?: ConcreteComponent;
    };
    content?: string;
    title?: string;
}

interface Props<T> {
    emptyResults?: EmptyTable;
    emptyState?: EmptyTable;
    gutter?: number;
    items: T[];
    paginatePerPage?: number[];
    perPage?: number;
    selectable?: boolean;
    variant?: 'full' | 'short' | 'numeric';
}

const props = withDefaults(defineProps<Props<T>>(), {
    gutter: 3,
    paginatePerPage: () => [10, 25, 50],
    selectable: false,
    variant: 'short',
});

const allChecked = ref(false);
const checkedItems = ref<(string | number)[]>([]);
const currentPage = ref(1);
const headers = ref<Record<string, TableColumn>>({});
const searchable = ref({});
const searchKey = ref('');
const selectedPaginatePerPage = ref(props.perPage ?? props.paginatePerPage?.[0] ?? null);

const filteredItems = computed(() => {
    const searchableKeys = Object.keys(searchable.value);

    if (searchKey.value && searchableKeys.length) {
        return props.items.filter((item) => {
            return searchableKeys.some((key) => {
                const value = parseObjectValue(key, item);
                return (
                    typeof value === 'string' &&
                    (value as string).toLowerCase().includes(searchKey.value.toLowerCase())
                );
            });
        });
    }

    return props.items;
});

const getGutter = computed(() => `pr-${props.gutter}`);

const paginateItems = computed(() =>
    filteredItems.value.slice(
        (currentPage.value - 1) * selectedPaginatePerPage.value,
        currentPage.value * selectedPaginatePerPage.value,
    ),
);

const getHeaders = computed<TableColumn[]>(() => Object.values(headers.value));

const hasSearchableItems = computed(() => Object.keys(searchable.value).length > 0);

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

const parseObjectValue = (value: string, obj: Record<string, any>) => {
    return value.split('.').reduce((result, current) => {
        return result[current] ?? '';
    }, obj);
};

const resetHeaders = () => (headers.value = {});

const setAllChecked = (v: boolean) => (allChecked.value = v);

const setHeaders = (header: Record<string, Optional<TableColumn, 'width'>>) => {
    const [id, data] = Object.entries(header)[0];
    headers.value = { ...headers.value, [id]: { ...data, width: getColSpan(data.colspan) } };
};

const setSearchable = (notation: string) => {
    searchable.value = { ...searchable.value, [notation]: true };
};

const toggleCheckedItem = (checked: boolean, id: number | string) => {
    checkedItems.value = checked
        ? [...checkedItems.value, id]
        : checkedItems.value.filter((i) => i !== id);
};

const updatePage = (page: number) => (currentPage.value = page);

const updateSelectedPaginatePerPage = (selected: number) =>
    (selectedPaginatePerPage.value = selected);

provide<TableContextType>(TableContext, {
    allChecked,
    checkedItems,
    data: paginateItems,
    getColSpan,
    getHeaders,
    getGutter,
    hasSearchableItems,
    resetHeaders,
    searchKey,
    selectable: props.selectable,
    setAllChecked,
    setHeaders,
    setSearchable,
    toggleCheckedItem,
    updatePage,
    updateSelectedPaginatePerPage,
});
</script>

<template>
    <div v-if="!items.length">
        <slot v-if="$slots['empty-state']" name="empty-state" />
        <TableEmpty
            v-else
            :button="emptyState?.button"
            :title="emptyState?.title"
            :content="emptyState?.content"
        />
    </div>

    <div
        v-else
        class="rounded-xl border border-lm-stroke bg-lm-secondary dark:border-dm-stroke dark:bg-dm-secondary"
    >
        <TableOptions />

        <template v-if="!filteredItems.length">
            <slot v-if="$slots['empty-results']" name="empty-results" />
            <TableEmpty
                v-else
                :button="emptyResults?.button"
                :title="emptyResults?.title"
                :content="emptyResults?.content"
            />
        </template>
        <template v-else>
            <TableHeaders />

            <TableBody>
                <template v-slot="slots">
                    <TableRow :data="slots">
                        <slot />
                    </TableRow>
                </template>
            </TableBody>

            <TablePagination
                :options="paginatePerPage"
                :page="currentPage"
                v-model:selected="selectedPaginatePerPage"
                :total="filteredItems.length"
                :variant="variant"
            />
        </template>
    </div>
</template>
