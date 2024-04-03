<template>
    <div class="p-10 w-full container">
        <h2>Ticket Form</h2>

        <form @submit.prevent="addTicketAndProcess">
            <input
                type="number"
                placeholder="Importance"
                v-model="onHoldTicket.importance"
            />
            <input
                type="number"
                placeholder="Urgency"
                v-model="onHoldTicket.urgency"
            />
            <input
                type="number"
                placeholder="User Id"
                v-model="onHoldTicket.user_id"
            />
            <input
                type="number"
                placeholder="Task type Id"
                v-model="onHoldTicket.task_type_id"
            />

            <button type="submit">Add Ticket</button>
        </form>
        <br />

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
import { ref, reactive, onMounted } from "vue";
import useTickets from "@/Composables/Tickets";
import Pusher from "pusher-js";
import axios from "axios";

export default {
    name: "App",

    setup() {
        const { tickets, getTicketsForQueue } = useTickets();

        const onHoldTicket = ref({
            importance: "",
            urgency: "",
            user_id: "",
            ticket_status: "Pending",
            actual_response: null,
            actual_resolve: null,
            remarks: null,
            task_type_id: "",
            modified_date: new Date().toISOString().slice(0, 16),
            reference_date: new Date().toISOString().slice(0, 16),
        });

        // const tickets = ref([
        //     {
        //         importance: 4,
        //         urgency: 5,
        //         user_id: 1,
        //         ticket_status: "Pending",
        //         actual_response: null,
        //         actual_resolve: null,
        //         remarks: null,
        //         task_type_id: 1,
        //         modified_date: new Date().toISOString().slice(0, 16),
        //         reference_date: new Date().toISOString().slice(0, 16),
        //     },
        //     {
        //         importance: 3,
        //         urgency: 4,
        //         user_id: 2,
        //         ticket_status: "Pending",
        //         actual_response: null,
        //         actual_resolve: null,
        //         remarks: null,
        //         task_type_id: 3,
        //         modified_date: new Date().toISOString().slice(0, 16),
        //         reference_date: new Date().toISOString().slice(0, 16),
        //     },
        //     {
        //         importance: 2,
        //         urgency: 3,
        //         user_id: 3,
        //         ticket_status: "Pending",
        //         actual_response: null,
        //         actual_resolve: null,
        //         remarks: null,
        //         task_type_id: 2,
        //         modified_date: new Date().toISOString().slice(0, 16),
        //         reference_date: new Date().toISOString().slice(0, 16),
        //     },
        //     {
        //         importance: 1,
        //         urgency: 2,
        //         user_id: 2,
        //         ticket_status: "Pending",
        //         actual_response: null,
        //         actual_resolve: null,
        //         remarks: null,
        //         task_type_id: 2,
        //         modified_date: new Date().toISOString().slice(0, 16),
        //         reference_date: new Date().toISOString().slice(0, 16),
        //     },
        //     {
        //         importance: 5,
        //         urgency: 1,
        //         user_id: 1,
        //         ticket_status: "Pending",
        //         actual_response: null,
        //         actual_resolve: null,
        //         remarks: null,
        //         task_type_id: 3,
        //         modified_date: new Date().toISOString().slice(0, 16),
        //         reference_date: new Date().toISOString().slice(0, 16),
        //     },
        // ]);

        const startingData = reactive({
            importance: "",
            urgency: "",
            user_id: "",
            ticket_status: "Pending",
            actual_response: null,
            actual_resolve: null,
            remarks: null,
            task_type_id: "",
            modified_date: new Date().toISOString().slice(0, 16),
            reference_date: new Date().toISOString().slice(0, 16),
        });

        const handleChangeForTicket = (event) => {
            const { name, value } = event.target;
            onHoldTicket.value = { ...onHoldTicket.value, [name]: value };
        };

        const addTicketAndProcess = async () => {
            const newTicket = { ...onHoldTicket.value };
            // tickets.value.push(newTicket);

            let data = {
                importance: newTicket.importance,
                urgency: newTicket.urgency,
                user_id: newTicket.user_id,
                ticket_status: "Pending",
                actual_response: new Date().toISOString().slice(0, 16),
                actual_resolve: new Date().toISOString().slice(0, 16),
                remarks: "adsdf",
                task_type_id: newTicket.task_type_id,
                modified_date: new Date().toISOString().slice(0, 16),
                reference_date: new Date().toISOString().slice(0, 16),
            };

            await axios.post("/api/add-ticket", data, {
                headers: {
                    "Content-Type": "application/json",
                },
            });

            // Remove the newly added ticket from the local array
            tickets.value = tickets.value.filter(
                (ticket) => ticket !== newTicket
            );
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
            // Function to fetch tickets and sort them
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
            onHoldTicket,
            tickets,
            handleChangeForTicket,
            addTicketAndProcess,
        };
    },
};
</script>
