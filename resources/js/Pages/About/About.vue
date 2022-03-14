<template>
    <div class="container-md mt-5">
        <h1>This project is based on { Vue, Laravel, MySql, TypeScript } stack.</h1>
        <h5 class="mt-3">The idea is form 'Good Reads' book recommendations website, for share personal most memoriable and expertly written books.</h5>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import MasterLayout from '../Master/MasterLayout.vue'

export default defineComponent({
    name:'About',
    layout: MasterLayout,
})
</script>

<style scoped>
    h1, h5 {
        font-family: 'Montserrat', sans-serif;
    }
</style>