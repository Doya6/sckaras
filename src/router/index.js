import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Contact from '../views/Contact.vue'
import Fotogalerie from '../views/Fotogalerie.vue'
import Aktivity from '../components/Aktivity.vue'
import NewActivityForm from '../components/NewActivityForm.vue'
import UserLevelAssign from '../components/UserLevelAssign.vue'

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
  {
    path: '/newactivityform',
    name: 'NewActivityForm',
    component: NewActivityForm,
  },
  {
    path: '/userlevelassign',
    name: 'UserLevelAssign',
    component: UserLevelAssign,
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
