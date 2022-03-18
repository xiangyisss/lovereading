<template>
    <div class="card p-2 shadow p-3 mb-5 bg-body rounded border-0" style="width: 21rem;">
        <Link :href="`/books/${book.id}`">
        <div id="container">
            <img :src="`/storage/${book.image}` ?? '../../../../../../public/images/dummybookimage.jpg'" style="height:500px" class="img-scale card-img-top" alt="...">
        </div>
        </Link>
        <div class="card-body">
            <h6 class="card-title">{{book.title}}</h6>
            <p class="card-text mt-2"> <span>By</span>   {{book.author}}</p>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue'
import { Link } from '@inertiajs/inertia-vue3'
import { Book } from '@/interface/Book'

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

<style scoped>
    #container {
        overflow: hidden;
    }
    #container img {
        transition: transform .3s;
    }
    #container:hover img {
        transform: scale(1.03);
    }
    span {
        font-weight: 500;
    }
    h6{
        font-family: 'Libre Caslon Text', serif;
        font-weight: 600;
    }
    p,span {
        color: #75625a;
    }
</style>