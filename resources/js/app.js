require('./bootstrap')

import { createApp } from 'vue'
import axios from 'axios';
import router from './router'
import App from './App.vue'
import { createPinia } from 'pinia';

const pinia = createPinia()
const app = createApp(App)
app.config.globalProperties.$axios = axios;
app.component('welcome', App)
app.use(router)
app.use(pinia)
app.mount('#app')

// router.beforeEach((to, from, next) => {
//     if (!localStorage.getItem('token')) {
//         //return next('/login');
//         router.push('login')

//     }
//     next();
//   })
