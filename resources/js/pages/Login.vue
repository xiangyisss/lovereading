<template>
    <div>
        <form @submit.prevent="submit">
            <input v-model="form.email" placeholder="email"/>
            <input v-model="form.password" placeholder="password"/>
            <button>Login</button>
        </form>
    </div>
</template>

<script lang="ts">
import { defineComponent, reactive } from 'vue'
import axios from 'axios'

export default defineComponent({
    setup () {

        const form = reactive({
            email: '',
            password: ''
        })
        const submit = () => {
            axios.post('/login',{
                _token: 'Qwixwf24hYXAV8imtE5DRbNJF4ypey5CtSMa55Hq',
                email: form.email,
                password: form.password,
            })
        }

        return {
            form, submit
        }
    }
})
</script>

<style scoped>

</style>