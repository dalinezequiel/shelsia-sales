import { createStore } from 'vuex';

export default createStore({
    state: {
        cart: {
            items: [],
            total: 0,
        },
    },
    mutations: {
        storeCart(state, product) {
            state.cart.push(product);
        },
    },
    actions: {},
    getters: {},
});
