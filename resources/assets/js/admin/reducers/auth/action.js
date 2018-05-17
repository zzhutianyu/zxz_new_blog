import { actionType } from "./auth";

const updateToken = (token) => {
    return {
        type: actionType.updateToken,
        token
    }
}

const updateUser = (userInfo) => {
    return {
        type: actionType.updateUser,
        userInfo
    }
}

export default {
    updateToken,
    updateUser
}