<script setup lang="ts">
import { ShoppingCart } from 'lucide-vue-next';
import Countdown from './Countdown.vue';
import { ref } from 'vue';
import { toast } from 'vue-sonner';

interface Product {
    id: number;
    name: string;
    category: string;
    price: number
}

defineProps({
    product: {
        type: Object,
        required: true
    }
})

const cart = ref<Product[]>([]);
function product_list(product: Product) {
    cart.value.push({ id: product.id, name: product.name, category: product.category, price: product.price })
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
                <Countdown />
                <button
                    @click="product_list({ id: product.id, name: product.description, category: product.category, price: product.sale_price })"
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
                    <p class="text-gray-500 text-sm">{{ product.category }}</p>
                </div>
                <div class="text-right">
                    <p class="text-lg font-bold text-indigo-600">${{ product.sale_price }}</p>
                    <p class="text-xs text-gray-400 line-through">$249.99</p>
                </div>
            </div>
        </div>
    </div>

</template>