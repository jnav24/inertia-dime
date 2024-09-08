<script setup lang="ts"></script>

<template>
    <main class="flex h-screen w-full bg-white p-2 dark:bg-dm-main">
        <div class="relative w-1/2 overflow-hidden rounded-xl">
            <div class="absolute h-full w-full bg-primary/85"></div>
            <img src="/img/onboard_bg_1-1.jpg" class="h-full object-cover" alt="Dime Background" />
        </div>

        <section class="flex flex-1 flex-col justify-between px-6">
            <div class="flex items-center space-x-1 pt-2">
                <div class="w-14 overflow-hidden">
                    <img src="/img/logo_1.png" alt="Dime Logo" class="h-12 min-w-36" />
                </div>
                <p class="text-3xl font-light text-gray-600">Dime</p>
            </div>

            <div class="flex flex-1 flex-col justify-center pb-20">
                <div class="w-1/3 min-w-96">
                    <slot />
                </div>
            </div>
        </section>
    </main>
</template>
