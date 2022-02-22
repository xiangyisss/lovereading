<template>
    <div class="container mt-5" >
        <form  action="" method="post" @submit.prevent="login" >
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                    class="form-control"
                    type="email"
                    name="email"
                    id="email"
                    v-model="loginData.email"
                    required
                />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input
                    class="form-control"
                    type="password"
                    v-model="loginData.password"
                    autocomplete=""
                    required
                />
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</template>

<script lang="ts">
import { defineComponent, reactive } from "vue";
import MasterLayout from "@/Master/MasterLayout.vue";
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

<style scoped>
    button {
        width: 6rem;
        padding: 0.5rem;
        background: transparent;
        border: 1px solid #DAAA63;
        border-radius: 4px;
        font-weight: 500;
    }
    label {
        font-weight: 500;
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
