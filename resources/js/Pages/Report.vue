<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AuthenticatedContentLayout from '@/Layouts/AuthenticatedContentLayout.vue';
import { Head } from '@inertiajs/vue3';
import Card from '@/Components/Elements/Card.vue';
import BudgetForm from '@/Components/Fields/BudgetForm.vue';
import FormInput from '@/Components/Fields/FormInput.vue';
import FormSelect from '@/Components/Fields/FormSelect.vue';
import FormButton from '@/Components/Fields/FormButton.vue';
import LineChart from '@/Components/Charts/LineChart.vue';
import Table from '@/Components/table/Table.vue';
import { PageProps } from '@/types/providers';
import { computed, onMounted, reactive } from 'vue';
import { toTitleCase } from '@/utils/functions';
import Typography from '@/Components/Elements/Typography.vue';
import ArrowUp from '@/Components/Icons/outline/ArrowUp.vue';

type Props = PageProps & {
    aggregations: { label: string; value: string }[];
    results: any;
    types: any;
};

const props = defineProps<Props>();

const expenseTypes = computed(() => {
    return Object.keys(props.types).map((item) => ({ label: toTitleCase(item), value: item }));
});

const form = reactive({
    expense: '',
    type: '',
    year: new Date().getFullYear().toString(),
});

onMounted(() => {});
</script>

<template>
    <Head title="Reports" />

    <AuthenticatedLayout>
        <template #header> Reports </template>

        <AuthenticatedContentLayout>
            <section class="space-y-6">
                <Card>
                    <BudgetForm>
                        <div class="grid grid-cols-5 gap-4">
                            <FormSelect
                                label="Expense"
                                :items="expenseTypes"
                                :value="form.expense"
                                :rules="['required']"
                                @handle-selection="form.expense = `${$event}`"
                            />
                            <FormSelect
                                label="Year"
                                :items="aggregations"
                                :value="form.year"
                                :rules="['required']"
                            />
                            <FormSelect
                                label="Type"
                                :items="types[form.expense]?.data ?? []"
                                item-label="name"
                                item-value="id"
                                :value="form.type"
                            />
                            <FormInput label="Keywords" value="" />
                            <div class="pt-8">
                                <FormButton block color="primary" submit>Search</FormButton>
                            </div>
                        </div>
                    </BudgetForm>
                </Card>

                <Card>
                    <div class="pb-8">
                        <Typography variant="caption">YTD Gain/Loss</Typography>
                        <div class="flex items-center space-x-2">
                            <Typography variant="h1">$100,000.00</Typography>
                            <div
                                class="flex items-center space-x-1 rounded-lg bg-primary/25 px-2 py-1"
                            >
                                <ArrowUp classes="text-primary size-4" />
                                <Typography variant="caption">
                                    <span class="text-primary">25%</span>
                                </Typography>
                            </div>
                        </div>
                    </div>
                    <LineChart :labels="[]" :data="[]" />
                    <div class="grid grid-cols-5 divide-x pt-8">
                        <div class="pl-4">
                            <Typography variant="caption">Starting Balance</Typography>
                            <Typography variant="body1">$100,000.00</Typography>
                        </div>
                        <div class="pl-4">
                            <Typography variant="caption">Ending Balance</Typography>
                            <Typography variant="body1">$100,000.00</Typography>
                        </div>
                        <div class="pl-4">
                            <Typography variant="caption">Average Per Month</Typography>
                            <Typography variant="body1">$100,000.00</Typography>
                        </div>
                        <div class="pl-4">
                            <Typography variant="caption">Lowest Month</Typography>
                            <Typography variant="body1">$100,000.00</Typography>
                        </div>
                        <div class="pl-4">
                            <Typography variant="caption">Highest Month</Typography>
                            <Typography variant="body1">$100,000.00</Typography>
                        </div>
                    </div>
                </Card>

                <ul class="hidden">
                    <li>highest month</li>
                    <li>lowest month</li>
                    <li>average per month</li>
                    <li>total</li>
                    <li>starting balance</li>
                    <li>ending balance</li>
                </ul>

                <Table
                    :columns="[]"
                    :items="[]"
                    :empty="{ title: 'Some Title', content: 'Some content goes here' }"
                />
            </section>
        </AuthenticatedContentLayout>
    </AuthenticatedLayout>
</template>
