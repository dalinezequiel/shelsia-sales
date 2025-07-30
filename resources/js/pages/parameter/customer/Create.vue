<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { DropdownMenu } from '@/components/ui/dropdown-menu';
import AppLayout from '@/layouts/AppLayout.vue';
import ParameterLayout from '@/pages/parameter/Layout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

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
                                Customer registration
                            </h5>
                            <p
                                class="mt-1 block font-sans text-base leading-relaxed font-normal text-gray-700 antialiased">
                                See information about all customers
                            </p>
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
                            <Label for="email">Surname</Label>
                            <Input id="email" type="email" class="mt-1 block w-full" required autocomplete="username"
                                placeholder="Surname" />
                            <InputError class="mt-2" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="gender">Gender</Label>
                            <Input id="gender" class="mt-1 block w-full" required autocomplete="name"
                                placeholder="Gender" />
                            <InputError class="mt-2" />
                        </div>
                        <div>
                            <DropdownMenu></DropdownMenu>
                        </div>

                        <div class="grid gap-2">
                            <Label for="phone">Phone</Label>
                            <Input id="phone" type="number" class="mt-1 block w-full" required autocomplete="username"
                                placeholder="Phone" />
                            <InputError class="mt-2" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="email">Email address</Label>
                            <Input id="email" type="email" class="mt-1 block w-full" required autocomplete="username"
                                placeholder="Email address" />
                            <InputError class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <Button color="red">Back</Button>
                            <Button>Save</Button>

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
