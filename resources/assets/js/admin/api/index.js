import apiMap from './map'
const env = process.env ? process.env.NODE_ENV : 'production'
const host = process.env.DEV_HOST || 'localhost'
const devPort = process.env.DEV_PORT || '8000'
const devUrl = `http://${host}:${devPort}`

const serverUrl = 'http://127.0.0.1:8000/'


export default function API(name, params = {}, ext = {}) {
    const apiPath = apiMap[name]
    if (apiPath === undefined) {
        throw new Error('Cannot find a mock API path.')
    }

    const prefix = env === 'development' ? `${devUrl}/` : serverUrl
    const postfix = ext.postfix || ''

    let url =  `${prefix}${apiPath}`
    Object.keys(params).forEach( (key) => {
        url = url.replace(new RegExp(`{${key}}`, params[key]))
    })

    return url
}