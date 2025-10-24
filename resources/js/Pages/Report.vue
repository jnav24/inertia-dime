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
import { computed, onUpdated, reactive, ref } from 'vue';
import { convertToCurrency, toTitleCase, ucFirst } from '@/utils/functions';
import Typography from '@/Components/Elements/Typography.vue';
import ArrowUp from '@/Components/Icons/outline/ArrowUp.vue';
import { ChartDatasetCustomTypesPerDataset } from 'chart.js/auto';
import ArrowDown from '@/Components/Icons/outline/ArrowDown.vue';
import { formatTimeZone } from '@/utils/timestamp';
import ColumnBasic from '@/Components/table/ColumnBasic.vue';
import { Column, ColumnComponent } from '@/types/table';
import { Expenses, ExpenseType } from '@/types/expenses';

type ExpenseData = {
    amount: number;
    name: string;
};

type Report = {
    id: string;
    budget_cycle: string;
    data: ExpenseData;
};

type ExpenseForm = {
    expense: keyof Expenses;
    type: string;
    year: string;
};

type Props = PageProps & {
    aggregations: { label: string; value: string }[];
    results: Record<string, Array<Report>>;
    types: Record<keyof Expenses, Record<'data', Array<ExpenseType>>>;
};

const props = defineProps<Props>();

const getTotal = (data: Report[]) =>
    data.reduce((result, current) => result + current.data.amount, 0);

const expenseTypes = computed(() => {
    return Object.keys(props.types).map((item) => ({ label: toTitleCase(item), value: item }));
});

const reportData = computed(() => Object.values(props.results).flat());

const labels = computed(() => Object.keys(props.results));

const totals = computed(() => labels.value.map((month) => getTotal(props.results?.[month] ?? [])));

const datasets = computed(() => {
    return [
        {
            label: 'Dataset 1',
            data: totals.value,
            borderColor: '#264653',
            backgroundColor: '#389894',
        },
    ] as ChartDatasetCustomTypesPerDataset[];
});

const averageBalance = computed(() => yearTotal.value / totals.value.length ?? 0.0);
const startingBalance = computed(() => totals.value?.[0] ?? 0.0);
const endingBalance = computed(() => totals.value?.[totals.value.length - 1] ?? 0.0);
const lowestBalance = computed(() => Math.min(...totals.value) ?? 0.0);
const highestBalance = computed(() => Math.max(...totals.value) ?? 0.0);
const yearTotal = computed(() => getTotal(reportData.value));
const yearTotalPercentage = computed(() => {
    const percentage = Math.round(
        ((totals.value?.[totals.value?.length - 1] - totals.value?.[0]) / totals.value?.[0]) * 100,
    );
    return isNaN(percentage) ? 0 : percentage;
});

const form = reactive<ExpenseForm>({
    expense: 'banks',
    type: '',
    year: new Date().getFullYear().toString(),
});

const columns = ref<Column<Report>[]>([]);

const setColumns = () => {
    columns.value = [
        {
            label: 'Name',
            content: 'data.name',
            colspan: 4,
            searchable: true,
        },
        {
            label: 'Amount',
            content: {
                component: ColumnBasic as ColumnComponent<Report>,
                props: (obj: Report) => ({
                    value: convertToCurrency(obj.data.amount),
                }),
            },
            colspan: 2,
        },
        ...(form.expense === 'incomes'
            ? [
                  {
                      label: 'Pay Date',
                      content: {
                          component: ColumnBasic as ColumnComponent<Report>,
                          props: (obj: Report) => ({
                              value: formatTimeZone(
                                  'MMM dd yyyy',
                                  'UTC',
                                  (obj.data as any).pay_date,
                              ),
                          }),
                      },
                      colspan: 2,
                  },
              ]
            : []),
        ...(!['banks', 'incomes', 'investments'].includes(form.expense)
            ? [
                  {
                      label: 'Paid Date',
                      content: {
                          component: ColumnBasic as ColumnComponent<Report>,
                          props: (obj: Report) => ({
                              value: formatTimeZone(
                                  'MMM dd yyyy',
                                  'UTC',
                                  (obj.data as any).paid_date,
                              ),
                          }),
                      },
                      colspan: 2,
                  },
                  {
                      label: 'Confirmation',
                      content: {
                          component: ColumnBasic as ColumnComponent<Report>,
                          props: (obj: Report) => ({
                              value: (obj.data as any).confirmation,
                          }),
                      },
                      colspan: 2,
                  },
              ]
            : [
                  {
                      label: 'Budget',
                      content: {
                          component: ColumnBasic as ColumnComponent<Report>,
                          props: (obj: Report) => ({
                              value: formatTimeZone('MMM dd yyyy', 'UTC', obj.budget_cycle),
                          }),
                      },
                      colspan: 2,
                  },
              ]),
        // {
        //     label: 'Expense',
        //     content: {
        //         component: ColumnBasic as ColumnComponent<Report>,
        //         props: (_obj: Report) => ({
        //             value: ucFirst(form.expense),
        //         }),
        //     },
        //     colspan: 2,
        // },
        ...(form.type
            ? [
                  {
                      label: 'Type',
                      content: {
                          component: ColumnBasic as ColumnComponent<Report>,
                          props: (_obj: Report) => ({
                              value:
                                  props.types[form.expense]?.data.find((t) => t.id === form.type)
                                      ?.name ?? '',
                          }),
                      },
                      colspan: 2,
                  },
              ]
            : []),
    ];
};

