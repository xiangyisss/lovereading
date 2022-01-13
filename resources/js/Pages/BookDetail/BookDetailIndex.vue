<template>    
    <BookDetailComponent :book="book"/>     
    <BookReview :book="book"/>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import MasterLayout from '@/Master/MasterLayout.vue';
import BookDetailComponent from './Components/BookDetailComponent.vue'
import BookReview from './Components/BookReview.vue'

export default defineComponent({
    layout: MasterLayout,
    props: {
        book: {
            type: Object,
            required: true
        }
    },
    components: { BookDetailComponent, BookReview },
    setup () {

    }
})
</script>

<style scoped>

</style>