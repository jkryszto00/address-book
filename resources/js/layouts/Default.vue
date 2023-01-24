<script setup>
import { useStore } from 'vuex'
import { computed } from 'vue'

const store = useStore()

const user = computed(() => store.getters["auth/user"])
const isAuthenticated = computed(() => store.getters["auth/authenticated"])

function logout() {
    store.dispatch('auth/logout')
}
</script>
<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <router-link :to="{ name: 'Index'}" class="navbar-brand">Address book</router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto">
                    <template v-if="isAuthenticated">
                        <li class="nav-item">
                            <router-link :to="{ name:'AddressMyList' }" class="nav-link">My addresses</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name:'AddressAdd' }" class="nav-link">Users</router-link>
                        </li>
                    </template>
                </ul>
                <div class="d-flex">
                    <ul class="navbar-nav">
                        <template v-if="!isAuthenticated">
                            <li class="nav-item">
                                <router-link :to="{ name:'Login' }" class="nav-link">Login</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{ name:'Register' }" class="nav-link">Register</router-link>
                            </li>
                        </template>
                        <li v-else class="nav-item dropdown">
                            <button type="button" class="nav-link btn btn-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ user.email }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                                <li>
                                    <button class="dropdown-item" type="button" @click="logout">Logout</button>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <main class="container mt-3">
        <router-view></router-view>
    </main>
</template>
