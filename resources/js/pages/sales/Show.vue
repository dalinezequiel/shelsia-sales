<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';


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

defineProps<{ sales: Object }>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Vendas',
        href: '/sales',
    },
    {
        title: 'Detalhes',
        href: '/sales/show',
    },
];
</script>
<template>

    <Head title="Details" />
    <AppLayout :breadcrumbs="breadcrumbs">

        <div class="sm:w-11/12 lg:w-3/4 mx-auto">
            <div class="flex flex-col p-4 sm:p-10 bg-white shadow-md rounded-xl dark:bg-neutral-800">

                <div class="flex justify-between">
                    <div>
                        <AppLogoIcon class="size-8 mt-3 fill-current text-black dark:text-black" />
                        {{ sales }}
                    </div>

                    <div class="text-end">
                        <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 dark:text-neutral-200">Invoice #
                        </h2>
                        <span class="mt-1 block text-gray-500 dark:text-neutral-500">3682303</span>

                        <address class="mt-4 not-italic text-gray-800 dark:text-neutral-200">
                            Moçambique<br>
                            Data de criação<br>
                        </address>
                    </div>

                </div>

                <div class="mt-6">
                    <div class="border border-gray-200 p-4 rounded-lg space-y-4 dark:border-neutral-700">
                        <div class="hidden sm:grid sm:grid-cols-5">
                            <div
                                class="sm:col-span-2 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Item</div>
                            <div class="text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Qty</div>
                            <div class="text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Rate</div>
                            <div class="text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Amount</div>
                        </div>

                        <div class="hidden sm:block border-b border-gray-200 dark:border-neutral-700"></div>

                        <div class="grid grid-cols-3 sm:grid-cols-5 gap-2">
                            <div class="col-span-full sm:col-span-2">
                                <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Item</h5>
                                <p class="font-medium text-gray-800 dark:text-neutral-200">Design UX and UI</p>
                            </div>
                            <div>
                                <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Qty</h5>
                                <p class="text-gray-800 dark:text-neutral-200">1</p>
                            </div>
                            <div>
                                <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Rate</h5>
                                <p class="text-gray-800 dark:text-neutral-200">5</p>
                            </div>
                            <div>
                                <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Amount</h5>
                                <p class="sm:text-end text-gray-800 dark:text-neutral-200">$500</p>
                            </div>
                        </div>

                        <div class="sm:hidden border-b border-gray-200 dark:border-neutral-700"></div>

                        <div class="grid grid-cols-3 sm:grid-cols-5 gap-2">
                            <div class="col-span-full sm:col-span-2">
                                <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Item</h5>
                                <p class="font-medium text-gray-800 dark:text-neutral-200">Web project</p>
                            </div>
                            <div>
                                <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Qty</h5>
                                <p class="text-gray-800 dark:text-neutral-200">1</p>
                            </div>
                            <div>
                                <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Rate</h5>
                                <p class="text-gray-800 dark:text-neutral-200">24</p>
                            </div>
                            <div>
                                <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Amount</h5>
                                <p class="sm:text-end text-gray-800 dark:text-neutral-200">$1250</p>
                            </div>
                        </div>

                        <div class="sm:hidden border-b border-gray-200 dark:border-neutral-700"></div>

                        <div class="grid grid-cols-3 sm:grid-cols-5 gap-2">
                            <div class="col-span-full sm:col-span-2">
                                <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Item</h5>
                                <p class="font-medium text-gray-800 dark:text-neutral-200">SEO</p>
                            </div>
                            <div>
                                <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Qty</h5>
                                <p class="text-gray-800 dark:text-neutral-200">1</p>
                            </div>
                            <div>
                                <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Rate</h5>
                                <p class="text-gray-800 dark:text-neutral-200">6</p>
                            </div>
                            <div>
                                <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Amount</h5>
                                <p class="sm:text-end text-gray-800 dark:text-neutral-200">$2000</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex sm:justify-end">
                    <div class="w-full max-w-2xl sm:text-end space-y-2">

                        <div class="grid grid-cols-2 sm:grid-cols-1 gap-3 sm:gap-2">
                            <dl class="grid sm:grid-cols-5 gap-x-3">
                                <dt class="col-span-3 text-gray-800 dark:text-neutral-200">Subtotal:
                                </dt>
                                <dd class="col-span-2 text-gray-500 dark:text-neutral-500">$2750.00</dd>
                            </dl>

                            <dl class="grid sm:grid-cols-5 gap-x-3">
                                <dt class="col-span-3 text-gray-800 dark:text-neutral-200">Taxa de Entrega:</dt>
                                <dd class="col-span-2 text-gray-500 dark:text-neutral-500">$39.00</dd>
                            </dl>

                            <dl class="grid sm:grid-cols-5 gap-x-3">
                                <dt class="col-span-3 text-gray-800 dark:text-neutral-200">Desconto:</dt>
                                <dd class="col-span-2 text-gray-500 dark:text-neutral-500">$39.00</dd>
                            </dl>

                            <dl class="grid sm:grid-cols-5 gap-x-3">
                                <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Total:</dt>
                                <dd class="col-span-2 text-gray-500 dark:text-neutral-500">$2750.00</dd>
                            </dl>

                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex cursor-pointer justify-start gap-x-3">
                <Link :href="route('sales.index')"
                    class="inline-flex items-center gap-x-2 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-800 shadow-2xs hover:bg-gray-50 focus:bg-gray-50 focus:outline-hidden disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-transparent dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-arrow-left-icon lucide-arrow-left">
                    <path d="m12 19-7-7 7-7" />
                    <path d="M19 12H5" />
                </svg>
                Voltar
                </Link>
                <Button id="printButton" @click="printButton('printableArea')" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border cursor-pointer
                    border-gray-200 bg-gray-900 text-white shadow-2xs hover:shadow-gray-900/20 disabled:opacity-50
                    disabled:pointer-events-none focus:outline-hidden dark:border-neutral-700 dark:text-neutral-300
                    dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                        <polyline points="7 10 12 15 17 10" />
                        <line x1="12" x2="12" y1="15" y2="3" />
                    </svg>
                    Exportar PDF
                </Button>
            </div>
        </div>

    </AppLayout>
</template>