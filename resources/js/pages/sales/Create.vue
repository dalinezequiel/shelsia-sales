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
import { Trash2, Check } from 'lucide-vue-next';
import Product from '@/components/additional/Product.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import { store } from '@/store'
import { ref } from 'vue';
import { toast } from 'vue-sonner';

const props = defineProps({
    products: {
        type: Object,
        required: true
    },
    paymentMethods: {
        type: Object,
        required: true
    }, description: {
        type: String,
        required: false
    },
    sales: {
        type: Object,
        required: true
    },
    sale_stats: {
        type: Object,
        required: true
    }
})

interface Sale {
    discount: number;
    shipping: number;
    has_details: [{
        quantity: number;
        price: number;
    }]
}

const shipping = ref(0);
const discount = ref(0);
const total = () => {
    store.shipping = shipping.value
    store.discount = discount.value
}

const description = ref(props.description);
const search = () => {
    router.get(route('sales.pos', { description: description.value }, {
        preserveState: true,
        replace: true
    }))
}

const totalPerReservation = (subtotal: number, shipping: number, discount: number) =>
    subtotal + shipping - discount;

const totalByStatus = (shipping: number, discount: number,
    details: [{ quantity: number, price: number }]) => {
    const subtotal = details.reduce((acc: number, item) => acc + item.price * item.quantity, 0)
    const total = subtotal + Number(shipping) - Number(discount);
    return total;
}

const form = useForm({
    customer_name: 'Consumidor final',
    discount: 0.0,
    shipping: 0.0,
    payment_method: '',
    details: [{
        price: 0.0,
        quantity: 0.0
    }],
    status: 'paid'
});

const submit = () => {
    form.discount = discount.value
    form.shipping = shipping.value
    form.details = store.items.map(item => ({
        product_id: item.id.toString(),
        price: item.price,
        quantity: item.quantity
    }));

    store.items = [];

    form.post(route('sales.store'), {
        preserveScroll: true,
        onSuccess: () => toast.success('Venda realizada com sucesso.'),
        onError: () => toast.error('Ocorreu um erro ao tentar realizar venda.')
    });
};

