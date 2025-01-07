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
            'from-secondary to-dm-secondary': percentage > 0 && percentage < MIN,
            'from-danger to-dm-danger': percentage < 0,
        }"
    >
        <div class="absolute -top-12 right-12 rotate-6">
            <Library
                :classes="`size-48 ${percentage < MIN ? (percentage > 0 ? 'text-secondary/25' : 'text-danger/25') : 'text-success/25'}`"
            />
        </div>

        <div class="relative z-20 flex items-center justify-between">
            <div>
                <div class="flex items-end space-x-2">
                    <Typography variant="h1" tag="h3">
                        <span
                            :class="{
                                'text-gray-600': percentage > 0 && percentage < MIN,
                                'text-white': percentage < 0 || percentage > MIN,
                            }"
                        >
                            {{ percentage.toFixed(2) }}%
                        </span>
                    </Typography>
                    <Typography variant="body2">
                        <span
                            :class="{
                                'text-gray-600': percentage > 0 && percentage < MIN,
                                'text-white': percentage < 0 || percentage > MIN,
                            }"
                        >
                            Saved
                        </span>
                    </Typography>
                </div>

                <Typography variant="caption">
                    <span
                        class="italic"
                        :class="{
                            'text-gray-600': percentage > 0 && percentage < MIN,
                            'text-gray-300': percentage < 0 || percentage > MIN,
                        }"
                    >
                        <span v-if="percentage < 0"> You may have to adjust your spending. </span>
                        <span v-if="percentage > 0 && percentage < MIN">
                            It's good to save! Try aiming to save 20%.
                        </span>
                        <span v-if="percentage > MIN">You rock! Your hard work is paying off!</span>
                    </span>
                </Typography>
            </div>

            <FormButton
                :color="percentage < MIN ? (percentage > 0 ? 'secondary' : 'danger') : 'primary'"
                :icon="ArrowTopRightSquare"
                icon-position="right"
                @onclick="showModal = true"
            >
                More Info
            </FormButton>
        </div>
    </div>
</template>
