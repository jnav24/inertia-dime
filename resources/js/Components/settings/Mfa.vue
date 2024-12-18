<script setup lang="ts">
import Typography from '@/Components/Elements/Typography.vue';
import FormToggle from '@/Components/Fields/FormToggle.vue';
import BudgetForm from '@/Components/Fields/BudgetForm.vue';
import { MFASetup } from '@/types/mfa';
import MfaModal from '@/Components/modals/MfaModal.vue';
import { ref, watchEffect } from 'vue';

type Props = {
    hasMfa: boolean;
    mfa: null | MFASetup;
};

const props = defineProps<Props>();

const mfaData = ref<null | MFASetup>(null);

const showModal = ref(false);

watchEffect(() => {
    if (props.mfa) {
        mfaData.value = props.mfa;
        showModal.value = true;
    }
});

const reset = () => {
    mfaData.value = null;
    showModal.value = false;
};
</script>

<template>
    <MfaModal
        :mfa="mfaData as unknown as MFASetup"
        :show="showModal"
        @handleUpdate="showModal = $event"
        @reset="reset()"
    />

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
            <BudgetForm
                :action="route(hasMfa ? 'profile.mfa.destroy' : 'profile.mfa.store')"
                :method="hasMfa ? 'delete' : 'post'"
            >
                <FormToggle :toggle="hasMfa" label="mfa" submit />
            </BudgetForm>
        </div>
    </div>
</template>
