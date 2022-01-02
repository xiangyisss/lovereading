<template>
    <div>
        <form @submit.prevent="addNewBook" enctype="multipart/form-data">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" v-model="bookInfo.title" required>
            <label for="author">Author</label>
            <input type="test" name="author" id="author" v-model="bookInfo.author" required>
            <label for="description">Description</label>
            <textarea type="text" name="description" id="description" v-model="bookInfo.description" > </textarea>
            <label for="genre">Genre</label>
            <input type="text" name="genre" id="genre" v-model="bookInfo.genre" required>
            <label for="image">Image</label>
            <input type="file" accept="image/*" ref="images"  name="image" id="image" @change="imageUpload($event)" >
            <label for="image">Link</label>
            <input type="text" name="buy_link" id="buy_link" v-model="bookInfo.buy_link">
            <button>Add new book</button>
        </form>
    </div>
</template>

<script lang="ts">
import { defineComponent, reactive, ref } from 'vue'
import axios from 'axios'
import MasterLayout from '../Master/MasterLayout.vue'

export default defineComponent({
    layout: MasterLayout,
    setup () {
        const images = ref();
        const imageUpload = async ($event : Event) => {
            const target = $event.target as HTMLInputElement
            if ( target && target.files ) {
                images.value = target.files[0];
                console.log('working', images.value)
            } 
        }
        const bookInfo = reactive({
            title : '',
            author : '',
            description :'',
            genre : '',
            buy_link : ''
        })


        const addNewBook = () => {

            let data = new FormData();
            data.append('title', bookInfo.title,)
            data.append('author', bookInfo.author,)
            data.append('description', bookInfo.description,)
            data.append('genre', bookInfo.genre,)
            data.append('image', images.value,)
            data.append('buy_link', bookInfo.buy_link,)

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            axios.post('/save_book', data, config)
            .then( 
                (res) => console.log('Post Ok', res.data)
            )
            .catch( 
                err => console.log( err)
            )
        }

        return { bookInfo, addNewBook, imageUpload, images }
    }
})
</script>

<style scoped>

</style>

{
                title : bookInfo.title,
                author : bookInfo.author,
                description : bookInfo.description,
                genre : bookInfo.genre,
                image : images,
                buy_link : bookInfo.buy_link,
                
            } 
