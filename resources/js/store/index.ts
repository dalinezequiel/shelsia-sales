import { ICart } from '@/interfaces';
import { reactive } from 'vue';

export const dateFormat = (date: Date) =>
    new Intl.DateTimeFormat('en-US', { month: 'short', day: '2-digit', year: 'numeric' }).format(new Date(date));

interface Cart {
    items: ICart[];
    total(): number;
    subtotal(): number;
    shipping: number;
    discount: number;
    increment(id: number): void;
    decrement(id: number): void;
    delete(id: number): void;
}

export const store: Cart = reactive({
    items: [],
    total: () => {
        return store.shipping + store.subtotal() - store.discount;
    },
    subtotal: () => {
        return store.items.reduce((sum, value) => sum + value.total, 0);
    },
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
