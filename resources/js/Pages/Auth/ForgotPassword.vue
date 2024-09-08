<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head } from '@inertiajs/vue3';
import Typography from '@/Components/Elements/Typography.vue';
import BudgetForm from '@/Components/Fields/BudgetForm.vue';
import FormInput from '@/Components/Fields/FormInput.vue';
import FormButton from '@/Components/Fields/FormButton.vue';

defineProps<{
    status?: string;
}>();
</script>

<template>
    <GuestLayout>
        <Head title="Forgot Password" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
            {{ status }}
        </div>

        <div class="my-12 space-y-2">
            <Typography variant="h1">Forgot Password</Typography>
            <Typography variant="body1"
                >No worries! Enter your email and we will send you reset instructions.</Typography
            >
        </div>

        <BudgetForm :action="route('password.email')">
            <div class="space-y-4">
                <FormInput label="Email" :rules="['required', 'email']" />
                <FormButton color="primary" block submit>Reset Password</FormButton>
            </div>
        </BudgetForm>
    </GuestLayout>
</template>
