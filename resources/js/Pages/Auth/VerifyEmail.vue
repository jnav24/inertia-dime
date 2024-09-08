<script setup lang="ts">
import { computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head } from '@inertiajs/vue3';
import Typography from '@/Components/Elements/Typography.vue';
import BudgetForm from '@/Components/Fields/BudgetForm.vue';
import FormButton from '@/Components/Fields/FormButton.vue';
import AppLink from '@/Components/Elements/AppLink.vue';
import Alert from '@/Components/Elements/Alert.vue';

const props = defineProps<{
    status?: string;
}>();

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <GuestLayout>
        <Head title="Email Verification" />

        <div class="my-8 space-y-4">
            <Typography variant="h1">Verify your email</Typography>
            <Typography variant="body1"
                >Thanks for signing up! Before getting started, could you verify your email address
                by clicking on the link we just emailed to you? If you didn't receive the email, we
                will gladly send you another.</Typography
            >
        </div>

        <Alert
            v-if="verificationLinkSent"
            message="A new verification link has been sent to the email address you provided during registration."
            type="success"
            title="Success"
        />

        <BudgetForm :action="route('verification.send')">
            <FormButton color="primary" submit block>Resend Verification Email</FormButton>
        </BudgetForm>

        <div class="mt-6 text-center">
            <Typography variant="caption">
                <AppLink :href="route('logout')" method="post" as="button">Log Out</AppLink>
            </Typography>
        </div>
    </GuestLayout>
</template>
