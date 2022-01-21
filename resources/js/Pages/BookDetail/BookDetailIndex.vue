<template>
    <div class="container">

        <BookDetailComponent :book="book"/>
        <CreateOrUpdateReview
            :book="book" 
           
        />
        <DisplayReview 
            v-for="review in book.reviews" 
            :key="review.id" 
            :review="review"
            :book="book"
        />
            <!-- @editComment="changeCommentVisibility" -->
    </div>    
</template>

<script lang="ts">
import { defineComponent, PropType, ref } from 'vue'
import MasterLayout from '@/Master/MasterLayout.vue';
import BookDetailComponent from './Components/BookDetailComponent.vue'
import CreateOrUpdateReview from './Components/CreateOrUpdateReview.vue'
import DisplayReview from './Components/DisplayReview.vue'
import { Review } from '@/interface/Review'

export default defineComponent({
    layout: MasterLayout,
    props: {
        book: {
            type: Object,
            required: true
        },
        review: {
            type: Object as PropType<Review>,
        }
        // userHasCommented: {
        //     type: Boolean,
        //     required: true
        // }
    },
    components: { 
        BookDetailComponent, 
        CreateOrUpdateReview, 
        DisplayReview 
    },
    // setup( props ){
    //     const commentIsVisible = ref(!props.userHasCommented)

    //     const changeCommentVisibility = () => {
    //         return commentIsVisible.value = !commentIsVisible.value
    //     }
    //     return {
    //         commentIsVisible,
    //         changeCommentVisibility
    //     }
    // }
  
})
</script>

<style scoped>

</style>