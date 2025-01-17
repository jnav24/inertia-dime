<script setup lang="ts">
import FormInput from '@/Components/Fields/FormInput.vue';
import FormCheckbox from '@/Components/Fields/FormCheckbox.vue';
import FormTextarea from '@/Components/Fields/FormTextarea.vue';
import FormDatePicker from '@/Components/Fields/FormDatePicker.vue';
import { ExpenseFormActionProps } from '@/types/expenses';

type Props = {
    expense: {
        data: ExpenseFormActionProps;
    };
};

defineProps<Props>();
</script>

<template>
    <div>
        <FormCheckbox label="Calculate this purchase in your totals?" />

        <div class="mt-4 grid grid-cols-2 gap-4">
            <FormInput label="Confirmation" :value="expense?.data.confirmation" />
            <FormDatePicker label="Paid Date" :value="expense?.data.paid_date" />
        </div>

        <FormTextarea label="Notes" :value="expense?.data.notes" />
    </div>
</template>
