import { createRouter, createWebHistory } from 'vue-router'
import Home from '@/views/Home.vue'
import About from '@/views/About.vue'
import EffectsHover from '@/components/effects/EffectsHover.vue'
import EffectsAnimate from '@/components/effects/EffectsAnimate.vue'
import EffectsScroll from '@/components/effects/EffectsScroll.vue'
import Effects3D from '@/components/effects/Effects3D.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    { path: '/', component: Home },
    { path: '/about', component: About },
    { path: '/effect/hover', component: EffectsHover },
    { path: '/effect/animate', component: EffectsAnimate },
    { path: '/effect/scroll', component: EffectsScroll },
    { path: '/effect/3d', component: Effects3D },
  ],
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition 
    } else {
      return { top: 0 } 
    }
  }
})

export default router
