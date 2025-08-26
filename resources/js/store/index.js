import { createStore } from 'vuex';

export default createStore({
    state: {
        cart: [],
    },
    mutations: {
        storeCart(state, product) {
            state.cart.push(product);
        },
    },
    actions: {},
    getters: {},
});
