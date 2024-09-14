<script setup lang="ts"></script>

<template>
    <div
        :class="[
            'border-lm-stroke dark:border-dm-stroke flex flex-row items-center space-x-4 border-0 px-4 py-6 shadow-sm',
            'bg-lm-secondary hover:bg-gray-100 dark:bg-dm-secondary dark:hover:bg-dm-primary/25',
        ]"
    >
        <slot />
    </div>
</template>
