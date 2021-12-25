<template>
    <div>
        <Link href="/books">Books page</Link>
        <h1>This is the page for reviews</h1>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import { Link } from '@inertiajs/inertia-vue3'

export default defineComponent({
    name: 'HomeIndex',
    components: {
        Link
    },
    setup () {
        return {}
    }
})
</script>

<style scoped>

</style>