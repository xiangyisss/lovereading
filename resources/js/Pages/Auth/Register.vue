<template>
    <div class="container mt-5" >
                <form action="" method="post" @submit.prevent="sendRegisterData" autocomplete="off">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" v-model="registerForm.name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" v-model="registerForm.email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password1" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password1" id="password1" v-model="registerForm.password" required minlength="8">
                    </div>
                    <!-- <label for="password2">Password</label>
                    <input type="password" name="password2" id="password2" v-model="registerForm.password_confirm" required minlength="8"> -->
                    <button type="submit">Register</button>
                </form>
    </div>
</template>

<script lang="ts">
import { defineComponent, reactive } from 'vue'
import MasterLayout from '../Master/MasterLayout.vue'
import axios from 'axios'
import AuthUser from '../../stores/AuthUser'
import { Inertia } from '@inertiajs/inertia'

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
                .then(
                    res => {
                    authUser(res.data.name, res.data.email, res.data.id)
                })
                .then(
                    () => {
                        Inertia.visit('/')
                    }
                )
            )
            .catch( err => {
                console.log(err.message)
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
    button {
        width: 6rem;
        padding: 0.5rem;
        background: #49a09d;
        border: none;
        border-radius: 4px;
    }
    form {
        width: 40%;
        max-width: 600px;
        margin: 0 auto;
    }
    .form-control:focus {
        box-shadow: none;
    }

    @media (max-width: 1200px) {
        form {
            width: 50%;
        }
    }
    @media (max-width: 960px) {
        form {
            width: 60%;
        }
    }
    @media (max-width: 560px) {
        form {
            width: 80%;
        }
}
</style>