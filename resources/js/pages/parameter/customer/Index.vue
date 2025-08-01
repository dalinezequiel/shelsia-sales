<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import ParameterLayout from '@/pages/parameter/Layout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import ParameterTable from '@/components/additional/ParameterTable.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Customers',
        href: '/customers',
    },
    {
        title: 'List',
        href: '/customers',
    },
];
</script>

<template>

    <Head title="Customer Parameters" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <ParameterLayout>
            <ParameterTable title="Customers list" subtitle="See information about all customers"
                href="/parameters/customers/create" />
        </ParameterLayout>
    </AppLayout>
</template>
