<template>
    <div class="container-xl mt-5">
        <div class="row justify-content-center gap-5" >
            <BookComponent class="col-md-4" :book="book" v-for="book in books" :key="book.id"/>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import MasterLayout from '@/Master/MasterLayout.vue';
import BookComponent from './Components/BookComponent.vue'

export default defineComponent({
    name: 'BookIndex',
    layout: MasterLayout,
    props: {
        books:{
            type: Array,
            required: true
        }
    },
    components:{ BookComponent },
    setup () {

        return { }
    }
})
</script>

<style scoped>
</style>