const reservation = () => {
    form.status = 'pending';
    submit();
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Vendas',
        href: '/sales',
    },
    {
        title: 'Caixa',
        href: '/sales/Create',
    }
];
</script>
<template>

    <Head title="Products" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="grid grid-cols-1 gap-6 p-4">
            <div class="grid grid-cols-1 gap-2 pr-88">
                <div class="relative h-10 w-full min-w-[200px]">
                    <div
                        class="absolute grid w-5 h-5 top-2/4 right-3 -translate-y-2/4 place-items-center text-blue-gray-500">
                        <Button @click="search" class="cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                </path>
                            </svg>
                        </Button>
                    </div>
                    <Input v-model="description" @keyup.enter="search"
                        class="rounded-lg h-full w-full font-sans text-sm " placeholder="Buscar..." />
                </div>
                <div class="grid grid-cols-4 pt-1 gap-2">
                    <Product v-for="product in products" :key="product.id" :product="product" />
                </div>
            </div>

            <div class="absolute right-1/46 md:col-span-1 w-full max-w-xs">
                <div class="bg-white rounded-md border border-gray-200  p-4 sm:p-6">
                    <div class="flex justify-between">
                        <h2 class="text-lg font-bold mb-4">Resumo do Pedido</h2>
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
                                            class="absolute -top-1 -right-1 w-5 h-5 bg-indigo-600 text-white text-xs rounded-full flex items-center justify-center">{{
                                                store.items.length }}</span>
                                    </button>

                                </AlertDialogTrigger>
                                <AlertDialogContent class="min-w-240">
                                    <AlertDialogHeader>
                                        <AlertDialogTitle>Carrinho de compras</AlertDialogTitle>
                                        <AlertDialogDescription>
                                            <section v-if="store.items.length !== 0"
                                                class="bg-white mx-4 my-2 dark:border-gray-700 dark:bg-gray-800 md:px-6">
                                                <div
                                                    class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                                    <div class="w-full min-w-0 flex-1 space-y-2 md:order-2 md:max-w-md">
                                                        <p>Produto</p>
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
                                                        <div
                                                            class="flex items-center gap-4 md:order-6 md:w-30 justify-end">
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>



                                            <section v-if="store.items.length !== 0" v-for="product in store.items"
                                                :key="product.id"
                                                class="rounded-lg border border-gray-200 bg-white mx-4 my-2 p-2 dark:border-gray-700 dark:bg-gray-800 md:px-6">
                                                <div
                                                    class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                                    <a href="#" class="shrink-0 md:order-1">
                                                        <img class="h-10 dark:hidden"
                                                            :src="'/storage/'.concat(product.image)"
                                                            :alt="product.image" />
                                                    </a>

                                                    <div class="w-full min-w-0 flex-1 space-y-2 md:order-2 md:max-w-md">
                                                        <p class="text-base font-medium text-gray-900 dark:text-white">
                                                            {{ product.name }}
                                                        </p>
                                                    </div>

                                                    <label for="counter-input" class="sr-only">Choose
                                                        quantity:</label>
                                                    <div
                                                        class="flex items-center justify-between md:order-3 md:justify-end">
                                                        <div class="flex items-center">
                                                            <button type="button" id="decrement-button"
                                                                @click="store.decrement(product.id)"
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
                                                                placeholder="" v-model="product.quantity" required />
                                                            <button type="button" id="increment-button"
                                                                @click="store.increment(product.id)"
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
                                                        <div class="text-end md:order-4 md:w-30">
                                                            <p
                                                                class="text-base font-bold text-gray-900 dark:text-white">
                                                                {{ product.price }}</p>
                                                        </div>
                                                        <div class="text-end md:order-5 md:w-30">
                                                            <p
                                                                class="text-base font-bold text-gray-900 dark:text-white">
                                                                {{ product.total.toFixed(2) }}</p>
                                                        </div>
                                                        <div
                                                            class="flex items-center gap-4 md:order-6 md:w-30 justify-end">

                                                            <button type="button" @click="store.delete(product.id)"
                                                                class="inline-flex p-2 items-center cursor-pointer rounded-md border border-gray-200 hover:bg-[#F5F0F0] hover:border-[#F5F0F0] text-sm font-medium text-red-600 dark:text-red-500">
                                                                <Trash2 width="18" height="18" color="#C80909"
                                                                    class="transition-all" />
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                            <p v-else>Seu carrinho está vazio.</p>


                                        </AlertDialogDescription>
                                    </AlertDialogHeader>
                                    <AlertDialogFooter>
                                        <AlertDialogCancel class="cursor-pointer">Cancelar</AlertDialogCancel>
                                        <AlertDialogAction class="cursor-pointer bg-[#212121]" @click="reservation">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"
                                                fill="#FFFFFF">
                                                <path
                                                    d="M176 96C149.5 96 128 117.5 128 144L128 496C128 522.5 149.5 544 176 544L240 544C266.5 544 288 522.5 288 496L288 144C288 117.5 266.5 96 240 96L176 96zM400 96C373.5 96 352 117.5 352 144L352 496C352 522.5 373.5 544 400 544L464 544C490.5 544 512 522.5 512 496L512 144C512 117.5 490.5 96 464 96L400 96z" />
                                            </svg>
                                            Reservar
                                        </AlertDialogAction>
                                    </AlertDialogFooter>
                                </AlertDialogContent>
                            </AlertDialog>
                        </div>
                    </div>
                    <form @submit.prevent="submit">
                        <div class="py-8 ">
                            <div class="grid gap-2 pb-4 lg:mb-0">
                                <Label for="payment_method">Forma de pagamento</Label>
                                <Select id="payment_method" v-model="form.payment_method" required>
                                    <SelectTrigger class="w-auto">
                                        <SelectValue placeholder="Selecionar forma de pagamento" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectItem v-for="paymentMethod in paymentMethods" :key="paymentMethod.id"
                                            :value="paymentMethod.description">{{ paymentMethod.description }}
                                        </SelectItem>
                                    </SelectContent>
                                </Select>
                            </div>
                            <div class="grid gap-2 pb-4 lg:mb-0">
                                <Label for="customer_name">Cliente</Label>
                                <Input id="customer_name" class="block w-full" v-model="form.customer_name"
                                    placeholder="Nome do cliente" />
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="grid gap-2 lg:mb-0">
                                    <Label for="shipping">Taxa de entrega</Label>
                                    <Input id="shipping" type="number" v-model="shipping" @input="total()"
                                        class="block w-full" placeholder="Taxa de entrega" />
                                </div>
                                <div class="grid gap-2 lg:mb-0">
                                    <Label for="discount">Desconto total</Label>
                                    <Input id="discount" type="number" v-model="discount" @input="total()"
                                        class="block w-full" placeholder="Desconto total" />
                                </div>
                            </div>
                        </div>
                        <div class="space-y-3 mb-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-medium">{{ store.subtotal().toFixed(2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Taxa de entrega</span>
                                <span class="font-medium">{{ shipping.toFixed(2) }}</span>
                            </div>
                            <div x-show="discount > 0" class="flex justify-between">
                                <span>Desconto total</span>
                                <span class="font-medium">{{ discount.toFixed(2) }}</span>
                            </div>
                            <div class="border-t py-2 mt-3">
                                <div class="flex justify-between font-bold text-lg">
                                    <span>Total</span>
                                    <span>{{ store.total().toFixed(2) }}</span>
                                </div>
                            </div>
                        </div>


                        <button
                            class="w-full bg-indigo-600 text-white py-2 mb-2 gap-x-2 rounded-md cursor-pointer font-medium hover:bg-indigo-700 transition flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="#FFFFFF" viewBox="0 0 640 640">
                                <path
                                    d="M256 160L256 224L384 224L384 160C384 124.7 355.3 96 320 96C284.7 96 256 124.7 256 160zM192 224L192 160C192 89.3 249.3 32 320 32C390.7 32 448 89.3 448 160L448 224C483.3 224 512 252.7 512 288L512 512C512 547.3 483.3 576 448 576L192 576C156.7 576 128 547.3 128 512L128 288C128 252.7 156.7 224 192 224z" />
                            </svg> Finalizar a Venda
                        </button>

                        <AlertDialog>
                            <AlertDialogTrigger
                                class="w-full py-2 inline-flex cursor-pointer justify-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" width="18">
                                    <path
                                        d="M272 112C272 85.5 293.5 64 320 64C346.5 64 368 85.5 368 112C368 138.5 346.5 160 320 160C293.5 160 272 138.5 272 112zM272 528C272 501.5 293.5 480 320 480C346.5 480 368 501.5 368 528C368 554.5 346.5 576 320 576C293.5 576 272 554.5 272 528zM112 272C138.5 272 160 293.5 160 320C160 346.5 138.5 368 112 368C85.5 368 64 346.5 64 320C64 293.5 85.5 272 112 272zM480 320C480 293.5 501.5 272 528 272C554.5 272 576 293.5 576 320C576 346.5 554.5 368 528 368C501.5 368 480 346.5 480 320zM139 433.1C157.8 414.3 188.1 414.3 206.9 433.1C225.7 451.9 225.7 482.2 206.9 501C188.1 519.8 157.8 519.8 139 501C120.2 482.2 120.2 451.9 139 433.1zM139 139C157.8 120.2 188.1 120.2 206.9 139C225.7 157.8 225.7 188.1 206.9 206.9C188.1 225.7 157.8 225.7 139 206.9C120.2 188.1 120.2 157.8 139 139zM501 433.1C519.8 451.9 519.8 482.2 501 501C482.2 519.8 451.9 519.8 433.1 501C414.3 482.2 414.3 451.9 433.1 433.1C451.9 414.3 482.2 414.3 501 433.1z" />
                                </svg>
                                Vendas Reservadas
                            </AlertDialogTrigger>

                            <AlertDialogContent class="min-w-240">
                                <AlertDialogHeader>
                                    <AlertDialogTitle>Vendas Reservadas</AlertDialogTitle>
                                    <AlertDialogDescription>

                                        <section v-if="sales.length !== 0"
                                            class="bg-white mx-4 my-2 dark:border-gray-700 dark:bg-gray-800 md:px-6">
                                            <div
                                                class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                                <div class="w-full min-w-0 flex-1 space-y-2 md:order-2 md:max-w-md">
                                                    <p>Descrição da venda</p>
                                                </div>
                                                <div
                                                    class="flex items-center justify-between md:order-3 md:justify-end">
                                                    <div class="flex items-center md:w-60">
                                                        <p>Cliente</p>
                                                    </div>
                                                    <div class="md:order-4 md:w-40">
                                                        <p>Forma de pagamento</p>
                                                    </div>
                                                    <div class="text-end md:order-5 md:w-30">
                                                        <p>Valor Total</p>
                                                    </div>
                                                    <div class="flex items-center gap-4 md:order-6 md:w-30 justify-end">
                                                    </div>
                                                </div>
                                            </div>
                                        </section>


                                        <section v-if="sales.length !== 0" v-for="sale in sales" :key="sale.id"
                                            class="rounded-lg border border-gray-200 bg-white mx-4 my-2 p-2 dark:border-gray-700 dark:bg-gray-800 md:px-6">
                                            <div
                                                class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">

                                                <div class="w-full min-w-0 flex-1 space-y-2 md:order-2 md:max-w-md">
                                                    <p class="text-base font-medium text-gray-900 dark:text-white">
                                                        {{ sale.description }}
                                                    </p>
                                                </div>

                                                <div
                                                    class="flex items-center justify-between md:order-3 md:justify-end">
                                                    <div class=" md:order-4 md:w-60">
                                                        <p class="text-base font-bold text-gray-900 dark:text-white">
                                                            {{ sale.customer_name }}</p>
                                                    </div>
                                                    <div class=" md:order-4 md:w-40">
                                                        <p class="text-base font-bold text-gray-900 dark:text-white">
                                                            {{ sale.payment_method }}</p>
                                                    </div>
                                                    <div class="text-end md:order-5 md:w-30">
                                                        <p class="text-base font-bold text-gray-900 dark:text-white">
                                                            {{totalPerReservation(sale.has_details.reduce((acc: number,
                                                                item:
                                                                    {
                                                                        price: number; quantity: number;
                                                                    }) => acc + item.price * item.quantity,
                                                                0), Number(sale.shipping),
                                                                Number(sale.discount)).toFixed(2)}}</p>
                                                    </div>
                                                    <div class="flex items-center gap-2 md:order-6 md:w-30 justify-end">
                                                        <button type="button" @click="store.delete(sale.id)"
                                                            class="inline-flex p-2 items-center cursor-pointer rounded-md border border-gray-200 hover:bg-[#EFF2F5] hover:border-[#EFF2F5] text-sm font-medium text-red-600 dark:text-red-500">
                                                            <Check width="18" height="18" color="#3560BD"
                                                                class="transition-all" />
                                                        </button>

                                                        <button type="button" @click="store.delete(sale.id)"
                                                            class="inline-flex p-2 items-center cursor-pointer rounded-md border border-gray-200 hover:bg-[#F5F0F0] hover:border-[#F5F0F0] text-sm font-medium text-red-600 dark:text-red-500">
                                                            <Trash2 width="18" height="18" color="#C80909"
                                                                class="transition-all" />
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <p v-else>Nenhuma venda está reservada.</p>


                                    </AlertDialogDescription>
                                </AlertDialogHeader>
                                <AlertDialogFooter>
                                    <AlertDialogCancel class="cursor-pointer">Cancelar</AlertDialogCancel>
                                </AlertDialogFooter>
                            </AlertDialogContent>
                        </AlertDialog>


                        <div class="flex items-center gap-2 mt-4">
                            <Link :href="route('sales.index')"
                                class="w-full px-4 py-2 inline-flex justify-center gap-x-2 text-sm font-medium rounded-lg border border-gray-100 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-arrow-left-icon lucide-arrow-left">
                                <path d="m12 19-7-7 7-7" />
                                <path d="M19 12H5" />
                            </svg>
                            Voltar</Link>

                            <AlertDialog>
                                <AlertDialogTrigger
                                    class="w-full px-4 py-2 inline-flex justify-center cursor-pointer gap-x-2 text-sm font-medium rounded-lg border border-gray-100 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" width="16px">
                                        <path
                                            d="M96 160C96 142.3 110.3 128 128 128L512 128C529.7 128 544 142.3 544 160C544 177.7 529.7 192 512 192L128 192C110.3 192 96 177.7 96 160zM96 320C96 302.3 110.3 288 128 288L512 288C529.7 288 544 302.3 544 320C544 337.7 529.7 352 512 352L128 352C110.3 352 96 337.7 96 320zM544 480C544 497.7 529.7 512 512 512L128 512C110.3 512 96 497.7 96 480C96 462.3 110.3 448 128 448L512 448C529.7 448 544 462.3 544 480z" />
                                    </svg>
                                    Balanço
                                </AlertDialogTrigger>

                                <AlertDialogContent>
                                    <AlertDialogHeader>
                                        <AlertDialogTitle>Balanço Diário</AlertDialogTitle>
                                        <AlertDialogDescription>

                                            <div>

                                                <div
                                                    class="w-full justify-between min-w-0 flex text-center  rounded-lg border border-gray-200 bg-white my-2 p-2 dark:border-gray-700 dark:bg-gray-800 md:px-3">
                                                    <p class="flex gap-1 font-bold text-gray-900 dark:text-white">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"
                                                            width="18">
                                                            <path
                                                                d="M530.8 134.1C545.1 144.5 548.3 164.5 537.9 178.8L281.9 530.8C276.4 538.4 267.9 543.1 258.5 543.9C249.1 544.7 240 541.2 233.4 534.6L105.4 406.6C92.9 394.1 92.9 373.8 105.4 361.3C117.9 348.8 138.2 348.8 150.7 361.3L252.2 462.8L486.2 141.1C496.6 126.8 516.6 123.6 530.9 134z" />
                                                        </svg>
                                                        Pago ({{ sale_stats.paid.total }})
                                                    </p>

                                                    <p v-if="sale_stats.paid.items.length !== 0"
                                                        class="font-bold text-gray-900">
                                                        {{sale_stats.paid.items.map((sale: Sale) =>
                                                            totalByStatus(sale.shipping, sale.discount,
                                                                sale.has_details)).reduce((acc: number, subtotal: number) => acc
                                                                    + subtotal, 0).toFixed(2)}}
                                                    </p>
                                                    <p v-else class="font-bold text-gray-900">0.00</p>

                                                </div>
                                                <div
                                                    class="w-full justify-between min-w-0 flex text-center  rounded-lg border border-gray-200 bg-white my-2 p-2 dark:border-gray-700 dark:bg-gray-800 md:px-3">
                                                    <p class="flex gap-1 font-bold text-gray-900 dark:text-white">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"
                                                            width="18">
                                                            <path
                                                                d="M431.2 476.5L163.5 208.8C141.1 240.2 128 278.6 128 320C128 426 214 512 320 512C361.5 512 399.9 498.9 431.2 476.5zM476.5 431.2C498.9 399.8 512 361.4 512 320C512 214 426 128 320 128C278.5 128 240.1 141.1 208.8 163.5L476.5 431.2zM64 320C64 178.6 178.6 64 320 64C461.4 64 576 178.6 576 320C576 461.4 461.4 576 320 576C178.6 576 64 461.4 64 320z" />
                                                        </svg>
                                                        Pendente ({{ sale_stats.pending.total }})
                                                    </p>

                                                    <p v-if="sale_stats.pending.items.length !== 0"
                                                        class="font-bold text-gray-900">
                                                        {{sale_stats.pending.items.map((sale: Sale) =>
                                                            totalByStatus(sale.shipping, sale.discount,
                                                                sale.has_details)).reduce((acc: number, subtotal: number) => acc
                                                                    + subtotal, 0).toFixed(2)}}
                                                    </p>
                                                    <p v-else class="font-bold text-gray-900">0.00</p>

                                                </div>
                                                <div
                                                    class="w-full justify-between min-w-0 flex text-center  rounded-lg border border-gray-200 bg-white mt-2 p-2 dark:border-gray-700 dark:bg-gray-800 md:px-3">
                                                    <p class="flex gap-1 font-bold text-gray-900 dark:text-white">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"
                                                            width="18">
                                                            <path
                                                                d="M183.1 137.4C170.6 124.9 150.3 124.9 137.8 137.4C125.3 149.9 125.3 170.2 137.8 182.7L275.2 320L137.9 457.4C125.4 469.9 125.4 490.2 137.9 502.7C150.4 515.2 170.7 515.2 183.2 502.7L320.5 365.3L457.9 502.6C470.4 515.1 490.7 515.1 503.2 502.6C515.7 490.1 515.7 469.8 503.2 457.3L365.8 320L503.1 182.6C515.6 170.1 515.6 149.8 503.1 137.3C490.6 124.8 470.3 124.8 457.8 137.3L320.5 274.7L183.1 137.4z" />
                                                        </svg>
                                                        Cancelado ({{ sale_stats.cancelled.total }})
                                                    </p>

                                                    <p v-if="sale_stats.cancelled.items.length !== 0"
                                                        class="font-bold text-gray-900">
                                                        {{sale_stats.cancelled.items.map((sale: Sale) =>
                                                            totalByStatus(sale.shipping, sale.discount,
                                                                sale.has_details)).reduce((acc: number, subtotal: number) => acc
                                                                    + subtotal, 0).toFixed(2)}}
                                                    </p>
                                                    <p v-else class="font-bold text-gray-900">0.00</p>
                                                </div>

                                            </div>

                                        </AlertDialogDescription>
                                    </AlertDialogHeader>
                                    <AlertDialogFooter>
                                        <AlertDialogCancel class="cursor-pointer">Cancelar</AlertDialogCancel>
                                    </AlertDialogFooter>
                                </AlertDialogContent>
                            </AlertDialog>

                        </div>
                    </form>
                </div>

            </div>

        </div>
    </AppLayout>
</template>