<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AuthenticatedContentLayout from '@/Layouts/AuthenticatedContentLayout.vue';
import { Head } from '@inertiajs/vue3';
import FormButton from '@/Components/Fields/FormButton.vue';
import Plus from '@/Components/Icons/outline/Plus.vue';
import PencilSquare from '@/Components/Icons/outline/PencilSquare.vue';
import Table from '@/Components/table/Table.vue';
import FormSelect from '@/Components/Fields/FormSelect.vue';
import Typography from '@/Components/Elements/Typography.vue';
import TrendUp from '@/Components/Icons/outline/TrendUp.vue';
import TrendDown from '@/Components/Icons/outline/TrendDown.vue';

defineProps<{ budgets: any[] }>();

const redirectToTemplatePage = () => {
    console.log('redirecting...');
};

const createBudget = () => {
    console.log('creating budget....');
};
</script>

<template>
    <Head title="Budgets" />

    <AuthenticatedLayout>
        <template #header> Budgets </template>
        <template #call-to-action>
            <FormButton @onclick="redirectToTemplatePage()" :icon="PencilSquare">
                Edit Template
            </FormButton>
            <FormButton color="primary" @onclick="createBudget()" :icon="Plus">
                New Budget
            </FormButton>
        </template>

        <AuthenticatedContentLayout>
            <template v-if="budgets.length">
                <div class="grid grid-cols-3 gap-4">
                    <div
                        class="border-lm-stroke bg-lm-secondary dark:border-dm-stroke flex items-center justify-between rounded-lg border px-4 py-8 dark:bg-dm-secondary"
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
                        class="border-lm-stroke bg-lm-secondary dark:border-dm-stroke flex items-center justify-between rounded-lg border px-4 py-8 dark:bg-dm-secondary"
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
                        :items="[{ label: '2024', value: 2024 }]"
                        value="2024"
                    />
                </div>
            </template>

            <Table
                :columns="[
                    { content: 'name', label: 'Name', colspan: 3 },
                    { content: 'name', label: 'Saved', colspan: 3 },
                    { content: 'budget_cycle', label: 'Title', colspan: 2 },
                    { content: 'budget_cycle', label: 'Actions', colspan: 2 },
                ]"
                :empty="{
                    title: 'No Budgets Found',
                    content: 'Click on the `New Budget` button, above, to add a budget.',
                }"
                :items="budgets"
                :paginate="{ current: 1, options: [12], selected: 12 }"
            />
        </AuthenticatedContentLayout>
    </AuthenticatedLayout>
</template>
