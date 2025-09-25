<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import AdminStat from '@/components/additional/AdminStat.vue';
import SaleStatus from '@/components/additional/SaleStatus.vue';
import FinanceStatus from '@/components/additional/FinanceStatus.vue';

defineProps({
    indicators: {
        type: Object,
        required: true
    }
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Painel',
        href: '/dashboard',
    },
];
</script>

<template>

    <Head title="Painel" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <AdminStat :indicators="indicators" />
            <FinanceStatus :indicators="indicators" />
            <SaleStatus :indicators="indicators" />
        </div>
    </AppLayout>
</template>
