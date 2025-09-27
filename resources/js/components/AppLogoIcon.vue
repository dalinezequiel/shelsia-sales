<script setup lang="ts">
import type { HTMLAttributes } from 'vue';
import logo from '/public/logo.svg';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
    <img :src="logo" class="w-full h-full" />
</template>
