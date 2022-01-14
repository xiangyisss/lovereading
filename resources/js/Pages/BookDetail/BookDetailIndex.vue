<template>    
    <BookDetailComponent :book="book"/>     
    <BookReview :book="book"/>
    <DisplayReview 
        v-for="review in book.reviews" 
        :key="review.id" 
        :review="review"
    />
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import MasterLayout from '@/Master/MasterLayout.vue';
import BookDetailComponent from './Components/BookDetailComponent.vue'
import BookReview from './Components/BookReview.vue'
import DisplayReview from './Components/DisplayReview.vue'

export default defineComponent({
    layout: MasterLayout,
    props: {
        book: {
            type: Object,
            required: true
        }
    },
    components: { BookDetailComponent, BookReview, DisplayReview },
})
</script>

<style scoped>

</style>