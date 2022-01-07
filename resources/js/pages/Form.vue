<template>
    <div>
        <h1>This is Form Components</h1>
        <!-- <form  enctype="multipart/form-data"  @submit.prevent="$emit('sendBookData', bookData)"> -->
        <form  enctype="multipart/form-data"  @submit.prevent="sendBookData">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" v-model="bookInfo.title" required>
            <label for="author">Author</label>
            <input type="test" name="author" id="author" v-model="bookInfo.author" required>
            <label for="description">Description</label>
            <textarea type="text" name="description" id="description" v-model="bookInfo.description" > </textarea>
            <label for="genre">Genre</label>
            <input type="text" name="genre" id="genre" v-model="bookInfo.genre" required>
            <label for="image">Image</label>
            <input type="file"  ref="images"  name="image" id="image" @change="imageUpload($event)" >
            <label for="image">Link</label>
            <input type="text" name="buy_link" id="buy_link" v-model="bookInfo.buy_link">
            <button>Submit</button>
        </form>
    </div>
</template>

<script lang="ts">
import { defineComponent, reactive, ref } from 'vue'

interface Book {
    title: string
    author: string
    description: string
    genre: string
    image: string
    buy_link:string
}

export default defineComponent({
    props: {
        book: {
            type: Object ,
            required: true  
        }
    },
    // emits:['sendBookData'],
    setup ( props, { emit }) {
        const images = ref();
        const imageUpload = async ($event : Event) => {
            const target = $event.target as HTMLInputElement
            if ( target && target.files ) {
                images.value = target.files[0];
                console.log('working', images.value)
            } 
        }
        const bookInfo = reactive({
            title : props.book.title || '',
            author : props.book.author || '',
            description : props.book.description || '',
            genre : props.book.genre || '',
            buy_link : props.book.buy_link || ''
        })

        const sendBookData = () => {

            let bookData = new FormData();
            bookData.append('title', bookInfo.title,)
            bookData.append('author', bookInfo.author,)
            bookData.append('description', bookInfo.description,)
            bookData.append('genre', bookInfo.genre,)
            bookData.append('image', images.value,)
            bookData.append('buy_link', bookInfo.buy_link,)
            // console.log('check data', bookData)
            emit('emitData', bookData)
        }

        return { images, imageUpload, bookInfo, sendBookData}
    }
})
</script>

<style scoped>

</style>