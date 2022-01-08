<template>
    <div>
        <h1 >This is the books page</h1>
        <BookComponent class="book-box" :book="book" v-for="book in books" :key="book.id"/>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import MasterLayout from '@/Master/MasterLayout.vue';
import BookComponent from './Components/BookComponent.vue'

export default defineComponent({
    name: 'BookIndex',
    layout: MasterLayout,
    components:{ BookComponent },
    props: {
        books:{
            type: Array,
            required: true
        }
    },
    setup () {

        return { }
    }
})
</script>

<style scoped>
.buy_link {
    color: crimson;
    cursor: pointer;
}
img {
    width: 300px;
}
</style>