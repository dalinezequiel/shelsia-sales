<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Analysis',
        href: '/analysis',
    },
    {
        title: 'Prediction',
        href: '/analysis',
    }
];
</script>

<template>

    <Head title="Products" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <h1>Predictions Index</h1>
    </AppLayout>
</template>
