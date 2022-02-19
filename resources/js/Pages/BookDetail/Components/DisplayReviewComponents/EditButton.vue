<template>
    <button @click="editReview">Edit</button>
</template>

<script setup lang="ts">
    import { Review } from '@/interface/Review';
    import axios from 'axios'

    const props = defineProps<{
        review: Review
    }>()

    const emit = defineEmits<{
        (e: 'changeEditStatus', payload: boolean): void
        (e: 'getReview', payload: Review): void
    }>()

    const editReview = () => {
        emit('changeEditStatus', true)
        axios.get(`reviews/edit/${props.review.id}`)
            .then(
                (res) => {
                    emit('getReview', res.data.review)
                }
            )
            .catch(
                err => console.log(err.message)
            )
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