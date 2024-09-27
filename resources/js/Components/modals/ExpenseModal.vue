<script setup lang="ts">
import { ucFirst } from '@/utils/functions';
import Modal from '@/Components/modals/Modal.vue';
import Typography from '@/Components/Elements/Typography.vue';
import GainExpenseForm from '@/Components/Forms/GainExpenseForm.vue';
import CommonExpenseForm from '@/Components/Forms/CommonExpenseForm.vue';
import CreditCardExpenseForm from '@/Components/Forms/CreditCardExpenseForm.vue';
import IncomeExpenseForm from '@/Components/Forms/IncomeExpenseForm.vue';
import MiscellaneousExpenseForm from '@/Components/Forms/MiscellaneousExpenseForm.vue';
import VehicleExpenseForm from '@/Components/Forms/VehicleExpenseForm.vue';

type Props = {
    type: string;
};

defineProps<Props>();
</script>

<template>
    <Modal :show="show" @close-modal="$emit('update:show', false)" hide-close-button>
        <div class="w-150 space-y-4 p-4">
            <div>
                <Typography variant="h3">{{ ucFirst(type) }}</Typography>
                <Typography variant="caption">Add/Update your expense</Typography>
            </div>
            <GainExpenseForm v-if="['banks', 'investments'].includes(type)" />
            <CreditCardExpenseForm v-else-if="'credit cards' === type" />
            <IncomeExpenseForm v-else-if="'incomes' === type" />
            <MiscellaneousExpenseForm v-else-if="'miscellaneous' === type" />
            <VehicleExpenseForm v-else-if="'vehicles' === type" />
            <CommonExpenseForm v-else />
        </div>
    </Modal>
</template>
