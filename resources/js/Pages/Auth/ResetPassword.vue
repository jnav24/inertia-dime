<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head } from '@inertiajs/vue3';
import FormButton from "@/Components/Fields/FormButton.vue";
import FormInput from "@/Components/Fields/FormInput.vue";
import Typography from "@/Components/Elements/Typography.vue";
import BudgetForm from "@/Components/Fields/BudgetForm.vue";
import { validation } from '@/utils/helpers';

defineProps<{
    email: string;
    token: string;
}>();
</script>

<template>
    <GuestLayout>
        <Head title="Reset Password" />

        <div class="space-y-2 my-12">
            <Typography variant="h1">Reset Password</Typography>
        </div>

        <BudgetForm :action="route('password.email')">
            <div class="space-y-4">
                <FormInput label="Email" :rules="['required', 'email']" :value="email" />
                <FormInput label="Password" :rules="validation.password" password />
                <FormInput label="Confirm Password" :rules="['required', 'match:password']" password />
                <FormButton color="primary" block submit>Reset Password</FormButton>
            </div>
        </BudgetForm>
    </GuestLayout>
</template>
