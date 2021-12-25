<template>
    <div>
        <Link href="/reviews">Reviews page</Link>
        <h1>This is the books page</h1>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import { Link } from '@inertiajs/inertia-vue3'

export default defineComponent({
    name: 'BookIndex',
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