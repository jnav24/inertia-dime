<script setup lang="ts">
import FormInput from '@/Components/Fields/FormInput.vue';
import ExpenseFormActions from '@/Components/Forms/ExpenseFormActions.vue';
import BudgetForm from '@/Components/Fields/BudgetForm.vue';
import FormSelect from '@/Components/Fields/FormSelect.vue';
import FormCheckbox from '@/Components/Fields/FormCheckbox.vue';
import FormTextarea from '@/Components/Fields/FormTextarea.vue';
import ExpenseFormConfirmation from '@/Components/Forms/ExpenseFormConfirmation.vue';
</script>

<template>
    <BudgetForm :action="route('budget.test')">
        <div class="mb-6 grid grid-cols-2 gap-4">
            <FormInput label="Name" :rules="['required', 'min:3']" />
            <FormInput label="Amount" :rules="['required', 'float:2']" />
            <FormSelect :items="[]" label="Account Type" value="" :rules="['required']" />
            <FormSelect :items="[]" label="Due Date" value="" />
        </div>

        <ExpenseFormConfirmation />
        <ExpenseFormActions />
    </BudgetForm>
</template>
