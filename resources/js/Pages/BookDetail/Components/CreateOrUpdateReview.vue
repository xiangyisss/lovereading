<template>
    <form  
        action=""
        method="post"
        class="mt-5 mb-5"
        @submit.prevent="postReview"
         v-if="!checkIfUserCommented(book.reviews, 'user_id' , id)"
    >
        <div class="mb-3">
            <label for="review" class="form-label">What did you think?</label>
            <textarea
                name="review"
                class="form-control"
                id="review"
                cols="30"
                rows="5"
                placeholder="Enter your review"
                v-model="reviewInfo.review"
            >
            </textarea>
        </div>
        <button class="btn btn-primary" type="submit">Post</button>
    </form>
</template>

<script lang="ts">
import { defineComponent, reactive, PropType } from "vue";
import axios from "axios";
import { Book } from "@/interface/Book";
import { Review } from "@/interface/Review";
import { constructFormData } from "../../../Utils/helpers";
import { Inertia } from "@inertiajs/inertia";
import AuthUser from '../../../stores/AuthUser';

interface Props {
    book: Book
}
export default defineComponent({
    props: {
        book: {
            type: Object as PropType<Book>,
            required: true,
        },    
    },
    setup(props: Props) {
        const reviewInfo = reactive({
            review: '',
            book_id: props.book.id,
        });

        const postReview = () => {
            axios
                .post(`/books/reviews`, constructFormData(reviewInfo))
                .then(() =>
                    Inertia.visit(`/books/${props.book.id}`, {
                        only: ["book"],
                        preserveScroll: true,
                    })
                )
                .catch((err) => console.log(err.message));
        };

        const { state } = AuthUser()

        type arrayValue = (string | number| boolean)
        
        const checkIfUserCommented  = 
            (reviews:Review[] = [], key:string, val:arrayValue) => {
            return reviews.some((review : Review) => {
                return review.hasOwnProperty(key) && review[key] === val
            })
        }
        return { ...state, postReview, reviewInfo, checkIfUserCommented };
    },
});

</script>

<style scoped></style>
