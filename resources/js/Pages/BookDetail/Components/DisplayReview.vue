<template>
    <div class="mb-5 review-box">
        <p v-if="!showEditReviewContainer">review: {{ review.review }}</p>

        <div v-if="showEditReviewContainer" >
            <label for="review" class="form-label"></label>
            <textarea name="review" id="review" 
                class="form-control" cols="30" rows="2" 
                v-model="reviewInfo.review" >
            </textarea>
            <button class="btn btn-primary" @click="updateReview">Post</button>
        </div>

        <div v-if="id === review.user_id && !showEditReviewContainer">
            <button class="btn btn-primary" @click="editReview" >
                Edit
            </button>
            <button class="btn btn-primary" @click="deleteReview">
                Delete
            </button>

        </div>
    </div>
</template>

<script lang="ts">
import { Inertia } from "@inertiajs/inertia"
import { defineComponent, PropType, reactive, ref } from "vue"
import axios from "axios"
import AuthUser from "../../../stores/AuthUser"
import { Review } from '@/interface/Review'
import { Book } from '@/interface/Book'
import { constructFormData } from '../../../Utils/helpers'

export default defineComponent({
    props: {
        review: {
            type: Object as PropType<Review>,
            required: true,
        },
        book: {
            type: Object as PropType<Book>,
            required: true,
        },
    },
    setup( props ) {
        const { state } = AuthUser();
        const showEditReviewContainer = ref(false)
        const reviewInfo = reactive({
            review: ' ',
            book_id: props.book.id,
        });
         const editReview = () => {
            showEditReviewContainer.value = true
            axios.get(`reviews/edit/${props.review.id}`)
            .then(
                (res) => {
                    reviewInfo.review = res.data.review.review
                }
            )
            .catch(
                err => console.log(err.message)
            )
        };

        const deleteReview = () => {
            axios
                .delete(`reviews/${props.review.id}`)
                .then(() =>
                    Inertia.visit(`/books/${props.book.id}`, {
                        only: ["book"],
                        preserveScroll: true,
                    })                    
                )
                .catch((err) => console.log(err.message));
        };

        const updateReview = () => {
            axios.put(`reviews/${props.review.id}`, reviewInfo)
            .then(
                () => {
                    Inertia.visit(`/books/${props.book.id}`, {
                        only: ["book"],
                        preserveScroll: true,
                    })
                }
            )
            .catch(
                err => console.log(err.message)
            )
        }

        return {
            deleteReview,
            ...state,
            reviewInfo,
            editReview,
            showEditReviewContainer,
            updateReview,
        };
    },
});
</script>

<style scoped>
button {
    display: inline-block;
}
</style>
