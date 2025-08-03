<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import ParameterLayout from '@/pages/parameter/Layout.vue';
import { type BreadcrumbItem } from '@/types';
import { File, Pencil, Trash2 } from 'lucide-vue-next';
import { Head, Link } from '@inertiajs/vue3';
import Avatar from '@/components/additional/Avatar.vue';

defineProps({
    customers: {
        type: Object,
        required: true
    }
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Customers',
        href: '/customers',
    },
    {
        title: 'List',
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
                                Customers list
                            </h5>
                            <p
                                class="mt-1 block font-sans text-base leading-relaxed font-normal text-gray-700 antialiased">
                                See information about all customers
                            </p>
                        </div>
                        <div class="flex shrink-0 flex-col gap-2 sm:flex-row">
                            <button
                                class="rounded-lg border border-gray-900 px-4 py-2 text-center align-middle font-sans text-xs font-bold text-gray-900 uppercase transition-all select-none hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                type="button">
                                view all
                            </button>
                            <button
                                class="flex items-center gap-3 rounded-lg bg-gray-900 px-4 py-2 text-center align-middle font-sans text-xs font-bold text-white uppercase shadow-md shadow-gray-900/10 transition-all select-none hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                type="button">
                                <Link :href="route('customers.create')" class="flex gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    aria-hidden="true" stroke-width="2" class="h-4 w-4">
                                    <path
                                        d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                    </path>
                                </svg>
                                Add Customer
                                </Link>
                            </button>
                        </div>
                    </div>
                    <div class="flex flex-col items-center justify-between gap-4 md:flex-row">
                        <div class="block w-full overflow-hidden md:w-max">
                            <nav>
                                <ul role="tablist"
                                    class="bg-gray-100 bg-opacity-60 relative flex flex-row rounded-lg p-1">
                                    <li role="tab"
                                        class="text-blue-gray-900 relative flex h-full w-full cursor-pointer items-center justify-center bg-transparent px-2 py-1 text-center font-sans text-base leading-relaxed font-normal antialiased select-none"
                                        data-value="all">
                                        <div class="z-20 text-inherit">&nbsp;&nbsp;All&nbsp;&nbsp;</div>
                                        <div class="absolute inset-0 z-10 h-full rounded-md bg-white shadow"></div>
                                    </li>
                                    <li role="tab"
                                        class="text-blue-gray-900 relative flex h-full w-full cursor-pointer items-center justify-center bg-transparent px-2 py-1 text-center font-sans text-base leading-relaxed font-normal antialiased select-none"
                                        data-value="monitored">
                                        <div class="z-20 text-inherit">&nbsp;&nbsp;Monitored&nbsp;&nbsp;</div>
                                    </li>
                                    <li role="tab"
                                        class="text-blue-gray-900 relative flex h-full w-full cursor-pointer items-center justify-center bg-transparent px-2 py-1 text-center font-sans text-base leading-relaxed font-normal antialiased select-none"
                                        data-value="unmonitored">
                                        <div class="z-20 text-inherit">&nbsp;&nbsp;Unmonitored&nbsp;&nbsp;</div>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="w-full md:w-72">
                            <div class="relative h-10 w-full min-w-[200px]">
                                <div
                                    class="text-blue-gray-500 absolute top-2/4 right-3 grid h-5 w-5 -translate-y-2/4 place-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="h-5 w-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                        </path>
                                    </svg>
                                </div>
                                <input
                                    class="peer border-blue-gray-200 text-blue-gray-700 placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 disabled:bg-blue-gray-50 h-full w-full rounded-[7px] border border-t-transparent bg-transparent px-3 py-2.5 !pr-9 font-sans text-sm font-normal outline outline-0 transition-all placeholder-shown:border focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0"
                                    placeholder=" " />
                                <label
                                    class="before:content[' '] after:content[' '] before:border-blue-gray-200 after:border-blue-gray-200 peer-placeholder-shown:text-blue-gray-500 peer-disabled:peer-placeholder-shown:text-blue-gray-500 pointer-events-none absolute -top-1.5 left-0 flex h-full w-full truncate !overflow-visible text-[11px] leading-tight font-normal text-gray-500 transition-all select-none peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-disabled:text-transparent before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:transition-all peer-placeholder-shown:before:border-transparent peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:!border-gray-900 peer-disabled:before:border-transparent after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:transition-all peer-placeholder-shown:after:border-transparent peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:!border-gray-900 peer-disabled:after:border-transparent">
                                    Search
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
                                        Member</p>
                                </th>
                                <th class="border-blue-gray-100 bg-blue-gray-50/50 border-y p-4">
                                    <p
                                        class="text-blue-gray-900 block font-sans text-sm leading-none font-normal antialiased opacity-70">
                                        Function</p>
                                </th>
                                <th class="border-blue-gray-100 bg-blue-gray-50/50 border-y p-4">
                                    <p
                                        class="text-blue-gray-900 block font-sans text-sm leading-none font-normal antialiased opacity-70">
                                        Status</p>
                                </th>
                                <th class="border-blue-gray-100 bg-blue-gray-50/50 border-y p-4">
                                    <p
                                        class="text-blue-gray-900 block font-sans text-center text-sm leading-none font-normal antialiased opacity-70">
                                        Action</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="customer in customers" :key="customer.id">
                                <td class="border-blue-gray-50 border-b p-4">
                                    <div class="flex items-center gap-3">
                                        <Avatar name="JL" />
                                        <div class="flex flex-col">
                                            <p
                                                class="text-blue-gray-900 block font-sans text-sm leading-normal font-normal antialiased">
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
                                        <div :class="customer.is_active ? 'bg-green-500/20' : 'bg-gray-200'"
                                            class="relative grid items-center rounded-md  px-2 py-1 font-sans text-xs font-bold whitespace-nowrap text-green-900 uppercase select-none">
                                            <span v-if="customer.is_active" class="">Activo</span>
                                            <span v-else class="">Inactivo</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="border-blue-gray-50 border-b p-4 text-center">
                                    <button
                                        class="relative rounded-lg text-center align-middle font-sans text-xs font-medium text-gray-900 uppercase transition-all select-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                        type="button">
                                        <Link :href="route('customers.edit', 334)">
                                        <Pencil width="18" height="18" color="#1C7005" class="hover:stroke-[#33C809]" />
                                        </Link>
                                    </button>
                                    <button
                                        class="relative rounded-lg text-center mx-2 align-middle font-sans text-xs font-medium text-gray-900 uppercase transition-all select-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                        type="button">
                                        <Link :href="route('customers.show', 305)">
                                        <File width="18" height="18" color="#393B3C" class="hover:stroke-[#949799]" />
                                        </Link>
                                    </button>
                                    <button
                                        class="relative rounded-lg text-center align-middle font-sans text-xs font-medium text-gray-900 uppercase transition-all select-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                        type="button">
                                        <Link href="">
                                        <Trash2 width="18" height="18" color="#C80909"
                                            class="transition-all hover:stroke-[#F86363]" />
                                        </Link>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="border-blue-gray-50 flex items-center justify-between p-4">
                    <p class="text-blue-gray-900 block font-sans text-sm leading-normal font-normal antialiased">Page 1
                        of 10
                    </p>
                    <div class="flex gap-2">
                        <button
                            class="rounded-lg border border-gray-900 px-4 py-2 text-center align-middle font-sans text-xs font-bold text-gray-900 uppercase transition-all select-none hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            type="button">
                            Previous
                        </button>
                        <button
                            class="rounded-lg border border-gray-900 px-4 py-2 text-center align-middle font-sans text-xs font-bold text-gray-900 uppercase transition-all select-none hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            type="button">
                            Next
                        </button>
                    </div>
                </div>
            </div>

        </ParameterLayout>
    </AppLayout>
</template>
