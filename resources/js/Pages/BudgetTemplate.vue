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
import { toTitleCase } from '@/utils/functions';
import { PageProps } from '@/types/providers';
import { UserVehicle } from '@/types/expenses';
import ConfirmModal from '@/Components/modals/ConfirmModal.vue';
import { ValueOfExpense } from '@/types/expenses';

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
                        :columns="[...(columns[selectedItem] ?? [])]"
                        :empty="{
                            title: `No results found`,
                            content: 'Click the button above to add an expense.',
                        }"
                        :paginate="{ options: [10], selected: 10, current: 1 }"
                        :items="budgetTemplate.data.expenses[selectedItem]"
                        @column-event="handleColumnEvent($event)"
                    />
                </div>
            </section>
        </AuthenticatedContentLayout>
    </AuthenticatedLayout>
</template>
