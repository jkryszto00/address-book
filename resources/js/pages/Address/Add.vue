<script setup>
import { watch, reactive, ref } from "vue";
import { NCard, NButton, NForm, NFormItem, NAutoComplete, NGrid, NGi } from 'naive-ui'
import { isEmpty } from "lodash";

import useAddresses from "../../composables/addresses"
import usePlacematic from "../../3rd/placematic"

const { storeAddress } = useAddresses()
const { addressSuggestions, getAddressSuggestions } = usePlacematic()

const formRef = ref(null)

let form = reactive({})

const rules = {
    number: {
        required: true,
        message: 'Street number is required'
    },
    street: {
        required: true,
        message: 'Street number is required'
    },
    city: {
        required: true,
        message: 'City number is required'
    },
    zip: {
        required: true,
        message: 'Zip number is required'
    }
}

const addAddress = async (e) => {
    formRef.value?.validate(async (errors) => {
        if (!errors) {
            await storeAddress(form)
        }
    })
}

const addressQuery = ref()

watch(addressQuery, (query) => {
    getAddressSuggestions(query)
})

function setAddressForm(value) {
    const addressObject = addressSuggestions.value.filter((address) => address.label === value)

    if (!isEmpty(addressObject)) {
        form = addressObject[0].value
    }
}
</script>
<template>
    <n-card title="Add address">
        <n-form
            ref="formRef"
            :model="form"
            :rules="rules"
        >
            <n-grid x-gap="12" cols="1">
                <n-gi>
                    <n-form-item label="Address">
                        <n-auto-complete
                            v-model:value="addressQuery"
                            :options="addressSuggestions"
                            @update:value="setAddressForm"
                        />
                    </n-form-item>
                </n-gi>
            </n-grid>
        </n-form>
        <template #action>
            <n-button type="info" :block="true" @click="addAddress">Add address</n-button>
        </template>
    </n-card>
</template>
