<template>
    <div>
        <button class="btn btn-primary" type="submit" @click="editBook">Edit</button>
        <button class="btn btn-primary" type="submit" @click="deleteBook" >Delete</button>
        <p class="title" >Title:{{book.title}}</p>
        <p class="author">Author {{book.author}}</p>
        <p class="description">Description {{book.description}}</p>
        <p class="genre">Genre {{book.author}}</p>
        <img class="image" :src="`/storage/${book.image}`" width="100"/>
        <a class="buy_link" :href="book.buy_link">Buy Link </a>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import axios from 'axios'

export default defineComponent({
    props: {
        book: {
            type: Object,
            required: true
        }
    },
    setup ( props ) {
        
        const editBook = () => {
            Inertia.visit(`/update_book/${props.book.id}`)
        }

        const deleteBook = () => {
            axios.delete(`/books/${props.book.id}`)
                .then(() => {
                    Inertia.visit('/')
                })
        }

        return { editBook, deleteBook}
    }
})
</script>

