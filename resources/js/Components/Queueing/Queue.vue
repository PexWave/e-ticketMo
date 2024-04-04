<template>
    <div class="p-10 w-full container">
        <h3>Tickets:</h3>

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
import { onMounted } from "vue";
import useTickets from "@/Composables/Tickets";
import Pusher from "pusher-js";

export default {
    name: "App",

    setup() {
        const { tickets, getTicketsForQueue } = useTickets();

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

            // Fetch initial tickets
            const reloadTickets = () => {
                getTicketsForQueue().then(() => {
                    sortAndAssignTickets();
                });
            };

            // Initial call to load tickets
            reloadTickets();

            // Reload tickets every minute
            // setInterval(reloadTickets, 60000);
        });

        return {
            tickets,
        };
    },
};
</script>
