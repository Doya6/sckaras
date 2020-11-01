import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Contact from '../views/Contact.vue'
import Fotogalerie from '../views/Fotogalerie.vue'
import Aktivity from '../views/Aktivity.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
  },
  {
    path: '/contact',
    name: 'Contact',
    component: Contact,
  },
  {
    path: '/fotogalerie',
    name: 'Fotogalerie',
    component: Fotogalerie,
  },
  {
    path: '/aktivity',
    name: 'Aktivity',
    component: Aktivity,
  },

  //comment for build / uncoment for Netlify build
  {
  path: "/index.html",
  redirect: "/" 
 }
  // comment for build / uncoment for Netlify build
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
