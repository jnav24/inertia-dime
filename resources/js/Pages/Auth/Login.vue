<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head } from '@inertiajs/vue3';
import AppLink from '@/Components/Elements/AppLink.vue';
import BudgetForm from '@/Components/Fields/BudgetForm.vue';
import FormInput from '@/Components/Fields/FormInput.vue';
import FormButton from '@/Components/Fields/FormButton.vue';
import Typography from '@/Components/Elements/Typography.vue';
import FormCheckbox from '@/Components/Fields/FormCheckbox.vue';

defineProps<{
    canResetPassword?: boolean;
    status?: string;
}>();
</script>

<template>
    <GuestLayout>
        <Head title="Login" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <div class="my-12">
            <Typography variant="h1">Welcome Back</Typography>
        </div>

        <BudgetForm>
            <div class="space-y-6">
                <FormInput label="Email" :rules="['required', 'email']" />
                <FormInput label="Password" :rules="['required']" password />
            </div>

            <div class="my-6 flex items-center justify-between">
                <FormCheckbox label="Remember Me" />
                <Typography v-if="canResetPassword" variant="caption">
                    <AppLink :href="route('password.request')">Forgot password?</AppLink>
                </Typography>
            </div>

            <FormButton block color="primary" submit>Login</FormButton>
        </BudgetForm>

        <div class="my-6 text-center">
            <Typography variant="caption"
                >Don't have an account?
                <AppLink :href="route('register')">Sign up</AppLink></Typography
            >
        </div>
    </GuestLayout>
</template>