onUpdated(() => {
    setColumns();
});
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
                                @handle-selection="form.expense = `${$event}` as keyof Expenses"
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
                                @handle-selection="form.type = `${$event}`"
                            />
                            <FormInput label="Keywords" value="" />
                            <div class="pt-8">
                                <FormButton block color="primary" submit>Search</FormButton>
                            </div>
                        </div>
                    </BudgetForm>
                </Card>

                <Card v-if="labels.length > 0">
                    <div class="pb-8">
                        <Typography variant="caption">YTD Gain/Loss</Typography>
                        <div class="flex items-center space-x-2">
                            <Typography variant="h1">{{ convertToCurrency(yearTotal) }}</Typography>
                            <div
                                class="flex items-center space-x-1 rounded-lg px-2 py-1"
                                :class="{
                                    'bg-primary/25': yearTotalPercentage >= 0,
                                    'bg-danger/25': yearTotalPercentage < 0,
                                }"
                            >
                                <ArrowUp
                                    v-if="yearTotalPercentage >= 0"
                                    classes="text-primary size-4"
                                />
                                <ArrowDown
                                    v-if="yearTotalPercentage < 0"
                                    classes="text-danger size-4"
                                />
                                <Typography variant="caption">
                                    <span
                                        :class="{
                                            'text-primary': yearTotalPercentage >= 0,
                                            'text-danger': yearTotalPercentage < 0,
                                        }"
                                    >
                                        {{ yearTotalPercentage }}%
                                    </span>
                                </Typography>
                            </div>
                        </div>
                    </div>
                    <LineChart :labels="labels" :data="datasets" hide-legend />
                    <div class="grid grid-cols-5 divide-x pt-8">
                        <div class="pl-4">
                            <Typography variant="caption">Starting Balance</Typography>
                            <Typography variant="body1">{{
                                convertToCurrency(startingBalance)
                            }}</Typography>
                        </div>
                        <div class="pl-4">
                            <Typography variant="caption">Ending Balance</Typography>
                            <Typography variant="body1">{{
                                convertToCurrency(endingBalance)
                            }}</Typography>
                        </div>
                        <div class="pl-4">
                            <Typography variant="caption">Average Per Month</Typography>
                            <Typography variant="body1">{{
                                convertToCurrency(averageBalance)
                            }}</Typography>
                        </div>
                        <div class="pl-4">
                            <Typography variant="caption">Lowest Balance</Typography>
                            <Typography variant="body1">{{
                                convertToCurrency(lowestBalance)
                            }}</Typography>
                        </div>
                        <div class="pl-4">
                            <Typography variant="caption">Highest Balance</Typography>
                            <Typography variant="body1">{{
                                convertToCurrency(highestBalance)
                            }}</Typography>
                        </div>
                    </div>
                </Card>

                <Table :columns="columns as Column<Report>[]" :items="reportData" />
            </section>
        </AuthenticatedContentLayout>
    </AuthenticatedLayout>
</template>
