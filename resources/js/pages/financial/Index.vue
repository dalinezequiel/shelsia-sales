<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import { File, Pencil, Trash2, ArrowDownUp, Check } from 'lucide-vue-next';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
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
import Tablist from '@/components/additional/Tablist.vue';
import Pagination from '@/components/additional/Pagination.vue';
import Avatar from '@/components/additional/Avatar.vue';

defineProps({
    accounts: {
        type: Object,
        required: true
    },
    paymentMethods: {
        type: Object,
        required: true
    }
});

interface Account {
    id: number;
    account_plan: string;
    description: string;
    category: string;
    supplier: string;
    due_date: Date;
    amount: number;
    date_of_issue: Date;
    payment_method: string;
    occurrence: string;
    observation: string;
    is_active: boolean;
}
const form = useForm({
    id: '',
    account_plan: '',
    description: '',
    category: '',
    supplier: '',
    due_date: '',
    amount: '',
    date_of_issue: '',
    payment_method: '',
    occurrence: '',
    observation: '',
    is_active: true
});

const letter = (description: string) => description.charAt(0)

const payBill = (bill: Account) => {
    form.id = bill.id.toString();
    form.account_plan = bill.account_plan;
    form.description = bill.description;
    form.category = bill.category;
    form.supplier = bill.supplier;
    form.due_date = bill.due_date.toString();
    form.amount = bill.amount.toString();
    form.date_of_issue = bill.date_of_issue.toString();
    form.payment_method = bill.payment_method;
    form.occurrence = bill.occurrence;
    form.observation = bill.observation;
    form.is_active = true
}

const submit = () => {
    form.put(route('financial.update', { financial: form }), {
        preserveScroll: true,
        onSuccess: () => toast.success('Pagamento efectuado com sucesso.'),
        onError: () => toast.error('Ocorreu um erro ao tentar pagar conta.')
    });
};

const description = ref('');
const search = () => {
    router.get(route('financial.index', { description: description.value }, {
        preserveState: true,
        replace: true
    }))
};

const deleteAccount = (id: number) => {
    router.delete(route('financial.destroy', id), {
        preserveScroll: true,
        onSuccess: () => toast.success('Conta excluída com sucesso.'),
        onError: () => toast.error('Ocorreu um erro ao tentar excluir conta.')
    })
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Financeiro',
        href: '/financial',
    },
    {
        title: 'Lista',
        href: '/financial',
    },
];
</script>

