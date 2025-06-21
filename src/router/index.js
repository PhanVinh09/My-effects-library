import { createRouter, createWebHistory } from 'vue-router'
import Home from '@/views/Home.vue'
import About from '@/views/About.vue'

// Effect
import EffectsHover from '@/components/effects/EffectsHover.vue'
import EffectsAnimate from '@/components/effects/EffectsAnimate.vue'
import EffectsScroll from '@/components/effects/EffectsScroll.vue'
import Effects3D from '@/components/effects/Effects3D.vue'
import EffectCLick from '@/components/effects/EffectClick.vue'
import EffectLoad from '@/components/effects/EffectLoad.vue'

//Form 
import LoginForm from '@/components/forms/LoginForm.vue'
import RegisterForm from '@/components/forms/RegisterForm.vue'
import PasswordResetForm from '@/components/forms/ResetPasswordForm.vue'
import ChangePasswordForm from '@/components/forms/ChangePasswordForm.vue'
import ProfileUpdateForm from '@/components/forms/ProfileUpdateForm.vue'

//Layout
import HeaderLayout from '@/components/layouts/Header.vue'
import FooterLayout from '@/components/layouts/Footer.vue'
import SidebarLayout from '@/components/layouts/Sidebar.vue'
import HeroBannerLayout from '@/components/layouts/HeroBanner.vue'
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    { path: '/', component: Home },
    { path: '/about', component: About },
    //Effect
    { path: '/effect/hover', component: EffectsHover },
    { path: '/effect/animate', component: EffectsAnimate },
    { path: '/effect/scroll', component: EffectsScroll },
    { path: '/effect/3d', component: Effects3D },
    { path: '/effect/click', component: EffectCLick },
    { path: '/effect/load', component: EffectLoad },

    //Form
    { path: '/form/login', component: LoginForm },
    { path: '/form/register', component: RegisterForm },
    { path: '/form/passwordReset', component: PasswordResetForm },
    { path: '/form/changePassword', component: ChangePasswordForm },
    { path: '/form/profileUpdate', component: ProfileUpdateForm },


    //Layout
    { path: '/layout/header', component: HeaderLayout },
    { path: '/layout/footer', component: FooterLayout },
    { path: '/layout/sideBar', component: SidebarLayout },
    { path: '/layout/heroBanner', component: HeroBannerLayout },

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
