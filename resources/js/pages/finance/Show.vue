<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';

interface Account {
    account_plan: string;
    description: string;
    category: string;
    supplier: string;
    due_date: Date;
    amount: number;
    date_of_issue: Date;
    payment_method: string;
    period: string;
    observation: string;
    is_active: boolean;
}

const props = defineProps<{ finance: Account }>();

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
        title: 'Financeiro',
        href: '/financial',
    },
    {
        title: 'Detalhes',
        href: '/financial/Show',
    },
];
</script>
<template>

    <Head title="Details" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="px-12">
            <div id="printableArea" class="max-w-4xl overflow-hidden bg-white sm:rounded-lg">
                <div class="px-0 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Conta a {{
                        props.finance.category === 'Receitas' ? 'Pagar' : 'Receber' }}</h3>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Descrição</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ props.finance.account_plan
                            }} - {{ props.finance.description }}</dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Valor da conta</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ props.finance.amount }}
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Data de vencimento</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ props.finance.due_date }}
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Forma de pagamento</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{
                                props.finance.payment_method }}
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Categoria</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ props.finance.category ===
                                'income' ? 'Receitas' : 'Despesas' }}
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Fornecedor</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ props.finance.supplier }}
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Periodicidade</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ props.finance.period
                            }}</dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Estado da conta</dt>
                            <dd v-if="props.finance.is_active" class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                Pago</dd>
                            <dd v-else="props.financial.is_active"
                                class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">Não Pago</dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Observação</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                {{ props.finance.observation }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <div class="mt-6 flex cursor-pointer justify-start gap-x-3">
                <Link :href="route('finances.index')"
                    class="inline-flex items-center gap-x-2 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-800 shadow-2xs hover:bg-gray-50 focus:bg-gray-50 focus:outline-hidden disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-transparent dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-arrow-left-icon lucide-arrow-left">
                    <path d="m12 19-7-7 7-7" />
                    <path d="M19 12H5" />
                </svg>
                Voltar
                </Link>
                <button id="printButton" @click="printButton('printableArea')"
                    class="py-2 px-3 cursor-pointer inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-gray-900 text-white shadow-2xs hover:shadow-gray-900/20 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden  dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                    href="#">
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                        <polyline points="7 10 12 15 17 10" />
                        <line x1="12" x2="12" y1="15" y2="3" />
                    </svg>
                    Exportar PDF
                </button>
            </div>
        </div>
    </AppLayout>
</template>
