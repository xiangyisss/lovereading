<template>
    <div>
        <h1 >This is the books page</h1>

        <div class="book-box" v-for="book in books" :key="book.id">
            <p class="title" >Title:{{book.title}}</p>
            <p class="author">Author {{book.author}}</p>
            <p class="description">Description {{book.description}}</p>
            <p class="genre">Genre {{book.author}}</p>
            <img class="image" :src="book.image" />Image 
            <a class="buy_link" :href="book.buy_link">Buy Link </a>
        </div>
    </div>
</template>

<script lang="ts">
import axios from 'axios';
import { defineComponent, onMounted, reactive, ref } from 'vue'
import MasterLayout from '../Master/MasterLayout.vue';

interface Book {
    title: string
    author: string
    description: string
    genre: string
    image: string
    buy_link:string
}

export default defineComponent({
    name: 'BookIndex',
    layout: MasterLayout,
    setup () {
        const books = ref('')
        onMounted(() => {
            axios.get('/books')
            .then(
                (res) => {
                    books.value = res.data;
                }
                
            )
            .catch(err => console.log(err))
        })

        return { books }
    }
})
</script>

<style scoped>
/* .book-box {
    width: 300px;
    height: 200px;
    background-color: pink;
} */
.buy_link {
    color: crimson;
    cursor: pointer;
}
img {
    width: 300px;
}
</style>