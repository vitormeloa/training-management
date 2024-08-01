import apiClient from '../../apiClient';

const state = {
  trainings: [],
};

const getters = {
  allTrainings: state => state.trainings,
};

const actions = {
  async fetchTrainings({ commit }) {
    const response = await apiClient.get('/trainings');
    commit('setTrainings', response.data);
  },
  async createTraining({ commit }, training) {
    const response = await apiClient.post('/trainings', training);
    commit('newTraining', response.data);
  },
};

const mutations = {
  setTrainings: (state, trainings) => (state.trainings = trainings),
  newTraining: (state, training) => state.trainings.unshift(training),
};

export default {
  state,
  getters,
  actions,
  mutations,
};
