<template>
    <div class="container">

        <BookDetailComponent :book="book"/>     
        <CreateOrUpdateReview
            v-if="!userHasCommented"
            :book="book" 
        />
        <DisplayReview 
            v-for="review in book.reviews" 
            :key="review.id" 
            :review="review"
            :book="book"
        />
    </div>    
</template>

<script lang="ts">
import { defineComponent, computed } from 'vue'
import MasterLayout from '@/Master/MasterLayout.vue';
import BookDetailComponent from './Components/BookDetailComponent.vue'
import CreateOrUpdateReview from './Components/CreateOrUpdateReview.vue'
import DisplayReview from './Components/DisplayReview.vue'


export default defineComponent({
    layout: MasterLayout,
    props: {
        book: {
            type: Object,
            required: true
        },
        userHasCommented: {
            type: Boolean,
            required: true
        }
    },
    components: { 
        BookDetailComponent, 
        CreateOrUpdateReview, 
        DisplayReview 
    },
})
</script>

<style scoped>

</style>