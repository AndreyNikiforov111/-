

import MainCreate from "../main/create.vue"
import IndexCreate from "../main/index.vue"

import History from "../main/history.vue"

import NewsletterCreate from "../newsletter/create.vue"

import Login from "../auth/Login.vue"
import Register from "../auth/Register.vue"


const routes = [
    {
        path: '/client/create',
        component: MainCreate

    },
    {
        path: '/client',
        component: IndexCreate

    },
    {
        path: '/newsletter',
        component: NewsletterCreate

    },
    {
        path: '/history',
        component: History

    },

    {
        path: '/login',
        component: Login
    },
    {
        path: '/register',
        component: Register
    }

]

export default routes
