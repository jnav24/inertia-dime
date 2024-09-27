<script setup lang="ts">
import FormButton from '@/Components/Fields/FormButton.vue';
</script>

<template>
    <div class="space-x-2 border-t border-lm-stroke pt-4 text-right">
        <FormButton @click="$emit('update:show', false)">Cancel</FormButton>
        <FormButton color="primary" submit>Submit</FormButton>
    </div>
</template>
