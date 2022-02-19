<template>
    <button @click="postReview">Post Review</button>
</template>

<script setup lang="ts">
    import axios from 'axios'
    import { Inertia } from '@inertiajs/inertia';

    const props = defineProps<{
        reviewId: number
        bookId?: number
        reviewInfo: {
            review: string,
            book_id?: number,
        }
    }>()
    const postReview = () => {
            axios.put(`reviews/${props.reviewId}`, props.reviewInfo)
            .then(
                () => {
                    Inertia.visit(`/books/${props.bookId}`, {
                        only: ["book"],
                        preserveScroll: true,
                    })
                }
            )
            .catch(
                err => console.log(err.message)
            )
        }
</script>

<style scoped>
    button {
        padding: 0.25rem 0.5rem;
        border: 1px solid #4B79A1;
        border-radius: 4px;
        background-color: transparent;
        color: black;
    }
</style>