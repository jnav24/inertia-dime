<script setup lang="ts">
import ArrowTopRightSquare from '@/Components/Icons/outline/ArrowTopRightSquare.vue';
import FormButton from '@/Components/Fields/FormButton.vue';
import Typography from '@/Components/Elements/Typography.vue';
import Library from '@/Components/Icons/outline/Library.vue';
</script>

<template>
    <div
        class="relative overflow-hidden rounded-xl bg-gradient-to-r from-success to-dm-primary px-4 py-2"
    >
        <div class="absolute -top-12 right-12 rotate-6">
            <Library classes="size-48 text-success/25" />
        </div>

        <div class="relative z-20 flex items-center justify-between">
            <div>
                <Typography variant="h1" tag="h3">
                    <span class="text-white">21%</span>
                </Typography>
                <Typography variant="body2">
                    <span class="text-gray-200">Total saved</span>
                </Typography>
            </div>

            <FormButton color="primary" :icon="ArrowTopRightSquare" icon-position="right">
                More Info
            </FormButton>
        </div>
    </div>
</template>
