<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AuthenticatedContentLayout from '@/Layouts/AuthenticatedContentLayout.vue';
import { PageProps } from '@/types/providers';
import { computed, onMounted, ref } from 'vue';
import Sidebar from '@/Components/Elements/Sidebar.vue';
import Plus from '@/Components/Icons/outline/Plus.vue';
import { toTitleCase } from '@/utils/functions';
import FormButton from '@/Components/Fields/FormButton.vue';
import Table from '@/Components/table/Table.vue';
import { budgetColumns } from '@/utils/helpers';
import { formatTimeZone } from '@/utils/timestamp';
import ExpenseModal from '@/Components/modals/ExpenseModal.vue';

type Props = PageProps & {
    budget: any;
    types: any;
    vehicles: any;
};

const props = defineProps<Props>();

const categories = ref<string[]>([]);
const formData = ref(undefined);
const showModal = ref(false);
const selectedItem = ref('');

const defaultCategory = computed(() => categories.value?.[0] ?? 'banks');

const category = computed(() => {
    const categories: Record<string, string> = {
        creditCards: 'credit cards',
    };

    return categories[selectedItem.value] ?? selectedItem.value;
});

const handleColumnEvent = (e: { type: string; obj: any }) => {
    switch (e.type) {
        case 'edit':
            formData.value = e.obj;
            showModal.value = true;
            break;
        case 'delete':
            console.log('open delete confirm');
            break;
    }
};

onMounted(() => {
    categories.value = Object.keys(props.types);
    selectedItem.value = categories.value?.[0] ?? 'banks';
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

        <template #header>
            {{ formatTimeZone('MMM yyyy', 'UTC', budget.data.budget_cycle) }}
        </template>

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
                        :columns="[...(budgetColumns[selectedItem] ?? [])]"
                        :empty="{
                            title: `No results found`,
                            content: 'Click the button above to add an expense.',
                        }"
                        :paginate="{ options: [15], selected: 15, current: 1 }"
                        :items="budget.data.expenses[selectedItem]"
                        @column-event="handleColumnEvent($event)"
                    />
                </div>
            </section>
        </AuthenticatedContentLayout>
    </AuthenticatedLayout>
</template>
