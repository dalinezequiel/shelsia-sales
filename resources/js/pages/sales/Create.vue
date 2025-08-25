<script setup lang="ts">
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
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
import { Trash2 } from 'lucide-vue-next';
import Product from '@/components/additional/Product.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Sales',
        href: '/sales',
    },
    {
        title: 'Sell',
        href: '/sales/Create',
    }
];
</script>
<template>

    <Head title="Products" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="grid grid-cols-1 gap-6 p-4">
            <div class="grid grid-cols-1 gap-2 pr-88">
                <div class="">
                    <Input id="description" class="block w-full" required autocomplete="description"
                        placeholder="Search..." />
                </div>
                <div class="grid grid-cols-4 gap-2">
                    <Product />
                    <Product />
                    <Product />
                    <Product />
                    <Product />
                    <Product />
                </div>
            </div>

            <div class="absolute right-1/46 md:col-span-1 w-full max-w-xs">
                <div class="bg-white rounded-md border border-gray-200  p-4 sm:p-6">
                    <div class="flex justify-between">
                        <h2 class="text-xl font-bold mb-4">Order Summary</h2>
                        <div class="relative w-fit">
                            <AlertDialog>
                                <AlertDialogTrigger
                                    class="relative cursor-pointer rounded-lg text-center align-middle font-sans text-xs font-medium text-gray-900 uppercase transition-all select-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">

                                    <button
                                        class="p-2 text-gray-600 cursor-pointer hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" width="20"
                                            fill="black">
                                            <path
                                                d="M24 48C10.7 48 0 58.7 0 72C0 85.3 10.7 96 24 96L69.3 96C73.2 96 76.5 98.8 77.2 102.6L129.3 388.9C135.5 423.1 165.3 448 200.1 448L456 448C469.3 448 480 437.3 480 424C480 410.7 469.3 400 456 400L200.1 400C188.5 400 178.6 391.7 176.5 380.3L171.4 352L475 352C505.8 352 532.2 330.1 537.9 299.8L568.9 133.9C572.6 114.2 557.5 96 537.4 96L124.7 96L124.3 94C119.5 67.4 96.3 48 69.2 48L24 48zM208 576C234.5 576 256 554.5 256 528C256 501.5 234.5 480 208 480C181.5 480 160 501.5 160 528C160 554.5 181.5 576 208 576zM432 576C458.5 576 480 554.5 480 528C480 501.5 458.5 480 432 480C405.5 480 384 501.5 384 528C384 554.5 405.5 576 432 576z" />
                                        </svg>
                                        <span
                                            class="absolute -top-1 -right-1 w-5 h-5 bg-indigo-600 text-white text-xs rounded-full flex items-center justify-center">0</span>
                                    </button>

                                </AlertDialogTrigger>
                                <AlertDialogContent class="min-w-240">
                                    <AlertDialogHeader>
                                        <AlertDialogTitle>Shopping Cart</AlertDialogTitle>
                                        <AlertDialogDescription>

                                            <section
                                                class="rounded-lg border border-gray-200 bg-white m-4 p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:px-6">
                                                <div
                                                    class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                                    <a href="#" class="shrink-0 md:order-1">
                                                        <img class="h-10 w-20 dark:hidden"
                                                            src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg"
                                                            alt="imac image" />
                                                        <img class="hidden h-20 w-20 dark:block"
                                                            src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg"
                                                            alt="imac image" />
                                                    </a>

                                                    <label for="counter-input" class="sr-only">Choose
                                                        quantity:</label>
                                                    <div
                                                        class="flex items-center justify-between md:order-3 md:justify-end">
                                                        <div class="flex items-center">
                                                            <button type="button" id="decrement-button"
                                                                data-input-counter-decrement="counter-input"
                                                                class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                                <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white"
                                                                    aria-hidden="true"
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 18 2">
                                                                    <path stroke="currentColor" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M1 1h16" />
                                                                </svg>
                                                            </button>
                                                            <input type="text" id="counter-input" data-input-counter
                                                                class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white"
                                                                placeholder="" value="2" required />
                                                            <button type="button" id="increment-button"
                                                                data-input-counter-increment="counter-input"
                                                                class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                                <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white"
                                                                    aria-hidden="true"
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 18 18">
                                                                    <path stroke="currentColor" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M9 1v16M1 9h16" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        <div class="text-end md:order-4 md:w-32">
                                                            <p
                                                                class="text-base font-bold text-gray-900 dark:text-white">
                                                                1,499.00</p>
                                                        </div>
                                                        <div
                                                            class="flex items-center gap-4 md:order-5 md:w-32 justify-end">

                                                            <button type="button"
                                                                class="inline-flex p-2 items-center cursor-pointer rounded-md border border-gray-200 hover:bg-[#F5F0F0] hover:border-[#F5F0F0] text-sm font-medium text-red-600 dark:text-red-500">
                                                                <Trash2 width="18" height="18" color="#C80909"
                                                                    class="transition-all" />
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <div class="w-full min-w-0 flex-1 space-y-2 md:order-2 md:max-w-md">
                                                        <p class="text-base font-medium text-gray-900 dark:text-white">
                                                            Apple M3, 24" Retina 4.5K, 8GB, SSD 256GB
                                                        </p>
                                                    </div>
                                                </div>
                                            </section>


                                        </AlertDialogDescription>
                                    </AlertDialogHeader>
                                    <AlertDialogFooter>
                                        <AlertDialogCancel class="cursor-pointer">Cancel</AlertDialogCancel>
                                        <AlertDialogAction class="cursor-pointer bg-[#212121]" @click="">
                                            Confirm
                                        </AlertDialogAction>
                                    </AlertDialogFooter>
                                </AlertDialogContent>
                            </AlertDialog>
                        </div>
                    </div>
                    <div class="grid gap-2 py-8 lg:mb-0">
                        <Label for="category">Payment Form</Label>
                        <Select id="category">
                            <SelectTrigger class="w-auto mt-1">
                                <SelectValue placeholder="Select payment form" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectItem value="Mpesa"> Mpesa </SelectItem>
                                <SelectItem value="Emola"> Emola </SelectItem>
                                <SelectItem value="Mkesh"> Debit Card </SelectItem>
                            </SelectContent>
                        </Select>
                    </div>
                    <div class="space-y-3 mb-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-medium">0.00</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Shipping</span>
                            <span class="font-medium">0.00</span>
                        </div>
                        <div x-show="discount > 0" class="flex justify-between">
                            <span>Discount</span>
                            <span class="font-medium">0.00</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Tax</span>
                            <span class="font-medium">0.00</span>
                        </div>
                        <div class="border-t py-4 mt-3">
                            <div class="flex justify-between font-bold text-lg">
                                <span>Total</span>
                                <span>0.00</span>
                            </div>
                        </div>
                    </div>
                    <button
                        class="w-full bg-indigo-600 text-white py-2 mb-2 rounded-md cursor-pointer font-medium hover:bg-indigo-700 transition flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#FFFFFF"
                            viewBox="0 0 640 640" class="mr-1">
                            <path
                                d="M256 160L256 224L384 224L384 160C384 124.7 355.3 96 320 96C284.7 96 256 124.7 256 160zM192 224L192 160C192 89.3 249.3 32 320 32C390.7 32 448 89.3 448 160L448 224C483.3 224 512 252.7 512 288L512 512C512 547.3 483.3 576 448 576L192 576C156.7 576 128 547.3 128 512L128 288C128 252.7 156.7 224 192 224z" />
                        </svg> Proceed to Checkout
                    </button>

                    <div class="flex items-center gap-2 mt-10">
                        <Link :href="route('sales.index')"
                            class="w-full px-4 py-2 inline-flex justify-center gap-x-2 text-sm font-medium rounded-lg border border-gray-100 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-arrow-left-icon lucide-arrow-left">
                            <path d="m12 19-7-7 7-7" />
                            <path d="M19 12H5" />
                        </svg>
                        Back</Link>
                        <Link :href="route('sales.index')"
                            class="w-full px-4 py-2 inline-flex justify-center gap-x-2 text-sm font-medium rounded-lg border border-gray-100 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" width="16px">
                            <path
                                d="M96 160C96 142.3 110.3 128 128 128L512 128C529.7 128 544 142.3 544 160C544 177.7 529.7 192 512 192L128 192C110.3 192 96 177.7 96 160zM96 320C96 302.3 110.3 288 128 288L512 288C529.7 288 544 302.3 544 320C544 337.7 529.7 352 512 352L128 352C110.3 352 96 337.7 96 320zM544 480C544 497.7 529.7 512 512 512L128 512C110.3 512 96 497.7 96 480C96 462.3 110.3 448 128 448L512 448C529.7 448 544 462.3 544 480z" />
                        </svg>

                        History</Link>
                    </div>
                </div>

            </div>

        </div>
    </AppLayout>
</template>