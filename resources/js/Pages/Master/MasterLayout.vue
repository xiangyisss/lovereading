<template>
    <main>
        <header>
            <div class="logo">
                <Link href="/">Love read</Link>
            </div>
            <div class="menu-list">
                <Link href="/about">About</Link>
                <div v-if="username" class="logout">
                    <Logout />
                    <Link href="/add_new_book">Add new book </Link>
                </div>
                <div v-else class="login">
                    <Link href="/login_form" >Login</Link>
                    <Link href="/register_form"  >Register</Link>
                </div>
            </div>
        </header>
        <article>
            <slot/>
        </article>
    </main>
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import axios from "axios";
import Logout from './components/Logout.vue';
import AuthUser from '../../stores/AuthUser';

export default defineComponent({
    components: {
        Link,
        Logout,
    },
    setup() {
        //@ts-ignore
        // console.log(window.csrf_token);
        axios.defaults.headers.common = {
            "X-Requested-With": "XMLHttpRequest",
            //@ts-ignore
            "X-CSRF-TOKEN": window.csrf_token,
        };
        
        const { state, authUser } = AuthUser();
        
        onMounted( () => {
            axios.get('/auth_user')
            .then(
                (res) => {
                    authUser(res.data.name, res.data.email, res.data.id)
                }
            )
        })

        return { ...state };
    },
});
</script>

<style scoped>
main {
    width: 100%;
    height: 8vh;
    background-color: #232f3e;
}
header {
    width: 80%;
    height: 100%;
    /* background-color: green; */
    margin: 0 auto;
    padding-left: 1.5rem;
    padding-right: 1.5rem;

    display: flex;
    justify-content: space-between;
    align-items: center;
}
.menu-list{
    width: 40%;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
a {
    text-decoration: none;
    color:#f5f5f5;
    /* padding-right: 1.5rem; */
    font-weight: 500;
    display: block;
    font-size: 1.2rem;
}
.login,
.logout {
    width: 60%;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
</style>
