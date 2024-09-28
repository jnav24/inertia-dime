<script setup lang="ts">
import { onBeforeUnmount, ref, watchEffect } from 'vue';
import FadeTransition from '@/Components/modals/FadeTransition.vue';
import TransitionOverlay from '@/Components/modals/TransitionOverlay.vue';
import SlideTransition from '@/Components/modals/SlideTransition.vue';
import FormButton from '@/Components/Fields/FormButton.vue';
import Close from '@/Components/Icons/outline/Close.vue';

type Emits = {
    (e: 'close-modal'): void;
    (e: 'update:show', v: boolean): void;
};

type Props = {
    hideCloseButton?: boolean;
    persistent?: boolean;
    show: boolean;
};

const emit = defineEmits<Emits>();
const props = defineProps<Props>();

let timeoutId = undefined;
const state = ref(false);

const closeModal = () => {
    emit('close-modal');
    emit('update:show', false);
};

watchEffect(() => {
    timeoutId = setTimeout(
        () => {
            state.value = props.show;
        },
        !props.show ? 500 : 0,
    );
});

onBeforeUnmount(() => {
    clearTimeout(timeoutId);
});
</script>

<template>
    <div v-if="state">
        <FadeTransition :show="show">
            <div
                class="flex min-h-screen items-end justify-center px-4 pb-20 pt-4 text-center sm:block sm:p-0"
            >
                <TransitionOverlay @handle-close="!persistent && closeModal()" />

                <SlideTransition direction="up" :show="show">
                    <!-- This element is to trick the browser into centering the modal contents. -->
                    <span class="hidden sm:inline-block sm:h-screen sm:align-middle" />
                    &#8203;
                    <section
                        class="relative z-10 inline-block rounded-lg bg-white text-left align-bottom shadow-xl dark:bg-dm-secondary sm:my-8 sm:align-middle"
                        role="dialog"
                        aria-modal="true"
                        aria-labelledby="modal-content"
                    >
                        <Close
                            @click="closeModal()"
                            classes="size-5 absolute top-4 right-4 text-gray-400 cursor-pointer"
                        />
                        <slot />
                        <FormButton v-if="!hideCloseButton" @click="closeModal()">
                            Close
                        </FormButton>
                    </section>
                </SlideTransition>
            </div>
        </FadeTransition>
    </div>
</template>
