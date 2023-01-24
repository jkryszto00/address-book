import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from "vue-router";

export default function useAddresses() {
    const addresses = ref([])
    const address = ref([])
    const router = useRouter()

    const getAddresses = async () => {
        let response = await axios.get('/api/addresses')
        addresses.value = response.data
    }

    const getAddress = async (id) => {
        let response = await axios.get('/api/addresses/' + id)
        address.value = response.data
    }

    const storeAddress = async (payload) => {
        await axios.post('/api/addresses', payload)
        await router.push({ name: 'AddressMyList' })
    }

    const updateAddress = async (id) => {
        await axios.put('/api/addresses/' + id, address.value)
        await router.push({ name: 'AddressMyList' })
    }

    const destroyAddress = async (id) => {
        await axios.delete('/api/addresses/' + id)
    }

    return {
        addresses,
        address,
        getAddresses,
        getAddress,
        storeAddress,
        updateAddress,
        destroyAddress
    }
}
