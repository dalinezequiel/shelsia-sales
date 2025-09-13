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
import { Loader } from 'lucide-vue-next';

defineProps({
    productCategories: {
        type: Object,
        required: true
    },
    suppliers: {
        type: Object,
        required: true
    },
    units: {
        type: Object,
        required: true
    }
});

const form = useForm({
    barcode: '',
    description: '',
    category: '',
    unit: '',
    supplier: '',
    purchase_price: '',
    sale_price: '',
    promotional_price: '',
    validity: '',
    minimum_stock: '',
    maximum_stock: '',
    available_stock: '',
    location: '',
    image: '',
    is_active: false
});

const submit = () => {
    form.post(route('products.store'), {
        preserveScroll: true,
        onSuccess: () => toast.success('Producto cadastrado com sucesso.'),
        onError: () => toast.error('Ocorreu um erro ao tentar cadastrar producto.')
    });
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Produtos',
        href: '/products',
    },
    {
        title: 'Cadastro',
        href: '/product/Create',
    }
];
</script>
<template>

    <Head title="Products" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="relative flex h-full lg:pr-40 w-full flex-col bg-white bg-clip-border text-gray-700">
            <div class="relative mx-4 mt-4 overflow-hidden rounded-none bg-white bg-clip-border text-gray-700">
                <div class="mb-8 flex items-center justify-between gap-8">
                    <div>
                        <h5
                            class="text-blue-gray-900 block font-sans text-lg leading-snug font-semibold tracking-normal antialiased">
                            Cadastrar Produto
                        </h5>
                    </div>
                </div>
            </div>
            <div class="mx-4">
                <form @submit.prevent="submit" enctype="multipart/form-data" class="space-y-6">
                    <div class="grid lg:grid-cols-2 lg:gap-4 ">
                        <div class="grid gap-2 mb-6 lg:mb-0">
                            <Label for="barcode">Código de barras</Label>
                            <Input id="barcode" v-model="form.barcode" type="number" class="mt-1 block w-full" required
                                autocomplete="barcode" placeholder="Código de barras" />
                            <InputError :message="form.errors.barcode" class="mt-2" />
                        </div>

                        <div class="grid gap-2 mb-6 lg:mb-0">
                            <Label for="description">Descrição</Label>
                            <Input id="description" v-model="form.description" class="mt-1 block w-full" required
                                autocomplete="description" placeholder="Descrição" />
                            <InputError :message="form.errors.description" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid lg:grid-cols-2 lg:gap-4 ">
                        <div class="grid gap-2 mb-6 lg:mb-0">
                            <Label for="category">Categoria</Label>
                            <Select id="category" v-model="form.category">
                                <SelectTrigger class="w-auto mt-1">
                                    <SelectValue placeholder="Selecionar categoria" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem v-for="productCategory in productCategories" :key="productCategory.id"
                                        :value="productCategory.description">{{ productCategory.description }}
                                    </SelectItem>
                                </SelectContent>
                            </Select>
                            <InputError :message="form.errors.category" class="mt-2" />
                        </div>

                        <div class="grid gap-2 mb-6 lg:mb-0">
                            <Label for="unit">Unidade</Label>
                            <Select id="unit" v-model="form.unit">
                                <SelectTrigger class="w-auto mt-1">
                                    <SelectValue placeholder="Selecionar unidade" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem v-for="unit in units" :key="unit.id" :value="unit.description">{{
                                        unit.description }}</SelectItem>
                                </SelectContent>
                            </Select>
                            <InputError :message="form.errors.unit" class="mt-2" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="supplier">Fornecedor</Label>
                            <Select id="supplier" v-model="form.supplier">
                                <SelectTrigger class="w-auto mt-1">
                                    <SelectValue placeholder="Selecionar fornecedor" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem v-for="supplier in suppliers" :key="supplier.id" :value="supplier.name">
                                        {{ supplier.name }}</SelectItem>
                                </SelectContent>
                            </Select>
                            <InputError :message="form.errors.supplier" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid lg:grid-cols-3 lg:gap-4 ">
                        <div class="grid gap-2 mb-6 lg:mb-0">
                            <Label for="purchase_price">Preço de compra</Label>
                            <Input id="purchase_price" v-model="form.purchase_price" type="number"
                                class="mt-1 block w-full" required placeholder="Preço de compra" />
                            <InputError :message="form.errors.purchase_price" class="mt-2" />
                        </div>

                        <div class="grid gap-2 mb-6 lg:mb-0">
                            <Label for="sale_price">Preço de venda</Label>
                            <Input id="sale_price" v-model="form.sale_price" type="number" class="mt-1 block w-full"
                                required placeholder="Preço de venda" />
                            <InputError :message="form.errors.sale_price" class="mt-2" />
                        </div>

                        <div class="grid gap-2 mb-6 lg:mb-0">
                            <Label for="promotional_price">Preço promocional</Label>
                            <Input id="promotional_price" v-model="form.promotional_price" type="number"
                                class="mt-1 block w-full" required placeholder="Preço promocional" />
                            <InputError :message="form.errors.promotional_price" class="mt-2" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="validity">Validade</Label>
                            <Input id="validity" v-model="form.validity" type="date" class="mt-1 block w-full" required
                                autocomplete="validity" placeholder="Validade" />
                            <InputError :message="form.errors.validity" class="mt-2" />
                        </div>


                        <div class="grid gap-2 mb-6 lg:mb-0">
                            <Label for="minimum_stock">Estoque minimo</Label>
                            <Input id="minimum_stock" v-model="form.minimum_stock" type="number"
                                class="mt-1 block w-full" required autocomplete="minimum_stock"
                                placeholder="Estoque minimo" />
                            <InputError :message="form.errors.minimum_stock" class="mt-2" />
                        </div>

                        <div class="grid gap-2 mb-6 lg:mb-0">
                            <Label for="maximum_stock">Estoque máximo</Label>
                            <Input id="maximum_stock" v-model="form.maximum_stock" type="number"
                                class="mt-1 block w-full" required autocomplete="maximum_stock"
                                placeholder="Estoque máximo" />
                            <InputError :message="form.errors.maximum_stock" class="mt-2" />
                        </div>

                        <div class="grid gap-2 mb-6 lg:mb-0">
                            <Label for="available_stock">Estoque disponível</Label>
                            <Input id="available_stock" v-model="form.available_stock" type="number"
                                class="mt-1 block w-full" autocomplete="available_stock"
                                placeholder="Estoque disponível" />
                            <InputError :message="form.errors.available_stock" class="mt-2" />
                        </div>

                        <div class="grid gap-2 mb-6 lg:mb-0">
                            <Label for="location">Localização</Label>
                            <Input id="location" v-model="form.location" class="mt-1 block w-full"
                                autocomplete="location" placeholder="Localização" />
                            <InputError :message="form.errors.location" class="mt-2" />
                        </div>

                        <div class="grid gap-2 mb-6 lg:mb-0">
                            <Label for="image">Imagem </Label>
                            <Input id="image" type="file" name="image" @input="form.image = $event.target.files[0]"
                                accept="image/*" class="mt-1 block w-full" />
                            <InputError :message="form.errors.image" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center space-x-2 ">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" id="is_active" v-model="form.is_active" class="sr-only peer">
                            <div
                                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-gray-900 dark:peer-checked:bg-blue-600">
                            </div>
                            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Situação do
                                produto</span>
                        </label>
                    </div>

                    <div class="flex items-center gap-2 mt-10">
                        <Link :href="route('products.index')"
                            class="px-4 py-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-900 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-arrow-left-icon lucide-arrow-left">
                            <path d="m12 19-7-7 7-7" />
                            <path d="M19 12H5" />
                        </svg>
                        Voltar</Link>
                        <Button class="cursor-pointer">
                            <Loader class="animate-spin" v-if="form.processing" />
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-save-icon lucide-save">
                                <path
                                    d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z" />
                                <path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7" />
                                <path d="M7 3v4a1 1 0 0 0 1 1h7" />
                            </svg>
                            Salvar
                        </Button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>