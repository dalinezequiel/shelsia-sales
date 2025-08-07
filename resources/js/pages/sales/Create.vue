<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Sales',
        href: '/sales',
    },
    {
        title: 'PDV',
        href: '/sales/Create',
    }
];
</script>
<template>

    <Head title="Products" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <section class="w-full bg-white dark:bg-[#0A2025] py-9 pl-8 pr-20">
            <div class="flex items-start mt-8 gap-6">
                <div class="bg-white p-4 w-[800px] rounded-xl">
                    <table class="w-full bg-white rounded-xl">
                        <thead>
                            <tr
                                class="text-center border-b border-gray-400 w-full text-[#7f7f7f] text-sm font-medium uppercase leading-[14px] tracking-wide">
                                <th class="text-left px-2 py-2">Product</th>
                                <th class="px-2 py-2">price</th>
                                <th class="px-2 py-2">Quantity</th>
                                <th class="px-2 py-2">Subtotal</th>
                                <th class="w-7 px-2 py-2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td class="px-2 py-2 text-left align-top">
                                    <img src="https://iili.io/3FqLBsI.png" alt="test"
                                        class="w-[100px] mr-2 inline-block h-[100px]" /><span>Green Capsicum</span>
                                </td>
                                <td class="px-2 py-2">14.00</td>
                                <td
                                    class="p-2 mt-9 bg-white rounded-[170px] border border-[#a0a0a0] justify-around items-center flex">
                                    <svg width="14" height="15" class="cursor-pointer" viewBox="0 0 14 15" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.33398 7.5H11.6673" stroke="#666666" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg><span
                                        class="w-10 text-center text-[#191919] text-base font-normal leading-normal">5</span><svg
                                        class="cursor-pointer relative" width="14" height="15" viewBox="0 0 14 15"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.33398 7.49998H11.6673M7.00065 2.83331V12.1666V2.83331Z"
                                            stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>
                                </td>
                                <td class="px-2 py-2">70.00</td>
                                <td class="px-2 py-2">
                                    <svg width="24" class="cursor-pointer" height="25" viewBox="0 0 24 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12 23.5C18.0748 23.5 23 18.5748 23 12.5C23 6.42525 18.0748 1.5 12 1.5C5.92525 1.5 1 6.42525 1 12.5C1 18.5748 5.92525 23.5 12 23.5Z"
                                            stroke="#CCCCCC" stroke-miterlimit="10"></path>
                                        <path d="M16 8.5L8 16.5" stroke="#666666" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M16 16.5L8 8.5" stroke="#666666" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </td>
                            </tr>
                            <tr class="text-center">
                                <td class="px-2 py-2 text-left align-top">
                                    <img src="https://iili.io/3FqLBsI.png" alt="test"
                                        class="w-[100px] mr-2 inline-block h-[100px]" /><span>Green Capsicum</span>
                                </td>
                                <td class="px-2 py-2">14.00</td>
                                <td
                                    class="p-2 mt-9 bg-white rounded-[170px] border border-[#a0a0a0] justify-around items-center flex">
                                    <svg width="14" height="15" class="cursor-pointer" viewBox="0 0 14 15" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.33398 7.5H11.6673" stroke="#666666" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg><span
                                        class="w-10 text-center text-[#191919] text-base font-normal leading-normal">5</span><svg
                                        class="cursor-pointer relative" width="14" height="15" viewBox="0 0 14 15"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.33398 7.49998H11.6673M7.00065 2.83331V12.1666V2.83331Z"
                                            stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>
                                </td>
                                <td class="px-2 py-2">70.00</td>
                                <td class="px-2 py-2">
                                    <svg width="24" class="cursor-pointer" height="25" viewBox="0 0 24 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12 23.5C18.0748 23.5 23 18.5748 23 12.5C23 6.42525 18.0748 1.5 12 1.5C5.92525 1.5 1 6.42525 1 12.5C1 18.5748 5.92525 23.5 12 23.5Z"
                                            stroke="#CCCCCC" stroke-miterlimit="10"></path>
                                        <path d="M16 8.5L8 16.5" stroke="#666666" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M16 16.5L8 8.5" stroke="#666666" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </td>
                            </tr>
                            <tr class="text-center">
                                <td class="px-2 py-2 text-left align-top">
                                    <img src="https://iili.io/3FqLBsI.png" alt="test"
                                        class="w-[100px] mr-2 inline-block h-[100px]" /><span>Green Capsicum</span>
                                </td>
                                <td class="px-2 py-2">14.00</td>
                                <td
                                    class="p-2 mt-9 bg-white rounded-[170px] border border-[#a0a0a0] justify-around items-center flex">
                                    <svg width="14" height="15" class="cursor-pointer" viewBox="0 0 14 15" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.33398 7.5H11.6673" stroke="#666666" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg><span
                                        class="w-10 text-center text-[#191919] text-base font-normal leading-normal">5</span><svg
                                        class="cursor-pointer relative" width="14" height="15" viewBox="0 0 14 15"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.33398 7.49998H11.6673M7.00065 2.83331V12.1666V2.83331Z"
                                            stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>
                                </td>
                                <td class="px-2 py-2">70.00</td>
                                <td class="px-2 py-2">
                                    <svg width="24" class="cursor-pointer" height="25" viewBox="0 0 24 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12 23.5C18.0748 23.5 23 18.5748 23 12.5C23 6.42525 18.0748 1.5 12 1.5C5.92525 1.5 1 6.42525 1 12.5C1 18.5748 5.92525 23.5 12 23.5Z"
                                            stroke="#CCCCCC" stroke-miterlimit="10"></path>
                                        <path d="M16 8.5L8 16.5" stroke="#666666" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M16 16.5L8 8.5" stroke="#666666" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <div class="flex items-center gap-2 mt-10">
                                <Link :href="route('sales.index')"
                                    class="px-4 py-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-900 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-arrow-left-icon lucide-arrow-left">
                                    <path d="m12 19-7-7 7-7" />
                                    <path d="M19 12H5" />
                                </svg>
                                Back</Link>

                                <Link href=""
                                    class="px-4 py-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-900 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus">
                                    <path d="M5 12h14" />
                                    <path d="M12 5v14" />
                                </svg>
                                Add Product</Link>
                            </div>
                        </tfoot>
                    </table>
                </div>
                <div class="w-[424px] bg-white rounded-lg p-6">
                    <h2 class="text-[#191919] mb-2 text-xl font-medium leading-[30px]">
                        Cart Total
                    </h2>
                    <div class="w-[376px] py-3 justify-between items-center flex">
                        <span class="text-[#4c4c4c] text-base font-normal leading-normal">Total:</span><span
                            class="text-[#191919] text-base font-semibold leading-tight">MZN 84.00</span>
                    </div>
                    <div
                        class="w-[376px] py-3 shadow-[0px_1px_0px_0px_rgba(229,229,229,1.00)] justify-between items-center flex">
                        <span class="text-[#4c4c4c] text-sm font-normal leading-[21px]">Shipping:</span><span
                            class="text-[#191919] text-sm font-medium leading-[21px]">Free</span>
                    </div>
                    <div
                        class="w-[376px] py-3 shadow-[0px_1px_0px_0px_rgba(229,229,229,1.00)] justify-between items-center flex">
                        <span class="text-[#4c4c4c] text-sm font-normal leading-[21px]">Subtotal:</span><span
                            class="text-[#191919] text-sm font-medium leading-[21px]">MZN 84.00</span>
                    </div>
                    <button
                        class="w-full cursor-pointer text-white mt-5 px-10 py-4 bg-primary rounded-[40px] gap-4 text-base font-semibold leading-tight">
                        Proceed to checkout
                    </button>
                </div>
            </div>
        </section>
    </AppLayout>
</template>