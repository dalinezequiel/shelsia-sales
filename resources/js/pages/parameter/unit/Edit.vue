<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import ParameterLayout from '@/pages/parameter/Layout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { toast } from 'vue-sonner';
import { Loader } from 'lucide-vue-next';

interface Unit {
    id: number;
    description: string;
    abbreviation: string;
    observation: string;
    is_active: boolean;
}

const props = defineProps<{ unit: Unit }>();

const form = useForm({
    description: props.unit.description,
    abbreviation: props.unit.abbreviation,
    observation: props.unit.observation,
    is_active: Boolean(props.unit.is_active)
});

const submit = () => {
    form.put(route('units.update', props.unit), {
        preserveScroll: true,
        onSuccess: () => toast.success('Unidade de medida actualizada com sucesso.'),
        onError: () => toast.error('Ocorreu um erro ao tentar actualizar unidade de medida.')
    });
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Unidades',
        href: '/units',
    },
    {
        title: 'Actualização',
        href: '/units/Create',
    },
];
</script>

<template>

    <Head title="Customer Parameters" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <ParameterLayout>
            <div class="relative flex h-full w-full flex-col bg-white bg-clip-border text-gray-700">
                <div class="relative mx-4 mt-1 overflow-hidden rounded-none bg-white bg-clip-border text-gray-700">
                    <div class="mb-8 flex items-center justify-between gap-8">
                        <div>
                            <h5
                                class="text-blue-gray-900 block font-sans text-lg leading-snug font-semibold tracking-normal antialiased">
                                Unidade de Medida
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="mx-4">
                    <form @submit.prevent="submit" class="space-y-6">
                        <div class="grid gap-2">
                            <Label for="description">Descrição</Label>
                            <Input id="description" v-model="form.description" class="mt-1 block w-full"
                                autocomplete="description" placeholder="Descrição" />
                            <InputError :message="form.errors.description" class="mt-2" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="abbreviation">Abreviação</Label>
                            <Input id="abbreviation" v-model="form.abbreviation" class="mt-1 block w-full"
                                autocomplete="abbreviation" placeholder="Abreviação" />
                            <InputError :message="form.errors.abbreviation" class="mt-2" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="observation">Observação</Label>
                            <Textarea id="observation" v-model="form.observation" class="mt-1 block w-full"
                                placeholder="Observação" />
                        </div>

                        <div class="flex items-center space-x-2 ">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="is_active" v-model="form.is_active" class="sr-only peer">
                                <div
                                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-gray-900 dark:peer-checked:bg-blue-600">
                                </div>
                                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Situação da
                                    unidade de medida</span>
                            </label>
                        </div>

                        <div class="flex items-center gap-2 mt-10">
                            <Link :href="route('units.index')"
                                class="px-4 py-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-900 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-arrow-left-icon lucide-arrow-left">
                                <path d="m12 19-7-7 7-7" />
                                <path d="M19 12H5" />
                            </svg>
                            Voltar</Link>
                            <Button class="cursor-pointer">
                                <Loader class="animate-spin" v-if="form.processing" />
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-rotate-ccw-icon lucide-rotate-ccw">
                                    <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                                    <path d="M3 3v5h5" />
                                </svg>
                                Actualizar
                            </Button>
                        </div>
                    </form>
                </div>
            </div>
        </ParameterLayout>
    </AppLayout>
</template>