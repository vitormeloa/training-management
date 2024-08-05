import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    token: localStorage.getItem('token') || '',
    user: null
  },
  mutations: {
    setToken (state, token) {
      state.token = token
    },
    setUser (state, user) {
      state.user = user
    },
    logout (state) {
      state.token = ''
      state.user = null
    }
  },
  actions: {
    async login ({ commit, dispatch }, user) {
      const response = await axios.post('/login', user)
      const token = response.data.access_token
      localStorage.setItem('token', token)
      commit('setToken', token)
      await dispatch('fetchUser')
    },
    async register ({ commit }, user) {
      await axios.post('/register', user)
    },
    async fetchUser ({ commit }) {
      try {
        const response = await axios.get('/user', {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`
          }
        })
        commit('setUser', response.data)
      } catch (error) {
        console.error('Failed to fetch user:', error)
      }
    },
    logout ({ commit }) {
      localStorage.removeItem('token')
      commit('logout')
    }
  },
  getters: {
    isAuthenticated: state => !!state.token,
    user: state => state.user
  }
})
