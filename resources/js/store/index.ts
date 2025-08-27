import { reactive } from 'vue';

interface Product {
    id: number;
    name: string;
    price: number;
    quantity: number;
    image: string;
}

interface Cart {
    items: Product[];
    total?: number;
    subtotal?: number;
    shipping?: number;
    discount?: number;
}

export const store: Cart = reactive({
    items: [],
    total: 0,
    subtotal: 0,
    shipping: 0,
    discount: 0,
});
