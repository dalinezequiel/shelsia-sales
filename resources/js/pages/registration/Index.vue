<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../../components/PlaceholderPattern.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Registration',
        href: '/initials',
    },
];
</script>

<template>
    <Head title="Registration" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <h1>Reg. Index</h1>
    </AppLayout>
</template>
