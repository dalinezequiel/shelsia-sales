<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { Separator } from '@/components/ui/separator';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { Box, Landmark, CreditCard, User, SlidersHorizontal } from 'lucide-vue-next';

const sidebarNavItems: NavItem[] = [
    {
        title: 'Clientes',
        href: '/parameters/customers',
        icon: User
    },
    {
        title: 'Fornecedores',
        href: '/parameters/suppliers',
        icon: Box
    },
    {
        title: 'Accounts',
        href: '/parameters/accounts',
        icon: Landmark
    },
    {
        title: 'Categorias',
        href: '/parameters/product_categories',
        icon: SlidersHorizontal
    },
    {
        title: 'Pagamentos',
        href: '/parameters/payment_methods',
        icon: CreditCard
    }
];

const page = usePage();

const currentPath = page.props.ziggy?.location ? new URL(page.props.ziggy.location).pathname : '';
</script>

<template>
    <div class="px-4 py-6">
        <div class="flex flex-col space-y-8 md:space-y-0 lg:flex-row lg:space-y-0 lg:space-x-12">
            <aside class="w-full max-w-xl lg:w-44">
                <nav class="flex flex-col space-y-1 space-x-0">
                    <Button v-for="item in sidebarNavItems" :key="item.href" variant="ghost"
                        :class="['w-full justify-start', { 'bg-muted': currentPath === item.href }]" as-child>
                        <Link :href="item.href" class="text-gray-700 font-normal">
                        <component :is="item.icon" />
                        {{ item.title }}
                        </Link>
                    </Button>
                </nav>
            </aside>

            <Separator class="my-6 md:hidden" />

            <div class="flex-1 md:max-w-2xl">
                <section class="max-w-1xl space-y-12">
                    <slot />
                </section>
            </div>
        </div>
    </div>
</template>
