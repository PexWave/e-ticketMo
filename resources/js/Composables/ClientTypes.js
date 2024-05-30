import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default function useclientTypes() {
    const clientTypes = ref([]);
    const clientType = ref([]);
    const router = useRouter();
    const errors = ref("");

    const extractClientTypes = async () => {
        let response = await axios.get("/api/extract-client-types");
        clientTypes.value = response.data.data;
    };

    const getClientType = async (id) => {
        let response = await axios.get("/api/get-client-type/" + id);
        clientType.value = response.data;
    };

    const getClientTypes = async (office_id) => {
        let response = await axios.get(`/api/get-client-types/${office_id}`);
        clientTypes.value = response.data;
    };

    const storeClientType = async (data) => {
        errors.value = "";
        try {
            await axios.post("/api/add-client-type/", data);
            await router.push({ name: "clientTypes.index" });
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
        }
    };

    const updateClientType = async (id) => {
        errors.value = "";
        try {
            await axios.put("/api/update-client-type/" + id, company.value);
            await router.push({ name: "clientTypes.index" });
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
        }
    };

    const destroyClientType = async (id) => {
        await axios.delete("/api/delete-client-type/" + id);
    };

    return {
        clientTypes,
        clientType,
        errors,
        getClientTypes,
        getClientType,
        storeClientType,
        updateClientType,
        destroyClientType,
        extractClientTypes,
    };
}
