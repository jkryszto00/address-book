<script setup>
import { ref } from 'vue'
import { useStore } from 'vuex'

const store = useStore()

const form = ref({
    email: '',
    password: ''
})

const validationErrors = ref({})
const processing = ref(false)

async function login() {
    processing.value = true

    await axios.get('/sanctum/csrf-cookie')
    await axios.post('/login', form.value).then(({data}) => {
        validationErrors.value = {}
        store.dispatch('auth/login')
    }).catch(({response}) => {
        if (response.status === 422) {
            validationErrors.value = response.data.errors
        } else {
            validationErrors.value = {}
            alert(response.data.message)
        }
    }).finally(() => {
        processing.value = false
    })
}
</script>
<template>
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12 col-md-6 offset-md-3">
                <div class="card shadow sm">
                    <div class="card-body">
                        <h1 class="text-center">Login</h1>
                        <hr/>
                        <form @submit.prevent="login" class="row" method="post">
                            <div class="col-12" v-if="Object.keys(validationErrors).length > 0">
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        <li v-for="(value, key) in validationErrors" :key="key">{{ value[0] }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label for="email" class="font-weight-bold">Email</label>
                                <input type="text" v-model="form.email" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group col-12 my-2">
                                <label for="password" class="font-weight-bold">Password</label>
                                <input type="password" v-model="form.password" name="password" id="password" class="form-control">
                            </div>
                            <div class="col-12 mb-2">
                                <button type="submit" :disabled="processing" @click="login" class="btn btn-primary btn-block">
                                    {{ processing ? "Please wait" : "Login" }}
                                </button>
                            </div>
                            <div class="col-12 text-center">
                                <label>Don't have an account? <router-link :to="{name:'Register'}">Register Now!</router-link></label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
