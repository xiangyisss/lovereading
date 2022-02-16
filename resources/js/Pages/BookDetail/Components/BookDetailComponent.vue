<template>
    <div class="container mt-5">
        <div class="row justify-content-center g-5">
            <div class="col-md-6 col-lg-4">
                <img class="img-fluid" :src="`/storage/${book.image}`"/>
            </div>
            <div class="col-md-6 col-lg-8">
                <h1 class="title" >{{book.title}}</h1>
                <p class="author">By {{book.author}}</p>
                <p class="genre">Genre {{book.genre}}</p>
                <p class="description">{{book.description}}</p>
                <a class="buy_link" :href="book.buy_link">Amazon</a>
            </div>
            <div  v-if="id == book.user_id" >
                    <button class="btn btn-primary" type="submit" @click="editBook">Edit</button>
                    <button class="btn btn-primary" type="submit" @click="deleteBook" >Delete</button>
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

