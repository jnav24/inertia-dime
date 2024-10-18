<script setup lang="ts">
import { ref } from 'vue';
import Typography from '@/Components/Elements/Typography.vue';
import Table from '@/Components/table/Table.vue';
import FormButton from '@/Components/Fields/FormButton.vue';
import Plus from '@/Components/Icons/outline/Plus.vue';
import ExpenseModal from '@/Components/modals/ExpenseModal.vue';
import ColumnActions from '@/Components/table/ColumnActions.vue';
import ColumnBadge from '@/Components/table/ColumnBadge.vue';
import { ColumnBadgeProps } from '@/utils/helpers';

type Props = {
    vehicles: any[];
};

defineProps<Props>();

const columns = [
    { content: 'year', label: 'Year', colspan: 1 },
    { content: 'color', label: 'Color' },
    { content: 'make', label: 'Make' },
    { content: 'model', label: 'Model' },
    { content: 'license', label: 'License' },
    {
        content: {
            component: ColumnBadge,
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
            component: ColumnActions,
            props: (obj) => ({ obj }),
        },
        label: '',
        colspan: 1,
    },
];

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
            console.log('open delete confirm');
            break;
    }
};
</script>

<template>
    <ExpenseModal
        v-model:show="showModal"
        expense="user vehicles"
        :form-data="formData"
        :types="[]"
    />

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
        :items="vehicles"
        :empty="{ title: 'No Vehicles Found' }"
        @column-event="handleColumnEvent($event)"
    />
</template>
