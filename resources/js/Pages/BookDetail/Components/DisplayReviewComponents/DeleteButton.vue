<template>
    <button @click="deleteReview">
        Delete
    </button>
</template>

<script setup lang="ts">
    import axios from 'axios'
    import { Inertia } from "@inertiajs/inertia"

    const props = defineProps<{
        reviewId?: number;
        bookId?: number;
    }>()

    const deleteReview = () => {
        axios
            .delete(`reviews/${props.reviewId}`)
            .then(() =>
                Inertia.visit(`/books/${props.bookId}`, {
                    only: ["book"],
                    preserveScroll: true,
                })
            )
            .catch((err) => console.log(err.message));
    };
</script>

<style scoped>
    button {
        width: 4rem;
            border: 1px solid #4B79A1;
            border-radius: 4px;
            background-color: transparent;
    }
</style>