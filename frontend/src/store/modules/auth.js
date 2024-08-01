import apiClient from '../../apiClient';

const state = {
  user: null,
  token: localStorage.getItem('token') || '',
};

const getters = {
  isAuthenticated: state => !!state.token,
  stateUser: state => state.user,
};

const actions = {
  async registerUser({ dispatch }, form) {
    await apiClient.post('/register', form);
    const UserForm = new FormData();
    UserForm.append('email', form.email);
    UserForm.append('password', form.password);
    await dispatch('logIn', UserForm);
  },
  async logIn({ commit }, user) {
    const response = await apiClient.post('/login', user);
    await commit('setUser', response.data.user);
    await commit('setToken', response.data.token);
  },
  async logOut({ commit }) {
    let user = null;
    commit('logOut', user);
  },
};

const mutations = {
  setUser(state, username) {
    state.user = username;
  },
  setToken(state, token) {
    state.token = token;
  },
  logOut(state) {
    state.user = null;
    state.token = '';
  },
};

export default {
  state,
  getters,
  actions,
  mutations,
};
