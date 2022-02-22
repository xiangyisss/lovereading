<template>
    <header>
        <div class="menu-wrapper">
            <div class="logo">
                <!-- <img src="../../../icon/heart-tree.svg" alt=""> -->
                <Link href="/"> Reading tree </Link>
            </div>
            <div class="menu-list">
                <Link href="/about">About</Link>
                <div v-if="username" class="logout">
                    <Link href="/books/add_new_book">Add book </Link>
                    <Logout />
                </div>
                <div v-else class="login">
                    <Link href="/login_form" >Login</Link>
                    <Link href="/register_form"  >Register</Link>
                </div>
            </div>
        </div>
    </header>
    <main>
        <article>
            <slot/>
        </article>
    </main>
    <footer>© 2022 Loveread, Xiang YS</footer>
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
        Logout
    },
    setup() {
        //@ts-ignore
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

header {
    width: 100%;
    height: 6vh;
    background-color: #DAAA63;
    flex-shrink: 0;
    font-family: 'Montserrat', sans-serif;;
}
.logo a {
    font-size: 1.2rem;
    font-weight: 600;
    color: #2C1810;
}
.logo img {
    width: 20px;
    margin-right: 0.5rem;
}
.menu-wrapper {
    width: 80%;
    max-width: 1500px;
    height: 100%;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
main {
    flex: 1 0 auto;
    width: 70%;
    margin: 0 auto;
}

footer {
    width: 100%;
    height: 50px;
    line-height: 50px;
    background-color: #DAAA63;
    color: whitesmoke;
    text-align: center;
    flex-shrink: 0;
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
    font-weight: 500;
    display: block;
    font-size: 1rem;
}
.login,
.logout {
    width: 60%;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
@media (max-width: 900px) {
    .menu-list {
        width: 60%
    }
    .login, .logout {
        width: 60%;
    }
}

@media (max-width: 640px) {
    .menu-list {
        width: 60%
    }
    .login, .logout {
        width: 65%;
    }

}

@media (max-width: 550px) {
    .menu-list, .logout {
        width: 65%
    }

    .logo a, .menu-list a {
        font-size: 0.85rem !important;
    }

}

@media (max-width: 460px) {
    .login {
        width: 60%;
    }
    .logout {
        width: 65%;
    }
}

</style>
