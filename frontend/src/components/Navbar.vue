<template>
  <nav class="navbar">
    <router-link to="/" class="nav-item">Home</router-link>
    <router-link to="/login" class="nav-item">Login</router-link>
    <router-link to="/register" class="nav-item">Cadastro</router-link>
    <router-link to="/trainings" class="nav-item">Treinamentos</router-link>
  </nav>
</template>

<script>
export default {
  name: 'Navbar',
};
</script>

<style scoped>
.navbar {
  display: flex;
  justify-content: space-around;
  align-items: center;
  background-color: #007bff;
  padding: 1em;
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 1000;
  margin: 0;
}

.nav-item {
  color: white;
  text-decoration: none;
  padding: 0.5em 1em;
}

.nav-item:hover {
  background-color: #0056b3;
  border-radius: 5px;
}
</style>
