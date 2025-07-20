<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import MemberTable from '@/components/additional/MemberTable.vue';

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
        <MemberTable></MemberTable>
    </AppLayout>
</template>
