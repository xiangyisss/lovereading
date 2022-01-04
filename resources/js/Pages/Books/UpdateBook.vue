<template>
    <div>
        <Form @emit-data="bookData"/>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import Form from './components/Form.vue'
import axios from 'axios'

export default defineComponent({
    components: { Form },
    setup () {
        const bookData = (value) => {
            axios.put('books/' + {})
        }

        return { bookData }
    }
})
</script>

<style scoped>

</style>