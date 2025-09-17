<script setup lang="ts">
import { currencyFormat } from '@/store';

defineProps({
    indicators: {
        type: Object,
        required: true
    }
});

const calculate = (items: any, income: number) => {
    if (items !== null) {
        const total = items.reduce((acc: number, item: { shipping: number; discount: number; details: any }) => {
            const total_sum = each_sale_total(item.shipping, item.discount, item.details);
            return acc + total_sum;
        }, 0)
        return currencyFormat(total + Number(income));
    }
    return 0;
}

const each_sale_total = (shipping: number, discount: number, item: any) => {
    return item.reduce((acc: number, detail: { quantity: number; price: number; }) => {
        return acc + detail.quantity * detail.price
    }, 0) + Number(shipping) - discount;
}

</script>
<template>
    <div class="grid gap-4 lg:gap-4 md:grid-cols-4 px-0 pt-0">
        <div class="relative px-6 py-4 rounded-2xl bg-white shadow dark:bg-gray-800">
            <div class="space-y-2">
                <div
                    class="flex items-center space-x-2 rtl:space-x-reverse text-sm font-medium text-gray-500 dark:text-gray-400">
                    <span>Receita</span>
                </div>

                <div class="text-green-700 text-2xl dark:text-gray-100">
                    {{ calculate(indicators.sales.paid.items_to_sum, indicators.finances.income.sum) }}
                </div>
            </div>
        </div>

        <div class="relative px-6 py-4 rounded-2xl bg-white shadow dark:bg-gray-800">
            <div class="space-y-2">
                <div
                    class="flex items-center space-x-2 rtl:space-x-reverse text-sm font-medium text-gray-500 dark:text-gray-400">
                    <span>Produtos</span>
                </div>

                <div class="text-cyan-800 text-2xl dark:text-gray-100">
                    {{ indicators.products.total }}
                </div>
            </div>

        </div>

        <div class="relative px-6 py-4 rounded-2xl bg-white shadow dark:bg-gray-800">
            <div class="space-y-2">
                <div
                    class="flex items-center space-x-2 rtl:space-x-reverse text-sm font-medium text-gray-500 dark:text-gray-400">

                    <span>Vendas</span>
                </div>

                <div class="text-cyan-800 text-2xl dark:text-gray-100">
                    {{ indicators.sales.total }}
                </div>
            </div>
        </div>

        <div class="relative px-6 py-4 rounded-2xl bg-white shadow dark:bg-gray-800">
            <div class="space-y-2">
                <div
                    class="flex items-center space-x-2 rtl:space-x-reverse text-sm font-medium text-gray-500 dark:text-gray-400">
                    <span>Despesas</span>
                </div>

                <div class="text-red-700 text-2xl dark:text-gray-100">
                    {{ currencyFormat(Number(indicators.finances.expenses.sum) +
                        Number(indicators.finances.late_bills.sum)) }}
                </div>
            </div>
        </div>
    </div>
</template>