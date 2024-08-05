import Vue from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import store from './store'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import './styles/global.scss'

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

Vue.config.productionTip = false

axios.defaults.baseURL = 'http://localhost/api'
axios.defaults.headers.common.Authorization = `Bearer ${store.state.token}`

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
