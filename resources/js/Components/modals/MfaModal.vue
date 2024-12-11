<script setup lang="ts">
import Modal from '@/Components/modals/Modal.vue';
import { MFASetup } from '@/types/mfa';
import Typography from '@/Components/Elements/Typography.vue';
import FormButton from '@/Components/Fields/FormButton.vue';
import { computed, ref } from 'vue';
import DocumentDuplicate from '@/Components/Icons/outline/DocumentDuplicate.vue';
import Eye from '@/Components/Icons/outline/Eye.vue';
import FormMfa from '@/Components/Fields/FormMfa.vue';
import BudgetForm from '@/Components/Fields/BudgetForm.vue';
import EyeSlash from '@/Components/Icons/outline/EyeSlash.vue';

type Emits = {
    (e: 'update:show', v: boolean): void;
};

type Props = {
    mfa: MFASetup;
    show: boolean;
};

defineEmits<Emits>();
const props = defineProps<Props>();

const blurRecoveryCodes = ref(true);
const isCopied = ref(false);

const halfCodes = computed(() => Math.ceil(props.mfa.recovery_codes.length / 2));

const closeModal = () => emit('update:show', false);

const copyRecoveryCodes = async () => {
    try {
        const result = await navigator.clipboard.writeText(props.mfa.recovery_codes);
        isCopied.value = true;
        setTimeout(() => {
            isCopied.value = false;
        }, 3000);
    } catch (err) {}
};
</script>

<template>
    <Modal :show="show" @close-modal="closeModal()" hide-close-button persistent>
        <div class="w-200 space-y-4 p-4">
            <Typography variant="h3">Set Up Two Factor Authentication</Typography>

            <div class="flex">
                <div class="flex-1">
                    <div class="space-y-4">
                        <Typography variant="body2">
                            Scan the following QR Code using your phone's authenticator application.
                        </Typography>

                        <Typography variant="caption">
                            Note: The information below will only be shown once.
                        </Typography>
                    </div>

                    <div class="mt-6 flex justify-center" v-html="mfa.qr_code"></div>

                    <BudgetForm>
                        <FormMfa label="Verification" />
                    </BudgetForm>
                </div>

                <div class="flex-1">
                    <Typography variant="body2">
                        If you lose access to your auth app, you can login using one of your
                        recovery codes below. Each code can only be used once.
                    </Typography>

                    <div
                        class="my-6 flex justify-between rounded border border-gray-300 bg-gray-100 px-2 pb-2 pt-4"
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

                    <div class="space-x-2">
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
                class="flex flex-row items-end justify-end space-x-2 rounded-b-lg border-t-2 border-lm-stroke p-4"
            >
                <FormButton @click="$emit('update:show', false)">Cancel</FormButton>
                <FormButton color="primary" @click="$emit('update:show', false)" submit>
                    Enable Two Factor
                </FormButton>
            </div>
        </div>
    </Modal>
</template>
