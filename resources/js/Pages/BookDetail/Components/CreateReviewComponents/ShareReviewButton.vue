<template>
    <div>
        <button  @click="checkIfLoggedIn">Share a review</button>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue'
import AuthUser from '../../../../stores/AuthUser'


export default defineComponent({
    props : {
        showWriteReviewContainer: {
            type : Boolean,
            required : true
        },
        alertStatus: {
            type : Boolean,
            required : true
        }

    },
    setup ( props, { emit } ) {
        const { state } = AuthUser();

        const showAlertStatus = ref(props.alertStatus)

        const showWriteReviewContainerState = ref(props.showWriteReviewContainer)

        const showAlert = ():void => {
            setTimeout(() => {
                showAlertStatus.value = false;
            }, 2500)
        }

        const checkIfLoggedIn = ():boolean | void => {
            if(state.username.value) {
                showWriteReviewContainerState.value = true;
                return emit('writeReviewBoxStatusUpdate', true)
            }
            showAlertStatus.value = true;
            emit('alertStatusUpdate', true)
            showAlert()

        }
        return { checkIfLoggedIn }
    }
})
</script>

<style scoped>
    button {
        padding: 0.25rem 0.5rem;
        background-color: #DAAA63;
        border-radius: 4px;
        color: whitesmoke;
        border: none;
    }
</style>