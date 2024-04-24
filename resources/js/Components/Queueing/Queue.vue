<template>
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
                            <th class="text-start" style="padding-top: 2rem">
                                Queue #
                            </th>
                            <template v-if="userRole === 'Supervisor'">
                                <th
                                    class="text-start"
                                    style="padding: 0 1.5rem; padding-top: 2rem"
                                >
                                    Ticket #
                                </th>
                                <th
                                    class="text-start"
                                    style="padding: 0 1.5rem; padding-top: 2rem"
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
                            </template>
                            <th
                                class="text-start"
                                style="padding: 0 1.5rem; padding-top: 2rem"
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
                                style="padding: 0 1.5rem; padding-top: 2rem"
                            >
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(ticket, index) in tickets" :key="index">
                            <td style="padding-top: 2rem">
                                {{
                                    ticketStatusFilter === "Pending"
                                        ? `${index + 1}`
                                        : ""
                                }}
                            </td>
                            <template v-if="userRole === 'Supervisor'">
                                <td
                                    class="text-normal"
                                    style="padding: 0 1.5rem; padding-top: 2rem"
                                >
                                    {{ ticket.ticket_number }}
                                </td>
                                <td
                                    class="text-normal"
                                    style="padding: 0 1.5rem; padding-top: 2rem"
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
                            </template>
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
                                style="padding-left: 2rem; padding-top: 2rem"
                            >
                                <v-dialog max-width="500">
                                    <template
                                        v-slot:activator="{
                                            props: activatorProps,
                                        }"
                                    >
                                        <button v-bind="activatorProps">
                                            <v-icon
                                                size="20px"
                                                style="padding-left: 1.5rem"
                                                class="drawer-icon primary-color"
                                                >fas fa-eye</v-icon
                                            >
                                        </button>
                                    </template>

                                    <template v-slot:default="{ isActive }">
                                        <v-card title="Dialog">
                                            <v-card-text>
                                                Lorem ipsum dolor sit amet,
                                                consectetur adipiscing elit, sed
                                                do eiusmod tempor incididunt ut
                                                labore et dolore magna aliqua.
                                            </v-card-text>

                                            <v-card-actions>
                                                <v-spacer></v-spacer>

                                                <v-btn
                                                    text="Close Dialog"
                                                    @click="
                                                        isActive.value = false
                                                    "
                                                ></v-btn>
                                            </v-card-actions>
                                        </v-card>
                                    </template>
                                </v-dialog>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </v-row>
    </v-container>
</template>

<script>
import { ref, onMounted } from "vue";
import useTickets from "@/Composables/Tickets";
import useAssigningTickets from "@/Composables/AssignTickets";
import useCategories from "@/Composables/Categories";
import Pusher from "pusher-js";

export default {
    setup() {
        const { tickets, getTicketsForQueue } = useTickets();
        const { categories, extractCategories } = useCategories();
        const { assignTicket } = useAssigningTickets();

        const ticketStatusFilter = ref("Pending");
        const categoryId = ref(1);
        let userRole = "Supervisor";

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
            userRole,
            categories,
            categoryId,
            ticketStatusFilter,
            handleCategoryChange,
            handleTicketStatusChange,
        };
    },
};
</script>
