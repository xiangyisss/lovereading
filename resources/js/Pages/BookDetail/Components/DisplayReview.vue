<template>
    <div class="mb-5 review-box">
        <p v-if="!showEditReviewContainer">review: {{ review.review }}</p>
        <p v-if="!showEditReviewContainer">{{dateFormated}}</p>
        <div v-if="showEditReviewContainer" >
            <label for="review" class="form-label"></label>
            <textarea name="review" id="review"
                class="form-control" cols="30" rows="2"
                v-model="reviewInfo.review" >
            </textarea>
            <PostButton
                :review-id="review.id"
                :book-id="book.id"
                :review-info="reviewInfo"
            />
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
import { defineComponent, PropType, reactive, ref, computed, ComputedRef } from "vue"
import AuthUser from "../../../stores/AuthUser"
import { Review } from '@/interface/Review'
import { Book } from '@/interface/Book'
import EditButton from './DisplayReviewComponents/EditButton.vue'
import DeleteButton from './DisplayReviewComponents/DeleteButton.vue'
import PostButton from './DisplayReviewComponents/PostButton.vue'

interface Props {
    review: Review,
    book: Book
}

export default defineComponent({
    components: {
        EditButton,
        DeleteButton,
        PostButton,
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

        const dateFormated: ComputedRef<string> = computed((): string => {
            const date = new Date(props.review.updated_at)
            return date.toLocaleDateString()
        })

        return {
            dateFormated,
            ...state,
            reviewInfo,
            showEditReviewContainer,
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
