<script setup lang="ts">
import { computed, inject, watch } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { ucFirst } from '@/utils/functions';
import Modal from '@/Components/modals/Modal.vue';
import Typography from '@/Components/Elements/Typography.vue';
import GainExpenseForm from '@/Components/Forms/GainExpenseForm.vue';
import CommonExpenseForm from '@/Components/Forms/CommonExpenseForm.vue';
import CreditCardExpenseForm from '@/Components/Forms/CreditCardExpenseForm.vue';
import IncomeExpenseForm from '@/Components/Forms/IncomeExpenseForm.vue';
import MiscellaneousExpenseForm from '@/Components/Forms/MiscellaneousExpenseForm.vue';
import VehicleExpenseForm from '@/Components/Forms/VehicleExpenseForm.vue';
import BudgetForm from '@/Components/Fields/BudgetForm.vue';
import { NotificationContext, NotificationContextType } from '@/types/providers';
import UserVehicleForm from '@/Components/Forms/UserVehicleForm.vue';

type Props = {
    expense: string;
    formData: any;
    notify?: string;
    types: any[];
};

const emit = defineEmits<{ (e: 'update:show', v: boolean): void }>();
const props = defineProps<Props>();

const notificationContext = inject<NotificationContextType>(NotificationContext);

const page = usePage();
const isTemplate = page.url.includes('template');

const routes = {
    banks: route('expense.bank.store'),
    childcares: route('expense.childcare.store'),
    'credit cards': route('expense.credit_cards.store'),
    education: route('expense.education.store'),
    entertainments: route('expense.entertainment.store'),
    food: route('expense.food.store'),
    gifts: route('expense.gift.store'),
    housings: route('expense.housing.store'),
    incomes: route('expense.income.store'),
    investments: route('expense.investment.store'),
    loans: route('expense.loan.store'),
    medicals: route('expense.medical.store'),
    miscellaneouses: route('expense.miscellaneous.store'),
    personals: route('expense.personal.store'),
    shoppings: route('expense.shopping.store'),
    subscriptions: route('expense.subscription.store'),
    taxes: route('expense.tax.store'),
    travel: route('expense.travel.store'),
    utilities: route('expense.utility.store'),
    'user vehicles': route('user-vehicle.store'),
    vehicles: route('expense.bank.store'),
};

const submitRoute = computed(() => {
    if (props.formData?.id) {
        return { route: `${routes[props.expense]}/${props.formData.id}`, method: 'patch' };
    }

    return { route: routes[props.expense], method: 'post' };
});

const closeModal = () => emit('update:show', false);

watch(
    () => props.notify,
    (v) => {
        if (v) {
            notificationContext?.addNotification({
                title: 'Success',
                message: v,
                type: 'success',
            });
        }
    },
);
</script>

<template>
    <Modal :show="show" @close-modal="closeModal()" hide-close-button>
        <div class="w-150 space-y-4 p-4">
            <div>
                <Typography variant="h3">{{ ucFirst(expense) }}</Typography>
                <Typography variant="caption">Add/Update your expense</Typography>
            </div>

            <BudgetForm
                :action="submitRoute.route"
                :method="submitRoute.method"
                @after-submit="closeModal()"
            >
                <GainExpenseForm
                    v-if="['banks', 'investments'].includes(expense)"
                    :expense="formData"
                    :is-template="isTemplate"
                    @close="closeModal()"
                    :types="types"
                />
                <CreditCardExpenseForm
                    v-else-if="'credit cards' === expense"
                    :expense="formData"
                    :is-template="isTemplate"
                    @close="closeModal()"
                    :types="types"
                />
                <IncomeExpenseForm
                    v-else-if="'incomes' === expense"
                    :expense="formData"
                    :is-template="isTemplate"
                    @close="closeModal()"
                    :types="types"
                />
                <MiscellaneousExpenseForm
                    v-else-if="'miscellaneouses' === expense"
                    :expense="formData"
                    :is-template="isTemplate"
                    @close="closeModal()"
                    :types="types"
                />
                <VehicleExpenseForm
                    v-else-if="'vehicles' === expense"
                    :expense="formData"
                    :is-template="isTemplate"
                    @close="closeModal()"
                    :types="types"
                />
                <UserVehicleForm
                    v-else-if="'user vehicles' === expense"
                    :data="formData"
                    @close="closeModal()"
                />
                <CommonExpenseForm
                    v-else
                    :expense="formData"
                    :is-template="isTemplate"
                    @close="closeModal()"
                    :types="types"
                />
            </BudgetForm>
        </div>
    </Modal>
</template>
