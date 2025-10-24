<script setup lang="ts">
import Modal from '@/Components/modals/Modal.vue';
import Typography from '@/Components/Elements/Typography.vue';
import FormButton from '@/Components/Fields/FormButton.vue';
import ExclamationTriangle from '@/Components/Icons/outline/ExclamationTriangle.vue';
import BudgetForm from '@/Components/Fields/BudgetForm.vue';
import FormInput from '@/Components/Fields/FormInput.vue';
import { usePage } from '@inertiajs/vue3';

type Emits = {
    (e: 'close-modal'): void;
};

type Props = {
    description?: string;
    id: string | null;
    expense: string;
    title?: string;
};

const emit = defineEmits<Emits>();
withDefaults(defineProps<Props>(), {
    description: 'Are you sure you want to delete this item? This action cannot be undone.',
    title: 'Delete Item',
});

const page = usePage();
const isTemplate = page.url.includes('template');

const routes: Record<string, string> = {
    banks: route('expense.bank.destroy'),
    childcares: route('expense.childcare.destroy'),
    'credit cards': route('expense.credit_cards.destroy'),
    education: route('expense.education.destroy'),
    entertainments: route('expense.entertainment.destroy'),
    food: route('expense.food.destroy'),
    gifts: route('expense.gift.destroy'),
    housings: route('expense.housing.destroy'),
    incomes: route('expense.income.destroy'),
    investments: route('expense.investment.destroy'),
    loans: route('expense.loan.destroy'),
    medicals: route('expense.medical.destroy'),
    miscellaneouses: route('expense.miscellaneous.destroy'),
    personals: route('expense.personal.destroy'),
    shoppings: route('expense.shopping.destroy'),
    subscriptions: route('expense.subscription.destroy'),
    taxes: route('expense.tax.destroy'),
    travel: route('expense.travel.destroy'),
    utilities: route('expense.utility.destroy'),
    'user vehicles': route('user-vehicle.destroy'),
    vehicles: route('expense.vehicle.destroy'),
};

const closeModal = () => emit('close-modal');
</script>

<template>
    <Modal :show="!!id" @close-modal="closeModal()" hide-close-button>
        <div class="w-100 p-4">
            <div class="mb-6 flex space-x-4">
                <div>
                    <div class="rounded-full bg-danger/25 p-2">
                        <ExclamationTriangle classes="size-6 text-danger" />
                    </div>
                </div>
                <div>
                    <Typography variant="h3">{{ title }}</Typography>
                    <Typography variant="body2">
                        {{ description }}
                    </Typography>
                </div>
            </div>

            <BudgetForm @after-submit="closeModal()" :action="routes[expense]" method="delete">
                <div class="flex justify-end space-x-2">
                    <FormInput label="id" hidden :value="id ?? ''" />
                    <FormInput label="template" hidden :value="String(isTemplate)" />
                    <FormButton @onclick="closeModal()">Cancel</FormButton>
                    <FormButton color="danger" submit>Confirm</FormButton>
                </div>
            </BudgetForm>
        </div>
    </Modal>
</template>
