const env = process.env.NODE_ENV

const initState = {
    token: null,
    userInfo: null
}

export const actionType = {
    updateToken: 'updateToken',
    updateUser: 'updateUser'
}


export const auth = (state = initState, action = {}) => {
    switch(action.type) {
        case actionType.updateToken:
            return {...state, ...{token: action.token}};
        case actionType.updateUser:
            return {...state, ...{userInfo: action.userInfo}};
        default:
            return state;
    }
}