import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default function useTickets() {
    const tickets = ref([]);
    const ticket = ref([]);
    const router = useRouter();
    const errors = ref("");

    const getTickets = async () => {
        let response = await axios.get("/api/extract-tickets/");
        tickets.value = response.data.data;
    };

    const getTicketsForQueue = async () => {
        let response = await axios.get("/api/queue/");
        tickets.value = response.data;
        console.log(response.data);
    };

    const getTicket = async (id) => {
        let response = await axios.get("/api/get-ticket/" + id);
        ticket.value = response.data;
    };

    const storeTicket = async (data) => {
        errors.value = "";
        try {
            await axios.post("/api/add-ticket", data);
            await router.push({ name: "auth.queue" });
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
        }
    };

    const updateTicket = async (id) => {
        errors.value = "";
        try {
            await axios.put("/api/update-ticket/" + id, company.value);
            await router.push({ name: "tickets.index" });
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
        }
    };

    const destroyTicket = async (id) => {
        await axios.delete("/api/delete-ticket/" + id);
    };

    return {
        tickets,
        ticket,
        errors,
        getTickets,
        getTicketsForQueue,
        getTicket,
        storeTicket,
        updateTicket,
        destroyTicket,
    };
}
