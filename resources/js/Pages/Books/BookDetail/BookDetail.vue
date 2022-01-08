<template>
    <div>
        <h1>This is Book detail info page.</h1>    
        <BookDetailComponent :book="book" />
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import MasterLayout from '@/Master/MasterLayout.vue';
import BookDetailComponent from './Components/BookDetailComponent.vue'

export default defineComponent({
    layout: MasterLayout,
    props: {
        book: {
            type: Array,
            required: true
        }
    },
    components: { BookDetailComponent },
    setup () {

    }
})
</script>

<style scoped>

</style>