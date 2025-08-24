<script setup>
import { ShoppingCart } from 'lucide-vue-next';
</script>
<template>
    <!-- Product Card 1 -->
    <div
        class="group relative bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-500 hover:shadow-2xl hover:-translate-y-2">
        <div class="relative overflow-hidden h-43">
            <img src="https://images.unsplash.com/photo-1546868871-7041f2a55e12?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1064&q=80"
                alt="Smart Watch"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
            <div
                class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
            </div>
            <div
                class="absolute bottom-0 left-0 right-0 p-4 translate-y-10 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">
                <button
                    class="w-full bg-indigo-600 text-white py-2 text-sm rounded-md font-medium cursor-pointer hover:bg-indigo-700 transition-colors duration-300 flex items-center justify-center gap-2">
                    <ShoppingCart width="16px" /> Add to Cart
                </button>
            </div>
            <span
                class="absolute top-4 left-4 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full animate-pulse-slow">NEW</span>
        </div>
        <div class="p-5">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Premium Smart Watch</h3>
                    <p class="text-gray-500 text-sm">Fitness Tracker, Heart Rate Monitor</p>
                </div>
                <div class="text-right">
                    <p class="text-lg font-bold text-indigo-600">$199.99</p>
                    <p class="text-xs text-gray-400 line-through">$249.99</p>
                </div>
            </div>
        </div>
    </div>
</template>