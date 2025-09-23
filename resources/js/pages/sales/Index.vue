<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import { File, ShoppingBag, Trash2 } from 'lucide-vue-next';
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
import { currencyFormat, dateFormat } from '@/store';

defineProps({
    sales: {
        type: Object,
        required: true
    },
    more_less_sold: {
        type: Object,
        required: true
    }
});

const description = ref('');
const search = () => {
    router.get(route('sales.index', { description: description.value }, {
        preserveState: true,
        replace: true
    }))
}

const deleteSale = (id: number) => {
    router.delete(route('sales.destroy', id), {
        preserveScroll: true,
        onSuccess: () => toast.success('Venda excluída com sucesso.'),
        onError: () => toast.error('Ocorreu um erro ao tentar excluir venda.')
    })
}

enum Status {
    PAID = "paid",
    CANCELLED = "cancelled"
}

const form = useForm({
    sale_id: '',
    status: '',
    details: [
        { id: 0, quantity: 0 }
    ],
    can_update_stock: true
})
const updateSale = (sale_id: number, status: string, details: [{ id: number; quantity: number; }]) => {
    form.sale_id = sale_id.toString(),
        form.status = status,
        form.details = details,
        form.put(route('sales.update', { id: 0 }), {
            preserveScroll: true,
            onSuccess: () => toast.success('Venda processada com sucesso.'),
            onError: () => toast.error('Ocorreu um erro ao tentar processar venda.')
        });
};

const calculate = (subtotal: number, shipping: number, discount: number) => subtotal + shipping - discount;

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Vendas',
        href: '/sales',
    },
    {
        title: 'Lista',
        href: '/sales',
    }
];
</script>

