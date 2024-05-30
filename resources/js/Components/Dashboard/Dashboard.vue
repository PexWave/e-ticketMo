<template style="background-color: #f4f5ff">
    <Sidebar />
    <v-layout align-center justify-center class="px-20">
        <v-col cols="3" class="px-10 py-10 mt-20">
            <!--ignore this -->
        </v-col>

        <v-col cols="8" align-center justify-center>
            <v-row class="px-5 py-5">
                <h1>Good morning, Nicole.</h1>
            </v-row>

            <v-row class="total-tickets px-5 py-5">
                <h2>Total Tickets</h2>
                <v-divider inset></v-divider>
                <h1>10,000</h1>
            </v-row>

            <v-row class="row 2 px-0 py-5 pl-0">
                <v-col cols="3" align-center justify-center>
                    <v-card class="ticket-count px-0 py-10">
                        <h2>Pending</h2>
                        <h1>100</h1>
                    </v-card>
                </v-col>

                <v-col cols="3" align-center justify-center>
                    <v-card class="ticket-count px-0 py-10">
                        <h2>In Progress</h2>
                        <h1>50</h1>
                    </v-card>
                </v-col>

                <v-col cols="3" align-center justify-center>
                    <v-card class="ticket-count px-0 py-10">
                        <h2>Resolved</h2>
                        <h1>64</h1>
                    </v-card>
                </v-col>

                <v-col cols="3" align-center justify-center>
                    <v-card class="ticket-count px-0 py-10">
                        <h2>Unresolved</h2>
                        <h1>23</h1>
                    </v-card>
                </v-col>
            </v-row>

            <v-row>
                <v-col
                    cols="3"
                    class="text-lg primary-color margin-0 font-medium"
                    >Offices</v-col
                >
                <v-col
                    cols="9"
                    class="text-lg primary-color margin-0 font-medium"
                    >Users</v-col
                >
            </v-row>

            <v-row class="px-0 pl-0">
                <v-col cols="3" align-center justify-center>
                    <v-card class="office-count px-0 py-10">
                        <h2>Total</h2>
                        <h1>163</h1>
                    </v-card>
                </v-col>

                <v-col cols="3" align-center justify-center>
                    <v-card class="user-count px-0 py-10">
                        <h2>Help Desk</h2>
                        <h1>4</h1>
                    </v-card>
                </v-col>

                <v-col cols="3" align-center justify-center>
                    <v-card class="user-count px-0 py-10">
                        <h2>Client</h2>
                        <h1>63</h1>
                    </v-card>
                </v-col>

                <v-col cols="3" align-center justify-center>
                    <v-card class="user-count px-0 py-10">
                        <h2>Staff</h2>
                        <h1>12</h1>
                    </v-card>
                </v-col>
            </v-row>

            <v-row>
                <v-col
                    cols="12"
                    class="text-lg pt-12 primary-color margin-0 font-medium"
                    >Ticket Queues</v-col
                >
            </v-row>

            <Queue />

            <!-- <v-row>
                <Footer />
            </v-row> -->
        </v-col>
        <!-- end -->
    </v-layout>
</template>

<script>
import "@fortawesome/fontawesome-free/css/all.min.css";

import Footer from "@/Components/Layout/Footer.vue";
import Sidebar from "@/Components/Dashboard/Sidebar.vue";
import Queue from "@/Components/Queueing/Queue.vue";
import "../../../css/global.css";

export default {
    components: {
        Footer,
        Sidebar,
        Queue,
    },
};
</script>
