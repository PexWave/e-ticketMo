import { ref } from 'vue'
import axios from "axios";
import { useRouter } from 'vue-router';

export default function useClient() {
    const clients = ref([])
    const client = ref([])
    const router = useRouter()
    const errors = ref('')

    const getClients = async () => {
        let response = await axios.get('/api/extract-client-types/')
        clients.value = response.data.data;
    }

    const getClient = async (id) => {
        let response = await axios.get('/api/extract-client-types/' + id)
        client.value = response.data.data;
    }

    const storeClient = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/extract-client-types/', data)
            await router.push({name: 'clients.index'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const updateClient = async (id) => {
        errors.value = ''
        try {
            await axios.put('/api/extract-client-types/' + id, company.value)
            await router.push({name: 'clients.index'})
        } catch (e) {
            if (e.response.status === 422) {
               errors.value = e.response.data.errors
            }
        }
    }

    const destroyClient = async (id) => {
        await axios.delete('/api/extract-client-types/' + id)
    }


    return {
        clients,
        clients,
        errors,
        getClients,
        getClient,
        storeClient,
        updateClient,
        destroyClient
    }
}