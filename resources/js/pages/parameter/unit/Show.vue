<script setup lang="ts">
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';

interface Unit {
    id: number;
    description: string;
    abbreviation: string;
    observation: string;
    is_active: boolean;
}

defineProps<{ unit: Unit }>();

const printButton = () => window.print();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Unidade',
        href: '/units',
    },
    {
        title: 'Detalhes',
        href: '/units/show',
    },
];
</script>
<template>

    <Head title="Unidades" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="px-12">
            <div id="printableArea" class="max-w-4xl overflow-hidden bg-white sm:rounded-lg">
                <div class="px-0 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Unidade de medida</h3>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Descrição</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ unit.description
                                }}</dd>
                        </div>

                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Observação</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ unit.observation
                            }}
                            </dd>
                        </div>

                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Situação</dt>
                            <dd v-if="unit.is_active" class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                Activo</dd>
                            <dd v-else class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">Inactivo</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <div class="mt-6 flex cursor-pointer justify-start gap-x-3">
                <Link :href="route('units.index')"
                    class="inline-flex items-center gap-x-2 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-800 shadow-2xs hover:bg-gray-50 focus:bg-gray-50 focus:outline-hidden disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-transparent dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-arrow-left-icon lucide-arrow-left">
                    <path d="m12 19-7-7 7-7" />
                    <path d="M19 12H5" />
                </svg>
                Voltar
                </Link>
                <Button id="printButton" @click="printButton" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border cursor-pointer
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