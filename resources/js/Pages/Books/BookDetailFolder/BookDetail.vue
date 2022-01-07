<template>
    <div>
        <h1>This is Book detail info page.</h1>    

        <button class="btn btn-primary" type="submit" @click="editBook">Edit</button>
        <button class="btn btn-primary" type="submit" @click="deleteBook" >Delete</button>
        <p class="title" >Title:{{book.title}}</p>
        <p class="author">Author {{book.author}}</p>
        <p class="description">Description {{book.description}}</p>
        <p class="genre">Genre {{book.author}}</p>
        <!-- <Link :href="`/books/${book.id}`"><img class="image" :src="`/storage/${book.image}`" width="100"/></Link> -->
        <img class="image" :src="`/storage/${book.image}`" width="100"/>
        <a class="buy_link" :href="book.buy_link">Buy Link </a>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import MasterLayout from '../../Master/MasterLayout.vue';
import axios from 'axios'
import { Inertia } from '@inertiajs/inertia'


export default defineComponent({
    layout: MasterLayout,
    props: {
        book: {
            type: Object,
            required: true
        }
    },

    setup (props) {

        const editBook = () => {
            Inertia.visit(`/update_book/${props.book.id}`)
        }

        const deleteBook = () => {
            axios.delete(`/books/${props.book.id}`)
                .then(() => {
                    Inertia.visit('/')
                })
        }

        return { deleteBook, editBook }
    }
})
</script>

<style scoped>

</style>