<script setup lang="ts">
import { currencyFormat } from '@/store';

defineProps({
    indicators: {
        type: Object,
        required: true
    }
});

const percents = (total: number, total_per_situation: number) =>
    Number.isInteger((total_per_situation * 100) / total) ? (total_per_situation * 100) / total : 0;
const applyProgressBar = (number: number) => "width: ".concat(number.toString(), "%");

const calculate = (items: any) => {
    if (items !== null) {
        const total = items.reduce((acc: number, item: { shipping: number; discount: number; has_details: any }) => {
            const total_sum = each_sale_total(item.shipping, item.discount, item.has_details);
            return acc + total_sum;
        }, 0)
        return currencyFormat(total);
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
    <div class="block w-full mt-4 overflow-x-auto rounded-2xl border">
        <table class="items-center w-full bg-transparent border-collapse">
            <thead>
                <tr>
                    <th
                        class="px-6 text-gray-700 align-middle py-3 text-md font-semibold text-left border-l-0 border-r-0 whitespace-nowrap">
                        Vendas Diárias</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <tr class="grid grid-cols-5">
                    <td
                        class="px-6 bg-gray-50 text-gray-500 align-middle py-3 text-xs font-semibold text-left border-l-0 border-r-0 whitespace-nowrap">
                        Situação</td>

                    <td
                        class="px-3 bg-gray-50 text-gray-500 text-end py-3 text-xs font-semibold border-l-0 border-r-0 whitespace-nowrap">
                        Progresso</td>
                    <td
                        class="px-3 bg-gray-50 text-gray-500 text-end py-3 text-xs font-semibold border-l-0 border-r-0 whitespace-nowrap">
                        Núm.</td>
                    <td
                        class="px-4 bg-gray-50 text-gray-500 text-start py-3 text-xs font-semibold border-l-0 border-r-0 whitespace-nowrap">
                        Percentual
                    </td>
                    <td
                        class="px-6 bg-gray-50 text-gray-500 text-end py-3 text-xs font-semibold border-l-0 border-r-0 whitespace-nowrap">
                        Montante
                    </td>
                </tr>
                <tr class="grid grid-cols-5 py-4 text-gray-500">
                    <td class="border-t-0 px-6 text-sm font-normal whitespace-nowrap">
                        Pagas</td>
                    <td class="border-t-0 px-4 text-end text-xs font-medium whitespace-nowrap">
                        <span class="px-2 py-1 rounded-md border border-gray-200">{{ indicators.sales.paid.total }} / {{
                            indicators.sales.total }}</span>
                    </td>

                    <td class="border-t-0 px-4 text-end text-xs font-medium text-gray-900 whitespace-nowrap">
                        {{ indicators.sales.paid.total }}</td>
                    <td class="w-40 border-t-0 px-4 align-middle text-xs whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="mr-2 text-xs font-medium">{{ percents(indicators.sales.total,
                                indicators.sales.paid.total).toFixed(0) }}%</span>
                            <div class="relative w-full">
                                <div class="w-full bg-gray-200 rounded-sm h-2">
                                    <div class="bg-cyan-600 h-2 rounded-sm"
                                        :style="applyProgressBar(percents(indicators.sales.total, indicators.sales.paid.total))">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td v-if="indicators.sales.paid.items_to_sum"
                        class="border-t-0 px-6 text-end text-xs font-medium text-gray-900 whitespace-nowrap">
                        {{ calculate(indicators.sales.paid.items_to_sum) }}
                    </td>
                    <td v-else class="border-t-0 px-6 text-end text-xs font-medium text-gray-900 whitespace-nowrap">
                        0,00
                    </td>
                </tr>
                <tr class="grid grid-cols-5 py-4 text-gray-500">
                    <td class="border-t-0 px-6 text-sm font-normal whitespace-nowrap">
                        Pendentes</td>
                    <td class="border-t-0 px-4 text-end text-xs font-medium whitespace-nowrap">
                        <span class="px-2 py-1 rounded-md border border-gray-200">{{ indicators.sales.pending.total }} /
                            {{ indicators.sales.total }}</span>
                    </td>
                    <td class="border-t-0 px-4 text-end text-xs font-medium text-gray-900 whitespace-nowrap">
                        {{ indicators.sales.pending.total }}</td>
                    <td class="w-40 border-t-0 px-4 text-xs whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="mr-2 text-xs font-medium">{{ percents(indicators.sales.total,
                                indicators.sales.pending.total).toFixed(0) }}%</span>
                            <div class="relative w-full">
                                <div class="w-full bg-gray-200 rounded-sm h-2">
                                    <div class="bg-orange-300 h-2 rounded-sm"
                                        :style="applyProgressBar(percents(indicators.sales.total, indicators.sales.pending.total))">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td v-if="indicators.sales.pending.items_to_sum"
                        class="border-t-0 px-6 text-end text-xs font-medium text-gray-900 whitespace-nowrap">
                        {{ calculate(indicators.sales.pending.items_to_sum) }}
                    </td>
                    <td v-else class="border-t-0 px-6 text-end text-xs font-medium text-gray-900 whitespace-nowrap">
                        0,00
                    </td>
                </tr>
                <tr class="grid grid-cols-5 py-4 text-gray-500">
                    <td class="border-t-0 px-6 align-middle text-sm font-normal whitespace-nowrap">
                        Canceladas
                    </td>
                    <td class="border-t-0 px-4 text-end text-xs font-medium  whitespace-nowrap">
                        <span class="px-2 py-1 rounded-md border border-gray-200">{{ indicators.sales.cancelled.total }}
                            / {{ indicators.sales.total }}</span>
                    </td>
                    <td class="border-t-0 px-4 text-end text-xs font-medium text-gray-900 whitespace-nowrap">
                        {{ indicators.sales.cancelled.total }}</td>
                    <td class="w-40 border-t-0 px-4 text-xs whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="mr-2 text-xs font-medium">{{ percents(indicators.sales.total,
                                indicators.sales.cancelled.total).toFixed(0) }}%</span>
                            <div class="relative w-full">
                                <div class="w-full bg-gray-200 rounded-sm h-2">
                                    <div class="bg-red-600 h-2 rounded-sm"
                                        :style="applyProgressBar(percents(indicators.sales.total, indicators.sales.cancelled.total))">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>

                    <td v-if="indicators.sales.cancelled.items_to_sum"
                        class="border-t-0 px-6 text-end text-xs font-medium text-gray-900 whitespace-nowrap">
                        {{ calculate(indicators.sales.cancelled.items_to_sum) }}
                    </td>
                    <td v-else class="border-t-0 px-6 text-end text-xs font-medium text-gray-900 whitespace-nowrap">
                        0,00
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>