<script setup>
import { reactive, ref } from "vue";
import { NCard, NButton, NForm, NFormItem, NInput, NGrid, NGi } from 'naive-ui'
import useAddresses from "../../composables/addresses"

const { storeAddress } = useAddresses()

const formRef = ref(null)

const form = reactive({
    number: '',
    street: '',
    city: '',
    zip: ''
})

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

const addAddress = async (e) => {
    formRef.value?.validate(async (errors) => {
        if (!errors) {
            await storeAddress(form)
        }
    })
}
</script>
<template>
    <n-card title="Add address">
        <n-form
            ref="formRef"
            :model="form"
            :rules="rules"
        >
            <n-grid x-gap="12" cols="2">
                <n-gi>
                    <n-form-item label="Number" path="number">
                        <n-input v-model:value="form.number" />
                    </n-form-item>
                </n-gi>
                <n-gi>
                    <n-form-item label="Street" path="street">
                        <n-input v-model:value="form.street" />
                    </n-form-item>
                </n-gi>
            </n-grid>
            <n-grid x-gap="12" cols="2">
                <n-gi>
                    <n-form-item label="City" path="city">
                        <n-input v-model:value="form.city" />
                    </n-form-item>
                </n-gi>
                <n-gi>
                    <n-form-item label="Zip Code" path="zip">
                        <n-input v-model:value="form.zip" />
                    </n-form-item>
                </n-gi>
            </n-grid>
        </n-form>
        <template #action>
            <n-button type="info" :block="true" @click="addAddress">Add address</n-button>
        </template>
    </n-card>
</template>
