import { createWebHistory, createRouter } from "vue-router";

import Home from "../pages/Home.vue";
import Register from "../pages/Register.vue";
import ProducteurRegister from "../pages/ProducteurRegister.vue";
import UserRegister from "../pages/UserRegister.vue";
import Login from "../pages/Login.vue";
import LoginUser from "../pages/LoginUser.vue";
import LoginProducteur from "../pages/LoginProducteur.vue";
import Producteur from "../pages/Producteur.vue";
import UpdateProfil from "../pages/Producteur/Update.vue";
import User from "../pages/User.vue";
import store from "../store";
import ResultResearch from "../pages/ResultResearch.vue";
import InfoProducteur from "../pages/InfoProducteur.vue";

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },

    {
        path: "/register",
        name: "Register",
        component: Register,
    },
    {
        path: "/ProducteurRegister",
        name: "ProducteurRegister",
        component: ProducteurRegister,
    },
    {
        path: "/UserRegister",
        name: "UserRegister",
        component: UserRegister,
    },
    {
        path: "/login",
        name: "Login",
        component: Login,
    },
    {
        path: "/loginUser",
        name: "LoginUser",
        component: LoginUser,
    },
    {
        path: "/loginProducteur",
        name: "LoginProducteur",
        component: LoginProducteur,
    },
    {
        path: "/result/:results?/:location?",
        name: "ResultResearch",
        component: ResultResearch,
    },
    {
        path: `/monproducteur/:id`,
        name: "InfoProducteur",
        component: InfoProducteur,
    },
    {
        path: `/producteur/:id`,
        name: "Producteur",
        component: Producteur,
        // props: user

        beforeEnter: (to, from, next) => {
            // store.state.user.token
            if (store.state.user.token !== localStorage.getItem("token")) {
                console.log(store);
                next(false);
            } else {
                next();
            }
        },
    },
    {
        path: `/updateProfil/:id`,
        name: "UpdateProfil",
        component: UpdateProfil,
        // props: user

        beforeEnter: (to, from, next) => {
            // store.state.user.token
            if (store.state.user.token !== localStorage.getItem("token")) {
                console.log(store);
                next(false);
            } else {
                next();
            }
        },
    },
    {
        path: "/user/:id",
        name: "User",
        component: User,
        beforeEnter: (to, from, next) => {
            if (store.state.user.token !== localStorage.getItem("token")) {
                next(false);
            } else {
                next();
            }
        },

        // path: '/:pathMatch(.*)*',
        // redirect: "/"
    },
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
});

export default router;
