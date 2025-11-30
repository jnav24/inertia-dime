<script setup lang="ts">
import { inject, ref, watch } from 'vue';
import Typography from '@/Components/Elements/Typography.vue';
import FormButton from '@/Components/Fields/FormButton.vue';
import Plus from '@/Components/Icons/outline/Plus.vue';
import ExpenseModal from '@/Components/modals/ExpenseModal.vue';
import { NotificationContext, NotificationContextType, PageProps } from '@/types/providers';
import ConfirmModal from '@/Components/modals/ConfirmModal.vue';
import { ErrorBag, Errors } from '@inertiajs/inertia';
import Table from '@/Components/table/Table.vue';
import ColumnBasic from '@/Components/table/ColumnBasic.vue';
import ColumnBadge from '@/Components/table/ColumnBadge.vue';
import { ColumnBadgeColor } from '@/types/table';
import ColumnActions from '@/Components/table/ColumnActions.vue';

type Props = Partial<PageProps> & {
    notify?: string;
    data: any[];
};

const props = withDefaults(defineProps<Props>(), { notify: undefined });

const notificationContext = inject<NotificationContextType>(NotificationContext);

const toBeDeleted = ref<null | string>(null);
const showModal = ref(false);
const formData = ref(undefined);

const handleColumnEvent = (e: { type: string; obj: any }) => {
    switch (e.type) {
        case 'edit':
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

    <Table :items="data">
        <ColumnBasic header="Year" />
        <ColumnBasic header="Color" />
        <ColumnBasic header="Make" searchable />
        <ColumnBasic header="Model" searchable />
        <ColumnBasic header="License" />
        <ColumnBadge
            :color="(d) => (d.is_active ? ColumnBadgeColor.SUCCESS : ColumnBadgeColor.DANGER)"
            header="Status"
        >
            <template v-slot:default="{ data }">
                {{ data.is_active ? 'Active' : 'Inactive' }}
            </template>
        </ColumnBadge>
        <ColumnActions @action-event="handleColumnEvent" hide="is_active" header="" />
    </Table>
</template>
