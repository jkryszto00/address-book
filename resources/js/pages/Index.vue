<script setup>
import { onMounted } from 'vue'
import { NCard, NList, NListItem, NThing } from 'naive-ui'

import useAddresses from "../composables/addresses"

const { addresses, getAddresses } = useAddresses()

onMounted(getAddresses)
</script>
<template>
    <n-card title="Addresses">
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
