<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AuthenticatedContentLayout from '@/Layouts/AuthenticatedContentLayout.vue';
import { PageProps } from '@/types/providers';
import { computed, onMounted, ref, watch } from 'vue';
import Sidebar from '@/Components/Elements/Sidebar.vue';
import Plus from '@/Components/Icons/outline/Plus.vue';
import { convertToCurrency, toTitleCase } from '@/utils/functions';
import FormButton from '@/Components/Fields/FormButton.vue';
import { formatTimeZone } from '@/utils/timestamp';
import ExpenseModal from '@/Components/modals/ExpenseModal.vue';
import Typography from '@/Components/Elements/Typography.vue';
import SavedWidget from '@/Components/SavedWidget.vue';
import BudgetSummary from '@/Components/BudgetSummary.vue';
import ConfirmModal from '@/Components/modals/ConfirmModal.vue';
import { ValueOfExpense } from '@/types/expenses';
import BreakdownModal from '@/Components/modals/BreakdownModal.vue';
import Chart from '@/Components/Icons/solid/Chart.vue';
import ColumnActions from '@/Components/table/ColumnActions.vue';
import Table from '@/Components/table/Table.vue';
import ColumnBasic from '@/Components/table/ColumnBasic.vue';
import ColumnBadge from '@/Components/table/ColumnBadge.vue';
import { ColumnBadgeColor } from '@/types/table';
import CheckCircle from '@/Components/Icons/outline/CheckCircle.vue';

type Props = PageProps & {
    budget: any;
    types: any;
    unpaid: any;
    vehicles: any;
};

const props = defineProps<Props>();

const categories = ref<string[]>([]);
const formData = ref(undefined);
const showBreakdown = ref(false);
const showModal = ref(false);
const selectedItem = ref('');
const toBeDeleted = ref<null | string>(null);

const defaultCategory = computed(() => categories.value?.[0] ?? 'banks');

const category = computed(() => {
    const categories: Record<string, string> = {
        creditCards: 'credit cards',
    };

    return categories[selectedItem.value] ?? selectedItem.value;
});

const expenseTotal = computed(() => {
    return convertToCurrency(
        props.budget.data.expenses[selectedItem.value]?.reduce(
            (result: number, item: { data: { amount: number } }) =>
                result + Number(item.data.amount ?? 0),
            0,
        ),
    );
});

const showBalanceColumns = computed(() => {
    return ['credit cards', 'vehicles'].includes(category.value);
});

const showPaidColumns = computed(() => {
    return !['banks', 'incomes', 'investments'].includes(category.value);
});

const handleColumnEvent = (e: { type: string; obj: any }) => {
    switch (e.type) {
        case 'edit':
            formData.value = e.obj;
            showModal.value = true;
            break;
        case 'delete':
            toBeDeleted.value = (e.obj as ValueOfExpense).id;
            break;
    }
};

onMounted(() => {
    categories.value = Object.keys(props.types);
    selectedItem.value = categories.value?.[0] ?? 'banks';
});

watch(showModal, (val) => {
    if (!val) {
        formData.value = undefined;
    }
});
</script>

<template>
    <Head title="Budgets" />

    <AuthenticatedLayout>
        <ExpenseModal
            v-model:show="showModal"
            :expense="category"
            :form-data="formData"
            :errors="errors"
            :notify="flash.message ?? ''"
            :types="types[selectedItem]?.data ?? []"
        />
        <ConfirmModal :id="toBeDeleted" :expense="category" @close-modal="toBeDeleted = null" />
        <BreakdownModal
            v-model:show="showBreakdown"
            :expenses="budget.data.expenses[selectedItem]"
        />

        <template #header>
            {{ formatTimeZone('MMM yyyy', 'UTC', budget.data.budget_cycle) }}
        </template>

        <AuthenticatedContentLayout>
            <section class="grid grid-cols-5 items-center gap-8">
                <div class="col-span-2">
                    <SavedWidget
                        :savings="budget.data.aggregation.data.saved"
                        :total="budget.data.aggregation.data.earned"
                    />
                </div>
                <div class="col-span-3">
                    <BudgetSummary :aggregation="budget.data.aggregation" />
                </div>
            </section>

            <section class="mt-12 grid grid-cols-4 gap-3">
                <Sidebar
                    :badges="unpaid"
                    :value="defaultCategory"
                    :items="categories"
                    @on-selection="selectedItem = $event"
                />

                <div class="col-span-4 ml-3 mr-4 sm:mx-0 md:col-span-3">
                    <div class="mb-4 flex items-end justify-between">
                        <div>
                            <div class="flex items-center space-x-2">
                                <Typography variant="body2">
                                    <span class="">Total</span>
                                </Typography>
                                <Typography variant="body1">
                                    <span class="font-bold">{{ expenseTotal }}</span>
                                </Typography>
                                <FormButton @click="showBreakdown = true" fab>
                                    <Chart classes="size-3" />
                                </FormButton>
                            </div>
                        </div>
                        <div>
                            <FormButton color="primary" :icon="Plus" @click="showModal = true">
                                Add {{ toTitleCase(selectedItem) }}
                            </FormButton>
                        </div>
                    </div>

                    <Table
                        :items="budget.data.expenses[selectedItem] ?? []"
                        :paginatePerPage="[10]"
                    >
                        <ColumnBasic v-if="showPaidColumns" header="">
                            <template v-slot:default="{ data }">
                                <CheckCircle
                                    v-if="data.data?.confirmation"
                                    classes="size-8 text-primary"
                                />
                            </template>
                        </ColumnBasic>
                        <ColumnBasic
                            v-if="category !== 'vehicles'"
                            :colspan="3"
                            header="Name"
                            notation="data.name"
                            searchable
                        />
                        <ColumnBasic v-if="category === 'vehicles'" :colspan="3" header="Vehicle">
                            <template v-slot:default="{ data }">
                                {{ data.vehicle.year }} {{ data.vehicle.make }}
                                {{ data.vehicle.model }}
                            </template>
                        </ColumnBasic>
                        <ColumnBasic :colspan="2" header="Amount">
                            <template v-slot:default="{ data }">
                                {{ convertToCurrency(Number(data.data.amount)) }}
                            </template>
                        </ColumnBasic>
                        <ColumnBadge
                            v-if="category !== 'miscellaneouses'"
                            :color="ColumnBadgeColor.GRAY"
                            :colspan="2"
                            header="Type"
                        >
                            <template v-slot:default="{ data }">
                                {{ data.expense.name }}
                            </template>
                        </ColumnBadge>
                        <ColumnBasic v-if="showBalanceColumns" :colspan="2" header="Balance">
                            <template v-slot:default="{ data }">
                                {{ convertToCurrency(Number(data.data.balance)) }}
                            </template>
                        </ColumnBasic>
                        <ColumnBasic v-if="showPaidColumns" :colspan="2" header="Paid Date">
                            <template v-slot:default="{ data }">
                                <span v-if="data.data.paid_date">
                                    {{ formatTimeZone('MMM d', 'UTC', data.data.paid_date) }}
                                </span>
                            </template>
                        </ColumnBasic>
                        <ColumnBasic v-if="category === 'incomes'" :colspan="2" header="Pay Date">
                            <template v-slot:default="{ data }">
                                <span v-if="data.data.pay_date">
                                    {{ formatTimeZone('MMM d', 'UTC', data.data.pay_date) }}
                                </span>
                            </template>
                        </ColumnBasic>
                        <ColumnActions @action-event="handleColumnEvent" header="" />
                    </Table>
                </div>
            </section>
        </AuthenticatedContentLayout>
    </AuthenticatedLayout>
</template>
