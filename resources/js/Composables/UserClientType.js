import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default function useUserClientTypes() {
    const userClientTypes = ref([]);
    const userClientType = ref([]);
    const router = useRouter();
    const errors = ref("");

    const getUserClientTypes = async () => {
        let response = await axios.get("/api/userClientType");
        userClientTypes.value = response.data.data;
    };

    const getUserClientType = async (id) => {
        let response = await axios.get("/api/userClientType/" + id);
        userClientType.value = response.data;
    };

    const storeUserClientType = async (data) => {
        errors.value = "";
        try {
            await axios.post("/api/userClientType/", data);
            await router.push({ name: "userClientTypes.index" });
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
        }
    };

    const updateUserClientType = async (id) => {
        errors.value = "";
        try {
            await axios.put("/api/userClientType/" + id, company.value);
            await router.push({ name: "userClientTypes.index" });
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
        }
    };

    const destroyUserClientType = async (id) => {
        await axios.delete("/api/userClientType/" + id);
    };

    return {
        userClientTypes,
        userClientType,
        errors,
        getUserClientTypes,
        getUserClientType,
        storeUserClientType,
        updateUserClientType,
        destroyUserClientType,
    };
}
