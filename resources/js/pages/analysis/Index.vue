<script setup lang="ts">
import LineChart from '@/components/additional/LineChart.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger,
} from '@/components/ui/alert-dialog'
import { ChartNoAxesColumn, Microchip } from 'lucide-vue-next';

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
                                    Evaluation metrics
                                </h1>
                                <p class="mb-4 max-w-3xl text-gray-400" data-aos="fade-down">
                                    Insights sobre o desempenho do modelo, avaliam a sua
                                    capacidade
                                    preditiva, capacidade de generalização e qualidade geral.
                                </p>
                                <div class="flex items-center gap-2 mt-10">
                                    <AlertDialog>
                                        <AlertDialogTrigger
                                            class="relative cursor-pointer rounded-lg text-center align-middle font-sans text-xs font-medium text-gray-900 uppercase transition-all select-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                            <button
                                                class="px-4 py-2 cursor-pointer inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-900 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                                                <Microchip />
                                                Performance
                                            </button>
                                        </AlertDialogTrigger>

                                        <AlertDialogContent>
                                            <AlertDialogHeader>
                                                <AlertDialogTitle>Performance</AlertDialogTitle>
                                                <AlertDialogDescription>
                                                    <div>
                                                        <p class="mb-4 max-w-3xl text-gray-400" data-aos="fade-down">
                                                            Essas métricas fornecem insights sobre o desempenho do
                                                            modelo e ajudam a comparar diferentes modelos ou algoritmos.
                                                        </p>
                                                    </div>

                                                    <div class="grid gap-2 sm:grid-cols-2 lg:grid-cols-2">
                                                        <div class="rounded-lg border border-gray-400 py-3 text-center">
                                                            <h4 class="text-lg font-bold text-[#36AD5E]">{{
                                                                forecasts.performance.r2_score.toFixed(5) }}</h4>
                                                            <p class="text-gray-500">r2 score</p>
                                                        </div>
                                                        <div class="rounded-lg border border-gray-400 py-3 text-center">
                                                            <h4 class="text-lg font-bold text-[#36AD5E]">{{
                                                                forecasts.performance.mean_absolute_error.toFixed(5) }}
                                                            </h4>
                                                            <p class="text-gray-500">mean absolute error</p>
                                                        </div>
                                                        <div class="rounded-lg border border-gray-400 py-3 text-center">
                                                            <h4 class="text-lg font-bold text-[#36AD5E]">{{
                                                                forecasts.performance.mean_absolute_percentage_error.toFixed(5)
                                                            }}%
                                                            </h4>
                                                            <p class="text-gray-500">mean absolute percentage error</p>
                                                        </div>
                                                        <div class="rounded-lg border border-gray-400 p-3 text-center">
                                                            <h4 class="text-lg font-bold text-[#36AD5E]">{{
                                                                forecasts.performance.mean_squared_error.toFixed(5) }}
                                                            </h4>
                                                            <p class="text-gray-500">mean squared error</p>
                                                        </div>
                                                        <div class="rounded-lg border border-gray-400 p-3 text-center">
                                                            <h4 class="text-lg font-bold text-[#36AD5E]">{{
                                                                forecasts.performance.root_mean_squared_error.toFixed(5)
                                                                }}</h4>
                                                            <p class="text-gray-500">root mean squared error</p>
                                                        </div>

                                                    </div>
                                                </AlertDialogDescription>
                                            </AlertDialogHeader>
                                            <AlertDialogFooter>
                                                <AlertDialogCancel class="cursor-pointer">Cancel</AlertDialogCancel>
                                            </AlertDialogFooter>
                                        </AlertDialogContent>
                                    </AlertDialog>

                                    <AlertDialog>
                                        <AlertDialogTrigger
                                            class="relative cursor-pointer rounded-lg text-center align-middle font-sans text-xs font-medium text-gray-900 uppercase transition-all select-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                            <button
                                                class="px-4 py-2 cursor-pointer inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-900 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                                                <ChartNoAxesColumn />
                                                Statistics
                                            </button>
                                        </AlertDialogTrigger>

                                        <AlertDialogContent>
                                            <AlertDialogHeader>
                                                <AlertDialogTitle>Statistics</AlertDialogTitle>
                                                <AlertDialogDescription>
                                                    <div>
                                                        <p class="mb-4 max-w-3xl text-gray-400" data-aos="fade-down">
                                                            Descrever e resumir conjunto de dados através de um único
                                                            valor, para facilitar a compreensão das características de
                                                            um fenómeno.
                                                        </p>
                                                    </div>

                                                    <div class="grid gap-2 sm:grid-cols-2 lg:grid-cols-3">
                                                        <div class="rounded-lg border border-gray-400 py-3 text-center">
                                                            <h4 class="text-lg font-bold text-[#36AD5E]">{{
                                                                forecasts.statistics.count }}</h4>
                                                            <p class="text-gray-500">count</p>
                                                        </div>
                                                        <div class="rounded-lg border border-gray-400 py-3 text-center">
                                                            <h4 class="text-lg font-bold text-[#36AD5E]">{{
                                                                forecasts.statistics.mean.toFixed(4) }}
                                                            </h4>
                                                            <p class="text-gray-500">mean</p>
                                                        </div>
                                                        <div class="rounded-lg border border-gray-400 py-3 text-center">
                                                            <h4 class="text-lg font-bold text-[#36AD5E]">{{
                                                                forecasts.statistics.std.toFixed(4) }}
                                                            </h4>
                                                            <p class="text-gray-500">std</p>
                                                        </div>
                                                        <div class="rounded-lg border border-gray-400 p-3 text-center">
                                                            <h4 class="text-lg font-bold text-[#36AD5E]">{{
                                                                forecasts.statistics.p25.toFixed(4)
                                                                }}</h4>
                                                            <p class="text-gray-500">p25%</p>
                                                        </div>
                                                        <div class="rounded-lg border border-gray-400 p-3 text-center">
                                                            <h4 class="text-lg font-bold text-[#36AD5E]">{{
                                                                forecasts.statistics.p50.toFixed(4)
                                                                }}</h4>
                                                            <p class="text-gray-500">p50%</p>
                                                        </div>
                                                        <div class="rounded-lg border border-gray-400 p-3 text-center">
                                                            <h4 class="text-lg font-bold text-[#36AD5E]">{{
                                                                forecasts.statistics.p75.toFixed(4)
                                                                }}</h4>
                                                            <p class="text-gray-500">p75%</p>
                                                        </div>

                                                    </div>
                                                    <div class="grid mt-2 gap-2 sm:grid-cols-2 lg:grid-cols-2">
                                                        <div
                                                            class="rounded-lg truncate overflow-hidden whitespace-nowrap border border-gray-400 p-3 text-center">
                                                            <h4 class="text-lg font-bold text-[#36AD5E]">{{
                                                                forecasts.statistics.min }}
                                                            </h4>
                                                            <p class="text-gray-500">min</p>
                                                        </div>
                                                        <div class="rounded-lg border border-gray-400 p-3 text-center">
                                                            <h4 class="text-lg font-bold text-[#36AD5E]">{{
                                                                forecasts.statistics.max
                                                                }}</h4>
                                                            <p class="text-gray-500">max</p>
                                                        </div>
                                                    </div>
                                                </AlertDialogDescription>
                                            </AlertDialogHeader>
                                            <AlertDialogFooter>
                                                <AlertDialogCancel class="cursor-pointer">Cancel</AlertDialogCancel>
                                            </AlertDialogFooter>
                                        </AlertDialogContent>
                                    </AlertDialog>
                                </div>

                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
