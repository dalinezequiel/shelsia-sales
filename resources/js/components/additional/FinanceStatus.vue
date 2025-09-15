<script setup lang="ts">
import { currencyFormat } from '@/store';

defineProps({
    indicators: {
        type: Object,
        required: true
    }
});

const percents = (total: number, total_per_situation: number) => (total_per_situation * 100) / total;
const applyProgressBar = (number: number) => "width: ".concat(number.toString(), "%");
</script>
<template>
    <div class="block w-full mt-4 overflow-x-auto rounded-2xl border">
        <table class="items-center w-full bg-transparent border-collapse">
            <thead>
                <tr>
                    <th
                        class="w-2/5 px-6 text-gray-700 align-middle py-3 text-md font-semibold text-left border-l-0 border-r-0 whitespace-nowrap">
                        Contas Financeiras</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <tr>
                    <th
                        class="w-2/5 px-6 bg-gray-50 text-gray-500 align-middle py-3 text-xs font-semibold text-left border-l-0 border-r-0 whitespace-nowrap">
                        Classificação</th>
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
                        Recebimentos</th>
                    <td class="border-t-0 px-4 text-end text-xs font-medium text-gray-900 whitespace-nowrap p-4">
                        {{ indicators.finances.income.total }}</td>
                    <td class="w-40 border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                        <div class="flex items-center">
                            <span class="mr-2 text-xs font-medium">{{
                                percents(indicators.finances.total, indicators.finances.income.total).toFixed(0) }}
                                %</span>
                            <div class="relative w-full">
                                <div class="w-full bg-gray-200 rounded-sm h-2">
                                    <div class="bg-cyan-600 h-2 rounded-sm" style="width: 30%"></div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="border-t-0 px-6 text-end text-xs font-medium text-gray-900 whitespace-nowrap p-4">
                        {{ currencyFormat(indicators.finances.income.sum) }}</td>
                </tr>
                <tr class="text-gray-500">
                    <th class="border-t-0 px-6 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">
                        Pagamentos</th>
                    <td class="border-t-0 px-4 text-end text-xs font-medium text-gray-900 whitespace-nowrap p-4">
                        {{ indicators.finances.expenses.total }}</td>
                    <td class="w-40 border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                        <div class="flex items-center">
                            <span class="mr-2 text-xs font-medium">{{
                                percents(indicators.finances.total, indicators.finances.expenses.total).toFixed(0) }}
                                %</span>
                            <div class="relative w-full">
                                <div class="w-full bg-gray-200 rounded-sm h-2">
                                    <div class="bg-orange-300 h-2 rounded-sm" :style="applyProgressBar(17)">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="border-t-0 px-6 text-end text-xs font-medium text-gray-900 whitespace-nowrap p-4">
                        {{ currencyFormat(indicators.finances.expenses.sum) }}</td>
                </tr>
                <tr class="text-gray-500">
                    <th class="border-t-0 px-6 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">
                        Dívidas
                    </th>
                    <td class="border-t-0 px-4 text-end text-xs font-medium text-gray-900 whitespace-nowrap p-4">
                        {{ indicators.finances.late_bills.total }}</td>
                    <td class="w-40 border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                        <div class="flex items-center">
                            <span class="mr-2 text-xs font-medium">{{ percents(indicators.finances.total,
                                indicators.finances.late_bills.total).toFixed() }}%</span>
                            <div class="relative w-full">
                                <div class="w-full bg-gray-200 rounded-sm h-2">
                                    <div class="bg-red-600 h-2 rounded-sm" style="width: 40%"></div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="border-t-0 px-6 text-end text-xs font-medium text-gray-900 whitespace-nowrap p-4">
                        {{ currencyFormat(indicators.finances.late_bills.sum) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>