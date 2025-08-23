<script setup lang="ts">
import LineChart from '@/components/additional/LineChart.vue';
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
                <h1>Sales forecast</h1>
                <LineChart />
                <div class="pt-8">
                    <section id="about">
                        <div class="container">
                            <div>
                                <!-- Heading -->
                                <h1 class="mb-4 section-title" data-aos="fade-down">
                                    Performance metrics
                                </h1>
                                <p class="mb-4 max-w-3xl text-gray-400" data-aos="fade-down">
                                    Insights sobre o desempenho do modelo, avaliam a sua
                                    capacidade
                                    preditiva, capacidade de generalização e qualidade geral.
                                </p>

                                <!-- About Cards Section -->
                                <div class="grid gap-2 sm:grid-cols-2 lg:grid-cols-6">
                                    <!-- Card 1 -->
                                    <div class="rounded-lg border border-gray-400 py-3 text-center">
                                        <h4 class="text-lg font-bold text-[#36AD5E]">{{ forecasts.performance.r2_score.toFixed(5) }}</h4>
                                        <p class="text-gray-500">r2 score</p>
                                    </div>
                                    <div class="rounded-lg border border-gray-400 py-3 text-center">
                                        <h4 class="text-lg font-bold text-[#36AD5E]">{{
                                            forecasts.performance.mean_absolute_error.toFixed(5) }}</h4>
                                        <p class="text-gray-500">mean absolute error</p>
                                    </div>
                                    <div class="rounded-lg border border-gray-400 p-3 text-center">
                                        <h4 class="text-lg font-bold text-[#36AD5E]">{{
                                            forecasts.performance.mean_squared_error.toFixed(5) }}</h4>
                                        <p class="text-gray-500">mean squared error</p>
                                    </div>
                                    <div class="rounded-lg border border-gray-400 p-3 text-center">
                                        <h4 class="text-lg font-bold text-[#36AD5E]">{{
                                            forecasts.performance.root_mean_squared_error.toFixed(5) }}</h4>
                                        <p class="text-gray-500">root mean squared error</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- <p>
                    {{ forecasts }}
                </p> -->
            </div>
        </div>
    </AppLayout>
</template>
