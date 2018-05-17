import { combineReducers } from 'redux'
import {auth} from './auth/auth'
import {loading} from './loading/loading'



const reducer = combineReducers({
    auth,
    loading
})


export default reducer;