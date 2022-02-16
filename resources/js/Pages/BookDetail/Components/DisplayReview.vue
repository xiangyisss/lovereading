<template>
    <div class="mb-5 review-box">
        <p v-if="!showEditReviewContainer">review: {{ review.review }}</p>
        <p v-if="!showEditReviewContainer">{{review.updated_at}}</p>
        <div v-if="showEditReviewContainer" >
            <label for="review" class="form-label"></label>
            <textarea name="review" id="review"
                class="form-control" cols="30" rows="2"
                v-model="reviewInfo.review" >
            </textarea>
            <button class="btn btn-primary" @click="updateReview">Post</button>
        </div>

        <div v-if="id === review.user_id && !showEditReviewContainer">
            <EditButton :review="review"
                @change-edit-status="changeShowContainerStatus"
                @get-review="updateReviewInfo"
            />
            <DeleteButton
                :book-id="book.id"
                :review-id="review.id"
            />
        </div>
    </div>
</template>

<script lang="ts">
import { Inertia } from "@inertiajs/inertia"
import { defineComponent, PropType, reactive, ref, computed, ComputedRef } from "vue"
import axios from "axios"
import AuthUser from "../../../stores/AuthUser"
import { Review } from '@/interface/Review'
import { Book } from '@/interface/Book'
import EditButton from './DisplayReviewComponents/EditButton.vue'
import DeleteButton from './DisplayReviewComponents/DeleteButton.vue'
// import { constructFormData } from '../../../Utils/helpers'

interface Props {
    review: Review,
    book: Book
}

export default defineComponent({
    components: {
        EditButton,
        DeleteButton
    },
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
    setup( props: Props ) {
        const { state } = AuthUser();
        const showEditReviewContainer = ref(false)
        const reviewInfo = reactive({
            review: ' ',
            book_id: props.book.id,
        });

        const changeShowContainerStatus = (data: boolean): void => {
            showEditReviewContainer.value = data
        }

        const updateReviewInfo = (data: Review): void => {
            reviewInfo.review = data.review
        }

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

        const dateFormated: ComputedRef<string> = computed((): string => {
            const date = new Date(props.review.updated_at)
            return date.toISOString().slice(0, 10)
        })

        return {
            dateFormated,
            ...state,
            reviewInfo,
            showEditReviewContainer,
            updateReview,
            changeShowContainerStatus,
            updateReviewInfo,
        };
    },
});
</script>

<style scoped>
button {
    display: inline-block;
}
</style>
