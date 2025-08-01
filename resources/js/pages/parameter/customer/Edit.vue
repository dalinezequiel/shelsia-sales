<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Switch } from '@/components/ui/switch';
import AppLayout from '@/layouts/AppLayout.vue';
import ParameterLayout from '@/pages/parameter/Layout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Customers',
        href: '/customers',
    },
    {
        title: 'Update',
        href: '/customers/Edit',
    },
];
</script>

<template>

    <Head title="Customer Parameters" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <ParameterLayout>
            <div class="relative flex h-full w-full flex-col bg-white bg-clip-border text-gray-700">
                <div class="relative mx-4 mt-2 overflow-hidden rounded-none bg-white bg-clip-border text-gray-700">
                    <div class="mb-8 flex items-center justify-between gap-8">
                        <div>
                            <h5
                                class="text-blue-gray-900 block font-sans text-xl leading-snug font-semibold tracking-normal antialiased">
                                Edit Customer
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="mx-4">
                    <form class="space-y-6">
                        <div class="grid gap-2">
                            <Label for="name">Name</Label>
                            <Input id="name" class="mt-1 block w-full" required autocomplete="name"
                                placeholder="Full name" />
                            <InputError class="mt-2" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="surname">Surname</Label>
                            <Input id="surname" class="mt-1 block w-full" required autocomplete="username"
                                placeholder="Surname" />
                            <InputError class="mt-2" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="gender">Gender</Label>
                            <Select id="gender">
                                <SelectTrigger class="w-auto mt-1">
                                    <SelectValue placeholder="Select gender" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem value="male"> Male </SelectItem>
                                    <SelectItem value="female"> Female </SelectItem>
                                </SelectContent>
                            </Select>
                            <InputError class="mt-2" />
                        </div>

                        <div class="grid lg:grid-cols-2 lg:gap-4 ">
                            <div class="grid gap-2 mb-6 lg:mb-0">
                                <Label for="phone">Phone</Label>
                                <Input id="phone" type="number" class="mt-1 block w-full" required autocomplete="phone"
                                    placeholder="Phone" />
                                <InputError class="mt-2" />
                            </div>

                            <div class="grid gap-2">
                                <Label for="email">Email</Label>
                                <Input id="email" type="email" class="mt-1 block w-full" required
                                    autocomplete="username" placeholder="Email address" />
                                <InputError class="mt-2" />
                            </div>
                        </div>

                        <div class="grid gap-2">
                            <Label for="address">Address</Label>
                            <Input id="address" class="mt-1 block w-full" required autocomplete="username"
                                placeholder="Address" />
                            <InputError class="mt-2" />
                        </div>

                        <div class="flex items-center space-x-2 ">
                            <Switch id="airplane-mode" />
                            <Label for="airplane-mode">Customer status</Label>
                        </div>

                        <div class="flex items-center gap-2 mt-10">
                            <Link :href="route('customers.index')"
                                class="px-4 py-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-900 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-arrow-left-icon lucide-arrow-left">
                                <path d="m12 19-7-7 7-7" />
                                <path d="M19 12H5" />
                            </svg>
                            Back</Link>
                            <Button class="cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-rotate-ccw-icon lucide-rotate-ccw">
                                    <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                                    <path d="M3 3v5h5" />
                                </svg>
                                Edit</Button>

                            <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                                leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                                <p class="text-sm text-neutral-600">Edited.</p>
                            </Transition>
                        </div>
                    </form>
                </div>
            </div>
        </ParameterLayout>
    </AppLayout>
</template>
