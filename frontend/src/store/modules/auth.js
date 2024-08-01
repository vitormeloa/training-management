import axios from 'axios';

const state = {
    token: localStorage.getItem('token') || '',
    user: {},
};

const getters = {
    isAuthenticated: state => !!state.token,
    authStatus: state => state.status,
};

const actions = {
    async register({commit}, user) {
        let response = await axios.post('http://localhost:8000/api/register', user);
        let token = response.data.token;
        localStorage.setItem('token', token);
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        commit('auth_success', token, user);
    },
    async login({commit}, user) {
        let response = await axios.post('http://localhost:8000/api/login', user);
        let token = response.data.token;
        localStorage.setItem('token', token);
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        commit('auth_success', token, user);
    },
    async logout({commit}) {
        await axios.post('http://localhost:8000/api/logout');
        commit('logout');
        localStorage.removeItem('token');
        delete axios.defaults.headers.common['Authorization'];
    },
};

const mutations = {
    auth_success(state, token, user) {
        state.token = token;
        state.user = user;
    },
    logout(state) {
        state.token = '';
        state.user = {};
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
};
