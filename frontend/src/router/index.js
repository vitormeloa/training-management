import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/HomeView.vue'
import Login from '../views/LoginView.vue'
import Register from '../views/RegisterView.vue'
import Trainings from '../views/TrainingsView.vue'
import Subordinates from '../views/SubordinatesView.vue'
import TestConnection from '../views/TestConnection.vue'
import store from '../store'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
    meta: {
      requiresAuth: true,
      title: 'Home - Gestão de Treinamentos'
    }
  },
  {
    path: '/login',
    name: 'Login',
    component: Login,
    meta: {
      title: 'Login - Gestão de Treinamentos'
    }
  },
  {
    path: '/register',
    name: 'Register',
    component: Register,
    meta: {
      title: 'Cadastro - Gestão de Treinamentos'
    }
  },
  {
    path: '/trainings',
    name: 'Trainings',
    component: Trainings,
    meta: {
      requiresAuth: true,
      title: 'Treinamentos - Gestão de Treinamentos'
    }
  },
  {
    path: '/subordinates',
    name: 'Subordinates',
    component: Subordinates,
    meta: {
      requiresAuth: true,
      title: 'Subordinados - Gestão de Treinamentos'
    }
  },
  {
    path: '/test-connection',
    name: 'TestConnection',
    component: TestConnection,
    meta: {
      title: 'Teste de Conexão - Gestão de Treinamentos'
    }
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {
  const requiresAuth = to.matched.some(record => record.meta.requiresAuth)
  const isAuthenticated = store.getters.isAuthenticated

  if (requiresAuth && !isAuthenticated) {
    next('/login')
  } else {
    next()
  }
})

export default router
