import axios from 'axios';

const state = {
    trainings: [],
    userTrainings: [],
};

const getters = {
    allTrainings: state => state.trainings,
    allUserTrainings: state => state.userTrainings,
};

const actions = {
    async fetchTrainings({commit}) {
        let response = await axios.get('http://localhost:8000/api/trainings');
        commit('setTrainings', response.data);
    },
    async addTraining({commit}, training) {
        let response = await axios.post('http://localhost:8000/api/trainings', training);
        commit('newTraining', response.data);
    },
    async fetchUserTrainings({commit}) {
        let response = await axios.get('http://localhost:8000/api/user-trainings');
        commit('setUserTrainings', response.data);
    },
};

const mutations = {
    setTrainings(state, trainings) {
        state.trainings = trainings;
    },
    newTraining(state, training) {
        state.trainings.push(training);
    },
    setUserTrainings(state, userTrainings) {
        state.userTrainings = userTrainings;
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
};
