<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

defineProps({
    forecasts: {
        type: Object,
        required: true
    }
});

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
        <div class="relative flex flex-col w-full h-full text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
            <div class="relative mx-4 mt-4 text-gray-700 bg-white rounded-none bg-clip-border">
                <h1>Predictions Index</h1>
                <p>
                    {{ forecasts }}
                </p>
            </div>
        </div>
    </AppLayout>
</template>
