<template>
    <div class="flex">
        <h3>Tickets:</h3>

        <select
            id="client"
            v-model="ticketStatusFilter"
            class="input-box transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 rounded-md shadow-sm border border-gray-300 hover:border-gray-400 px-3 py-2"
            placeholder="Select a Client"
            @change="handleTicketStatusChange"
        >
            <option key="1" value="All Items" class="py-2">All Items</option>
            <option key="2" value="Pending" class="py-2">Pending</option>
            <option key="3" value="In Progress" class="py-2">
                In Progress
            </option>
            <option key="4" value="Resolved" class="py-2">Resolved</option>
            <option key="5" value="Unresolved" class="py-2">Unresolved</option>
        </select>

        <select
            id="client"
            v-model="categoryId"
            class="input-box transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 rounded-md shadow-sm border border-gray-300 hover:border-gray-400 px-3 py-2"
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

        <table class="w-full">
            <thead>
                <tr>
                    <th style="padding: 0 2rem">#</th>
                    <th style="padding: 0 2rem">Task</th>
                    <th style="padding: 0 2rem">Client Type</th>
                    <th style="padding: 0 2rem">Status</th>
                    <th style="padding: 0 2rem">Importance</th>
                    <th style="padding: 0 2rem">Urgency</th>
                    <th style="padding: 0 2rem">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(ticket, index) in tickets" :key="index">
                    <td style="padding: 0 2rem">
                        {{
                            ticketStatusFilter === "Pending"
                                ? `Queue #${index + 1}`
                                : ""
                        }}
                    </td>
                    <td style="padding: 0 2rem">{{ ticket.task }}</td>
                    <td style="padding: 0 2rem">{{ ticket.client_type }}</td>
                    <td style="padding: 0 2rem">{{ ticket.ticket_status }}</td>
                    <td style="padding: 0 2rem">{{ ticket.importance }}</td>
                    <td style="padding: 0 2rem">{{ ticket.urgency }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import { ref, onMounted } from "vue";
import useTickets from "@/Composables/Tickets";
import useAssigningTickets from "@/Composables/AssignTickets";
import useCategories from "@/Composables/Categories";
import Pusher from "pusher-js";

export default {
    name: "App",

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
};
</script>
