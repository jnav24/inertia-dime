<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import BudgetForm from '@/Components/Fields/BudgetForm.vue';
import FormMfa from '@/Components/Fields/FormMfa.vue';
import { Head } from '@inertiajs/vue3';
import FormButton from '@/Components/Fields/FormButton.vue';
import Typography from '@/Components/Elements/Typography.vue';
import { PageProps } from '@/types/providers';

defineProps<PageProps>();
</script>

<template>
    <GuestLayout>
        <Head title="Login" />

        <div class="my-12 space-y-4">
            <Typography variant="h1">Two-factor Authentication</Typography>
            <Typography variant="body2">
                Enter the code displayed in your authenticator app.
            </Typography>
        </div>

        <BudgetForm>
            <div class="mb-6">
                <FormMfa label="Code" :rules="['required', 'numeric']" />
            </div>

            <FormButton block color="primary" submit>Verify account</FormButton>
        </BudgetForm>
    </GuestLayout>
</template>
