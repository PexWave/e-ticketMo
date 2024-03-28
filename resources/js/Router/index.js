import { createRouter, createWebHistory } from "vue-router";

const SupervisorDashboard = () => import("@/Components/Supervisor/SupervisorDashboard.vue");
const ClientHomepage = () => import("@/Components/Client/ClientHomepage.vue");
const CreateTicket = () => import("@/Components/Forms/CreateTicket.vue");
const CreateTask = () => import("@/Components/Forms/CreateTask.vue");
const CreateUsers= () => import("@/Components/Forms/CreateUsers.vue");
const Offices= () => import("@/Components/Supervisor/Offices.vue");

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
            {
                path: "/supervisor-dashboard",
                name: "auth.supervisor-dashboard",
                component: SupervisorDashboard,
            },
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
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
