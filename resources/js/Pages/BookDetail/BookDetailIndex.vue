<template>
    <div class="container">
        <BookDetailComponent :book="book"/>
        <CreateReview
            :book="book"
        />
        <DisplayReview
            v-for="review in book.reviews"
            :key="review.id"
            :book="book"
            :review="review"
        />
    </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue'
import MasterLayout from '@/Master/MasterLayout.vue';
import BookDetailComponent from './Components/BookDetailComponent.vue'
import CreateReview from './Components/CreateReview.vue'
import DisplayReview from './Components/DisplayReview.vue'
import { Book } from '@/interface/Book'

export default defineComponent({
    layout: MasterLayout,
    props: {
        book: {
            type: Object as PropType<Book>,
            required: true
        },
    },
    components: {
    BookDetailComponent,
    CreateReview,
    DisplayReview
}
})
</script>

