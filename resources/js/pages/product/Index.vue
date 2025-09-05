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
import { ref } from 'vue';
import Pagination from '@/components/additional/Pagination.vue';
import Tablist from '@/components/additional/Tablist.vue';

defineProps({
    products: {
        type: Object,
        required: true
    }
});

const description = ref('');
const search = () => {
    router.get(route('products.index', { description: description.value }, {
        preserveState: true,
        replace: true
    }))
};

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
        title: 'Produtos',
        href: '/products',
    },
    {
        title: 'Lista',
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
                            class="block font-sans text-lg antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                            Lista de produtos
                        </h5>
                        <p class="block font-sans text-sm antialiased font-normal leading-relaxed text-gray-700">
                            Veja informações sobre todos os produtos
                        </p>
                    </div>
                    <div class="flex flex-col gap-2 shrink-0 sm:flex-row">
                        <Link :href="route('products.index')"
                            class="flex gap-y-3 gap-x-2 select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                        Listar
                        </Link>
                        <button
                            class="flex select-none items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            type="button">
                            <Link :href="route('products.create')" class="flex gap-y-3 gap-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" width="16" fill="#ffffff">
                                <path
                                    d="M352 128C352 110.3 337.7 96 320 96C302.3 96 288 110.3 288 128L288 288L128 288C110.3 288 96 302.3 96 320C96 337.7 110.3 352 128 352L288 352L288 512C288 529.7 302.3 544 320 544C337.7 544 352 529.7 352 512L352 352L512 352C529.7 352 544 337.7 544 320C544 302.3 529.7 288 512 288L352 288L352 128z" />
                            </svg>
                            Adicionar
                            </Link>
                        </button>
                    </div>
                </div>
                <div class="flex flex-col items-center justify-between gap-4 md:flex-row">
                    <div class="block w-full overflow-hidden md:w-max">
                        <nav>
                            <Tablist :list="products" />
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
                                    Categoria
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
                                <p
                                    class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    {{ product.category }}
                                </p>
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
                                            <AlertDialogTitle>Confirma está exclusão?</AlertDialogTitle>
                                            <AlertDialogDescription>
                                                Continuar com está operação implicará a exclusão permanente<br>do
                                                produto
                                                <strong> <span class="text-[#EC3636]">{{ product.description }}</span>
                                                </strong>.
                                            </AlertDialogDescription>
                                        </AlertDialogHeader>
                                        <AlertDialogFooter>
                                            <AlertDialogCancel class="cursor-pointer">Cancelar</AlertDialogCancel>
                                            <AlertDialogAction class="cursor-pointer bg-[#EC3636]"
                                                @click="deleteProduct(product.id)">
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

            <Pagination :list="products" />
        </div>
    </AppLayout>
</template>
