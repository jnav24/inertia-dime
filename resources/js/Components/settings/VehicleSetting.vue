<script setup lang="ts">
import { inject, ref, watch } from 'vue';
import Typography from '@/Components/Elements/Typography.vue';
import Table from '@/Components/table/Table.vue';
import FormButton from '@/Components/Fields/FormButton.vue';
import Plus from '@/Components/Icons/outline/Plus.vue';
import ExpenseModal from '@/Components/modals/ExpenseModal.vue';
import ColumnActions from '@/Components/table/ColumnActions.vue';
import ColumnBadge from '@/Components/table/ColumnBadge.vue';
import type { ColumnBadgeProps } from '@/types/table';
import { NotificationContext, NotificationContextType, PageProps } from '@/types/providers';
import ConfirmModal from '@/Components/modals/ConfirmModal.vue';
import { Column, ColumnComponent } from '@/types/table';
import { UserVehicle } from '@/types/expenses';
import { ErrorBag, Errors } from '@inertiajs/inertia';

type Props = Partial<PageProps> & {
    notify?: string;
    data: any[];
};

const props = withDefaults(defineProps<Props>(), { notify: undefined });

const columns: Column<UserVehicle>[] = [
    { content: 'year', label: 'Year', colspan: 1 },
    { content: 'color', label: 'Color' },
    { content: 'make', label: 'Make' },
    { content: 'model', label: 'Model' },
    { content: 'license', label: 'License' },
    {
        content: {
            component: ColumnBadge as ColumnComponent<UserVehicle>,
            props: (obj) =>
                ({
                    value: obj.is_active ? 'Active' : 'Inactive',
                    color: obj.is_active ? 'success' : 'danger',
                }) as ColumnBadgeProps,
        },
        label: 'Status',
    },
    {
        content: {
            component: ColumnActions as ColumnComponent<UserVehicle>,
            props: (obj) => ({ obj, hideActions: !obj.is_active }),
        },
        label: '',
        colspan: 1,
    },
];

const notificationContext = inject<NotificationContextType>(NotificationContext);

const toBeDeleted = ref<null | string>(null);
const showModal = ref(false);
const formData = ref(undefined);

const handleColumnEvent = (e: { type: string; obj: any }) => {
    switch (e.type) {
        case 'edit':
            console.log('e', e);
            formData.value = e.obj;
            showModal.value = true;
            break;
        case 'delete':
            toBeDeleted.value = e.obj.id;
            break;
    }
};

watch(
    () => props.notify,
    (v) => {
        if (v) {
            notificationContext?.addNotification({
                title: 'Success',
                message: v,
                type: 'success',
            });
        }
    },
);
</script>

<template>
    <ExpenseModal
        v-model:show="showModal"
        expense="user vehicles"
        :errors="errors as Errors & ErrorBag"
        :form-data="formData"
        :types="[]"
    />
    <ConfirmModal :id="toBeDeleted" expense="user vehicles" @close-modal="toBeDeleted = null" />

    <div class="mb-6 flex justify-between">
        <div>
            <Typography variant="h3">Vehicles</Typography>
            <Typography variant="caption">Add your vehicles here.</Typography>
        </div>

        <FormButton color="primary" :icon="Plus" @onclick="showModal = true">
            Add Vehicle
        </FormButton>
    </div>

    <Table
        :columns="columns"
        :items="data"
        :empty="{ title: 'No Vehicles Found' }"
        @column-event="handleColumnEvent($event)"
    />
</template>
