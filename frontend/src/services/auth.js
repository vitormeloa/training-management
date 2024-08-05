import axios from 'axios'

const API_URL = 'http://localhost/api'

export default {
  async login (user) {
    const response = await axios.post(`${API_URL}/login`, user)
    return {
      access_token: response.data.access_token,
      user: response.data.user
    }
  },
  async register (user) {
    const response = await axios.post(`${API_URL}/register`, user)
    return {
      access_token: response.data.access_token,
      user: response.data.user
    }
  },
  async logout () {
    const response = await axios.post(`${API_URL}/logout`)
    return response.data
  },
  setToken (token) {
    axios.defaults.headers.common.Authorization = `Bearer ${token}`
  },
  removeToken () {
    delete axios.defaults.headers.common.Authorization
  }
}
