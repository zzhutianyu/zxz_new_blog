
const initState = {
    loading: false
}

export const actionType = {
    updateLoading: 'updateLoading'
}

export const loading = (state = initState, action = {}) => {
    console.log(action)
    switch (action.type) {
        case actionType.updateLoading:
            return {...state, ...{loading: action.loading}}
        default:
            return state
    }

}