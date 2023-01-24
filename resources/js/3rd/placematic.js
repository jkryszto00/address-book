import { ref } from 'vue'
import axios from 'axios'

window.axios.defaults.withCredentials = false

export default function usePlacematic() {
    const API_URL = 'https://address-autocomplete-pl-stage.placematic.pl/1.0/suggest/'
    const addressSuggestions = ref([])

    const getAddressSuggestions = async (search) => {
        let response = await axios.get(API_URL + 'address', {
            params: {
                query: search,
                approximate: true,
                approximationRange: 10,
                outputSchema: 'basic',
                sortBy: 'populationClass'
            }
        })

        addressSuggestions.value = response.data.map((address) => {
            return {
                label: `${address.houseNumber} ${address.street}, ${address.city}, ${address.zip}`,
                value: {
                    number: address.houseNumber,
                    street: address.street,
                    city: address.city,
                    zip: address.zip
                }
            }
        })
    }

    return {
        addressSuggestions,
        getAddressSuggestions
    }
}