<template>

    <Head title="Financial" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="relative flex flex-col w-full h-full text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
            <div class="relative mx-4 mt-4 text-gray-700 bg-white rounded-none bg-clip-border">
                <div class="flex items-center justify-between gap-8 mb-8">
                    <div>
                        <h5
                            class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                            Contas financeiras
                        </h5>
                        <p class="block mt-1 font-sans text-base antialiased font-normal leading-relaxed text-gray-700">
                            Veja informações sobre todas contas financeiras
                        </p>
                    </div>
                    <div class="flex flex-col gap-2 shrink-0 sm:flex-row">
                        <Link :href="route('financial.index')"
                            class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            type="button">
                        Listar
                        </Link>
                        <button
                            class="flex select-none items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            type="button">
                            <Link :href="route('financial.create')" class="flex gap-y-3 gap-x-2">
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
                            <Tablist :list="accounts" />
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
            <div class="p-6 px-0 overflow-auto h-full">
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
                                    Valor
                                </p>
                            </th>
                            <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                                <p
                                    class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                    Ocorrência
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
                                    Vencimento
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
                        <tr v-for="account in accounts.data" :key="account.id">
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex items-center gap-3">
                                    <img src="https://placehold.co/600x400/transparent/F00"
                                        class="relative inline-block h-12 w-12 !rounded-full border border-blue-gray-50 bg-blue-gray-50/50 object-contain object-center p-1" />
                                    <div class="flex flex-col">
                                        <div class="flex flex-col">
                                            <p
                                                class="block font-sans text-sm font-bold antialiased leading-normal text-blue-gray-900">
                                                {{ account.description }}
                                            </p>
                                            <p
                                                class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900 opacity-70">
                                                {{ account.account_plan }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex">
                                    <div class="pr-1 flex justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" width="18"
                                            :fill="account.category === 'Receitas' ? '#218230' : '#D94629'">
                                            <path
                                                d="M64 320C64 178.6 178.6 64 320 64C461.4 64 576 178.6 576 320C576 461.4 461.4 576 320 576C178.6 576 64 461.4 64 320z" />
                                        </svg>
                                    </div>
                                    <p
                                        class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                        {{ account.category }}
                                    </p>
                                </div>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex flex-col">
                                    <p
                                        class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                        MZN {{ account.amount }}
                                    </p>
                                </div>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex flex-col">
                                    <p
                                        class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                        {{ account.occurrence }}
                                    </p>
                                </div>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="w-max">
                                    <div :class="account.is_active ? 'bg-green-500/20' : 'bg-red-500/20'"
                                        class="relative grid items-center rounded-md  px-2 py-1 font-sans text-xs font-bold whitespace-nowrap text-green-900 uppercase select-none">
                                        <span v-if="account.is_active" class="">Pago</span>
                                        <span v-else class="text-red-900">Não Pago</span>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <p
                                    class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    {{ account.due_date }}
                                </p>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50 text-center">
                                <AlertDialog>
                                    <AlertDialogTrigger
                                        class="relative mr-2 cursor-pointer rounded-lg text-center align-middle font-sans text-xs font-medium text-gray-900 uppercase transition-all select-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                        <ArrowDownUp width="20" color="#696969" class="hover:stroke-[#C4C4C4]" />
                                    </AlertDialogTrigger>

                                    <AlertDialogContent>
                                        <AlertDialogHeader>
                                            <AlertDialogTitle>{{ account.category }}</AlertDialogTitle>
                                            <AlertDialogDescription>
                                                <form id="payment" @submit.prevent="submit">
                                                    <div class="grid gap-y-4 mt-4">
                                                        <div class="grid gap-1  lg:mb-0">
                                                            <Label for="account_description">Descrição</Label>
                                                            <Input id="account_description"
                                                                class="text-primary mt-1 block w-full" required
                                                                v-model="account.description"
                                                                placeholder="Descrição da conta" readonly />
                                                        </div>

                                                        <div class="grid gap-1  lg:mb-0">
                                                            <Label for="amount_to_pay">Valor</Label>
                                                            <Input id="amount_to_pay" type="number"
                                                                class="text-primary mt-1 block w-full"
                                                                v-model="account.amount" required
                                                                placeholder="Valor da conta" readonly />
                                                        </div>

                                                        <div class="grid gap-1  lg:mb-0">
                                                            <Label for="payment_method">Forma de pagamento</Label>
                                                            <Input id="payment_method"
                                                                class="text-primary mt-1 block w-full"
                                                                v-model="account.payment_method" required
                                                                placeholder="Valor da conta" readonly />
                                                        </div>
                                                    </div>
                                                </form>
                                            </AlertDialogDescription>
                                        </AlertDialogHeader>
                                        <AlertDialogFooter>
                                            <AlertDialogCancel class="cursor-pointer">Cancelar</AlertDialogCancel>
                                            <AlertDialogAction>
                                                <button @click="payBill(account)" type="submit" form="payment"
                                                    class="flex items-center cursor-pointer">
                                                    <Check width="20" class="mr-1" />
                                                    Liquidar
                                                </button>
                                            </AlertDialogAction>
                                        </AlertDialogFooter>
                                    </AlertDialogContent>
                                </AlertDialog>


                                <button
                                    class="relative rounded-lg text-center align-middle font-sans text-xs font-medium text-gray-900 uppercase transition-all select-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button">
                                    <Link :href="route('financial.edit', account.id)">
                                    <Pencil width="18" height="18" color="#1C7005" class="hover:stroke-[#33C809]" />
                                    </Link>
                                </button>
                                <button
                                    class="relative rounded-lg text-center mx-2 align-middle font-sans text-xs font-medium text-gray-900 uppercase transition-all select-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button">
                                    <Link :href="route('financial.show', account.id)">
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
                                                Continuar com está operação implicará a exclusão permanente<br>da conta
                                                <strong> <span class="text-[#EC3636]">{{ account.description }}</span>
                                                </strong>.
                                            </AlertDialogDescription>
                                        </AlertDialogHeader>
                                        <AlertDialogFooter>
                                            <AlertDialogCancel class="cursor-pointer">Cancelar</AlertDialogCancel>
                                            <AlertDialogAction class="cursor-pointer bg-[#EC3636]"
                                                @click="deleteAccount(account.id)">
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

            <Pagination :list="accounts" />
        </div>
    </AppLayout>
</template>
