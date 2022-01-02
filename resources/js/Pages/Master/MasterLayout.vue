<template>
    <main>
        <header>
            <div class="logo">
                <Link href="/">Love read</Link>
            </div>
            <div class="menu-list">
                <Link href="/about">About</Link>
                <span v-if="username">

                <Logout />
                <Link href="/add_new_book">Add new book </Link>
                </span>
                <span v-else>

                <Link href="/login_form" >Login</Link>
                <Link href="/register_form"  >Register</Link>
                </span>
            </div>
        </header>
        <article>
            <slot />
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
    /* background-color: blue; */
}
header {
    width: 90%;
    height: 100%;
    /* background-color: green; */
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.menu-list {
    width: 40%;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.menu-list > * {
    padding-right: 1.5rem;
}
a {
    text-decoration: none;
    color: rgb(240, 33, 33);
    /* padding-right: 1.5rem; */
    font-weight: 600;
    display: block;
}
</style>
