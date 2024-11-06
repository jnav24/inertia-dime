<script setup lang="ts">
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AuthenticatedContentLayout from '@/Layouts/AuthenticatedContentLayout.vue';
import FormButton from '@/Components/Fields/FormButton.vue';
import Plus from '@/Components/Icons/outline/Plus.vue';
import PencilSquare from '@/Components/Icons/outline/PencilSquare.vue';
import Table from '@/Components/table/Table.vue';
import FormSelect from '@/Components/Fields/FormSelect.vue';
import Typography from '@/Components/Elements/Typography.vue';
import TrendUp from '@/Components/Icons/outline/TrendUp.vue';
import TrendDown from '@/Components/Icons/outline/TrendDown.vue';
import CreateBudgetModal from '@/Components/modals/CreateBudgetModal.vue';
import ColumnActions from '@/Components/table/ColumnActions.vue';
import AppLink from '@/Components/Elements/AppLink.vue';
import { Budget, BudgetAggregation } from '@/types/budget';
import { PageProps } from '@/types/providers';

type Props = PageProps & {
    aggregations: BudgetAggregation;
    budgets: { data: Budget[] };
};

defineProps<Props>();

const showModal = ref(false);
const selectedYear = ref('2024');

const handleColumnEvent = (e: { type: string; obj: any }) => {
    switch (e.type) {
        case 'edit':
            console.log('redirect to edit budget', e);
            break;
        case 'delete':
            console.log('open delete confirm', e);
            break;
    }
};
</script>

<template>
    <Head title="Budgets" />

    <AuthenticatedLayout>
        <CreateBudgetModal :aggregations="aggregations" v-model:show="showModal" />

        <template #header> Budgets </template>
        <template #call-to-action>
            <AppLink :href="route('budget.template.index')" as="button">
                <span class="flex flex-row items-center justify-center space-x-2">
                    <PencilSquare classes="w-4" />
                    <span>Edit Template</span>
                </span>
            </AppLink>
            <FormButton color="primary" @onclick="showModal = true" :icon="Plus">
                New Budget
            </FormButton>
        </template>

        <AuthenticatedContentLayout>
            <template v-if="budgets.data.length">
                <div class="grid grid-cols-3 gap-4">
                    <div
                        class="flex items-center justify-between rounded-lg border border-lm-stroke bg-lm-secondary px-4 py-8 dark:border-dm-stroke dark:bg-dm-secondary"
                    >
                        <div class="flex items-center space-x-4">
                            <TrendUp classes="size-10 text-primary" />
                            <div>
                                <Typography variant="body1">Best Month</Typography>
                                <Typography variant="caption">January</Typography>
                            </div>
                        </div>
                        <Typography tag="p" variant="h1">$2,000</Typography>
                    </div>
                    <div
                        class="flex items-center justify-between rounded-lg border border-lm-stroke bg-lm-secondary px-4 py-8 dark:border-dm-stroke dark:bg-dm-secondary"
                    >
                        <div class="flex items-center space-x-4">
                            <TrendDown classes="size-10 text-danger" />
                            <div>
                                <Typography variant="body1">Worst Month</Typography>
                                <Typography variant="caption">March</Typography>
                            </div>
                        </div>
                        <Typography tag="p" variant="h1">$2,000</Typography>
                    </div>
                </div>

                <div class="my-8 w-36">
                    <FormSelect
                        label="Select Year"
                        :items="[{ label: '2024', value: '2024' }]"
                        v-model:value="selectedYear"
                    />
                </div>
            </template>

            <Table
                :columns="[
                    { content: 'name', label: '', colspan: 2 },
                    { content: 'name', label: 'Name', colspan: 3 },
                    { content: 'name', label: 'Saved', colspan: 3 },
                    {
                        content: { component: ColumnActions, props: (obj: Budget) => ({ obj }) },
                        label: 'Actions',
                        colspan: 1,
                    },
                ]"
                :empty="{
                    title: 'No Budgets Found',
                    content: 'Click on the `New Budget` button, above, to add a budget.',
                }"
                :items="budgets.data"
                :paginate="{ current: 1, options: [12], selected: 12 }"
                @column-event="handleColumnEvent($event)"
            />
        </AuthenticatedContentLayout>
    </AuthenticatedLayout>
</template>
