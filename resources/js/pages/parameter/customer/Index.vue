<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import ParameterLayout from '@/pages/parameter/Layout.vue';
import { type BreadcrumbItem } from '@/types';
import { File, Pencil, Trash2 } from 'lucide-vue-next';
import { Head, Link, router } from '@inertiajs/vue3';
import Avatar from '@/components/additional/Avatar.vue';

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
import { toast } from 'vue-sonner';
import Pagination from '@/components/additional/Pagination.vue';
import Tablist from '@/components/additional/Tablist.vue';
import { ref } from 'vue';

defineProps({
    customers: {
        type: Object,
        required: true
    }
});

const name = ref('');
const search = () => {
    router.get(route('customers.index', { name: name.value }, {
        preserveState: true,
        replace: true
    }))
};

const letter = (name: string, surname: string) => {
    const first = name.charAt(0);
    const last = surname.length === 0 ? name.charAt(name.length - 1) : surname.charAt(0)
    return first + last;
}

const deleteCustomer = (id: number) => {
    router.delete(route('customers.destroy', id), {
        preserveScroll: true,
        onSuccess: () => toast.success('Cliente excluído com sucesso.'),
        onError: () => toast.error('Ocorreu um erro ao tentar excluir cliente.')
    })
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Clientes',
        href: '/customers',
    },
    {
        title: 'Lista',
        href: '/customers',
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
                                class="text-blue-gray-900 block font-sans text-xl leading-snug font-semibold tracking-normal antialiased">
                                Lista de clientes
                            </h5>
                            <p
                                class="mt-1 block font-sans text-sm leading-relaxed font-normal text-gray-700 antialiased">
                                Veja informações sobre todos os clientes
                            </p>
                        </div>
                        <div class="flex shrink-0 flex-col gap-2 sm:flex-row">
                            <Link :href="route('customers.index')"
                                class="flex gap-y-3 gap-x-2 select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                            Listar
                            </Link>
                            <button
                                class="flex items-center gap-3 rounded-lg bg-gray-900 px-4 py-2 text-center align-middle font-sans text-xs font-bold text-white uppercase shadow-md shadow-gray-900/10 transition-all select-none hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                type="button">
                                <Link :href="route('customers.create')" class="flex gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" width="16" fill="#ffffff">
                                    <path
                                        d="M352 128C352 110.3 337.7 96 320 96C302.3 96 288 110.3 288 128L288 288L128 288C110.3 288 96 302.3 96 320C96 337.7 110.3 352 128 352L288 352L288 512C288 529.7 302.3 544 320 544C337.7 544 352 529.7 352 512L352 352L512 352C529.7 352 544 337.7 544 320C544 302.3 529.7 288 512 288L352 288L352 128z" />
                                </svg>
                                Adicionar
                                </Link>
                            </button>
                        </div>
                    </div>
                    <div class="flex flex-col items-center justify-between gap-4 md:flex-row">
                        <div class="block w-full overflow-hidden md:w-max">
                            <nav>
                                <Tablist :list="customers" />
                            </nav>
                        </div>
                        <div class="w-full md:w-72">
                            <div class="relative h-10 w-full min-w-[200px]">
                                <div
                                    class="text-blue-gray-500 absolute top-2/4 right-3 grid h-5 w-5 -translate-y-2/4 place-items-center">
                                    <Button @click="search" class="cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="h-5 w-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                            </path>
                                        </svg>
                                    </Button>
                                </div>
                                <input v-model="name" @keyup.enter="search"
                                    class="peer border-blue-gray-200 text-blue-gray-700 placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 disabled:bg-blue-gray-50 h-full w-full rounded-[7px] border border-t-transparent bg-transparent px-3 py-2.5 !pr-9 font-sans text-sm font-normal outline outline-0 transition-all placeholder-shown:border focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0"
                                    placeholder=" " />
                                <label
                                    class="before:content[' '] after:content[' '] before:border-blue-gray-200 after:border-blue-gray-200 peer-placeholder-shown:text-blue-gray-500 peer-disabled:peer-placeholder-shown:text-blue-gray-500 pointer-events-none absolute -top-1.5 left-0 flex h-full w-full truncate !overflow-visible text-[11px] leading-tight font-normal text-gray-500 transition-all select-none peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-disabled:text-transparent before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:transition-all peer-placeholder-shown:before:border-transparent peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:!border-gray-900 peer-disabled:before:border-transparent after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:transition-all peer-placeholder-shown:after:border-transparent peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:!border-gray-900 peer-disabled:after:border-transparent">
                                    Buscar
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="overflow-auto px-0 pt-6 pb-2">
                    <table class="mt-4 w-full min-w-max table-auto text-left">
                        <thead>
                            <tr>
                                <th class="border-blue-gray-100 bg-blue-gray-50/50 border-y p-4">
                                    <p
                                        class="text-blue-gray-900 block font-sans text-sm leading-none font-normal antialiased opacity-70">
                                        Nome</p>
                                </th>
                                <th class="border-blue-gray-100 bg-blue-gray-50/50 border-y p-4">
                                    <p
                                        class="text-blue-gray-900 block font-sans text-sm leading-none font-normal antialiased opacity-70">
                                        Contacto</p>
                                </th>
                                <th class="border-blue-gray-100 bg-blue-gray-50/50 border-y p-4">
                                    <p
                                        class="text-blue-gray-900 block font-sans text-sm leading-none font-normal antialiased opacity-70">
                                        Situação</p>
                                </th>
                                <th class="border-blue-gray-100 bg-blue-gray-50/50 border-y p-4">
                                    <p
                                        class="text-blue-gray-900 block font-sans text-center text-sm leading-none font-normal antialiased opacity-70">
                                        Ação</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="customer in customers.data" :key="customer.id">
                                <td class="border-blue-gray-50 border-b p-4">
                                    <div class="flex items-center gap-3">
                                        <Avatar :name="letter(customer.name, customer.surname)" />
                                        <div class="flex flex-col">
                                            <p
                                                class="text-blue-gray-900 block font-sans text-sm leading-normal font-bold antialiased">
                                                {{ customer.name }}</p>
                                            <p
                                                class="text-blue-gray-900 block font-sans text-sm leading-normal font-normal antialiased opacity-70">
                                                {{ customer.surname }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="border-blue-gray-50 border-b p-4">
                                    <div class="flex flex-col">
                                        <p
                                            class="text-blue-gray-900 block font-sans text-sm leading-normal font-normal antialiased">
                                            {{ customer.phone }}</p>
                                        <p
                                            class="text-blue-gray-900 block font-sans text-sm leading-normal font-normal antialiased opacity-70">
                                            {{ customer.email }}
                                        </p>
                                    </div>
                                </td>
                                <td class="border-blue-gray-50 border-b p-4">
                                    <div class="w-max">
                                        <div :class="customer.is_active ? 'bg-green-500/20' : 'bg-red-500/20'"
                                            class="relative grid items-center rounded-md  px-2 py-1 font-sans text-xs font-bold whitespace-nowrap text-green-900 uppercase select-none">
                                            <span v-if="customer.is_active" class="">Activo</span>
                                            <span v-else class="text-red-900">Inactivo</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="border-blue-gray-50 border-b p-4 text-center">
                                    <button
                                        class="relative rounded-lg text-center align-middle font-sans text-xs font-medium text-gray-900 uppercase transition-all select-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                        type="button">
                                        <Link :href="route('customers.edit', customer.id)">
                                        <Pencil width="18" height="18" color="#1C7005" class="hover:stroke-[#33C809]" />
                                        </Link>
                                    </button>
                                    <button
                                        class="relative rounded-lg text-center mx-2 align-middle font-sans text-xs font-medium text-gray-900 uppercase transition-all select-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                        type="button">
                                        <Link :href="route('customers.show', customer.id)">
                                        <File width="18" height="18" color="#393B3C" class="hover:stroke-[#949799]" />
                                        </Link>
                                    </button>
                                    <AlertDialog>
                                        <AlertDialogTrigger
                                            class="relative cursor-pointer rounded-lg text-center align-middle font-sans text-xs font-medium text-gray-900 uppercase transition-all select-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                            <Trash2 width="18" height="18" color="#C80909"
                                                class="transition-all hover:stroke-[#F86363]" />
                                        </AlertDialogTrigger>

                                        <AlertDialogContent>
                                            <AlertDialogHeader>
                                                <AlertDialogTitle>Confirma está exclusão?</AlertDialogTitle>
                                                <AlertDialogDescription>
                                                    Continuar com está operação implicará a exclusão permanente do/a
                                                    cliente
                                                    <strong> <span class="text-[#EC3636]">{{ customer.name }}</span>
                                                    </strong>.
                                                </AlertDialogDescription>
                                            </AlertDialogHeader>
                                            <AlertDialogFooter>
                                                <AlertDialogCancel class="cursor-pointer">Cancelar</AlertDialogCancel>
                                                <AlertDialogAction class="cursor-pointer bg-[#EC3636]"
                                                    @click="deleteCustomer(customer.id)">Sim, Excluir
                                                </AlertDialogAction>
                                            </AlertDialogFooter>
                                        </AlertDialogContent>
                                    </AlertDialog>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <Pagination :list="customers" />
            </div>
        </ParameterLayout>
    </AppLayout>
</template>
