<template>
  <div class="training-form">
    <h2>Create Training</h2>
    <form @submit.prevent="addTraining">
      <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" v-model="title" required />
      </div>
      <div class="form-group">
        <label for="description">Description:</label>
        <input type="text" v-model="description" required />
      </div>
      <button type="submit">Add Training</button>
    </form>
  </div>
</template>

<script>
import { mapActions } from 'vuex';

export default {
  data() {
    return {
      title: '',
      description: '',
    };
  },
  methods: {
    ...mapActions(['addTraining']),
    async addTraining() {
      await this.addTraining({ title: this.title, description: this.description });
      this.title = '';
      this.description = '';
      this.$emit('trainingAdded');
    },
  },
};
</script>

<style scoped>
.training-form {
  max-width: 400px;
  margin: auto;
  padding: 1em;
  border-radius: 5px;
  background: #f9f9f9;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.form-group {
  margin-bottom: 1em;
}
.form-group label {
  display: block;
  margin-bottom: 0.5em;
}
.form-group input {
  width: 100%;
  padding: 0.5em;
  border: 1px solid #ccc;
  border-radius: 5px;
}
button {
  padding: 0.7em;
  color: white;
  background-color: #007bff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
button:hover {
  background-color: #0056b3;
}
</style>
