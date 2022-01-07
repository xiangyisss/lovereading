<template>
    <div>
        <h1 >This is the books page</h1>
        
        
        <div class="book-box" v-for="book in books" :key="book.id">
            <p class="title" >Title:{{book.title}}</p>
            <p class="author">Author {{book.author}}</p>
            <p class="description">Description {{book.description}}</p>
            <p class="genre">Genre {{book.author}}</p>
            <!-- <Link :href="`/books/${book.id}`"><img class="image" :src="`/storage/${book.image}`" width="100"/></Link> -->
            <Link :href="`/books/${book.id}`">
                <img class="image" :src="`/storage/${book.image}`" width="100"/>
            </Link>
            <a class="buy_link" :href="book.buy_link">Buy Link </a>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import MasterLayout from '../../Master/MasterLayout.vue';
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
    name: 'BookIndex',
    layout: MasterLayout,
    components:{ Link },
    props: {
        books:{
            type: Object,
            required: true
        }
    },
    setup () {
        // const books = ref('')
        // onMounted(() => {
        //     axios.get('/books')
        //     .then(
        //         (res) => {
        //             books.value = res.data
        //         }                
        //     )
        //     .catch(err => console.log(err))
        // })

        // const goToBookDetail = (id:number) => {
        //     console.log(id)
        // }

        return { }
    }
})
</script>

<style scoped>
.buy_link {
    color: crimson;
    cursor: pointer;
}
img {
    width: 300px;
}
</style>