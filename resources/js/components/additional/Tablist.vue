<script setup lang="ts">
import { IProduct } from '@/interfaces';

const props = defineProps({
    list: {
        type: Object,
        required: true
    }
});

const stats = {
    total: props.list.total,
    active: props.list.data.filter((item: IProduct) => item.is_active).length,
    inactive: function () {
        return this.total - this.active
    }
}
</script>
<template>
    <section>
        <ul class="flex">
            <li>
                <button
                    class="focus:outline-none p-2 rounded-l-md border border-r-0 bg-white flex space-x-1 items-center w-24">
                    <p class="font-semibold text-md">{{ stats.total }}</p>
                    <p class="text-gray-600 text-sm">
                        Registros
                    </p>
                </button>
            </li>
            <li>
                <button class="focus:outline-none p-2 border border-r-0 bg-white flex space-x-1 items-center w-24">
                    <p class="font-semibold text-md">{{ stats.active }}</p>
                    <p class="text-gray-600 text-sm">
                        Activos
                    </p>
                </button>
            </li>

            <li>
                <button class="focus:outline-none p-2 border rounded-r-md bg-white flex space-x-1 items-center w-24">
                    <p class="font-semibold text-md">{{ stats.inactive() }}</p>
                    <p class="text-gray-600 text-sm">
                        Inactivos
                    </p>
                </button>
            </li>
        </ul>
    </section>
</template>