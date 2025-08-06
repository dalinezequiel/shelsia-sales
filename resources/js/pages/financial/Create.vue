<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { toast } from 'vue-sonner';



const form = useForm({
    account_plan: '',
    description: '',
    category: '',
    supplier: '',
    due_date: '',
    amount: '',
    date_of_issue: '',
    document_number: '',
    occurrence: '',
    observation: '',
    is_active: false
});

const submit = () => {
    form.post(route('accounts.store'), {
        preserveScroll: true,
        onSuccess: () => toast.success('Conta cadastrado com sucesso.'),
        onError: () => toast.error('Ocorreu um erro ao tentar cadastrar conta.')
    });
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Accounts',
        href: '/accounts',
    },
    {
        title: 'Registration',
        href: '/accounts/Create',
    }
];
</script>
<template>

    <Head title="Products" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="relative flex h-full lg:pr-40 w-full flex-col bg-white bg-clip-border text-gray-700">
            <div class="relative mx-4 mt-2 overflow-hidden rounded-none bg-white bg-clip-border text-gray-700">
                <div class="mb-8 flex items-center justify-between gap-8">
                    <div>
                        <h5
                            class="text-blue-gray-900 block font-sans text-xl leading-snug font-semibold tracking-normal antialiased">
                            New Account
                        </h5>
                    </div>
                </div>
            </div>
            <div class="mx-4">
                <form @submit.prevent="submit" class="space-y-6">
                    <div class="grid lg:grid-cols-2 lg:gap-4 ">
                        <div class="grid gap-2 mb-6 lg:mb-0">
                            <Label for="account_plan">Account plan</Label>
                            <Input id="account_plan" v-model="form.account_plan" type="number" class="mt-1 block w-full"
                                required placeholder="Account plan: x-xxx-xx-x" />
                            <InputError :message="form.errors.account_plan" class="mt-2" />
                        </div>

                        <div class="grid gap-2 mb-6 lg:mb-0">
                            <Label for="description">Description</Label>
                            <Input id="description" v-model="form.description" class="mt-1 block w-full" required
                                autocomplete="description" placeholder="Description" />
                            <InputError :message="form.errors.description" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid lg:grid-cols-2 lg:gap-4 ">
                        <div class="grid gap-2 mb-6 lg:mb-0">
                            <Label for="category">Category</Label>
                            <Select id="category" v-model="form.category">
                                <SelectTrigger class="w-auto mt-1">
                                    <SelectValue placeholder="Select category" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem value="Income"> Income </SelectItem>
                                    <SelectItem value="Expense"> Expense </SelectItem>
                                </SelectContent>
                            </Select>
                            <InputError :message="form.errors.category" class="mt-2" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="supplier">Supplier</Label>
                            <Select id="supplier" v-model="form.supplier">
                                <SelectTrigger class="w-auto mt-1">
                                    <SelectValue placeholder="Select supplier" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem value="handling"> Handling Mozambique </SelectItem>
                                    <SelectItem value="wholesale"> Wholesale Zimpeto Market </SelectItem>
                                </SelectContent>
                            </Select>
                            <InputError :message="form.errors.supplier" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid lg:grid-cols-3 lg:gap-4 ">
                        <div class="grid gap-2">
                            <Label for="due_date">Due date</Label>
                            <Input id="due_date" v-model="form.due_date" type="date" class="mt-1 block w-full" required
                                placeholder="Due date" />
                            <InputError :message="form.errors.due_date" class="mt-2" />
                        </div>

                        <div class="grid gap-2 mb-6 lg:mb-0">
                            <Label for="amount">Amount</Label>
                            <Input id="amount" v-model="form.amount" type="number" class="mt-1 block w-full" required
                                placeholder="Amount" />
                            <InputError :message="form.errors.amount" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid lg:grid-cols-3 lg:gap-4 ">
                        <div class="grid gap-2">
                            <Label for="date_of_issue">Date of issue</Label>
                            <Input id="date_of_issue" v-model="form.date_of_issue" type="date" class="mt-1 block w-full"
                                required placeholder="Validity" />
                            <InputError :message="form.errors.date_of_issue" class="mt-2" />
                        </div>

                        <div class="grid gap-2 mb-6 lg:mb-0">
                            <Label for="document_number">Document number</Label>
                            <Input id="document_number" v-model="form.document_number" type="number"
                                class="mt-1 block w-full" required placeholder="Document number" />
                            <InputError :message="form.errors.document_number" class="mt-2" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="occurrence">Occurrence</Label>
                            <Select id="occurrence" v-model="form.occurrence">
                                <SelectTrigger class="w-auto mt-1">
                                    <SelectValue placeholder="Select occurrence" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem value="Monthly"> Monthly </SelectItem>
                                    <SelectItem value="Semi-Annual"> Semi-Annual </SelectItem>
                                    <SelectItem value="Annual"> Annual </SelectItem>
                                </SelectContent>
                            </Select>
                            <InputError :message="form.errors.occurrence" class="mt-2" />
                        </div>

                        <div class="grid gap-2 mb-6 lg:mb-0">
                            <Label for="observation">Observation</Label>
                            <textarea id="observation" rows="4" v-model="form.observation"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Write your observation here..."></textarea>
                            <InputError :message="form.errors.observation" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center space-x-2 ">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" id="is_active" v-model="form.is_active" class="sr-only peer">
                            <div
                                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-gray-900 dark:peer-checked:bg-blue-600">
                            </div>
                            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Account
                                status</span>
                        </label>
                    </div>

                    <div class="flex items-center gap-2 mt-10">
                        <Link :href="route('financial.index')"
                            class="px-4 py-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-900 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-arrow-left-icon lucide-arrow-left">
                            <path d="m12 19-7-7 7-7" />
                            <path d="M19 12H5" />
                        </svg>
                        Back</Link>
                        <Button class="cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-save-icon lucide-save">
                                <path
                                    d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z" />
                                <path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7" />
                                <path d="M7 3v4a1 1 0 0 0 1 1h7" />
                            </svg>
                            Save</Button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>