<script setup lang="ts">
import { computed, ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AuthenticatedContentLayout from '@/Layouts/AuthenticatedContentLayout.vue';
import FormButton from '@/Components/Fields/FormButton.vue';
import Plus from '@/Components/Icons/outline/Plus.vue';
import PencilSquare from '@/Components/Icons/outline/PencilSquare.vue';
import Fire from '@/Components/Icons/outline/Fire.vue';
import FormSelect from '@/Components/Fields/FormSelect.vue';
import Typography from '@/Components/Elements/Typography.vue';
import TrendUp from '@/Components/Icons/outline/TrendUp.vue';
import TrendDown from '@/Components/Icons/outline/TrendDown.vue';
import CreateBudgetModal from '@/Components/modals/CreateBudgetModal.vue';
import AppLink from '@/Components/Elements/AppLink.vue';
import { Budget, SortedAggregation, BudgetAggregationEnum, SortedBudget } from '@/types/budget';
import { PageProps } from '@/types/providers';
import { formatTimeZone } from '@/utils/timestamp';
import { convertToCurrency } from '@/utils/functions';
import Table from '@/Components/table/Table.vue';
import ColumnActions from '@/Components/table/ColumnActions.vue';
import ColumnBasic from '@/Components/table/ColumnBasic.vue';

type Props = PageProps & {
    aggregations: SortedAggregation;
    budgets: SortedBudget;
};

const props = defineProps<Props>();

const showModal = ref(false);
const selectedYear = ref(new Date().getFullYear().toString());

const allYears = computed(() => {
    const years = Object.keys(props.aggregations);

    if (
        !props.aggregations[selectedYear.value] ||
        !props.aggregations[new Date().getFullYear().toString()]
    ) {
        years.push(new Date().getFullYear().toString());
    }

    return years
        .sort((a: string, b: string) => +b - +a)
        .map((year) => ({ label: year, value: year }));
});

const highestSaved = computed(() => {
    if (!props.aggregations[selectedYear.value]) {
        return 0;
    }

    const savedList = Object.values(props.aggregations[selectedYear.value]).map(
        (obj) => obj.data[BudgetAggregationEnum.SAVED],
    );

    return Math.max(...savedList);
});

const selectedBudgets = computed(() => {
    if (!props.budgets[selectedYear.value]) {
        return [];
    }

    return props.budgets[selectedYear.value].map((budget) => budget.data);
});

const handleColumnEvent = (e: { type: string; obj: any }) => {
    switch (e.type) {
        case 'edit':
            Inertia.visit(route('budget.show', { uuid: e.obj.id }));
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
            <template v-if="selectedBudgets.length">
                <div class="mb-8 grid grid-cols-3 gap-4">
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
            </template>

            <div class="mb-8 w-36">
                <FormSelect label="Select Year" :items="allYears" v-model:value="selectedYear" />
            </div>

            <Table :items="selectedBudgets" :paginatePerPage="[12]">
                <ColumnBasic header="">
                    <template v-slot:default="{ data }">
                        <div class="flex">
                            <TrendDown
                                v-if="data.aggregation.data[BudgetAggregationEnum.SAVED] < 0"
                                classes="text-danger size-8"
                            />
                            <TrendUp v-else classes="text-success size-8" />
                            <Fire
                                v-if="
                                    data.aggregation.data[BudgetAggregationEnum.SAVED] ===
                                    highestSaved
                                "
                                classes="text-orange-500 size-8"
                            />
                        </div>
                    </template>
                </ColumnBasic>
                <ColumnBasic :colspan="3" header="Name">
                    <template v-slot:default="{ data }">
                        {{ formatTimeZone('MMMM', 'UTC', data.budget_cycle) }}
                    </template>
                </ColumnBasic>
                <ColumnBasic :colspan="3" header="Saved">
                    <template v-slot:default="{ data }">
                        {{
                            convertToCurrency(
                                data.aggregation.data[BudgetAggregationEnum.SAVED] ?? 0,
                            )
                        }}
                    </template>
                </ColumnBasic>
                <ColumnActions @action-event="handleColumnEvent" header="Actions" />
            </Table>
        </AuthenticatedContentLayout>
    </AuthenticatedLayout>
</template>
