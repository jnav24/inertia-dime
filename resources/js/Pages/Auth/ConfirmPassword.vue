<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head } from '@inertiajs/vue3';
import FormButton from '@/Components/Fields/FormButton.vue';
import FormInput from '@/Components/Fields/FormInput.vue';
import Typography from '@/Components/Elements/Typography.vue';
import BudgetForm from '@/Components/Fields/BudgetForm.vue';
</script>

<template>
    <GuestLayout>
        <Head title="Confirm Password" />

        <div class="my-12 space-y-2">
            <Typography variant="h1">Confirm Password</Typography>
            <Typography variant="body1"
                >This is a secure area of the application. Please confirm your password before
                continuing.</Typography
            >
        </div>

        <BudgetForm :action="route('password.confirm')">
            <div class="space-y-4">
                <FormInput label="Password" :rules="['required']" password />
                <FormButton color="primary" block submit>Confirm</FormButton>
            </div>
        </BudgetForm>
    </GuestLayout>
</template>
