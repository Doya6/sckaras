import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Kontakt from '../views/Kontakt.vue'
import Fotogalerie from '../views/Fotogalerie.vue'
import Aktivity from '../views/Aktivity.vue'
import Login from '../views/Login.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/kontakt',
    name: 'Kontakt',
    component: Kontakt
  },
  {
    path: '/fotogalerie',
    name: 'Fotogalerie',
    component: Fotogalerie
  },
  {
    path: '/aktivity',
    name: 'Aktivity',
    component: Aktivity
  },
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
//   {
//   path: "/index.html",
//   redirect: "/" 
// }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
