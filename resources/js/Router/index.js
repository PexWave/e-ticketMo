import { createRouter, createWebHistory } from "vue-router";

const SupervisorDashboard = () => import("@/Components/Supervisor/SupervisorDashboard.vue");
const ClientHomepage = () => import("@/Components/Client/ClientHomepage.vue");
const CreateTicket = () => import("@/Components/Forms/CreateTicket.vue");
const CreateTask = () => import("@/Components/Forms/CreateTask.vue");
const CreateUsers = () => import("@/Components/Forms/CreateUsers.vue");
const Offices = () => import("@/Components/Supervisor/Offices.vue");

const Home = () => import("@/Components/Home.vue");

// Authentication
const SignIn = () => import("@/Components/Auth/SignIn.vue");
const SignUp = () => import("@/Components/Auth/SignUp.vue");

// Queueing
const Queueing = () => import("@/Components/Queueing/Queue.vue");

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
    {
        path: "/supervisor",
        component: {
            template: "<router-view/>",
        },
        children: [
            {
                path: "/supervisor-dashboard",
                name: "auth.supervisor-dashboard",
                component: SupervisorDashboard,
            },

            {
                path: "/createTask",
                name: "auth.createTask",
                component: CreateTask,
            },

            {
                path: "/createUsers",
                name: "auth.createUsers",
                component: CreateUsers,
            },

            {
                path: "/offices",
                name: "auth.offices",
                component: Offices,
            },
        ],
    },
    {
        path: "/client",
        component: {
            template: "<router-view/>",
        },
        children: [
            {
                path: "/client-home",
                name: "auth.client-home",
                component: ClientHomepage,
            },

            {
                path: "/createTicket",
                name: "auth.createTicket",
                component: CreateTicket,
            },
        ],
    },
    {
        path: "/queueing",
        component: {
            template: "<router-view/>",
        },
        children: [
            {
                path: "/queue",
                name: "auth.queue",
                component: Queueing,
            },
        ],
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
