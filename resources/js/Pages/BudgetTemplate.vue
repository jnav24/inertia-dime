<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import FormButton from '@/Components/Fields/FormButton.vue';
import ArrowDownTray from '@/Components/Icons/outline/ArrowDownTray.vue';
</script>

<template>
    <Head title="Budget Template" />

    <AuthenticatedLayout>
        <template #header> Budget Template</template>
        <template #call-to-action>
            <FormButton color="primary" :icon="ArrowDownTray" disabled> Save Template </FormButton>
        </template>
    </AuthenticatedLayout>
</template>
