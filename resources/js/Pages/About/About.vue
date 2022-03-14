<template>
    <div class="container-md mt-5">
        <h4>This project is based on { Vue, Laravel, MySql, TypeScript } stack.</h4>
        <div class="d-flex flex-wrap">
            <p class="mt-5">The idea is form 'Good Reads' book recommendations website, for share personal most memoriable and master-class books.</p>
            <div class="reading-image"></div>
        </div>
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
    h4, p {
        font-family: 'Montserrat', sans-serif;
    }
    p {
        font-weight: 500;

    }
    .reading-image {
        width: 100%;
        height: 0;
        padding-top: 50%;
        background-image: url('../../../icon/boy-reading.svg');
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
        margin-top: 3rem;
    }
</style>