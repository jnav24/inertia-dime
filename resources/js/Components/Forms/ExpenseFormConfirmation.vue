<script setup lang="ts">
import FormInput from '@/Components/Fields/FormInput.vue';
import FormCheckbox from '@/Components/Fields/FormCheckbox.vue';
import FormTextarea from '@/Components/Fields/FormTextarea.vue';
</script>

<template>
    <div>
        <FormCheckbox label="Calculate this purchase in your totals?" />

        <div class="mt-4 grid grid-cols-2 gap-4">
            <FormInput label="Confirmation" />
            <FormInput label="Confirmation" />
        </div>

        <FormTextarea label="Notes" />
    </div>
</template>
