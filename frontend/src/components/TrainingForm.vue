<template>
  <div class="training-form">
    <h2>Adicionar Treinamento</h2>
    <form @submit.prevent="handleAddTraining">
      <div class="form-group">
        <label for="title">Título:</label>
        <input type="text" v-model="title" required />
      </div>
      <div class="form-group">
        <label for="description">Descrição:</label>
        <textarea v-model="description" required></textarea>
      </div>
      <button type="submit">Add Training</button>
    </form>
  </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
  data() {
    return {
      title: "",
      description: "",
    };
  },
  methods: {
    ...mapActions(["createTraining"]),
    async handleAddTraining() {
      await this.createTraining({ title: this.title, description: this.description });
      this.title = "";
      this.description = "";
      this.$router.push("/trainings");
    },
  },
};
</script>

<style scoped>
.training-form {
  max-width: 400px;
  margin-top: 10em;
  margin-left: 37em;
  padding: 5em;
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
.form-group input,
.form-group textarea {
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
