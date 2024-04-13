import { ref } from "vue";
import axios from "axios";

export default function useAssigningTickets() {
    const errors = ref("");

    const assignTicket = async (data) => {
        errors.value = "";
        console.log(data);
        try {
            var response = await axios.post("/api/assign-ticket", data, {
                headers: {
                  'Content-Type': 'application/json'
                }
              });

         
                console.log(response);
            
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
            console.log(e.response.data.message);
        }
    };


    return {
        assignTicket
    };
}
