<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import ParameterLayout from '@/pages/parameter/Layout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Accounts',
        href: '/parameters/accounts',
    },
];
</script>

<template>
    <Head title="Accounts" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <ParameterLayout>
            <h1>I'm account index</h1>
        </ParameterLayout>
    </AppLayout>
</template>
