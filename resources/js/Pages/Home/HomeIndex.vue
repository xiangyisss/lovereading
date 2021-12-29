<template>
    <div>
        <h1>This is home page</h1>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import MasterLayout from '../Master/MasterLayout.vue';

export default defineComponent({
    name: 'HomeIndex',
    layout: MasterLayout,
    setup () {
        return {}
    }
})
</script>

<style scoped>

</style>