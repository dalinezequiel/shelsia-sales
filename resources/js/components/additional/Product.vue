<script setup lang="ts">
import { ShoppingCart } from 'lucide-vue-next';
import { ref } from 'vue';
import { toast } from 'vue-sonner';
import { store } from '@/store'

const quantity = ref(1);

function increment() {
    quantity.value++;
}

function decrement() {
    if (quantity.value > 1) {
        quantity.value--;
    }
}

interface Product {
    id: number;
    name: string;
    category: string;
    price: number;
    image: string;
}

defineProps({
    product: {
        type: Object,
        required: true
    }
})

function product_list(product: Product) {
    const total = quantity.value * product.price
    store.items.push({ id: product.id, name: product.name, price: product.price, quantity: quantity.value, total: total, image: product.image })
    toast.success(product.name)
}
</script>
<template>
    <div
        class="group relative bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-500 hover:shadow-2xl hover:-translate-y-2">
        <div class="relative overflow-hidden h-43">
            <img :src="'/storage/'.concat(product.image)" :alt="product.image"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
            <div
                class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
            </div>
            <div
                class="flex gap-2 absolute bottom-0 left-0 right-0 p-4 translate-y-10 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">

                <div class="rounded-lg inline-flex items-center">
                    <button @click="decrement"
                        class="bg-white rounded-l border text-gray-600 cursor-pointer hover:bg-gray-100 active:bg-gray-200 disabled:opacity-50 inline-flex items-center px-2 py-1 border-r border-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                        </svg>
                    </button>
                    <div
                        class="bg-gray-100 border-t border-b border-gray-100 text-gray-600 hover:bg-gray-100 inline-flex items-center px-4 py-1 select-none">
                        {{ quantity }}
                    </div>
                    <button @click="increment"
                        class="bg-white rounded-r border text-gray-600 cursor-pointer hover:bg-gray-100 active:bg-gray-200 disabled:opacity-50 inline-flex items-center px-2 py-1 border-r border-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </button>
                </div>

                <button
                    @click="product_list({ id: product.id, name: product.description, category: product.category, price: product.promotional_price > 0 ? product.promotional_price : product.sale_price, image: product.image })"
                    class="w-full bg-indigo-600 text-white px-0 text-sm rounded-sm font-medium cursor-pointer hover:bg-indigo-700 transition-colors duration-300 flex items-center justify-center gap-2">
                    <ShoppingCart width="16px" />
                </button>
            </div>
            <span :class="product.available_stock >= product.minimum_stock ? 'bg-green-500' : 'bg-red-500'"
                class="absolute top-4 left-4 text-white text-xs font-bold px-2 py-1 rounded-full animate-pulse-slow">{{
                    product.available_stock }}</span>
        </div>
        <div class="px-4 py-5">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-md font-bold text-gray-800">{{ product.description }}</h3>
                    <p class="text-gray-500 text-sm">{{ product.product_category.description }}</p>
                </div>
                <div class="text-right">
                    <p class="text-md font-bold text-indigo-600"><span class="text-[0.6rem]">MT</span>{{
                        product.promotional_price > 0 ?
                            product.promotional_price : product.sale_price }}</p>
                    <p v-if="product.promotional_price > 0" class="text-xs text-gray-400 line-through">MT{{
                        product.sale_price }}</p>
                </div>
            </div>
        </div>
    </div>

</template>