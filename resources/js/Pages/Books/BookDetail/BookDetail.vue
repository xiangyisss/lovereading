<template>
    <div>
        <BookDetailComponent :book="book"/>
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
            type: Object,
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