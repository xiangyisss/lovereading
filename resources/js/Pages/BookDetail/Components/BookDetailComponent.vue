<template>
    <div class="container mt-5">
        <div class="row justify-content-center g-5">
            <div class="col-md-6 col-lg-4" >
                <img class="img-fluid" :src="`/storage/${book.image}`"/>
            </div>
            <div class="col-md-6 col-lg-8 bookdetails">
                <h1 class="title" >{{book.title}}</h1>
                <div class="edit-buttons" v-if="id == book.user_id" >
                        <button type="submit" @click="editBook">Edit</button>
                        <button type="submit" @click="deleteBook" >Delete</button>
                </div>
                <p class="author"><span>By</span>  {{book.author}}</p>
                <p class="genre"><span>Genre</span>  {{book.genre}}</p>
                <p class="description">{{book.description}}</p>
                <a class="buy_link" :href="book.buy_link">Get from Amazon</a>
            </div>
        </div>


    </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import axios from 'axios'
import AuthUser from '../../../stores/AuthUser'
import { Book } from '@/interface/Book'

export default defineComponent({
    props: {
        book: {
            type: Object as PropType<Book>,
            required: true
        }
    },
    setup ( props ) {

        const { state } = AuthUser();

        const editBook = () => {
            Inertia.visit(`/books/edit/${props.book.id}`)
        }

        const deleteBook = () => {
            axios.delete(`/books/${props.book.id}`)
                .then(() => {
                    Inertia.visit('/')
                })
        }

        return { editBook, deleteBook, ...state,  }
    }
})
</script>

<style scoped>
    span {
        font-weight: 600;
    }
    .bookdetails a {
        padding: 0.5rem;
        background-color: #4B79A1;
        border-radius: 4px;
        text-decoration: none;
        color: whitesmoke;
        box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
    }
    .bookdetails> * {
        margin-bottom: 1.25rem;
    }
    button {
        width: 4rem;
        border: 1px solid #4B79A1;
        border-radius: 4px;
        background-color: transparent;
        color: rgb(228, 118, 118);
    }
    .edit-buttons {
        width: 10rem;
        display: flex;
        justify-content: space-between;
    }

</style>
