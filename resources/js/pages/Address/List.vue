<script setup>
import { onMounted } from 'vue'
import { NButton, NButtonGroup, NCard, NList, NListItem, NThing } from 'naive-ui'

import useAddresses from "../../composables/addresses"
import router from "../../router";
const { addresses, getAddresses, destroyAddress } = useAddresses()

onMounted(getAddresses)

const deleteAddress = async (id) => {
    await destroyAddress(id)
    await getAddresses()
}
</script>
<template>
    <n-card title="My addresses">
        <template #header-extra>
            <router-link :to="{ name: 'AddressAdd' }">
                <n-button type="info">Add address</n-button>
            </router-link>
        </template>
        <n-list>
            <template v-for="address in addresses" :key="address.id">
                <n-list-item>
                    <n-thing
                        :title="`${address.number} ${address.street}`"
                        :description="`${address.city}, ${address.zip}`"
                    />
                    <template #suffix>
                        <n-button-group>
                            <n-button ghost @click="router.push({ name: 'AddressEdit', params: { id: address.id }})">Edit</n-button>
                            <n-button ghost @click="deleteAddress(address.id)">Delete</n-button>
                        </n-button-group>
                    </template>
                </n-list-item>
            </template>
        </n-list>
    </n-card>
</template>
