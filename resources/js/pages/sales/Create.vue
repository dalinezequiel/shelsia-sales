<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Sales',
        href: '/sales',
    },
    {
        title: 'PDV',
        href: '/sales/Create',
    }
];
</script>
<template>

    <Head title="Products" />
    <AppLayout :breadcrumbs="breadcrumbs">
    </AppLayout>
</template>