<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import ParameterLayout from '@/pages/parameter/Layout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Parameters b',
        href: '/customers',
    },
];
</script>

<template>
    <Head title="Customer Parameters" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <ParameterLayout>
            <h1>I'm customer index</h1>
            <p>Check it out.</p>
        </ParameterLayout>
    </AppLayout>
</template>
