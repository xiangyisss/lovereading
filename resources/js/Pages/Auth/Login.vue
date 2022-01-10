<template>
    <div>
        <h1>This is login page</h1>
        <form action="" method="post" @submit.prevent="login">
            <label for="email">Email</label>
            <input
                type="email"
                name="email"
                id="email"
                v-model="loginData.email"
                required
            />
            <label for="password">Password</label>
            <input
                type="password"
                v-model="loginData.password"
                autocomplete=""
                required
            />
            <button>Login</button>
        </form>
    </div>
</template>

<script lang="ts">
import { defineComponent, reactive } from "vue";
import MasterLayout from "../Master/MasterLayout.vue";
import axios from "axios";
import AuthUser from '../../stores/AuthUser';
import { Inertia } from '@inertiajs/inertia';


export default defineComponent({
    name: "Login",
    layout: MasterLayout,
    setup() {

        const { authUser } = AuthUser();
        const loginData = reactive({
            email: "",
            password: "",
        });

        const login = () => {
            axios
                .post("/login", loginData)
                .then(
                    () => axios.get('/auth_user')
                    .then(
                        res => {
                            authUser(res.data.name, res.data.email, res.data.id)
                        }
                    )
                    .then(
                        () => {
                            Inertia.visit('/')
                        }
                    )
                )
                .catch((err) => console.log(err.messages));
        };

        return { loginData, login, };
    },
});
</script>

<style scoped></style>
