<template>
    <div class="container mt-5">
        <ShareReviewButton
            :alertStatus="alertStatus"
            :showWriteReviewContainer="showWriteReviewContainer"
            @alertStatusUpdate="showAlert"
            @writeReviewBoxStatusUpdate="showReviewBox"
             v-if="!checkIfUserCommented(book.reviews, 'user_id' , id)"
        />
        <form
            action=""
            method="post"
            class="mt-2 mb-5"
            @submit.prevent="postReview"
            v-if="showWriteReviewContainer"
        >
            <div class="mb-3">
                <label for="review" class="form-label"></label>
                <textarea
                    name="review"
                    class="form-control"
                    id="review"
                    cols="30"
                    rows="5"
                    placeholder="What did you think?"
                    v-model="reviewInfo.review"
                >
                </textarea>
            </div>
            <button type="submit" >Post</button>
        </form>
        <Alert v-if="alertStatus"  />
    </div>
</template>

<script lang="ts">
import { defineComponent, reactive, PropType, ref } from "vue";
import axios from "axios";
import { Book } from "@/interface/Book";
import { Review } from "@/interface/Review";
import { constructFormData } from "../../../Utils/helpers";
import { Inertia } from "@inertiajs/inertia";
import AuthUser from "../../../stores/AuthUser";
import Alert from './Alert/Alert.vue';
import ShareReviewButton from "./CreateReviewComponents/ShareReviewButton.vue";

interface Props {
    book: Book
}
export default defineComponent({
    components: { Alert, ShareReviewButton },
    props: {
        book: {
            type: Object as PropType<Book>,
            required: true,
        },
    },
    setup(props: Props) {
        const alertStatus = ref(false);
        const showWriteReviewContainer = ref(false);

        const reviewInfo = reactive({
            review: "",
            book_id: props.book.id,
        });
        const postReview = () => {
            axios
                .post(`/books/reviews`, constructFormData(reviewInfo))
                .then(() => Inertia.visit(`/books/${props.book.id}`, {
                only: ["book"],
                preserveScroll: true,
            }))
                .catch(err => {
                if (err.response.status === 401) {
                    alert("you need an account to write a review.");
                }
                console.log(err.message);
            });
        };

        type arrayValue = (string | number | boolean);

        const checkIfUserCommented = (reviews: Review[] = [], key: string, val: arrayValue) => {
            return reviews.some((review: Review) => {
                return review.hasOwnProperty(key) && review[key] === val;
            });
        };

        const { state } = AuthUser();

        const showAlert = (data : boolean) :void => {
            alertStatus.value= data
        }
        const showReviewBox = (data : boolean) :void => {
            showWriteReviewContainer.value = data
        }

        return { ...state, postReview, reviewInfo,
            checkIfUserCommented, showWriteReviewContainer,
            showAlert, showReviewBox, alertStatus,

        };
    }
});

</script>

<style scoped>
    form {
        padding: 0.85rem;
    }
    .form-label {
        font-size: 1.5rem;
    }
    textarea {
        resize: none;
    }
    .form-control:focus {
        box-shadow: none;
    }
    button {
        padding: 0.25rem 0.5rem;
        background-color: #DAAA63;
        border-radius: 4px;
        color: whitesmoke;
        border: none;

    }

</style>
