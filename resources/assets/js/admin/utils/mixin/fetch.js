import axios from 'axios'
import store from '../../store'

export default function (url, originOptions) {
    const options = {
        creadenttials: 'include',
        ...originOptions
    }

    const token = store.getState().auth.token || ''
    options.headers = {
        ...options.headers,
        Authorization: `Bearer ${token}`
    }

    return axios(url, options).then(response => {
        return response.data
    })

    
}