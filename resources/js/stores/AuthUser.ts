import { reactive, toRefs } from '@vue/reactivity';

const state = reactive({
    username: '',
    email: '',
    id: 0,
})

export default () => {
    const authUser = (name : string, email : string, id : number) => {
        state.username = name,
        state.email = email,
        state.id = id;
    }

    return {
        state: toRefs(state),
        authUser,
    }
}