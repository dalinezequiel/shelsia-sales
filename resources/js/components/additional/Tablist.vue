<script setup lang="ts">
defineProps({
    statistics: {
        type: Object,
        required: true
    }
});
</script>
<template>
    <section>
        <ul class="flex">
            <li>
                <button
                    class="focus:outline-none p-2 rounded-l-md border border-r-0 bg-white flex space-x-1 items-center w-24">
                    <p class="font-semibold text-md">{{ statistics.total }}</p>
                    <p class="text-gray-600 text-sm">
                        Registros
                    </p>
                </button>
            </li>
            <li>
                <button class="focus:outline-none p-2 border border-r-0 bg-white flex space-x-1 items-center w-24">
                    <p class="font-semibold text-md">{{ statistics.active }}</p>
                    <p class="text-gray-600 text-sm">
                        Activos
                    </p>
                </button>
            </li>

            <li>
                <button class="focus:outline-none p-2 border rounded-r-md bg-white flex space-x-1 items-center w-24">
                    <p class="font-semibold text-md">{{ statistics.inactive }}</p>
                    <p class="text-gray-600 text-sm">
                        Inactivos
                    </p>
                </button>
            </li>
        </ul>
    </section>
</template>