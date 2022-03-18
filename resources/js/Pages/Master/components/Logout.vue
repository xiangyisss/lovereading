<template>
    <div >
        <button @click="logout" >Log out</button>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import axios from 'axios'
import { Inertia } from '@inertiajs/inertia'
import AuthUser from '../../../stores/AuthUser'

export default defineComponent({
    setup () {

        const { authUser } = AuthUser();
        const logout = () => {
            axios.post('/logout')
            .then(
                res => authUser(res.data.name, res.data.email, res.data.id)
            )
            .then(
                () => {
                    Inertia.visit('/')
                }
            )
        }

        return { logout,}
    }
})
</script>

<style scoped>
button {
    border: none;
    background: none;
    color: #f5f5f5;
    cursor: pointer;
    font-weight: 500;
    display: block;
    font-size: 1rem;
}

@media (max-width: 550px) {
    button {
        font-size: 0.85rem;
    }
}

</style>