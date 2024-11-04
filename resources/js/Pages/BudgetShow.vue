<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AuthenticatedContentLayout from '@/Layouts/AuthenticatedContentLayout.vue';
import { PageProps } from '@/types/providers';

type Props = PageProps & {
    budget: any;
};

defineProps<Props>();
</script>

<template>
    <Head title="Budgets" />

    <AuthenticatedLayout>
        <AuthenticatedContentLayout>
            <p>Hey Peeps</p>
            <pre>{{ budget }}</pre>
        </AuthenticatedContentLayout>
    </AuthenticatedLayout>
</template>
