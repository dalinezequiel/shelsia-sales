<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    list: {
        type: Object,
        required: true
    }
});

const newLinks = computed(() => {
    const length: number = props.list.links.length;
    return props.list.links.slice(1, length == 0 ? 0 : length - 1);
})
</script>
<template>
    <div class="flex justify-between items-center px-4 pb-4">
        <div class="text-sm text-slate-500">
            Mostrando <b>{{ list.from }}-{{ list.to }}</b> de {{ list.total }}
        </div>
        <div class="flex space-x-1">
            <Link :href="list.prev_page_url ?? ''" :disabled="!list.prev_page_url"
                :class="!list.prev_page_url ? 'opacity-50 pointer-events-none' : ''"
                class="px-3 py-1 min-w-9 min-h-9 flex items-center text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" width="14">
                <path
                    d="M105.4 297.4C92.9 309.9 92.9 330.2 105.4 342.7L265.4 502.7C277.9 515.2 298.2 515.2 310.7 502.7C323.2 490.2 323.2 469.9 310.7 457.4L173.3 320L310.6 182.6C323.1 170.1 323.1 149.8 310.6 137.3C298.1 124.8 277.8 124.8 265.3 137.3L105.3 297.3zM457.4 137.4L297.4 297.4C284.9 309.9 284.9 330.2 297.4 342.7L457.4 502.7C469.9 515.2 490.2 515.2 502.7 502.7C515.2 490.2 515.2 469.9 502.7 457.4L365.3 320L502.6 182.6C515.1 170.1 515.1 149.8 502.6 137.3C490.1 124.8 469.8 124.8 457.3 137.3z" />
            </svg>
            </Link>
            <Link v-for="(page, index) in newLinks" :key="index" :href="page.url ?? ''"
                :class="page.active ? 'text-white bg-primary border-slate-800 hover:bg-slate-600 hover:border-slate-600' : 'text-slate-500 bg-white border-slate-200 hover:bg-slate-50 hover:border-slate-400'"
                class="flex items-center px-3 py-1 min-w-9 min-h-9  text-sm font-normal border rounded cursor-pointer transition duration-200 ease">
            {{ page.label }}</Link>
            <Link :href="list.next_page_url ?? ''" :disabled="!list.next_page_url"
                :class="!list.next_page_url ? 'opacity-50 pointer-events-none' : ''"
                class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal flex items-center text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" width="14">
                <path
                    d="M535.1 342.6C547.6 330.1 547.6 309.8 535.1 297.3L375.1 137.3C362.6 124.8 342.3 124.8 329.8 137.3C317.3 149.8 317.3 170.1 329.8 182.6L467.2 320L329.9 457.4C317.4 469.9 317.4 490.2 329.9 502.7C342.4 515.2 362.7 515.2 375.2 502.7L535.2 342.7zM183.1 502.6L343.1 342.6C355.6 330.1 355.6 309.8 343.1 297.3L183.1 137.3C170.6 124.8 150.3 124.8 137.8 137.3C125.3 149.8 125.3 170.1 137.8 182.6L275.2 320L137.9 457.4C125.4 469.9 125.4 490.2 137.9 502.7C150.4 515.2 170.7 515.2 183.2 502.7z" />
            </svg>
            </Link>
        </div>
    </div>
</template>