<script setup lang="ts">
import { currencyFormat } from '@/store';

defineProps({
    indicators: {
        type: Object,
        required: true
    }
});

const calculate = (item: any, income: number) => {
    if (item !== null) {
        const subtotal = item.has_details
            .reduce((acc: number, item: { price: number; quantity: number; }) => acc + item.price * item.quantity,
                0);
        return currencyFormat(Number(income) + subtotal + (item.shipping - item.discount));
    }
    return 0;
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
                    {{ currencyFormat(indicators.finances.expenses.sum) }}
                </div>
            </div>
        </div>
    </div>
</template>