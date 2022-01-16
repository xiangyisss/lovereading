import { reactive, toRefs } from '@vue/reactivity';

const reviewInfo = reactive({
    user_id: 0,
    book_id: 0,
})

export default () => {
    const review = (user_id: number, book_id: number) => {
        reviewInfo.user_id = user_id,
        reviewInfo.book_id = book_id
    }
    return {
        reviewInfo: toRefs(reviewInfo),
        review
    }
}