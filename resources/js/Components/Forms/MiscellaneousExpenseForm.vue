<script setup lang="ts">
import FormInput from '@/Components/Fields/FormInput.vue';
import ExpenseFormActions from '@/Components/Forms/ExpenseFormActions.vue';
import FormSelect from '@/Components/Fields/FormSelect.vue';
import ExpenseFormConfirmation from '@/Components/Forms/ExpenseFormConfirmation.vue';
</script>

<template>
    <div class="mb-6 grid grid-cols-2 gap-4">
        <FormInput label="Name" :rules="['required', 'min:3']" />
        <FormInput label="Amount" :rules="['required', 'float:2']" />
        <FormSelect :items="[]" label="Account Type" value="" :rules="['required']" />
        <FormInput label="Due On" />
    </div>

    <ExpenseFormConfirmation />
    <ExpenseFormActions @close="$emit('close')" />
</template>
