<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { ChartSpline, LayoutGrid, WalletMinimal, ShoppingBag, Barcode, SlidersHorizontal } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';

const mainNavItems: NavItem[] = [
    {
        title: 'Painel',
        href: '/dashboard',
        icon: LayoutGrid,
    },
    {
        title: 'Produtos',
        href: '/products',
        icon: Barcode,
    },
    {
        title: 'Financeiro',
        href: '/finances',
        icon: WalletMinimal,
    },
    {
        title: 'Vendas',
        href: '/sales',
        icon: ShoppingBag,
    },
    {
        title: 'Análises',
        href: '/analysis',
        icon: ChartSpline,
    },
];

const footerNavItems: NavItem[] = [
    {
        title: 'Parâmetros',
        href: '/parameters/customers',
        icon: SlidersHorizontal,
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('dashboard.index')">
                        <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
