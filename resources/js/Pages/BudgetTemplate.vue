<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import FormButton from '@/Components/Fields/FormButton.vue';
import ExpenseModal from '@/Components/modals/ExpenseModal.vue';
import { computed, onMounted, ref, watch, watchEffect } from 'vue';
import AuthenticatedContentLayout from '@/Layouts/AuthenticatedContentLayout.vue';
import Sidebar from '@/Components/Elements/Sidebar.vue';
import Table from '@/Components/table/Table.vue';
import Plus from '@/Components/Icons/outline/Plus.vue';
import { columns } from '@/utils/helpers';
import { toTitleCase } from '@/utils/functions';
import { PageProps } from '@/types/providers';

type Props = PageProps & {
    budgetTemplate: any;
    expenses: any;
    types: any;
};

const props = defineProps<Props>();

const categories = ref([]);
const formData = ref(undefined);
const showModal = ref(false);
const selectedItem = ref('');

const defaultCategory = computed(() => categories.value?.[0] ?? 'banks');
const formSubmitted = computed(() => props.flash.message && !props.errors);

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
            console.log('open delete confirm');
            break;
    }
};

const category = computed(() => {
    const categories = {
        'credit cards': 'creditCards',
    };

    return categories[selectedItem.value] ?? selectedItem.value;
});

watch(showModal, (v) => {
    if (!v) {
        formData.value = undefined;
    }
});

watchEffect(() => {
    console.log('watching...', props.flash, props.errors);
});
</script>

<template>
    <Head title="Budget Template" />

    <AuthenticatedLayout>
        <ExpenseModal
            v-model:show="showModal"
            :expense="selectedItem"
            :form-data="formData"
            :notify="flash.message"
            :types="types[selectedItem]?.data ?? []"
        />

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
                        :paginate="{ options: [15], selected: 15, current: 1 }"
                        :items="budgetTemplate.data.expenses[category]"
                        @column-event="handleColumnEvent($event)"
                    />
                </div>
            </section>
        </AuthenticatedContentLayout>
    </AuthenticatedLayout>
</template>
