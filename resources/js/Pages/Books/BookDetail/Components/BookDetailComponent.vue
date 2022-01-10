<template>
    <div>
        <div  v-if="id == book.user_id" >
            <button class="btn btn-primary" type="submit" @click="editBook">Edit</button>
            <button class="btn btn-primary" type="submit" @click="deleteBook" >Delete</button>
        </div>
        <p class="title" >{{book.title}}</p>
        <p class="author">By {{book.author}}</p>
        <p class="description">{{book.description}}</p>
        <p class="genre">Genre {{book.author}}</p>
        <img class="image" :src="`/storage/${book.image}`" width="100"/>
        <a class="buy_link" :href="book.buy_link">Amazon</a>
    </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import axios from 'axios'
import AuthUser from '../../../../stores/AuthUser'
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
            Inertia.visit(`/update_book/${props.book.id}`)
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

