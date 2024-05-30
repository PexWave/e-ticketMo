import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default function useTaskTypes() {
    const taskTypes = ref([]);
    const taskType = ref([]);
    const router = useRouter();
    const errors = ref("");

    const getTaskTypes = async () => {
        let response = await axios.get("/api/task/");
        taskTypes.value = response.data.data;
    };

    const getTaskType = async (id) => {
        let response = await axios.get("/api/get-task/" + id);
        taskType.value = response.data;
    };

    const storeTaskType = async (data) => {
        errors.value = "";
        try {
            await axios.post("/api/task/", data);
            await router.push({ name: "taskTypes.index" });
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
        }
    };

    const updateTasktype = async (id) => {
        errors.value = "";
        try {
            await axios.put("/api/task/" + id, company.value);
            await router.push({ name: "taskTypes.index" });
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
        }
    };

    const destroyTaskType = async (id) => {
        await axios.delete("/api/task/" + id);
    };

    return {
        taskTypes,
        taskType,
        errors,
        getTaskTypes,
        getTaskType,
        storeTaskType,
        updateTasktype,
        destroyTaskType,
    };
}
