<script setup lang="ts">
import ParameterTable from '@/components/additional/ParameterTable.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import ParameterLayout from '@/pages/parameter/Layout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Suppliers',
        href: '/parameters/Suppliers',
    },
];
</script>

<template>

    <Head title="Suppliers" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <ParameterLayout>
            <ParameterTable title="Suppliers list" subtitle="See information about all suppliers" />
        </ParameterLayout>
    </AppLayout>
</template>
