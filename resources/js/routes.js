import Login from './components/Login'
import Home from './components/Home'

export default {
    mode: 'history',
    routes: [
        {
            path: '/vue/login',
            component: Login
        },
        {
            path: '/vue/home',
            component: Home,
            name: 'Home'
        }
    ]
}
