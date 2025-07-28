<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import ParameterLayout from '@/pages/parameter/Layout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import ParameterTable from '@/components/additional/ParameterTable.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Customers',
        href: '/customers',
    },
];
</script>

<template>

    <Head title="Customer Parameters" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <ParameterLayout>
            <ParameterTable title="Customers list" subtitle="See information about all customers" />
        </ParameterLayout>
    </AppLayout>
</template>
