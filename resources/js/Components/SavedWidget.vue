<script setup lang="ts">
import ArrowTopRightSquare from '@/Components/Icons/outline/ArrowTopRightSquare.vue';
import FormButton from '@/Components/Fields/FormButton.vue';
import Typography from '@/Components/Elements/Typography.vue';
import Library from '@/Components/Icons/outline/Library.vue';
import { computed, ref } from 'vue';
import SavingsModal from '@/Components/modals/SavingsModal.vue';

type Props = {
    savings: number;
    total: number;
};

const props = defineProps<Props>();

const MIN = 20;

const showModal = ref(false);

const percentage = computed(() => (props.savings / props.total) * 100);
</script>

<template>
    <SavingsModal v-model:show="showModal" />

    <div
        class="relative overflow-hidden rounded-xl bg-gradient-to-r px-4 py-2"
        :class="{
            'from-success to-dm-primary': percentage >= MIN,
            'from-danger to-dm-danger': percentage < MIN,
        }"
    >
        <div class="absolute -top-12 right-12 rotate-6">
            <Library
                :classes="`size-48 ${percentage < MIN ? 'text-danger/25' : 'text-success/25'}`"
            />
        </div>

        <div class="relative z-20 flex items-center justify-between">
            <div>
                <Typography variant="h1" tag="h3">
                    <span class="text-white">{{ percentage.toFixed(2) }}%</span>
                </Typography>
                <Typography variant="body2">
                    <span class="text-gray-200">Total saved</span>
                </Typography>
            </div>

            <FormButton
                :color="percentage < MIN ? 'danger' : 'primary'"
                :icon="ArrowTopRightSquare"
                icon-position="right"
                @onclick="showModal = true"
            >
                More Info
            </FormButton>
        </div>
    </div>
</template>
