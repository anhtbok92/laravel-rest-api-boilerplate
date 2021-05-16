import Vue from "vue";
import Router from "vue-router";
import Login from "../components/Login.vue";
import SignUp from "../components/SignUp.vue";
import Home from "../components/Home.vue";
import { store } from "../store";

Vue.use(Router);

const router = new Router({
    routes: [
        {
            path: '/',
            name: 'login',
            component: Login,
            meta: { requiresAuth: false }
        },
        {
            path: '/signup',
            name: 'signup',
            component: SignUp,
            meta: { requiresAuth: false }
        },
        {
            path: '/home',
            name: 'home',
            component: Home,
            meta: { requiresAuth: true }
        }
    ]
});


router.beforeEach((to, from, next) => {
    if (store.getters.isLoggedIn) {
        // console.log("logged in");
        next();
    } else {
        // console.log("not logged in");
        if (to.matched.some(record => record.meta.requiresAuth)) {
            next({
                path: '/'
            })
        } else {
            next();
        }
    }
})
export default router;
