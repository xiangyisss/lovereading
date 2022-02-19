<template>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center g-5">
            <div class="col-md-8 col-lg-6 col-xl-4" >
                <img class="img-fluid" :src="`/storage/${book.image}`"/>
            </div>
            <div class="col-md-12 col-lg-6 col-xl-8 d-flex flex-column justify-content-center bookdetails">
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
        width: 11rem;
        padding: 0.25rem 0.5rem;
        text-align: center;
        background-color: transparent;
        border-radius: 4px;
        text-decoration: none;
        color: #4B79A1;
        border: 1px solid #4B79A1;
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
    h1, p, span {
        font-family: 'Libre Caslon Text', serif;
    }
    img {
        box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 1px, rgba(0, 0, 0, 0.07) 0px 2px 2px, rgba(0, 0, 0, 0.07) 0px 4px 4px, rgba(0, 0, 0, 0.07) 0px 8px 8px, rgba(0, 0, 0, 0.07) 0px 16px 16px;
    }
</style>
