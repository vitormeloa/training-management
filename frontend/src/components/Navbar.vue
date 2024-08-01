<template>
  <nav class="navbar">
    <router-link to="/">Home</router-link>
    <router-link to="/login" v-if="!isAuthenticated">Login</router-link>
    <router-link to="/register" v-if="!isAuthenticated">Register</router-link>
    <router-link to="/trainings" v-if="isAuthenticated">Trainings</router-link>
    <router-link to="/user-trainings" v-if="isAuthenticated">User Trainings</router-link>
    <a @click="logout" v-if="isAuthenticated">Logout</a>
  </nav>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
  computed: {
    ...mapGetters(['isAuthenticated']),
  },
  methods: {
    ...mapActions(['logout']),
  },
};
</script>

<style scoped>
.navbar {
  background-color: #007bff;
  padding: 1em;
  display: flex;
  justify-content: space-around;
}
.navbar a {
  color: white;
  text-decoration: none;
  padding: 0.5em;
}
.navbar a:hover {
  background-color: #0056b3;
  border-radius: 5px;
}
</style>
