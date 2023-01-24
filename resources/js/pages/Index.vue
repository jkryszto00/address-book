<script setup>
import { ref, onMounted, watch } from 'vue'
import { NAutoComplete, NCard, NList, NListItem, NThing } from 'naive-ui'

import useAddresses from "../composables/addresses"
import usePlacematic from "../3rd/placematic"
import {debounce} from "lodash";

const { addresses, filterAddresses } = useAddresses()
const { addressSuggestions, getAddressSuggestions } = usePlacematic()

const search = ref('')

onMounted(async () => await filterAddresses(null))

watch(search, debounce((newSearch) => {
    getAddressSuggestions(newSearch)
    filterAddresses(newSearch)
}, 250))
</script>
<template>
    <n-card title="Addresses">
        <template #header>
            <n-auto-complete
                placeholder="Search address"
                v-model:value="search"
                :clearable="true"
                :options="addressSuggestions"
            />
        </template>
        <n-list>
            <template v-for="address in addresses" :key="address.id">
                <n-list-item>
                    <n-thing
                        :title="`${address.number} ${address.street}`"
                        :description="`${address.city}, ${address.zip}`"
                    />
                </n-list-item>
            </template>
        </n-list>
    </n-card>
</template>
