<script setup>
import { ref, defineProps, onMounted } from "vue";
import { NCard, NButton, NForm, NFormItem, NInput, NGrid, NGi } from 'naive-ui'
import useAddresses from "../../composables/addresses"

const { address, updateAddress, getAddress } = useAddresses()

const props = defineProps({
    id: {
        required: true,
        type: String
    }
})
const formRef = ref(null)

const rules = {
    number: {
        required: true,
        message: 'Street number is required'
    },
    street: {
        required: true,
        message: 'Street is required'
    },
    city: {
        required: true,
        message: 'City is required'
    },
    zip: {
        required: true,
        message: 'Zip is required'
    }
}

onMounted(() => getAddress(props.id))

const addAddress = async (e) => {
    formRef.value?.validate(async (errors) => {
        if (!errors) {
            await updateAddress(props.id)
        }
    })
}
</script>
<template>
    <n-card title="Add address">
        <n-form
            ref="formRef"
            :model="address"
            :rules="rules"
        >
            <n-grid x-gap="12" cols="2">
                <n-gi>
                    <n-form-item label="Number" path="number">
                        <n-input v-model:value="address.number" />
                    </n-form-item>
                </n-gi>
                <n-gi>
                    <n-form-item label="Street" path="street">
                        <n-input v-model:value="address.street" />
                    </n-form-item>
                </n-gi>
            </n-grid>
            <n-grid x-gap="12" cols="2">
                <n-gi>
                    <n-form-item label="City" path="city">
                        <n-input v-model:value="address.city" />
                    </n-form-item>
                </n-gi>
                <n-gi>
                    <n-form-item label="Zip Code" path="zip">
                        <n-input v-model:value="address.zip" />
                    </n-form-item>
                </n-gi>
            </n-grid>
        </n-form>
        <template #action>
            <n-button type="info" :block="true" @click="addAddress">Update address</n-button>
        </template>
    </n-card>
</template>
