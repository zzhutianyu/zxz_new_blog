import reducer from '../reducers'
import { createStore } from 'redux'

const env = process.env.NODE_ENV || 'production'
const debug = env !== 'production'


const store = createStore(
    reducer
)
store.subscribe(() => {
    console.log(store.getState())
})
export default store
