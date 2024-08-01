<template>
  <div class="user-training-list">
    <h2>User Trainings</h2>
    <ul>
      <li v-for="userTraining in userTrainings" :key="userTraining.id">
        {{ userTraining.training.title }} - {{ userTraining.status }}
      </li>
    </ul>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  computed: {
    ...mapGetters(["allUserTrainings"]),
  },
  created() {
    this.fetchUserTrainings();
  },
  methods: {
    ...mapActions(["fetchUserTrainings"]),
  },
};
</script>

<style scoped>
.user-training-list {
  max-width: 600px;
  margin: auto;
  padding: 1em;
  border-radius: 5px;
  background: #f9f9f9;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.user-training-list ul {
  list-style-type: none;
  padding: 0;
}
.user-training-list li {
  padding: 1em;
  border-bottom: 1px solid #ddd;
}
.user-training-list li:last-child {
  border-bottom: none;
}
</style>
