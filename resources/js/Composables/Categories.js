import { ref } from "vue";
import axios from "axios";

export default function useCategories() {
    const categories = ref([]);
    const errors = ref("");

    const extractCategories = async () => {
        let response = await axios.get("/api/extract-categories");
        categories.value = response.data.data;
    };

    return {
        categories,
        extractCategories,
    };
}
