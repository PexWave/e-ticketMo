import { createRouter, createWebHistory } from "vue-router";

const Home = () => import("@/Components/Home.vue");

// Authentication
const SignIn = () => import("@/Components/Auth/SignIn.vue");
const SignUp = () => import("@/Components/Auth/SignUp.vue");

const routes = [
    {
        path: "/",
        name: "home",
        component: Home,
    },
    {
        path: "/auth",
        component: {
            template: "<router-view/>",
        },
        children: [
            {
                path: "/signin",
                name: "auth.signin",
                component: SignIn,
            },
            {
                path: "/signup",
                name: "auth.signup",
                component: SignUp,
            },
        ],
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
