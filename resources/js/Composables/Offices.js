import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default function useOffice() {
    const offices = ref([]);
    const office = ref([]);
    const router = useRouter();
    const errors = ref("");

    const getOffices = async () => {
        let response = await axios.get("/api/office");
        offices.value = response.data.data;
    };

    const getOffice = async (id) => {
        let response = await axios.get("/api/office/" + id);
        office.value = response.data;
    };

    const storeOffice = async (data) => {
        errors.value = "";
        try {
            await axios.post("/api/office/", data);
            await router.push({ name: "offices.index" });
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
        }
    };

    const updateOffice = async (id) => {
        errors.value = "";
        try {
            await axios.put("/api/office/" + id, company.value);
            await router.push({ name: "offices.index" });
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
        }
    };

    const destroyOffice = async (id) => {
        await axios.delete("/api/office/" + id);
    };

    return {
        offices,
        office,
        errors,
        getOffices,
        getOffice,
        storeOffice,
        updateOffice,
        destroyOffice,
    };
}
