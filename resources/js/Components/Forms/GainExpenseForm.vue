<script setup lang="ts">
import FormInput from '@/Components/Fields/FormInput.vue';
import FormSelect from '@/Components/Fields/FormSelect.vue';
import ExpenseFormActions from '@/Components/Forms/ExpenseFormActions.vue';
import { ExpenseFormEmits, GainExpenseFormProps } from '@/types/expenses';

defineEmits<ExpenseFormEmits>();
defineProps<GainExpenseFormProps>();
</script>

<template>
    <div class="mb-6 grid grid-cols-2 gap-4">
        <FormInput label="Name" :rules="['required', 'min:3']" :value="expense?.data.name" />
        <FormInput label="Amount" :rules="['required', 'float:2']" :value="expense?.data.amount" />
        <FormSelect
            :items="types"
            label="Account Type"
            :value="expense?.expense_type_id"
            :rules="['required']"
        />
    </div>

    <ExpenseFormActions />
</template>
