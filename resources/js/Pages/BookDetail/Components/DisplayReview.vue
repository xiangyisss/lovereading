<template>
    <div>
        <p>{{review.review}}</p>

    </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";


export default defineComponent({
    props: {
        review: {
            type: Object,
            required: true,
        },
    },
    setup() {

        return {};
    },
});
</script>

<style scoped></style>
