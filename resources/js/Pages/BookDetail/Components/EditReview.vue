<template>
    <div @click="editReview">
        <label for="review" class="form-label"></label>
        <textarea name="review" id="review" 
            class="form-control" cols="30" rows="2" 
            v-model="reviewInfo.review" >
        </textarea>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref, PropType } from 'vue';
import axios from 'axios'
import { Review  } from '@/interface/Review';

export default defineComponent({
    props: {
        review: {
            type: Object as PropType<Review>,
            required: true
        }
    },
    setup( props ) {
        const reviewInfo = ref('')
         const editReview = () => {
            axios.get(`reviews/edit/${props.review.id}`)
            .then(
                (res) => {
                    reviewInfo.value = res.data.review
                    console.log('review', reviewInfo.value)
                }
            )
        };
        return { reviewInfo , editReview }
    }
})
</script>