<template>
    <div>
        <button @click="logout" >Log out</button>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import axios from 'axios'
export default defineComponent({
    setup () {

        const logout = () => {
            axios.post('/logout')
        }

        return { logout }
    }
})
</script>

<style scoped>

</style>