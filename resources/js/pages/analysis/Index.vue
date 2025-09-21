<script setup lang="ts">
import LineChart from '@/components/additional/LineChart.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, router } from '@inertiajs/vue3';
import Input from '@/components/ui/input/Input.vue';
import { ref } from 'vue';
import { currencyFormat } from '@/store';

const props = defineProps({
    forecasts: {
        type: Object,
        required: true
    },
    sales: {
        type: Object,
        required: true
    },
    search_period: {
        type: String,
        required: false
    }
});

const currentDate = ref(new Date());
const period = ref(props.search_period);
const frequency = ref('d');
const search = () => {
    router.get(route('analysis.index', { period: period.value, frequency: frequency.value }, {
        preserveState: true,
        replace: true
    }))
}

function printButton(elementId: string): void {
    const printContent = document.getElementById(elementId);

    if (printContent) {
        const originalContent = document.body.innerHTML;
        document.body.innerHTML = printContent.innerHTML;
        window.print();
        document.body.innerHTML = originalContent;
    } else {
        console.error(`Element with ID '${elementId}' not found.`);
    }
}


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Análises',
        href: '/analysis',
    },
    {
        title: 'Previsão',
        href: '/analysis',
    }
];
</script>

<template>

    <Head title="Previsão" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="relative flex flex-col w-full h-full text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
            <div id="printableArea" class="relative mx-4 mt-4 text-gray-700 bg-white rounded-none bg-clip-border">
                <div class="flex justify-between">
                    <section class="grid grid-cols-2 gap-2">
                        <div class="p-2 rounded-md border border-gray-200">
                            <p class="text-sm">Valor Bruto</p>
                            <p>{{ currencyFormat(sales.sum_gross_value) }}</p>
                        </div>
                        <div class="p-2 rounded-md border border-gray-200">
                            <p class="text-sm">Valor Líquido</p>
                            <p>{{ currencyFormat(sales.sum_net_value) }}</p>
                        </div>

                    </section>
                    <section class="flex gap-2">
                        <Input type="number" v-model="period" min="1" />
                        <div class="items-start">
                            <button @click="search"
                                class="flex justify-center gap-2 select-none cursor-pointer rounded-lg border border-gray-200 py-3 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 640 640">
                                    <path
                                        d="M480 272C480 317.9 465.1 360.3 440 394.7L566.6 521.4C579.1 533.9 579.1 554.2 566.6 566.7C554.1 579.2 533.8 579.2 521.3 566.7L394.7 440C360.3 465.1 317.9 480 272 480C157.1 480 64 386.9 64 272C64 157.1 157.1 64 272 64C386.9 64 480 157.1 480 272zM272 416C351.5 416 416 351.5 416 272C416 192.5 351.5 128 272 128C192.5 128 128 192.5 128 272C128 351.5 192.5 416 272 416z" />
                                </svg>
                            </button>
                        </div>

                        <div class="items-start">
                            <button @click="printButton('printableArea')"
                                class="flex justify-center gap-2 select-none cursor-pointer rounded-lg border border-gray-200 py-3 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                    <polyline points="7 10 12 15 17 10" />
                                    <line x1="12" x2="12" y1="15" y2="3" />
                                </svg>
                                PDF
                            </button>
                        </div>
                    </section>
                </div>
                <LineChart v-if="forecasts" :forecasts="forecasts.forecasts" :sales="sales.sum_per_sale" />
                <LineChart v-else />
                <div class="pt-8">
                    <div class="container">

                        <section class="w-full flex gap-12">
                            <div>
                                <h1 id="open-tickets-tabs-label" class="font-semibold block mb-1 text-md">Métricas de
                                    Desempenho
                                    <span class="font-normal text-xs text-gray-500">({{ currentDate.toDateString()
                                        }})</span>
                                </h1>
                                <div class="grid grid-cols-5 gap-2">
                                    <button
                                        class="focus:outline-none p-2 rounded-md border bg-white flex flex-col items-center w-24">
                                        <p v-if="forecasts !== null" class="font-medium text-md">{{
                                            forecasts.performance.r2_score.toString().slice(0, 7) }}</p>
                                        <p v-else="forecasts.performance" class="font-medium text-md">{{
                                            Number(0).toFixed(2) }}</p>
                                        <p class="text-xs text-gray-600">
                                            Coêficiente R2
                                        </p>
                                    </button>
                                    <button
                                        class="focus:outline-none p-2 rounded-md border bg-white flex flex-col items-center w-24">
                                        <p v-if="forecasts !== null" class="font-semibold text-md">{{
                                            forecasts.performance.mean_absolute_error.toString().slice(0, 7) }}</p>
                                        <p v-else="forecasts.performance" class="font-medium text-md">{{
                                            Number(0).toFixed(2) }}</p>
                                        <p class="text-xs text-gray-600">
                                            Erro médio absoluto
                                        </p>
                                    </button>
                                    <button
                                        class="focus:outline-none p-2 rounded-md border bg-white flex flex-col items-center w-24">
                                        <p v-if="forecasts !== null" class="font-semibold text-md">{{
                                            forecasts.performance.mean_absolute_percentage_error.toString().slice(0, 7)
                                        }}
                                        </p>
                                        <p v-else class="font-medium text-md">{{
                                            Number(0).toFixed(2) }}</p>
                                        <p class="text-xs text-gray-600">
                                            Erro percentual absoluto médio
                                        </p>
                                    </button>
                                    <button
                                        class="focus:outline-none p-2 rounded-md border bg-white flex flex-col items-center w-24">
                                        <p v-if="forecasts !== null" class="font-semibold text-md">{{
                                            forecasts.performance.mean_squared_error.toString().slice(0, 7) }}</p>
                                        <p v-else class="font-medium text-md">{{
                                            Number(0).toFixed(2) }}</p>
                                        <p class="text-xs text-gray-600">
                                            Erro quadrático médio
                                        </p>
                                    </button>
                                    <button
                                        class="focus:outline-none p-2 rounded-md border bg-white flex flex-col items-center w-24">
                                        <p v-if="forecasts !== null" class="font-semibold text-md">{{
                                            forecasts.performance.root_mean_squared_error.toString().slice(0, 7) }}</p>
                                        <p v-else class="font-medium text-md">{{
                                            Number(0).toFixed(2) }}</p>
                                        <p class="text-xs text-gray-600">
                                            Raiz do erro quadrático médio
                                        </p>
                                    </button>
                                </div>
                            </div>


                            <div>
                                <label id="ticket-statistics-tabs-label"
                                    class="font-semibold block mb-1 text-md">Estatísticas
                                    <span class="font-normal text-xs text-gray-500">({{ currentDate.toDateString()
                                    }})</span></label>
                                <div class="grid grid-cols-5 gap-2">
                                    <button
                                        class="focus:outline-none p-2 rounded-md border bg-white flex flex-col items-center w-24">
                                        <p v-if="forecasts !== null" class="font-semibold text-md">{{
                                            forecasts.statistics.count }}</p>
                                        <p v-else class="font-medium text-md">{{ 0 }}</p>
                                        <p class="text-xs text-gray-600">
                                            Total
                                        </p>
                                    </button>
                                    <button
                                        class="focus:outline-none p-2 rounded-md border bg-white flex flex-col items-center w-24">
                                        <p v-if="forecasts !== null" class="font-semibold text-md">{{
                                            forecasts.statistics.mean.toFixed(2)
                                        }}</p>
                                        <p v-else class="font-medium text-md">{{ Number(0).toFixed(2) }}</p>
                                        <p class="text-xs text-gray-600">
                                            Média
                                        </p>
                                    </button>
                                    <button
                                        class="focus:outline-none p-2 rounded-md border bg-white flex flex-col items-center w-24">
                                        <p v-if="forecasts !== null" class="font-semibold text-md">{{
                                            forecasts.statistics.std.toFixed(2)
                                        }}</p>
                                        <p v-else class="font-medium text-md">{{ Number(0).toFixed(2) }}</p>
                                        <p class="text-xs text-gray-600">
                                            Desvio padrão
                                        </p>
                                    </button>
                                    <button
                                        class="focus:outline-none p-2 rounded-md border bg-white flex flex-col items-center w-24">
                                        <p v-if="forecasts !== null" class="font-semibold text-md">{{
                                            forecasts.statistics.p25.toFixed(2)
                                        }}</p>
                                        <p v-else class="font-medium text-md">{{ Number(0).toFixed(2) }}</p>
                                        <p class="text-xs text-gray-600">
                                            Percentil 25%
                                        </p>
                                    </button>
                                    <button
                                        class="focus:outline-none p-2 rounded-md border bg-white flex flex-col items-center w-24">
                                        <p v-if="forecasts !== null" class="font-semibold text-md">{{
                                            forecasts.statistics.p50.toFixed(2)
                                        }}</p>
                                        <p v-else class="font-medium text-md">{{ Number(0).toFixed(2) }}</p>
                                        <p class="text-xs text-gray-600">
                                            Percentil 50%
                                        </p>
                                    </button>

                                    <button
                                        class="focus:outline-none p-2 rounded-md border bg-white flex flex-col items-center w-24">
                                        <p v-if="forecasts !== null" class="font-semibold text-md">{{
                                            forecasts.statistics.p75.toFixed(2)
                                        }}</p>
                                        <p v-else class="font-medium text-md">{{ Number(0).toFixed(2) }}</p>
                                        <p class="text-xs text-gray-600">
                                            Percentil 75%
                                        </p>
                                    </button>
                                    <button
                                        class="focus:outline-none p-2 rounded-md border bg-white flex flex-col items-center w-24">
                                        <p v-if="forecasts !== null" class="font-semibold text-md">{{
                                            forecasts.statistics.min.toFixed(2)
                                        }}</p>
                                        <p v-else class="font-medium text-md">{{ Number(0).toFixed(2) }}</p>
                                        <p class="text-xs text-gray-600">
                                            Mínimo
                                        </p>
                                    </button>
                                    <button
                                        class="focus:outline-none p-2 rounded-md border bg-white flex flex-col items-center w-24">
                                        <p v-if="forecasts !== null" class="font-semibold text-md">{{
                                            forecasts.statistics.max.toFixed(2)
                                        }}</p>
                                        <p v-else class="font-medium text-md">{{ Number(0).toFixed(2) }}</p>
                                        <p class="text-xs text-gray-600">
                                            Máximo
                                        </p>
                                    </button>
                                </div>
                            </div>

                        </section>
                    </div>

                </div>
            </div>
        </div>
    </AppLayout>
</template>
