<template>
  <div class="training-list">
    <h2>Treinamentos</h2>
    <ul>
      <li v-for="training in trainings" :key="training.id">
        {{ training.title }} - {{ training.description }}
      </li>
    </ul>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  computed: {
    ...mapGetters(["allTrainings"]),
  },
  created() {
    this.fetchTrainings();
  },
  methods: {
    ...mapActions(["fetchTrainings"]),
  },
};
</script>

<style scoped>
.training-list {
  max-width: 600px;
  margin-top: 5em;
  margin-left: 30em;
  margin-bottom: 5em;
  padding: 5em;
  border-radius: 5px;
  background: #f9f9f9;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.training-list ul {
  list-style-type: none;
  padding: 0;
}
.training-list li {
  padding: 1em;
  border-bottom: 1px solid #ddd;
}
.training-list li:last-child {
  border-bottom: none;
}
</style>
