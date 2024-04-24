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

            <v-container class="light-shadow">
                <v-row class="mt-5 px-3">
                    <v-col
                        cols="6"
                        class="text-normal primary-color margin-0 font-medium"
                    >
                        <select
                            id="client"
                            v-model="ticketStatusFilter"
                            class="input-box primary-color transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 rounded-md shadow-sm border border-gray-300 hover:border-gray-400 px-3 py-2"
                            placeholder="Select a Client"
                            @change="handleTicketStatusChange"
                        >
                            <option key="2" value="Pending" class="py-2">
                                Pending
                            </option>
                            <option key="3" value="In Progress" class="py-2">
                                In Progress
                            </option>
                            <option key="4" value="Resolved" class="py-2">
                                Resolved
                            </option>
                            <option key="5" value="Unresolved" class="py-2">
                                Unresolved
                            </option>
                        </select>
                    </v-col>
                    <v-col
                        cols="6"
                        class="text-normal primary-color margin-0 font-medium"
                        ><select
                            id="client"
                            v-model="categoryId"
                            class="input-box primary-color transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 rounded-md shadow-sm border border-gray-300 hover:border-gray-400 px-3 py-2"
                            placeholder="Select a Client"
                            @change="handleCategoryChange"
                        >
                            <!-- Use v-for to generate options dynamically -->
                            <option
                                v-for="category in categories"
                                :key="category.id"
                                :value="category.id"
                                class="py-2"
                            >
                                {{ category.name }}
                            </option>
                        </select>
                    </v-col>
                </v-row>

                <v-row class="flex vh-100 primary-color px-3">
                    <div>
                        <table class="min-vw-50 text-start px-5">
                            <thead>
                                <tr>
                                    <th
                                        class="text-start"
                                        style="padding-top: 2rem"
                                    >
                                        Queue #
                                    </th>
                                    <th
                                        class="text-start"
                                        style="
                                            padding: 0 1.5rem;
                                            padding-top: 2rem;
                                        "
                                    >
                                        Ticket #
                                    </th>
                                    <th
                                        class="text-start"
                                        style="
                                            padding: 0 1.5rem;
                                            padding-top: 2rem;
                                        "
                                    >
                                        Task
                                    </th>
                                    <th
                                        class="text-start"
                                        style="
                                            padding-left: 1.2rem;
                                            padding-right: 1.2rem;
                                            padding-top: 2rem;
                                        "
                                    >
                                        Client Type
                                    </th>
                                    <th
                                        class="text-start"
                                        style="
                                            padding: 0 1.5rem;
                                            padding-top: 2rem;
                                        "
                                    >
                                        Status
                                    </th>
                                    <!-- <th
                                        class="text-start"
                                        style="
                                            padding: 0 1.5rem;
                                            padding-top: 2rem;
                                        "
                                    >
                                        Importance
                                    </th>
                                    <th
                                        class="text-start"
                                        style="
                                            padding: 0 1.5rem;
                                            padding-top: 2rem;
                                        "
                                    >
                                        Urgency
                                    </th> -->
                                    <th
                                        class="text-start"
                                        style="
                                            padding: 0 1.5rem;
                                            padding-top: 2rem;
                                        "
                                    >
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(ticket, index) in tickets"
                                    :key="index"
                                >
                                    <td style="padding-top: 2rem">
                                        {{
                                            ticketStatusFilter === "Pending"
                                                ? `${index + 1}`
                                                : ""
                                        }}
                                    </td>
                                    <td
                                        class="text-normal"
                                        style="
                                            padding: 0 1.5rem;
                                            padding-top: 2rem;
                                        "
                                    >
                                        {{ ticket.ticket_number }}
                                    </td>
                                    <td
                                        class="text-normal"
                                        style="
                                            padding: 0 1.5rem;
                                            padding-top: 2rem;
                                        "
                                    >
                                        {{ ticket.task }}
                                    </td>
                                    <td
                                        class="text-normal"
                                        style="
                                            padding-left: 1.2rem;
                                            padding-right: 1.2rem;
                                            padding-top: 2rem;
                                        "
                                    >
                                        {{ ticket.client_type }}
                                    </td>
                                    <td
                                        class="text-normal"
                                        style="
                                            padding-left: 2rem;
                                            padding-right: 3rem;
                                            padding-top: 2rem;
                                        "
                                    >
                                        {{ ticket.ticket_status }}
                                    </td>
                                    <!-- <td
                                        class="text-normal"
                                        style="
                                            padding: 0 1.5rem;
                                            padding-top: 2rem;
                                        "
                                    >
                                        {{ ticket.importance }}
                                    </td>
                                    <td
                                        class="text-normal"
                                        style="
                                            padding: 0 1.5rem;
                                            padding-top: 2rem;
                                        "
                                    >
                                        {{ ticket.urgency }}
                                    </td> -->
                                    <td
                                        class="text-normal"
                                        style="
                                            padding-left: 2rem;
                                            padding-top: 2rem;
                                        "
                                    >
                                        <button>
                                            <v-icon
                                                size="20px"
                                                style="padding-left: 1.5rem"
                                                class="drawer-icon primary-color"
                                                >fas fa-eye</v-icon
                                            >
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </v-row>
            </v-container>

            <!-- <v-row>
                <Footer />
            </v-row> -->
        </v-col>
        <!-- end -->
    </v-layout>
