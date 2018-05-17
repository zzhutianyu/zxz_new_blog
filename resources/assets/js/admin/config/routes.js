import Login from '../pages/login'
import Posts from '../pages/posts'
import Edit from '../pages/edit'
import Link from '../pages/link'
import Visit from '../pages/Visit'

export default [
     {
        path: '/home/posts',
        component: Posts
    }, {
        path: '/home/edit',
        component: Edit
    }, {
        path: '/home/link',
        component: Link
    }, {
        path: '/home/visits',
        component: Visit
    }
]