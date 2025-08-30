<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router } from '@inertiajs/vue3';
import { File, Pencil, Trash2 } from 'lucide-vue-next';
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
import { computed, ref } from 'vue';

const props = defineProps({
    products: {
        type: Object,
        required: true
    }
});

const newLinks = computed(() => {
    const length: number = props.products.links.length;
    return props.products.links.slice(1, length == 0 ? 0 : length - 1);
})

const deleteProduct = (id: number) => {
    router.delete(route('products.destroy', id), {
        preserveScroll: true,
        onSuccess: () => toast.success('Producto excluído com sucesso.'),
        onError: () => toast.error('Ocorreu um erro ao tentar excluir producto.')
    })
}

const handleUpload = ref('');
const form = new FormData();

const upload = (id: number, delete_photo: string) => {
    form.append('id', id.toString());
    form.append('deletePhoto', delete_photo);
    form.append('newPhoto', handleUpload.value);

    router.post('products/photo', form), {
        preserveScroll: true
    }
}
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Products',
        href: '/products',
    },
    {
        title: 'List',
        href: '/products',
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
                            class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                            Product list
                        </h5>
                        <p class="block mt-1 font-sans text-base antialiased font-normal leading-relaxed text-gray-700">
                            See information about all products
                        </p>
                    </div>
                    <div class="flex flex-col gap-2 shrink-0 sm:flex-row">
                        <button
                            class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            type="button">
                            view all
                        </button>
                        <button
                            class="flex select-none items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            type="button">
                            <Link :href="route('products.create')" class="flex gap-y-3 gap-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                aria-hidden="true" stroke-width="2" class="w-4 h-4">
                                <path
                                    d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                </path>
                            </svg>
                            Add product
                            </Link>
                        </button>
                    </div>
                </div>
                <div class="flex flex-col items-center justify-between gap-4 md:flex-row">
                    <div class="block w-full overflow-hidden md:w-max">
                        <nav>
                            <ul role="tablist"
                                class="relative flex flex-row p-1 rounded-lg bg-blue-gray-50 bg-opacity-60">
                                <li role="tab"
                                    class="relative flex items-center justify-center w-full h-full px-2 py-1 font-sans text-base antialiased font-normal leading-relaxed text-center bg-transparent cursor-pointer select-none text-blue-gray-900"
                                    data-value="all">
                                    <div class="z-20 text-inherit">
                                        &nbsp;&nbsp;All&nbsp;&nbsp;
                                    </div>
                                    <div class="absolute inset-0 z-10 h-full bg-white rounded-md shadow"></div>
                                </li>
                                <li role="tab"
                                    class="relative flex items-center justify-center w-full h-full px-2 py-1 font-sans text-base antialiased font-normal leading-relaxed text-center bg-transparent cursor-pointer select-none text-blue-gray-900"
                                    data-value="monitored">
                                    <div class="z-20 text-inherit">
                                        &nbsp;&nbsp;Monitored&nbsp;&nbsp;
                                    </div>
                                </li>
                                <li role="tab"
                                    class="relative flex items-center justify-center w-full h-full px-2 py-1 font-sans text-base antialiased font-normal leading-relaxed text-center bg-transparent cursor-pointer select-none text-blue-gray-900"
                                    data-value="unmonitored">
                                    <div class="z-20 text-inherit">
                                        &nbsp;&nbsp;Unmonitored&nbsp;&nbsp;
                                    </div>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="w-full md:w-72">
                        <div class="relative h-10 w-full min-w-[200px]">
                            <div
                                class="absolute grid w-5 h-5 top-2/4 right-3 -translate-y-2/4 place-items-center text-blue-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                    </path>
                                </svg>
                            </div>
                            <input
                                class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 !pr-9 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                                placeholder=" " />
                            <label
                                class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none !overflow-visible truncate text-[11px] font-normal leading-tight text-gray-500 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:!border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:!border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                Search
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
                                    Preço
                                </p>
                            </th>
                            <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                                <p
                                    class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                    Fornecedor
                                </p>
                            </th>
                            <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                                <p
                                    class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                    Estoque
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
                                    Validade
                                </p>
                            </th>
                            <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                                <p
                                    class="block font-sans text-center text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                    Ação
                                </p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in products.data" :key="product.id">
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex items-center gap-3">


                                    <AlertDialog>
                                        <AlertDialogTrigger
                                            class="relative cursor-pointer rounded-lg text-center align-middle font-sans text-xs font-medium text-gray-900 uppercase transition-all select-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                            <img :src="'/storage/'.concat(product.image)" :alt="product.image"
                                                class="relative inline-block h-12 w-12 !rounded-full border border-blue-gray-50 bg-blue-gray-50/50 object-contain object-center p-1" />
                                        </AlertDialogTrigger>

                                        <AlertDialogContent>
                                            <AlertDialogHeader>
                                                <AlertDialogTitle>Nova imagem</AlertDialogTitle>
                                                <AlertDialogDescription>
                                                    <div class="grid gap-2 mb-6 lg:mb-0">
                                                        <Input id="image" type="file" name="image"
                                                            @input="handleUpload = $event.target.files[0]"
                                                            accept="image/*" class="mt-1 block w-full" />
                                                    </div>
                                                </AlertDialogDescription>
                                            </AlertDialogHeader>
                                            <AlertDialogFooter>
                                                <AlertDialogCancel class="cursor-pointer">Cancelar</AlertDialogCancel>
                                                <AlertDialogAction class="cursor-pointer bg-primary"
                                                    @click="upload(product.id, product.image)">
                                                    Actualizar
                                                </AlertDialogAction>
                                            </AlertDialogFooter>
                                        </AlertDialogContent>
                                    </AlertDialog>







                                    <div class="flex flex-col">
                                        <p
                                            class="block font-sans text-sm antialiased font-bold leading-normal text-blue-gray-900">
                                            {{ product.description }}
                                        </p>
                                        <p
                                            class="block font-sans text-xs antialiased font-normal leading-normal text-blue-gray-900 opacity-70">
                                            {{ product.barcode }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex flex-col">
                                    <p
                                        class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                        MZN {{ product.sale_price }}
                                    </p>
                                </div>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <p
                                    class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    {{ product.supplier }}
                                </p>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <p
                                    class="pl-4 block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    {{ product.available_stock }}
                                </p>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="w-max">
                                    <div :class="product.is_active ? 'bg-green-500/20' : 'bg-red-500/20'"
                                        class="relative grid items-center rounded-md  px-2 py-1 font-sans text-xs font-bold whitespace-nowrap text-green-900 uppercase select-none">
                                        <span v-if="product.is_active" class="">Activo</span>
                                        <span v-else class="text-red-900">Inactivo</span>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <p
                                    class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    {{ product.validity }}
                                </p>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50 text-center">
                                <button
                                    class="relative rounded-lg text-center align-middle font-sans text-xs font-medium text-gray-900 uppercase transition-all select-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button">
                                    <Link :href="route('products.edit', product.id)">
                                    <Pencil width="18" height="18" color="#1C7005" class="hover:stroke-[#33C809]" />
                                    </Link>
                                </button>
                                <button
                                    class="relative rounded-lg text-center mx-2 align-middle font-sans text-xs font-medium text-gray-900 uppercase transition-all select-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button">
                                    <Link :href="route('products.show', product.id)">
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
                                            <AlertDialogTitle>Are you absolutely sure?</AlertDialogTitle>
                                            <AlertDialogDescription>
                                                This action cannot be undone. This will permanently delete your
                                                account
                                                and remove your data from our servers.
                                            </AlertDialogDescription>
                                        </AlertDialogHeader>
                                        <AlertDialogFooter>
                                            <AlertDialogCancel class="cursor-pointer">Cancel</AlertDialogCancel>
                                            <AlertDialogAction class="cursor-pointer bg-[#EC3636]"
                                                @click="deleteProduct(product.id)">
                                                Yes, Delete
                                            </AlertDialogAction>
                                        </AlertDialogFooter>
                                    </AlertDialogContent>
                                </AlertDialog>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex justify-between items-center px-4 pb-4">
                <div class="text-sm text-slate-500">
                    Mostrando <b>{{ products.from }}-{{ products.to }}</b> de {{ products.total }}
                </div>
                <div class="flex space-x-1">
                    <Link :href="products.prev_page_url ?? ''" :disabled="!products.prev_page_url"
                        :class="!products.prev_page_url ? 'opacity-50 pointer-events-none' : ''"
                        class="px-3 py-1 min-w-9 min-h-9 flex items-center text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" width="14">
                        <path
                            d="M105.4 297.4C92.9 309.9 92.9 330.2 105.4 342.7L265.4 502.7C277.9 515.2 298.2 515.2 310.7 502.7C323.2 490.2 323.2 469.9 310.7 457.4L173.3 320L310.6 182.6C323.1 170.1 323.1 149.8 310.6 137.3C298.1 124.8 277.8 124.8 265.3 137.3L105.3 297.3zM457.4 137.4L297.4 297.4C284.9 309.9 284.9 330.2 297.4 342.7L457.4 502.7C469.9 515.2 490.2 515.2 502.7 502.7C515.2 490.2 515.2 469.9 502.7 457.4L365.3 320L502.6 182.6C515.1 170.1 515.1 149.8 502.6 137.3C490.1 124.8 469.8 124.8 457.3 137.3z" />
                    </svg>
                    </Link>
                    <Link v-for="(page, index) in newLinks" :key="index" :href="page.url ?? ''"
                        :class="page.active ? 'text-white bg-primary border-slate-800 hover:bg-slate-600 hover:border-slate-600' : 'text-slate-500 bg-white border-slate-200 hover:bg-slate-50 hover:border-slate-400'"
                        class="flex items-center px-3 py-1 min-w-9 min-h-9  text-sm font-normal border rounded cursor-pointer transition duration-200 ease">
                    {{ page.label }}</Link>
                    <Link :href="products.next_page_url ?? ''" :disabled="!products.next_page_url"
                        :class="!products.next_page_url ? 'opacity-50 pointer-events-none' : ''"
                        class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal flex items-center text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" width="14">
                        <path
                            d="M535.1 342.6C547.6 330.1 547.6 309.8 535.1 297.3L375.1 137.3C362.6 124.8 342.3 124.8 329.8 137.3C317.3 149.8 317.3 170.1 329.8 182.6L467.2 320L329.9 457.4C317.4 469.9 317.4 490.2 329.9 502.7C342.4 515.2 362.7 515.2 375.2 502.7L535.2 342.7zM183.1 502.6L343.1 342.6C355.6 330.1 355.6 309.8 343.1 297.3L183.1 137.3C170.6 124.8 150.3 124.8 137.8 137.3C125.3 149.8 125.3 170.1 137.8 182.6L275.2 320L137.9 457.4C125.4 469.9 125.4 490.2 137.9 502.7C150.4 515.2 170.7 515.2 183.2 502.7z" />
                    </svg>
                    </Link>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
