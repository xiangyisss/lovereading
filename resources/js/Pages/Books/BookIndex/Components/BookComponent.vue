<template>
    <div class="book-box" >
        <p class="title" >Title:{{book.title}}</p>
        <p class="author">Author {{book.author}}</p>
        <p class="description">Description {{book.description}}</p>
        <p class="genre">Genre {{book.genre}}</p>
        <Link :href="`/books/${book.id}`">
            <img class="image" :src="`/storage/${book.image}`" width="100"/>
        </Link>
        <a class="buy_link" :href="book.buy_link">Buy Link </a>
    </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue'
import { Link } from '@inertiajs/inertia-vue3'

interface Book {
    title: string
    author: string
    description: string
    genre: string
    image: string
    buy_link:string
}

export default defineComponent({
    name: 'BookComponent',
    components:{ Link },
    props: {
        book:{
            type: Object as PropType<Book>,
            required: true
        }
    },
})
</script>