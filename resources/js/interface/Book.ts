export interface Book{
    title: string
    author: string
    description: string
    genre: string
    image?: string
    buy_link: string
    id?: number
    user_id?: number
    reviews: {
        review: any
        user_id: any
        
    }
}