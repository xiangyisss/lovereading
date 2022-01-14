<template>
    <div class="container mt-5">
        <form  enctype="multipart/form-data" @submit.prevent="sendBookData" >
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="title" v-model="bookInfo.title" required>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="test" class="form-control" name="author" id="author" v-model="bookInfo.author" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea type="text" class="form-control" name="description" id="description" v-model="bookInfo.description" > </textarea>
            </div>
            <div class="mb-3">
                <label for="genre" class="form-label">Genre</label>
                <input type="text" class="form-control" name="genre" id="genre" v-model="bookInfo.genre" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" ref="images"  name="image" id="image" @change="imageUpload($event)" >
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Link</label>
                <input type="text" class="form-control" name="buy_link" id="buy_link" v-model="bookInfo.buy_link">
            </div>
            <button type="submit" class="btn btn-primary" >Submit</button>
            <!-- <button type="submit" class="btn btn-primary" @click="cancelSendData">Cancel</button> -->
        </form>
    </div>
</template>

<script lang="ts">
import MasterLayout from '@/Master/MasterLayout.vue'
import { defineComponent, reactive, ref } from 'vue'
import axios from 'axios'
import { Inertia } from '@inertiajs/inertia';
import { Book } from '@/interface/Book'
import { constructFormData } from '../../../Utils/helpers'

export default defineComponent({
    layout: MasterLayout,
    props: {
        book: {
            type: Object ,
            required: false  
        }
    },

    setup ( props ) {
        const images = ref();
        const imageUpload = async ($event : Event) => {
            const target = $event.target as HTMLInputElement
            if ( target && target.files ) {
                images.value = target.files[0];
            } 
        }
        const bookInfo = reactive({
            title : props.book?.title || '',
            author : props.book?.author || '',
            description : props.book?.description || '',
            genre : props.book?.genre || '',
            buy_link : props.book?.buy_link || '',
        })

        const updateBook = (bookInfo: Book) => {
            axios.put(`/books/${props.book?.id}`, bookInfo)
                .then(
                    () => Inertia.visit(`/books/${props.book?.id}`)
                )
        }

        const saveBook = (bookInfo: Book) => {
            axios.post('/books/save_book', 
                constructFormData(
                    bookInfo,
                    [
                        {key: 'image', value: images.value},
                    ]
                ))
                .then(
                    () => Inertia.visit('/')
                )
                .catch (
                    err => console.log(err.message)
                )
        }

        const sendBookData = () => {
            props.book ? updateBook(bookInfo) : saveBook(bookInfo)
        }    

        return { images, imageUpload, bookInfo, sendBookData}
    }
})
</script>

<style scoped>

</style>