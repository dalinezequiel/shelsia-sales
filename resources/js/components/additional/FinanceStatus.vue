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

</script>
<template>
    <div class="block w-full mt-4 overflow-x-auto rounded-2xl border">
        <table class="items-center w-full bg-transparent border-collapse">
            <thead>
                <tr>
                    <th
                        class="px-6 text-gray-700 py-3 text-start text-md font-semibold border-l-0 border-r-0 whitespace-nowrap">
                        Contas Financeiras</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <tr class="grid grid-cols-5">
                    <td
                        class="px-6 bg-gray-50 text-start text-gray-500 py-3 text-xs font-semibold border-l-0 border-r-0 whitespace-nowrap">
                        Classificação</td>
                    <td
                        class="px-3 bg-gray-50 text-end text-gray-500 py-3 text-xs font-semibold border-l-0 border-r-0 whitespace-nowrap">
                        Progresso</td>
                    <td
                        class="px-3 bg-gray-50 text-end text-gray-500 py-3 text-xs font-semibold border-l-0 border-r-0 whitespace-nowrap">
                        Núm.</td>
                    <td
                        class="px-4 bg-gray-50 text-start text-gray-500 py-3 text-xs font-semibold border-l-0 border-r-0 whitespace-nowrap">
                        Percentual
                    </td>
                    <td
                        class="px-6 bg-gray-50 text-end text-gray-500 py-3 text-xs font-semibold border-l-0 border-r-0 whitespace-nowrap">
                        Montante
                    </td>
                </tr>
                <tr class="py-4 grid grid-cols-5 text-gray-500">
                    <td class="border-t-0 px-6 text-sm font-normal whitespace-nowrap">
                        Recebimentos</td>
                    <td class="border-t-0 px-4 text-end text-xs font-medium whitespace-nowrap">
                        <span class="px-2 py-1 rounded-md border border-gray-200">{{ indicators.finances.income.paid }}
                            / {{ indicators.finances.income.total }}</span>
                    </td>
                    <td class="border-t-0 px-4 text-end text-xs font-medium text-gray-900 whitespace-nowrap">
                        {{ indicators.finances.income.total }}</td>
                    <td class="w-40 border-t-0 px-4 text-xs whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="mr-2 text-xs font-medium">{{
                                percents(indicators.finances.total, indicators.finances.income.total).toFixed(0) }}
                                %</span>
                            <div class="relative w-full">
                                <div class="w-full bg-gray-200 rounded-sm h-2">
                                    <div class="bg-cyan-600 h-2 rounded-sm"
                                        :style="applyProgressBar(percents(indicators.finances.total, indicators.finances.income.total))">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="border-t-0 px-6 text-end text-xs font-medium text-gray-900 whitespace-nowrap">
                        {{ currencyFormat(indicators.finances.income.sum) }}</td>
                </tr>
                <tr class="py-4 grid grid-cols-5 text-gray-500">
                    <th class="border-t-0 px-6 text-start text-sm font-normal whitespace-nowrap">
                        Pagamentos</th>
                    <td class="border-t-0 px-4 text-end text-xs font-medium whitespace-nowrap">
                        <span class="px-2 py-1 rounded-md border border-gray-200">{{ indicators.finances.expenses.paid
                        }} / {{ indicators.finances.expenses.total }}</span>
                    </td>

                    <td class="border-t-0 px-4 text-end text-xs font-medium text-gray-900 whitespace-nowrap">
                        {{ indicators.finances.expenses.total }}</td>
                    <td class="w-40 border-t-0 px-4 text-xs whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="mr-2 text-xs font-medium">{{
                                percents(indicators.finances.total, indicators.finances.expenses.total).toFixed(0) }}
                                %</span>
                            <div class="relative w-full">
                                <div class="w-full bg-gray-200 rounded-sm h-2">
                                    <div class="bg-orange-300 h-2 rounded-sm"
                                        :style="applyProgressBar(percents(indicators.finances.total, indicators.finances.expenses.total))">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="border-t-0 px-6 text-end text-xs font-medium text-gray-900 whitespace-nowrap">
                        {{ currencyFormat(indicators.finances.expenses.sum) }}</td>
                </tr>
                <tr class="py-4 grid grid-cols-5 text-gray-500">
                    <th class="border-t-0 px-6 text-start text-sm font-normal whitespace-nowrap">
                        Dívidas
                    </th>
                    <td class="border-t-0 px-4 text-end text-xs font-medium whitespace-nowrap">
                        <span class="px-2 py-1 rounded-md border border-gray-200">{{ indicators.finances.late_bills.paid
                        }} / {{ indicators.finances.late_bills.total }}</span>
                    </td>

                    <td class="border-t-0 px-4 text-end text-xs font-medium text-gray-900 whitespace-nowrap">
                        {{ indicators.finances.late_bills.total }}</td>
                    <td class="w-40 border-t-0 px-4 text-xs whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="mr-2 text-xs font-medium">{{ percents(indicators.finances.total,
                                indicators.finances.late_bills.total).toFixed() }}%</span>
                            <div class="relative w-full">
                                <div class="w-full bg-gray-200 rounded-sm h-2">
                                    <div class="bg-red-600 h-2 rounded-sm"
                                        :style="applyProgressBar(percents(indicators.finances.total, indicators.finances.late_bills.total))">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="border-t-0 px-6 text-end text-xs font-medium text-gray-900 whitespace-nowrap">
                        {{ currencyFormat(indicators.finances.late_bills.sum) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>