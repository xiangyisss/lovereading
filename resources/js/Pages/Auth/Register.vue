<template>
    <div >
        <h1>This is register page.</h1>
        <h2 >Name: {{username}}</h2>
        <form action="" method="post" @submit.prevent="sendRegisterData" autocomplete="off">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" v-model="registerForm.name" required>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" v-model="registerForm.email" required>
            <label for="password1">Password</label>
            <input type="password" name="password1" id="password1" v-model="registerForm.password" required minlength="8">
            <!-- <label for="password2">Password</label>
            <input type="password" name="password2" id="password2" v-model="registerForm.password_confirm" required minlength="8"> -->
            <input type="submit" value="Register">
        </form>
    </div>
</template>

<script lang="ts">
import { defineComponent, reactive } from 'vue'
import MasterLayout from '../Master/MasterLayout.vue';
import axios from 'axios'
import AuthUser from '../../stores/AuthUser';

export default defineComponent({
    name: 'Register',
    layout: MasterLayout,
    setup () {
        
        const { state,authUser } = AuthUser();
        const registerForm = reactive({
            name : '',
            email: '',
            password: '',
            password_confirm: '',
        })

        const sendRegisterData = () => {
            axios.post('/register', registerForm)
            .then(
                () => axios.get('/auth_user')
                .then(res => {
                    authUser(res.data.name, res.data.email, res.data.id)
                })
            )
            .catch( err => {
                console.log(err.messages)
            })
        }

        return { 
            ...state,
            registerForm,
            sendRegisterData,
         }
    }
})
</script>

<style scoped>

</style>