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
                                New Customer
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
                                class="rounded bg-[#E3E3E3] px-4 py-2 text-sm hover:bg-[#F2F2F2]">Back</Link>
                            <Button class="cursor-pointer">Save</Button>

                            <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                                leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                                <p class="text-sm text-neutral-600">Saved.</p>
                            </Transition>
                        </div>
                    </form>
                </div>
            </div>
        </ParameterLayout>
    </AppLayout>
</template>