<template>

    <Head title="Products" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="relative flex flex-col w-full h-full text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
            <div class="relative mx-4 mt-4 text-gray-700 bg-white rounded-none bg-clip-border">
                <div class="flex items-center justify-between gap-8 mb-8">
                    <div>
                        <h5
                            class="block font-sans text-lg antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                            Lista de vendas
                        </h5>
                        <p class="block mt-0 font-sans text-sm antialiased font-normal leading-relaxed text-gray-700">
                            Veja informações sobre todas as vendas
                        </p>
                    </div>
                    <div class="flex flex-col gap-2 shrink-0 sm:flex-row">

                        <AlertDialog>
                            <AlertDialogTrigger
                                class="select-none cursor-pointer rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" width="16">
                                    <path
                                        d="M256 144C256 117.5 277.5 96 304 96L336 96C362.5 96 384 117.5 384 144L384 496C384 522.5 362.5 544 336 544L304 544C277.5 544 256 522.5 256 496L256 144zM64 336C64 309.5 85.5 288 112 288L144 288C170.5 288 192 309.5 192 336L192 496C192 522.5 170.5 544 144 544L112 544C85.5 544 64 522.5 64 496L64 336zM496 160L528 160C554.5 160 576 181.5 576 208L576 496C576 522.5 554.5 544 528 544L496 544C469.5 544 448 522.5 448 496L448 208C448 181.5 469.5 160 496 160z" />
                                </svg>
                            </AlertDialogTrigger>

                            <AlertDialogContent class="px-8 min-w-152">
                                <AlertDialogHeader>
                                    <AlertDialogTitle>Estatísticas</AlertDialogTitle>
                                    <AlertDialogDescription>
                                        <div class="mb-8">
                                            <p class="py-2 text-center">Produto Mais Vendido</p>
                                            <div class="flex gap-4">
                                                <section>
                                                    <img :src="'/storage/'.concat(more_less_sold.best_selling.image)"
                                                        :alt="more_less_sold.best_selling.description"
                                                        class="object-cover h-full rounded-lg border border-gray-200 w-30" />
                                                </section>
                                                <section class="grid gap-2">
                                                    <div
                                                        class="w-full focus:outline-none p-2 rounded-md border bg-white flex flex-col  w-24">
                                                        <p class="text-md text-primary text-gray-600 font-semibold">
                                                            {{ more_less_sold.best_selling.description }}
                                                        </p>
                                                    </div>
                                                    <div class="flex gap-2">
                                                        <button
                                                            class="focus:outline-none p-2 rounded-md border bg-white flex flex-col items-center w-24">
                                                            <p class="font-medium text-primary text-md">{{
                                                                currencyFormat(more_less_sold.best_selling.subtotal) }}
                                                            </p>
                                                            <p class="text-xs text-gray-600">
                                                                Lucro bruto
                                                            </p>
                                                        </button>
                                                        <button
                                                            class="focus:outline-none p-2 rounded-md border bg-white flex flex-col items-center w-24">
                                                            <p class="font-medium text-primary text-md">{{
                                                                currencyFormat(more_less_sold.best_selling.profit_per_product)
                                                            }}</p>
                                                            <p class="text-xs text-gray-600">
                                                                Lucro líquido
                                                            </p>
                                                        </button>
                                                        <button
                                                            class="focus:outline-none p-2 rounded-md border bg-white flex flex-col items-center w-24">
                                                            <p class="font-medium text-primary text-md">{{
                                                                more_less_sold.best_selling.quantity_sold }}</p>
                                                            <p class="text-xs text-gray-600">
                                                                Unidades vendidas
                                                            </p>
                                                        </button>
                                                        <button
                                                            class="focus:outline-none p-2 rounded-md border bg-white flex flex-col items-center w-24">
                                                            <p class="font-medium text-primary text-md">{{
                                                                more_less_sold.best_selling.number_of_sales }}</p>
                                                            <p class="text-xs text-gray-600">
                                                                Número de vendas
                                                            </p>
                                                        </button>
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="py-2 text-center">Produto Menos Vendido</p>
                                            <div class="flex gap-4">
                                                <section>
                                                    <img :src="'/storage/'.concat(more_less_sold.least_sold.image)"
                                                        :alt="more_less_sold.least_sold.description"
                                                        class="object-cover h-full rounded-lg border border-gray-200 w-30" />
                                                </section>
                                                <section class="grid gap-2">
                                                    <div
                                                        class="w-full focus:outline-none p-2 rounded-md border bg-white flex flex-col  w-24">
                                                        <p class="text-md text-primary text-gray-600 font-semibold">
                                                            {{ more_less_sold.least_sold.description }}
                                                        </p>
                                                    </div>
                                                    <div class="flex gap-2">
                                                        <button
                                                            class="focus:outline-none p-2 rounded-md border bg-white flex flex-col items-center w-24">
                                                            <p class="font-medium text-primary text-md">{{
                                                                currencyFormat(more_less_sold.least_sold.subtotal) }}
                                                            </p>
                                                            <p class="text-xs text-gray-600">
                                                                Lucro bruto
                                                            </p>
                                                        </button>
                                                        <button
                                                            class="focus:outline-none p-2 rounded-md border bg-white flex flex-col items-center w-24">
                                                            <p class="font-medium text-primary text-md">{{
                                                                currencyFormat(more_less_sold.least_sold.profit_per_product)
                                                            }}</p>
                                                            <p class="text-xs text-gray-600">
                                                                Lucro líquido
                                                            </p>
                                                        </button>
                                                        <button
                                                            class="focus:outline-none p-2 rounded-md border bg-white flex flex-col items-center w-24">
                                                            <p class="font-medium text-primary text-md">{{
                                                                more_less_sold.least_sold.quantity_sold }}</p>
                                                            <p class="text-xs text-gray-600">
                                                                Unidades vendidas
                                                            </p>
                                                        </button>
                                                        <button
                                                            class="focus:outline-none p-2 rounded-md border bg-white flex flex-col items-center w-24">
                                                            <p class="font-medium text-primary text-md">{{
                                                                more_less_sold.least_sold.number_of_sales }}</p>
                                                            <p class="text-xs text-gray-600">
                                                                Número de vendas
                                                            </p>
                                                        </button>
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                    </AlertDialogDescription>
                                </AlertDialogHeader>
                                <AlertDialogFooter>
                                    <AlertDialogCancel class="cursor-pointer">Cancelar</AlertDialogCancel>
                                </AlertDialogFooter>
                            </AlertDialogContent>
                        </AlertDialog>


                        <button @click="search"
                            class="select-none cursor-pointer rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            type="button">
                            Listar
                        </button>
                        <button
                            class="flex select-none items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            type="button">
                            <Link :href="route('sales.pos')" class="flex gap-y-3 gap-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" width="16" fill="#FFFFFF">
                                <path
                                    d="M24 48C10.7 48 0 58.7 0 72C0 85.3 10.7 96 24 96L69.3 96C73.2 96 76.5 98.8 77.2 102.6L129.3 388.9C135.5 423.1 165.3 448 200.1 448L456 448C469.3 448 480 437.3 480 424C480 410.7 469.3 400 456 400L200.1 400C188.5 400 178.6 391.7 176.5 380.3L171.4 352L475 352C505.8 352 532.2 330.1 537.9 299.8L568.9 133.9C572.6 114.2 557.5 96 537.4 96L124.7 96L124.3 94C119.5 67.4 96.3 48 69.2 48L24 48zM208 576C234.5 576 256 554.5 256 528C256 501.5 234.5 480 208 480C181.5 480 160 501.5 160 528C160 554.5 181.5 576 208 576zM432 576C458.5 576 480 554.5 480 528C480 501.5 458.5 480 432 480C405.5 480 384 501.5 384 528C384 554.5 405.5 576 432 576z" />
                            </svg>
                            Aceder POS
                            </Link>
                        </button>
                    </div>
                </div>
                <div class="flex flex-col items-center justify-between gap-4 md:flex-row">
                    <div class="block w-full overflow-hidden md:w-max">
                        <nav>
                            <Tablist :list="sales" />
                        </nav>
                    </div>
                    <div class="w-full md:w-72">
                        <div class="relative h-10 w-full min-w-[200px]">
                            <div
                                class="absolute grid w-5 h-5 top-2/4 right-3 -translate-y-2/4 place-items-center text-blue-gray-500">
                                <Button @click="search" class="cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                        </path>
                                    </svg>
                                </Button>
                            </div>
                            <input v-model="description" @keyup.enter="search"
                                class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 !pr-9 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                                placeholder=" " />
                            <label
                                class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none !overflow-visible truncate text-[11px] font-normal leading-tight text-gray-500 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:!border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:!border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                Buscar
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-4 px-0 overflow-auto h-full">
                <table class="w-full mt-4 text-left table-auto min-w-max">
                    <thead>
                        <tr>
                            <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                                <p
                                    class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                    Descrição
                                </p>
                            </th>
                            <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                                <p
                                    class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                    Montante
                                </p>
                            </th>
                            <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                                <p
                                    class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                    Data da venda
                                </p>
                            </th>
                            <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                                <p
                                    class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                    Situação
                                </p>
                            </th>
                            <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                                <p
                                    class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                    Forma de pagamento
                                </p>
                            </th>
                            <th class="p-4 text-center border-y border-blue-gray-100 bg-blue-gray-50/50">
                                <p
                                    class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                    Ação
                                </p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="sale in sales.data" :key="sale.id">
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex items-center gap-3">
                                    <img :src="sale.status === 'paid' ? 'https://placehold.co/600x400/transparent/429657?text=$' : (sale.status === 'pending' ? 'https://placehold.co/600x400/transparent/BAB436?text=$' : 'https://placehold.co/600x400/transparent/F00?text=$')"
                                        class="relative inline-block h-12 w-12 !rounded-full border border-blue-gray-50 bg-blue-gray-50/50 object-contain object-center p-1" />
                                    <p
                                        class="block font-sans text-sm antialiased font-bold leading-normal text-blue-gray-900">
                                        {{ sale.description }}
                                    </p>
                                </div>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <p
                                    class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    MZN {{calculate(sale.details.reduce((acc: number, item: {
                                        price: number; quantity: number;
                                    }) => acc + item.price * item.quantity,
                                        0), Number(sale.shipping), Number(sale.discount)).toFixed(2)}}
                                </p>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <p
                                    class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    {{ dateFormat(new Date(sale.created_at)) }}
                                </p>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="w-max">
                                    <div :class="sale.status === 'paid' ? 'bg-green-500/20' : (sale.status === 'pending' ? 'bg-amber-500/20' : 'bg-red-500/20')"
                                        class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-green-900 uppercase rounded-md select-none whitespace-nowrap">
                                        <span v-if="sale.status === 'paid'" class="">Pago</span>
                                        <span v-else-if="sale.status === 'pending'"
                                            class="text-yellow-800">Pendente</span>
                                        <span v-else class="text-red-900">Cancelado</span>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p
                                            class="block font-sans text-sm antialiased font-normal leading-normal capitalize text-blue-gray-900">
                                            {{ sale.payment_method.description }}
                                        </p>
                                        <p
                                            class="block font-sans text-xs antialiased font-normal leading-normal text-blue-gray-900 opacity-70">
                                            {{ new Date(sale.created_at).toISOString().slice(0, 19) }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50 text-center">

                                <AlertDialog>
                                    <AlertDialogTrigger
                                        class="relative cursor-pointer rounded-lg text-center align-middle font-sans text-xs font-medium text-gray-900 uppercase transition-all select-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">

                                        <ShoppingBag width="18" height="18" color="#1C7005"
                                            class="hover:stroke-[#33C809]" />

                                    </AlertDialogTrigger>
                                    <AlertDialogContent class="min-w-240">
                                        <AlertDialogHeader>
                                            <AlertDialogTitle>Lista de produtos</AlertDialogTitle>
                                            <AlertDialogDescription>
                                                <section v-if="sale.details.length !== 0"
                                                    class="bg-white mx-4 my-2 dark:border-gray-700 dark:bg-gray-800 md:px-6">
                                                    <div
                                                        class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                                        <div
                                                            class="w-full min-w-0 flex-1 space-y-2 md:order-2 md:max-w-md">
                                                            <p>Descrição</p>
                                                        </div>
                                                        <div
                                                            class="flex items-center justify-between md:order-3 md:justify-end">
                                                            <div class="flex items-center">
                                                                <p>Quantidade</p>
                                                            </div>
                                                            <div class="text-end md:order-4 md:w-30">
                                                                <p>Valor Unitário</p>
                                                            </div>
                                                            <div class="text-end md:order-5 md:w-30">
                                                                <p>Valor Total</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>



                                                <section v-if="sale.details.length !== 0"
                                                    v-for="product in sale.details" :key="product.id"
                                                    class="rounded-lg border border-gray-200 bg-white mx-4 my-2 p-2 dark:border-gray-700 dark:bg-gray-800 md:px-6">
                                                    <div
                                                        class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                                        <a href="#" class="shrink-0">
                                                            <img class="h-10 dark:hidden"
                                                                :src="'/storage/'.concat(product.product.image)"
                                                                :alt="product.image" />
                                                        </a>
                                                        <div class="w-full min-w-0 flex-1 space-y-2 md:max-w-md">
                                                            <p
                                                                class="text-base font-medium text-gray-900 dark:text-white">
                                                                {{ product.product.description }}
                                                            </p>
                                                        </div>

                                                        <div class="text-end md:w-30">
                                                            <p
                                                                class="text-base font-bold text-gray-900 dark:text-white">
                                                                {{ product.quantity }}</p>
                                                        </div>
                                                        <div class="flex items-center justify-between md:justify-end">

                                                            <div class="text-end md:order-4 md:w-30">
                                                                <p
                                                                    class="text-base font-bold text-gray-900 dark:text-white">
                                                                    {{ product.price }}</p>
                                                            </div>
                                                            <div class="text-end md:order-4 md:w-30">
                                                                <p
                                                                    class="text-base font-bold text-gray-900 dark:text-white">
                                                                    {{ (product.quantity *
                                                                        product.price).toFixed(2) }}
                                                                </p>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </section>
                                                <p v-else>A lista está vazia.</p>
                                                <div class="flex flex-col mx-10">
                                                    <div class="flex gap-4">
                                                        <p>Taxa de entrega: <strong>{{ sale.shipping }}</strong></p>
                                                        <p>Cliente: <strong>{{ sale.customer_name }}</strong></p>
                                                    </div>
                                                    <p>Desconto: <strong>{{ sale.discount }}</strong></p>
                                                </div>

                                            </AlertDialogDescription>
                                        </AlertDialogHeader>
                                        <AlertDialogFooter>
                                            <AlertDialogCancel class="cursor-pointer">Cancelar</AlertDialogCancel>
                                            <AlertDialogAction v-if="sale.status === 'pending'"
                                                @click="updateSale(sale.id, Status.PAID, sale.details)"
                                                class="cursor-pointer  border border-[#475A88] bg-[#475A88] text-white shadow-2xs hover:bg-[#38476B] disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"
                                                    fill="#FFFFFF">
                                                    <path
                                                        d="M530.8 134.1C545.1 144.5 548.3 164.5 537.9 178.8L281.9 530.8C276.4 538.4 267.9 543.1 258.5 543.9C249.1 544.7 240 541.2 233.4 534.6L105.4 406.6C92.9 394.1 92.9 373.8 105.4 361.3C117.9 348.8 138.2 348.8 150.7 361.3L252.2 462.8L486.2 141.1C496.6 126.8 516.6 123.6 530.9 134z" />
                                                </svg>
                                                Pagar
                                            </AlertDialogAction>
                                            <AlertDialogAction
                                                @click="updateSale(sale.id, Status.CANCELLED, sale.details)"
                                                :disabled="sale.status === 'cancelled'"
                                                class="cursor-pointer bg-[#EC3636] hover:bg-[#D4563F]">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"
                                                    fill="#FFFFFF">
                                                    <path
                                                        d="M431.2 476.5L163.5 208.8C141.1 240.2 128 278.6 128 320C128 426 214 512 320 512C361.5 512 399.9 498.9 431.2 476.5zM476.5 431.2C498.9 399.8 512 361.4 512 320C512 214 426 128 320 128C278.5 128 240.1 141.1 208.8 163.5L476.5 431.2zM64 320C64 178.6 178.6 64 320 64C461.4 64 576 178.6 576 320C576 461.4 461.4 576 320 576C178.6 576 64 461.4 64 320z" />
                                                </svg>
                                                Cancelar Venda
                                            </AlertDialogAction>
                                        </AlertDialogFooter>
                                    </AlertDialogContent>
                                </AlertDialog>



                                <button
                                    class="relative rounded-lg text-center mx-2 align-middle font-sans text-xs font-medium text-gray-900 uppercase transition-all select-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button">
                                    <Link :href="route('sales.show', sale.id)">
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
                                                Continuar com está operação implicará a exclusão permanente<br>da
                                                venda
                                                <strong> <span class="text-[#EC3636]">{{ sale.description }}</span>
                                                </strong>.
                                            </AlertDialogDescription>
                                        </AlertDialogHeader>
                                        <AlertDialogFooter>
                                            <AlertDialogCancel class="cursor-pointer">Cancelar</AlertDialogCancel>
                                            <AlertDialogAction class="cursor-pointer bg-[#EC3636]"
                                                @click="deleteSale(sale.id)">
                                                Sim, Excluir
                                            </AlertDialogAction>
                                        </AlertDialogFooter>
                                    </AlertDialogContent>
                                </AlertDialog>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <Pagination :list="sales" />
        </div>
    </AppLayout>
</template>
