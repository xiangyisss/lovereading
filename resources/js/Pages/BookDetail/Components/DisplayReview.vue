<template>
    <div class="reviews-container mt-3 mb-5">
        <div class="card" >
            <!-- <div v-if="!showEditReviewContainer" class="card-header"></div> -->
            <div class="card-header"><img src="../../../../icon/user-icon.svg" alt=""> {{review.username}}</div>
            <div v-if="!showEditReviewContainer" class="card-body">{{ review.review }}</div>
            <div v-if="!showEditReviewContainer" class="card-footer">Created at {{dateFormated}}
                <div v-if="id === review.user_id && !showEditReviewContainer" class="edit-buttons">
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
        </div>
        <div v-if="showEditReviewContainer" >
            <label for="review" class="form-label"></label>
            <textarea name="review" id="review"
                class="form-control mb-3" cols="30" rows="5"
                v-model="reviewInfo.review" >
            </textarea>
            <PostButton
                :review-id="review.id"
                :book-id="book.id"
                :review-info="reviewInfo"
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
textarea {
    resize: none;
}
textarea:focus {
    box-shadow: none;
}
.card {
    margin: 0 auto;
}
.card-header img {
    width: 24px;
}
.card-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;
}
.edit-buttons {
    margin-left: 1rem;
    width: 9rem;
    display: flex;
    justify-content: space-between;
}
.edit-buttons button {
    border: 1px solid #4B79A1;
    border-radius: 4px;
    background-color: transparent;
    color: black;
}
.edit-buttons button:hover {
    border: none;
    background-color: #4B79A1;
    color: whitesmoke;
}

</style>
