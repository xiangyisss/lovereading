<template>
    <div>
        <h1>This is Book detail info page.</h1>
        <p>This book is {{ book.title}}</p>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
    props: {
        book: {
            type: Object,
            required: true
        }
    },
    setup () {
        

        return {}
    }
})
</script>

<style scoped>

</style>