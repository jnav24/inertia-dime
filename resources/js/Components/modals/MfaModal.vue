<script setup lang="ts">
import Modal from '@/Components/modals/Modal.vue';
import { MFASetup } from '@/types/mfa';
import Typography from '@/Components/Elements/Typography.vue';
import FormButton from '@/Components/Fields/FormButton.vue';
import { computed, ref, watchEffect } from 'vue';
import DocumentDuplicate from '@/Components/Icons/outline/DocumentDuplicate.vue';
import Eye from '@/Components/Icons/outline/Eye.vue';
import FormMfa from '@/Components/Fields/FormMfa.vue';
import BudgetForm from '@/Components/Fields/BudgetForm.vue';
import EyeSlash from '@/Components/Icons/outline/EyeSlash.vue';
import useHttp from '@/Composables/useHttp';
import CheckCircle from '@/Components/Icons/outline/CheckCircle.vue';
import ExclamationCircle from '@/Components/Icons/outline/ExclamationCircle.vue';

type Emits = {
    (e: 'update:show', v: boolean): void;
    (e: 'handleUpdate', v: boolean): void;
    (e: 'reset'): void;
};

type Props = {
    mfa: MFASetup;
    show: boolean;
};

const emit = defineEmits<Emits>();
const props = defineProps<Props>();

const code = ref('');

const verify = useHttp({
    method: 'post',
    path: 'verify',
    initialize: false,
});

const destroyMFA = useHttp({
    method: 'delete',
    path: 'profile/mfa-api',
    initialize: false,
});

const blurRecoveryCodes = ref(true);
const isCopied = ref(false);
const step = ref(1);

const halfCodes = computed(() => Math.ceil(props.mfa.recovery_codes.length / 2));

const closeModal = () => {
    emit('update:show', false);
    emit('handleUpdate', false);
    step.value = 1;
    verify.reset();
};

const copyRecoveryCodes = async () => {
    try {
        await navigator.clipboard.writeText(props.mfa.recovery_codes.join(','));
        isCopied.value = true;
        setTimeout(() => {
            isCopied.value = false;
        }, 3000);
    } catch (err) {}
};

const updateCode = (v: string) => (code.value = v);

const cancelMFA = () => {
    destroyMFA.refetch();
    closeModal();
    emit('reset');
};

watchEffect(() => {
    if (verify.isSuccess.value) {
        step.value = 2;
    }
});
</script>

<template>
    <Modal :show="show" @close-modal="closeModal()" hide-close-button persistent>
        <div class="w-200 space-y-4 p-4">
            <Typography variant="h3">Set Up Two Factor Authentication</Typography>

            <section v-if="step === 1">
                <div class="space-y-4">
                    <Typography variant="body2">
                        Scan the following QR Code using your phone's authenticator application and
                        enter the 6-digit code below.
                    </Typography>

                    <Typography variant="caption">
                        Note: The information below will only be shown once.
                    </Typography>
                </div>

                <div class="flex justify-center py-6" v-html="mfa?.qr_code"></div>

                <BudgetForm>
                    <div class="mb-6 flex justify-center">
                        <div class="w-80">
                            <FormMfa
                                label="Verification"
                                @handleUpdate="updateCode($event)"
                                :rules="['required']"
                            />

                            <div
                                class="mb-4 flex items-center space-x-2"
                                v-if="verify.isError.value"
                            >
                                <ExclamationCircle classes="size-6 text-danger" />
                                <Typography variant="caption">
                                    <span class="text-danger"> Code provided is not valid. </span>
                                </Typography>
                            </div>
                        </div>
                    </div>

                    <div
                        class="flex flex-row items-end justify-end space-x-2 rounded-b-lg border-t border-lm-stroke p-4"
                    >
                        <FormButton @click="cancelMFA()">Cancel</FormButton>
                        <FormButton color="primary" @click="verify.refetch({ code })">
                            Verify
                        </FormButton>
                    </div>
                </BudgetForm>
            </section>

            <section v-if="step === 2">
                <div class="mb-4 flex items-center space-x-2">
                    <CheckCircle classes="size-6 text-success" />
                    <Typography variant="caption">
                        <span class="text-success">
                            Two-factor authentication is now enabled for this account
                        </span>
                    </Typography>
                </div>
                <Typography variant="body2">
                    If you lose access to your auth app, you can login using one of your recovery
                    codes below. Each code can only be used once.
                </Typography>

                <div class="flex justify-center">
                    <div class="w-125 pb-4">
                        <div
                            class="my-6 flex justify-between rounded border border-gray-300 bg-gray-100 px-4 pb-2 pt-4"
                        >
                            <ul v-for="(v, i) in [1, 2]" :key="i">
                                <li
                                    class="mb-2"
                                    :class="{ 'blur-sm': blurRecoveryCodes }"
                                    v-for="(code, int) in [...mfa.recovery_codes].splice(
                                        i * halfCodes,
                                        v * halfCodes,
                                    )"
                                    :key="int"
                                >
                                    <Typography variant="caption">{{ code }}</Typography>
                                </li>
                            </ul>
                        </div>

                        <div class="flex justify-center space-x-2">
                            <FormButton
                                :icon="blurRecoveryCodes ? Eye : EyeSlash"
                                @click="blurRecoveryCodes = !blurRecoveryCodes"
                            >
                                {{ blurRecoveryCodes ? 'Show' : 'Hide' }} Codes
                            </FormButton>
                            <FormButton
                                :color="isCopied ? 'secondary' : 'default'"
                                :icon="DocumentDuplicate"
                                @click="copyRecoveryCodes()"
                            >
                                {{ isCopied ? 'Copied!' : 'Copy' }}
                            </FormButton>
                        </div>
                    </div>
                </div>

                <div
                    class="flex flex-row items-end justify-end space-x-2 rounded-b-lg border-t border-lm-stroke p-4"
                >
                    <FormButton color="primary" @click="closeModal()"> Done </FormButton>
                </div>
            </section>
        </div>
    </Modal>
</template>
