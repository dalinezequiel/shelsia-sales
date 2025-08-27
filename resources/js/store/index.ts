import { reactive } from 'vue';

interface Product {
    id: number;
    name: string;
    price: number;
    quantity: number;
}

interface Cart {
    items: Product[];
    total: number;
}

export const store: Cart = reactive({
    items: [],
    total: 0,
});
