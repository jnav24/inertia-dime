<script setup lang="ts">
import Typography from '@/Components/Elements/Typography.vue';
import FormToggle from '@/Components/Fields/FormToggle.vue';
import BudgetForm from '@/Components/Fields/BudgetForm.vue';

type Props = {
    hasMfa: boolean;
};

defineProps<Props>();
</script>

<template>
    <div class="flex items-center justify-between">
        <div>
            <Typography tag="h2" variant="h3">Two Factor Authentication</Typography>
            <Typography variant="caption">
                Add additional security to your account by using two factor authentication.
            </Typography>
            <Typography variant="caption">
                You will need an authenticator app like Authy or Google Authenticator to use two
                factor.
            </Typography>
        </div>

        <div>
            <BudgetForm :action="route('profile.mfa.store')">
                <FormToggle :toggle="hasMfa" label="mfa" submit />
            </BudgetForm>
        </div>
    </div>
</template>
