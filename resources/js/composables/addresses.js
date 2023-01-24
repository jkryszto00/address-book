import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from "vue-router";

export default function useAddresses() {
    const addresses = ref([])
    const address = ref([])
    const errors = ref('')
    const router = useRouter()

    const filterAddresses = async (filters) => {
        let response = await axios.get('/api/addresses/search', {
            params: filters
        })
        addresses.value = response.data
    }

    const getAddresses = async () => {
        let response = await axios.get('/api/addresses')
        addresses.value = response.data
    }

    const getAddress = async (id) => {
        try {
            let response = await axios.get('/api/addresses/' + id)
            address.value = response.data
        } catch (e) {
            if (e.response.status === 404 || e.response.status === 403) {
                router.go(-1)
            }
        }
    }

    const storeAddress = async (payload) => {
        errors.value = ''

        try {
            await axios.post('/api/addresses', payload)
            await router.push({ name: 'AddressList' })
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const updateAddress = async (id) => {
        errors.value = ''

        try {
            await axios.put('/api/addresses/' + id, address.value)
            await router.push({ name: 'AddressList' })
        } catch (e) {
            if (e.response.status === 404) {
                router.go(-1)
            }

            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const destroyAddress = async (id) => {
        await axios.delete('/api/addresses/' + id)
    }

    return {
        addresses,
        address,
        filterAddresses,
        getAddresses,
        getAddress,
        storeAddress,
        updateAddress,
        destroyAddress
    }
}
