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
    props: true
  },
  {
    path: '/contact',
    name: 'Contact',
    component: Contact,
    props: true
  },
  {
    path: '/fotogalerie',
    name: 'Fotogalerie',
    component: Fotogalerie,
    props: true
  },
  {
    path: '/aktivity',
    name: 'Aktivity',
    component: Aktivity,
    props: true
  },

  //comment for build / uncoment for Netlify build
  // {
  // path: "/index.html",
  // redirect: "/" 
 //}
  // comment for build / uncoment for Netlify build
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
