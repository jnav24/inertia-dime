<script setup lang="ts">
import FormInput from '@/Components/Fields/FormInput.vue';
import ExpenseFormActions from '@/Components/Forms/ExpenseFormActions.vue';
import FormSelect from '@/Components/Fields/FormSelect.vue';
import ExpenseFormConfirmation from '@/Components/Forms/ExpenseFormConfirmation.vue';
import { ExpenseFormEmits, ExpenseFormProps } from '@/types/expenses';

defineEmits<ExpenseFormEmits>();
defineProps<ExpenseFormProps>();
</script>

<template>
    <div class="mb-6 grid grid-cols-2 gap-4">
        <FormSelect :items="[]" label="Vehicle" value="" :rules="['required']" />
        <FormInput label="Amount" :rules="['required', 'float:2']" />
        <FormSelect :items="[]" label="Account Type" value="" :rules="['required']" />
        <FormInput label="Account Balance" :rules="['required', 'min:3']" />
        <FormInput label="Mileage" :rules="['required', 'min:3']" />
        <FormInput label="Due On" />
    </div>

    <ExpenseFormConfirmation />
    <ExpenseFormActions @close="$emit('close')" />
</template>
