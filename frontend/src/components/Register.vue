<template>
  <div class="register">
    <h2>Cadastre-se</h2>
    <form @submit.prevent="handleRegister">
      <div class="form-group">
        <label for="name">Nome:</label>
        <input type="text" v-model="name" required />
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" v-model="email" required />
      </div>
      <div class="form-group">
        <label for="password">Senha:</label>
        <input type="password" v-model="password" required />
      </div>
      <button type="submit">Cadastrar</button>
    </form>
  </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
  data() {
    return {
      name: "",
      email: "",
      password: "",
    };
  },
  methods: {
    ...mapActions(["registerUser"]),
    async handleRegister() {
      await this.registerUser({
        name: this.name,
        email: this.email,
        password: this.password,
      });
      this.$router.push("/login");
    },
  },
};
</script>

<style scoped>
.register {
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
