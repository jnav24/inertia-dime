<script setup lang="ts">
</script>

<template>
    <main class="flex h-screen w-full p-2 bg-white dark:bg-dm-main">
        <div class="w-1/2 relative rounded-xl overflow-hidden">
            <div class="bg-primary/85 absolute w-full h-full"></div>
            <img src="/img/onboard_bg_1-1.jpg" class="object-cover h-full" alt="Dime Background">
        </div>

        <section class="flex flex-col justify-between px-6 flex-1">
            <div class="flex space-x-1 items-center pt-2">
                <div class="w-14 overflow-hidden">
                    <img src="/img/logo_1.png" alt="Dime Logo" class="h-12 min-w-36">
                </div>
                <p class="text-3xl font-light text-gray-600">Dime</p>
            </div>

            <div class="pb-20 flex-1 flex flex-col justify-center">
                <div class="w-1/3 min-w-96">
                    <slot />
                </div>
            </div>
        </section>
    </main>
</template>
