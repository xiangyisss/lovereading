import { reactive, toRefs } from '@vue/reactivity';

const reviewInfo = reactive({
    review: '',
    user_id: 0,
    book_id: 0,
    id: 0
})

export default () => {
    const reviews = (review: string, user_id: number, book_id: number, id: number) => {
        reviewInfo.review = review,
        reviewInfo.user_id = user_id,
        reviewInfo.book_id = book_id,
        reviewInfo.id = id
    }
    return {
        reviewInfo: toRefs(reviewInfo),
        reviews
    }
}