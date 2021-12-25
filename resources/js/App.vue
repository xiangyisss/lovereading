<template>
    <div>
        <router-link to="/"></router-link>
        <router-view></router-view>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
    name: 'App',
    setup () {
        

        return {}
    }
})
</script>

<style scoped>

</style>