<template>
    <div class="container mt-5">
        <form action="" method="post" @submit.prevent="postReview">
            <div class="mb-3">
                <label for="review" class="form-label"
                    >What did you think?</label
                >
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
    </div>
</template>

<script lang="ts">
import { defineComponent, reactive, PropType } from "vue";
import axios from "axios";
import { Book } from "@/interface/Book";
import { constructFormData } from '../../../Utils/helpers'

export default defineComponent({
    props: {
        book: {
            type: Object as PropType<Book>,
            required: true,
        },
    },
    setup(props) {
        const reviewInfo = reactive({
            review: "",
            book_id: props.book.id,
        });
        const postReview = () => {
            axios.post(`/books/reviews`, constructFormData(reviewInfo))
            .then(
                res => console.log('post review ok', res.data)
            )
            .catch(
                err => console.log('error', err.message)
            )
        };

        return { postReview, reviewInfo };
    },
});
</script>

<style scoped></style>
