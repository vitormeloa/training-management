<template>
  <div class="home">
    <h1>Bem-vindo à Plataforma de Treinamentos</h1>
    <p>Gerencie seus treinamentos corporativos de forma eficiente.</p>
    <div class="buttons">
      <router-link to="/login" class="btn">Login</router-link>
      <router-link to="/register" class="btn">Cadastro</router-link>
      <router-link to="/trainings" class="btn">Treinamentos</router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Home'
}
</script>

<style scoped>
.home {
  text-align: center;
  padding: 2em;
}
.buttons {
  margin-top: 2em;
}
.btn {
  display: inline-block;
  margin: 0 1em;
  padding: 1em 2em;
  font-size: 1em;
  color: white;
  background-color: #007bff;
  border: none;
  border-radius: 5px;
  text-decoration: none;
  cursor: pointer;
}
.btn:hover {
  background-color: #0056b3;
}
</style>
