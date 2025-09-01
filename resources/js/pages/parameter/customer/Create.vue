<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import AppLayout from '@/layouts/AppLayout.vue';
import ParameterLayout from '@/pages/parameter/Layout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { toast } from 'vue-sonner';

const form = useForm({
    name: '',
    surname: '',
    gender: '',
    phone: '',
    email: '',
    address: '',
    is_active: false
});

const submit = () => {
    form.post(route('customers.store'), {
        preserveScroll: true,
        onSuccess: () => toast.success('Cliente cadastrado com sucesso.'),
        onError: () => toast.error('Ocorreu um erro ao tentar cadastrar cliente.')
    });
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Clientes',
        href: '/customers',
    },
    {
        title: 'Cadastro',
        href: '/customers/Create',
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
                                Cadastrar cliente
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="mx-4">
                    <form @submit.prevent="submit" class="space-y-6">
                        <div class="grid gap-2">
                            <Label for="name">Nome</Label>
                            <Input id="name" v-model="form.name" class="mt-1 block w-full" required autocomplete="name"
                                placeholder="Nome" />
                            <InputError :message="form.errors.name" class="mt-2" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="surname">Apelido</Label>
                            <Input id="surname" v-model="form.surname" class="mt-1 block w-full" required
                                autocomplete="surname" placeholder="Apelido" />
                            <InputError :message="form.errors.surname" class="mt-2" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="gender">Gênero</Label>
                            <Select id="gender" v-model="form.gender">
                                <SelectTrigger class="w-auto mt-1">
                                    <SelectValue placeholder="Selecionar gênero" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem value="male"> Masculino </SelectItem>
                                    <SelectItem value="female"> Feminino </SelectItem>
                                </SelectContent>
                            </Select>
                            <InputError :message="form.errors.gender" class="mt-2" />
                        </div>

                        <div class="grid lg:grid-cols-2 lg:gap-4 ">
                            <div class="grid gap-2 mb-6 lg:mb-0">
                                <Label for="phone">Telefone</Label>
                                <Input id="phone" v-model="form.phone" type="number" class="mt-1 block w-full" required
                                    autocomplete="phone" placeholder="Telefone ex: +258 xx xxxx xxx" />
                                <InputError :message="form.errors.phone" class="mt-2" />
                            </div>

                            <div class="grid gap-2">
                                <Label for="email">Email</Label>
                                <Input id="email" v-model="form.email" type="email" class="mt-1 block w-full" required
                                    autocomplete="email" placeholder="Email address" />
                                <InputError :message="form.errors.email" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid gap-2">
                            <Label for="address">Endereço</Label>
                            <Input id="address" v-model="form.address" class="mt-1 block w-full" required
                                autocomplete="username" placeholder="Endereço" />
                            <InputError :message="form.errors.address" class="mt-2" />
                        </div>

                        <div class="flex items-center space-x-2 ">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="is_active" v-model="form.is_active" class="sr-only peer">
                                <div
                                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-gray-900 dark:peer-checked:bg-blue-600">
                                </div>
                                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Situação do
                                    cliente</span>
                            </label>
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
                            Voltar</Link>
                            <Button class="cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-save-icon lucide-save">
                                    <path
                                        d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z" />
                                    <path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7" />
                                    <path d="M7 3v4a1 1 0 0 0 1 1h7" />
                                </svg>
                                Salvar</Button>
                        </div>
                    </form>
                </div>
            </div>
        </ParameterLayout>
    </AppLayout>
</template>
