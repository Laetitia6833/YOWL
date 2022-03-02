import axios from "axios";
import { createStore } from "vuex";

const store = createStore({
    state: {
        authenticated: "",
        user: "",
        locations: [],
        categories: [],
        products: [],
        producteurs: [],
        baskets: [],
        search: [],
    },
    getters: {
        allLocations: (state) => {
            return state.locations;
        },
        productsFromProducteur: (state) => (prod_id) => {
            return state.products.filter(
                (product) => product.producteur_id == prod_id
            );
        },

        departement: (state) => {
            let departement = state.locations.find(
                (location) => location.id === state.user.location_id
            );

            return departement;
        },
        currentUser: (state) => {
            return state.user;
        },

        basketsFromProducteur: (state) => (prod_id) => {
            return state.baskets.filter(
                (basket) => basket.producteur_id == prod_id
            );
        },

        producteur: (state) => (prod_id) => {
            return state.producteurs.find(
                (producteur) => producteur.id == prod_id
            );
        },
    },
    mutations: {
        setAuthentication(state, status) {
            state.authenticated = status;
            localStorage.setItem("auth", status);
            // state.user = user
        },
        setUser(state, user) {
            state.user = user;
            localStorage.setItem("user", JSON.stringify(user));
        },
        initializeAuth(state) {
            if (localStorage.getItem("user")) {
                state.authenticated = localStorage.getItem("auth");
                state.user = JSON.parse(localStorage.getItem("user"));
            }
        },
        GET_LOCATIONS(state, locations) {
            state.locations = locations;
        },

        GET_CATEGORIES(state, categories) {
            state.categories = categories;
        },

        GET_PRODUCTS(state, products) {
            state.products = products;
        },
        GET_PRODUCTEURS(state, producteurs) {
            state.producteurs = producteurs;
        },
        GET_BASKETS(state, baskets) {
            state.baskets = baskets;
        },
    },
    actions: {
        async getProducts({ commit }) {
            const response = await axios.get("/api/products");
            commit("GET_PRODUCTS", response.data);
        },
        async getLocations({ commit }) {
            const response = await axios.get("/api/locations");
            commit("GET_LOCATIONS", response.data);
        },

        async getCategories({ commit }) {
            const response = await axios.get("/api/categories");
            commit("GET_CATEGORIES", response.data);
        },
        async getProducteurs({ commit }) {
            const response = await axios.get("/api/producteurs");
            commit("GET_PRODUCTEURS", response.data);
            console.log(response.data);
        },

        async getBaskets({ commit }) {
            const response = await axios.get("/api/baskets");
            commit("GET_BASKETS", response.data);
        },
    },
});

export default store;
