import { reactive } from 'vue';

interface Product {
    id: number;
    name: string;
    price: number;
    quantity: number;
    total: number;
    image: string;
}

interface Cart {
    items: Product[];
    total?: number;
    subtotal?: number;
    shipping?: number;
    discount?: number;
    increment(id: number): void;
    decrement(id: number): void;
    delete(id: number): void;
}

export const store: Cart = reactive({
    items: [],
    total: 0,
    subtotal: 0,
    shipping: 0,
    discount: 0,
    increment: (id: number) => {
        const index = store.items.findIndex((product) => product.id == id);
        store.items[index].quantity++;
        store.items[index].total = store.items[index].quantity * store.items[index].price;
    },
    decrement: (id: number) => {
        const index = store.items.findIndex((product) => product.id == id);
        if (store.items[index].quantity > 1) {
            store.items[index].quantity--;
            store.items[index].total = store.items[index].quantity * store.items[index].price;
        }
    },
    delete: (id: number) => {
        const index = store.items.findIndex((product) => product.id == id);
        store.items.splice(index, 1);
    },
});
