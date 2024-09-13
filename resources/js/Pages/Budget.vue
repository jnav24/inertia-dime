<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AuthenticatedContentLayout from '@/Layouts/AuthenticatedContentLayout.vue';
import { Head } from '@inertiajs/vue3';
import FormButton from '@/Components/Fields/FormButton.vue';
import Plus from '@/Components/Icons/outline/Plus.vue';
import PencilSquare from '@/Components/Icons/outline/PencilSquare.vue';

const redirectToTemplatePage = () => {
    console.log('redirecting...');
};

const createBudget = () => {
    console.log('creating budget....');
};
</script>

<template>
    <Head title="Budgets" />

    <AuthenticatedLayout>
        <template #header> Budgets </template>
        <template #call-to-action>
            <FormButton @onclick="redirectToTemplatePage()">
                <div class="flex items-center space-x-2">
                    <PencilSquare classes="size-4" />
                    <span>Edit Template</span>
                </div>
            </FormButton>
            <FormButton color="primary" @onclick="createBudget()">
                <div class="flex items-center space-x-2">
                    <Plus classes="size-4" />
                    <span>New Budget</span>
                </div>
            </FormButton>
        </template>

        <AuthenticatedContentLayout> content here please </AuthenticatedContentLayout>
    </AuthenticatedLayout>
</template>
