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
                    <td style="padding: 0 2rem">{{ index + 1 }}</td>
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
import Pusher from "pusher-js";

export default {
    name: "App",

    setup() {
        const { tickets, getTicketsForQueue } = useTickets();
        const ticketStatusFilter = ref("All Items");

        onMounted(() => {
            Pusher.logToConsole = true;

            const pusher = new Pusher("3026c4d8bbdb03f57b3c", {
                cluster: "ap1",
            });

            const channel = pusher.subscribe("ticket-queue");
            channel.bind("ticket", (data) => {
                // When a new ticket is received, push it to the tickets array
                tickets.value.push(data);
                // Sort the tickets immediately after pushing the new ticket
                sortAndAssignTickets();
            });

            // Initial call to load tickets
            reloadTickets(ticketStatusFilter.value);

            // Reload tickets every minute
            // setInterval(reloadTickets, 60000);
        });

        // FUNCTIONS

        // Fetch initial tickets
        const reloadTickets = (ticketStatus) => {
            getTicketsForQueue(ticketStatus).then(() => {
                sortAndAssignTickets();
            });
        };

        const sortTickets = () => {
            const sortedTickets = [...tickets.value].sort((a, b) => {
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

            tickets.value = sortedTickets;
            console.log(tickets.value);
        };

        const sortAndAssignTickets = async () => {
            // Sort the tickets then assigning a ticket to available staff
            sortTickets();

            // assign ticket to available staff
        };

        const handleTicketStatusChange = () => {
            reloadTickets(ticketStatusFilter.value);
        };

        return {
            tickets,
            ticketStatusFilter,
            handleTicketStatusChange,
        };
    },
};
</script>
