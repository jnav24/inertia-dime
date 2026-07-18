<script lang="ts" setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AuthenticatedContentLayout from '@/Layouts/AuthenticatedContentLayout.vue';
import Tabs from '@/Components/tabs/Tabs.vue';
import TabItem from '@/Components/tabs/TabItem.vue';
</script>

<template>
    <Head title="Dividends" />

    <AuthenticatedLayout>
        <template #header> Dividends </template>

        <AuthenticatedContentLayout>
            <Tabs>
                <TabItem title="Dividends">Dividends</TabItem>
                <TabItem title="Payouts">Payouts</TabItem>
            </Tabs>
        </AuthenticatedContentLayout>
    </AuthenticatedLayout>
</template>
