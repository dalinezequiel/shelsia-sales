<script setup lang="ts">
import { currencyFormat } from '@/store';

defineProps({
    indicators: {
        type: Object,
        required: true
    }
});

const calculate = (subtotal: number, shipping: number, discount: number) => subtotal + shipping - discount;
</script>
<template>
    <div class="block w-full mt-4 overflow-x-auto rounded-2xl border">
        <table class="items-center w-full bg-transparent border-collapse">
            <thead>
                <tr>
                    <th
                        class="w-2/5 px-6 text-gray-700 align-middle py-3 text-md font-semibold text-left border-l-0 border-r-0 whitespace-nowrap">
                        Vendas Diárias</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <tr>
                    <th
                        class="w-2/5 px-6 bg-gray-50 text-gray-500 align-middle py-3 text-xs font-semibold text-left border-l-0 border-r-0 whitespace-nowrap">
                        Situação</th>
                    <th
                        class="px-4 bg-gray-50 text-gray-500 text-end py-3 text-xs font-semibold border-l-0 border-r-0 whitespace-nowrap">
                        Núm.</th>
                    <th
                        class="w-40 px-4 bg-gray-50 text-gray-500 text-start py-3 text-xs font-semibold border-l-0 border-r-0 whitespace-nowrap">
                        Percentual
                    </th>
                    <th
                        class="px-6 bg-gray-50 text-gray-500 text-end py-3 text-xs font-semibold border-l-0 border-r-0 whitespace-nowrap min-w-140-px">
                        Montante
                    </th>
                </tr>
                <tr class="text-gray-500">
                    <th class="border-t-0 px-6 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">
                        Pagas</th>
                    <td class="border-t-0 px-4 text-end text-xs font-medium text-gray-900 whitespace-nowrap p-4">
                        {{ indicators.sales.paid.total }}</td>
                    <td class="w-40 border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                        <div class="flex items-center">
                            <span class="mr-2 text-xs font-medium">30%</span>
                            <div class="relative w-full">
                                <div class="w-full bg-gray-200 rounded-sm h-2">
                                    <div class="bg-cyan-600 h-2 rounded-sm" style="width: 30%"></div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td v-if="indicators.sales.paid.items_to_sum"
                        class="border-t-0 px-6 text-end text-xs font-medium text-gray-900 whitespace-nowrap p-4">
                        {{currencyFormat(calculate(indicators.sales.paid.items_to_sum.has_details.reduce((acc:
                            number, item: {
                                price: number; quantity: number;
                            }) => acc + item.price * item.quantity,
                            0), Number(indicators.sales.paid.items_to_sum.shipping),
                            Number(indicators.sales.paid.items_to_sum.discount))
                        )}}
                    </td>
                    <td v-else class="border-t-0 px-6 text-end text-xs font-medium text-gray-900 whitespace-nowrap p-4">
                        0,00
                    </td>
                </tr>
                <tr class="text-gray-500">
                    <th class="border-t-0 px-6 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">
                        Pendentes</th>
                    <td class="border-t-0 px-4 text-end text-xs font-medium text-gray-900 whitespace-nowrap p-4">
                        {{ indicators.sales.pending.total }}</td>
                    <td class="w-40 border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                        <div class="flex items-center">
                            <span class="mr-2 text-xs font-medium">30%</span>
                            <div class="relative w-full">
                                <div class="w-full bg-gray-200 rounded-sm h-2">
                                    <div class="bg-orange-300 h-2 rounded-sm" style="width: 30%"></div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td v-if="indicators.sales.pending.items_to_sum"
                        class="border-t-0 px-6 text-end text-xs font-medium text-gray-900 whitespace-nowrap p-4">
                        {{currencyFormat(calculate(indicators.sales.pending.items_to_sum.has_details.reduce((acc:
                            number, item: {
                                price: number; quantity: number;
                            }) => acc + item.price * item.quantity,
                            0), Number(indicators.sales.pending.items_to_sum.shipping),
                            Number(indicators.sales.pending.items_to_sum.discount))
                        )}}
                    </td>
                    <td v-else class="border-t-0 px-6 text-end text-xs font-medium text-gray-900 whitespace-nowrap p-4">
                        0,00
                    </td>
                </tr>
                <tr class="text-gray-500">
                    <th class="border-t-0 px-6 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">
                        Canceladas
                    </th>
                    <td class="border-t-0 px-4 text-end text-xs font-medium text-gray-900 whitespace-nowrap p-4">
                        {{ indicators.sales.cancelled.total }}</td>
                    <td class="w-40 border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                        <div class="flex items-center">
                            <span class="mr-2 text-xs font-medium">30%</span>
                            <div class="relative w-full">
                                <div class="w-full bg-gray-200 rounded-sm h-2">
                                    <div class="bg-red-600 h-2 rounded-sm" style="width: 30%"></div>
                                </div>
                            </div>
                        </div>
                    </td>

                    <td v-if="indicators.sales.cancelled.items_to_sum"
                        class="border-t-0 px-6 text-end text-xs font-medium text-gray-900 whitespace-nowrap p-4">
                        {{currencyFormat(calculate(indicators.sales.cancelled.items_to_sum.has_details.reduce((acc:
                            number, item: {
                                price: number; quantity: number;
                            }) => acc + item.price * item.quantity,
                            0), Number(indicators.sales.cancelled.items_to_sum.shipping),
                            Number(indicators.sales.cancelled.items_to_sum.discount))
                        )}}
                    </td>
                    <td v-else class="border-t-0 px-6 text-end text-xs font-medium text-gray-900 whitespace-nowrap p-4">
                        0,00
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>