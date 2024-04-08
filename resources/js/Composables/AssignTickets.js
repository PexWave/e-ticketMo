import { ref } from "vue";
import axios from "axios";

export default function useAssigningTickets() {
    const errors = ref("");

    const assignTicket = async (data) => {
        errors.value = "";
        try {
            await axios.post("/api/assign-ticket", data.value);
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
            console.log(e.errors);
        }
    };


    return {
        assignTicket
    };
}
