<script setup lang="ts"></script>
<template>
    <div class="block w-full mt-4 overflow-x-auto rounded-2xl border">
        <table class="items-center w-full bg-transparent border-collapse">
            <thead>
                <tr>
                    <th
                        class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">
                        Top Channels</th>
                    <th
                        class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">
                        Users</th>
                    <th
                        class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap min-w-140-px">
                        Ranking
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <tr class="text-gray-500">
                    <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">
                        Organic
                        Search</th>
                    <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">
                        5,649</td>
                    <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                        <div class="flex items-center">
                            <span class="mr-2 text-xs font-medium">30%</span>
                            <div class="relative w-full">
                                <div class="w-full bg-gray-200 rounded-sm h-2">
                                    <div class="bg-cyan-600 h-2 rounded-sm" style="width: 30%"></div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="text-gray-500">
                    <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">
                        Referral</th>
                    <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">
                        4,025</td>
                    <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                        <div class="flex items-center">
                            <span class="mr-2 text-xs font-medium">24%</span>
                            <div class="relative w-full">
                                <div class="w-full bg-gray-200 rounded-sm h-2">
                                    <div class="bg-orange-300 h-2 rounded-sm" style="width: 24%"></div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="text-gray-500">
                    <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">
                        Direct
                    </th>
                    <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">
                        3,105</td>
                    <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                        <div class="flex items-center">
                            <span class="mr-2 text-xs font-medium">18%</span>
                            <div class="relative w-full">
                                <div class="w-full bg-gray-200 rounded-sm h-2">
                                    <div class="bg-teal-400 h-2 rounded-sm" style="width: 18%"></div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>