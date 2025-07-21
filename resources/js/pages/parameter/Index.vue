<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import NavParameter from '@/components/additional/NavParameter.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Parameters',
        href: '/parameters',
    },
];
</script>

<template>
    <Head title="Parameters" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <NavParameter></NavParameter>
    </AppLayout>
</template>
