<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import BudgetForm from '@/Components/Fields/BudgetForm.vue';
import FormInput from '@/Components/Fields/FormInput.vue';
import FormButton from '@/Components/Fields/FormButton.vue';
import { Head } from '@inertiajs/vue3';
import Typography from '@/Components/Elements/Typography.vue';
import AppLink from '@/Components/Elements/AppLink.vue';
import { validation } from '@/utils/helpers';
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <div class="my-12">
            <Typography variant="h1">Create an Account</Typography>
        </div>

        <BudgetForm>
            <div class="mb-6 space-y-6">
                <FormInput label="Name" :rules="['required', 'min:3', 'max:255']" />
                <FormInput label="Email" :rules="['required', 'email']" />
                <FormInput label="Password" :rules="validation.password" password />
                <FormInput
                    label="Password Confirmation"
                    :rules="['required', 'match:password']"
                    password
                />
            </div>

            <FormButton block color="primary" submit>Register</FormButton>
        </BudgetForm>

        <div class="my-6 text-center">
            <Typography variant="caption"
                >Already have an account?
                <AppLink :href="route('login')">Log in</AppLink></Typography
            >
        </div>
    </GuestLayout>
</template>