</template>

<script>
import Footer from "@/Components/Layout/Footer.vue";
import Sidebar from "@/Components/Dashboard/Sidebar.vue";
import { ref, onMounted } from "vue";
import useTickets from "@/Composables/Tickets";
import useAssigningTickets from "@/Composables/AssignTickets";
import useCategories from "@/Composables/Categories";
import Pusher from "pusher-js";
import "../../../css/global.css";

export default {
    setup() {
        const { tickets, getTicketsForQueue } = useTickets();
        const { categories, extractCategories } = useCategories();
        const { assignTicket } = useAssigningTickets();

        const ticketStatusFilter = ref("Pending");
        const categoryId = ref(1);

        onMounted(() => {
            Pusher.logToConsole = true;

            const pusher = new Pusher("3026c4d8bbdb03f57b3c", {
                cluster: "ap1",
            });

            const channel = pusher.subscribe("ticket-queue");
            channel.bind("ticket", (data) => {
                // When a new ticket is received, push it to the tickets array
                if (
                    !tickets.value.some(
                        (ticket) => ticket.ticket_id === data["ticket_id"]
                    )
                ) {
                    // Add the new ticket if it doesn't exist
                    tickets.value.push(data);
                } else {
                    // Find the existing ticket and update its status
                    const existingTicketIndex = tickets.value.findIndex(
                        (ticket) => ticket.ticket_id === data["ticket_id"]
                    );
                    if (existingTicketIndex !== -1) {
                        // Ticket found, update its status
                        tickets.value[existingTicketIndex].ticket_status =
                            "In Progress";
                    } else {
                        // Handle potential errors (e.g., unexpected ID mismatch)
                        console.error("Unexpected error: Ticket ID mismatch");
                    }
                }
                // Sort the tickets immediately after pushing the new ticket
                sortAndAssignTickets();

                // assign ticket to available staff
                assignTicket([...tickets.value, data]);
            });

            // Initial call to load tickets
            reloadTickets(ticketStatusFilter.value, categoryId.value);

            // Reload tickets every minute
            // setInterval(reloadTickets, 60000);
        });

        // FUNCTIONS

        // Fetch initial tickets
        const reloadTickets = (ticketStatus, categoryId) => {
            // categoryId.value = tickets.value[0].category_id;
            extractCategories().then(() => {
                getTicketsForQueue(ticketStatus).then(() => {
                    sortAndAssignTickets(categoryId);
                });
            });
        };

        const sortTickets = (categoryId) => {
            // Filter tickets based on categoryId
            const filteredTickets = tickets.value.filter(
                (ticket) => ticket.category_id === categoryId
            );

            // Sort the filtered tickets
            const sortedTickets = [...filteredTickets].sort((a, b) => {
                const priorityA = Number(a.importance) + Number(a.urgency);
                const priorityB = Number(b.importance) + Number(b.urgency);

                if (priorityA === priorityB) {
                    if (a.urgency === b.urgency) {
                        return (
                            new Date(a.reference_date) -
                            new Date(b.reference_date)
                        );
                    }
                    return b.urgency - a.urgency;
                }

                return priorityB - priorityA;
            });

            console.log("Sorted tickets:", sortedTickets);

            // Update tickets array with sorted and filtered tickets
            tickets.value = sortedTickets;
        };

        const sortAndAssignTickets = async (categoryId) => {
            // Sort the tickets
            sortTickets(categoryId);
        };

        const handleTicketStatusChange = () => {
            reloadTickets(ticketStatusFilter.value, categoryId.value);
        };

        const handleCategoryChange = () => {
            reloadTickets(ticketStatusFilter.value, categoryId.value);
        };

        return {
            tickets,
            categories,
            categoryId,
            ticketStatusFilter,
            handleCategoryChange,
            handleTicketStatusChange,
        };
    },
    components: {
        Footer,
        Sidebar,
    },
};
</script>
