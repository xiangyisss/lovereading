<template>
    <div>
        <button @click="logout" >Log out</button>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import axios from 'axios'
import AuthUser from '../../../stores/AuthUser'

export default defineComponent({
    setup () {

        const { state } = AuthUser();

        const logout = () => {
            axios.post('/logout')
            .then (
                () => {
                    window.location.href = '/'
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
    font-size: 1rem;
    color: rgb(240, 33, 33);
    cursor: pointer;
}
</style>