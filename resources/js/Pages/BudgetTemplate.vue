<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import FormButton from '@/Components/Fields/FormButton.vue';
import ExpenseModal from '@/Components/modals/ExpenseModal.vue';
import { computed, onMounted, ref, watch } from 'vue';
import AuthenticatedContentLayout from '@/Layouts/AuthenticatedContentLayout.vue';
import Sidebar from '@/Components/Elements/Sidebar.vue';
import Table from '@/Components/table/Table.vue';
import Plus from '@/Components/Icons/outline/Plus.vue';
import { columns } from '@/utils/helpers';
import { convertToCurrency, toTitleCase } from '@/utils/functions';
import { PageProps } from '@/types/providers';
import { UserVehicle } from '@/types/expenses';
import ConfirmModal from '@/Components/modals/ConfirmModal.vue';
import { ValueOfExpense } from '@/types/expenses';
import ColumnActions from '@/Components/table/ColumnActions.vue';
import ColumnBasic from '@/Components/table/ColumnBasic.vue';
import { ColumnBadgeColor } from '@/types/table';
import ColumnBadge from '@/Components/table/ColumnBadge.vue';
import { formatTimeZone } from '@/utils/timestamp';

type Props = PageProps & {
    budgetTemplate: any;
    expenses: any;
    types: any;
    vehicles: UserVehicle[];
};

const props = defineProps<Props>();

const categories = ref<string[]>([]);
const formData = ref(undefined);
const showModal = ref(false);
const selectedItem = ref('');
const toBeDeleted = ref<null | string>(null);

const defaultCategory = computed(() => categories.value?.[0] ?? 'banks');

onMounted(() => {
    categories.value = Object.keys(props.types);
    selectedItem.value = categories.value?.[0] ?? 'banks';
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

const category = computed(() => {
    const categories: Record<string, string> = {
        creditCards: 'credit cards',
    };

    return categories[selectedItem.value] ?? selectedItem.value;
});

const showBalanceColumns = computed(() => {
    return ['credit cards', 'vehicles'].includes(category.value);
});

const showPaidColumns = computed(() => {
    return !['banks', 'incomes', 'investments'].includes(category.value);
});

watch(showModal, (v) => {
    if (!v) {
        formData.value = undefined;
    }
});
</script>

<template>
    <Head title="Budget Template" />

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

        <template #header> Budget Template</template>

        <AuthenticatedContentLayout>
            <section class="grid grid-cols-4 gap-3">
                <Sidebar
                    :value="defaultCategory"
                    :items="categories"
                    @on-selection="selectedItem = $event"
                />
                <div class="col-span-4 ml-3 mr-4 sm:mx-0 md:col-span-3">
                    <div class="mb-4 text-right">
                        <FormButton color="primary" :icon="Plus" @click="showModal = true">
                            Add {{ toTitleCase(selectedItem) }}
                        </FormButton>
                    </div>

                    <Table
                        :items="budgetTemplate.data.expenses[selectedItem] ?? []"
                        :paginatePerPage="[10]"
                    >
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
                        <ColumnBasic
                            v-if="showPaidColumns"
                            header="Due Date"
                            notation="data.due_date"
                        />
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
