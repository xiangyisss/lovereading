<template>
    <div>
        <button @click="logout" >Log out</button>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import axios from 'axios'
import { Inertia } from '@inertiajs/inertia'


export default defineComponent({
    setup () {

        const logout = () => {
            axios.post('/logout')
            .then (
                () => {
                    Inertia.visit('/')
                }
            )
        }

        return { logout }
    }
})
</script>

<style scoped>
button {
    border: none;
    background: none;
    color: #f5f5f5;
    cursor: pointer;
    font-weight: 700;
    display: block;
    font-size: 1.5rem;
}
</style>