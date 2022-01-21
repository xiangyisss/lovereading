<template>
    <div class="mb-5 review-box">
        <p>review: {{ review.review }}</p>
        <p>user_id: {{ review.user_id }}</p>
        <div v-if="id === review.user_id">
            <button class="btn btn-primary" @click="emitChangeComment">
                Edit
            </button>
            <button class="btn btn-primary" @click="deleteReview">
                Delete
            </button>
        </div>
    </div>
</template>

<script lang="ts">
import { Inertia } from "@inertiajs/inertia";
import { defineComponent } from "vue";
import axios from "axios";
import AuthUser from "../../../stores/AuthUser";

export default defineComponent({
    props: {
        review: {
            type: Object,
            required: true,
        },
        book: {
            type: Object,
            required: true,
        },
    },
    setup(props, { emit }) {
        const { state } = AuthUser();
        const editReview = () => {};
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
        const emitChangeComment = () => {
            emit("editComment");
        };
        return {
            deleteReview,
            ...state,
            editReview,
            emitChangeComment,
        };
    },
});
</script>

<style scoped>
button {
    display: inline-block;
}
</style>
