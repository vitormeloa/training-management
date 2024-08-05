<template>
  <b-navbar toggleable="lg" type="dark" variant="dark" class="mb-4" style="background-color: #343a40;">
    <b-navbar-brand class="mx-3" href="#">Gestão de Treinamentos</b-navbar-brand>
    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
    <b-collapse id="nav-collapse" is-nav>
      <b-navbar-nav>
        <b-nav-item href="/">Início</b-nav-item>
        <b-nav-item href="/trainings">Treinamentos</b-nav-item>
        <b-nav-item href="/subordinates">Subordinados</b-nav-item>
      </b-navbar-nav>
      <b-navbar-nav class="ml-auto" style="display: flex; justify-content: flex-end;">
        <b-nav-item v-if="!isAuthenticated" href="/login">Login</b-nav-item>
        <b-nav-item v-if="!isAuthenticated" href="/register">Cadastro</b-nav-item>
        <b-nav-item-dropdown right v-if="isAuthenticated">
          <template #button-content>
            {{ user ? user.name : '' }}
          </template>
          <b-dropdown-item @click="handleLogout">Sair</b-dropdown-item>
        </b-nav-item-dropdown>
      </b-navbar-nav>
    </b-collapse>
  </b-navbar>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  computed: {
    ...mapGetters(['isAuthenticated', 'user'])
  },
  methods: {
    ...mapActions(['logout']),
    async handleLogout () {
      await this.logout()
      this.$router.push('/login')
    }
  }
}
</script>

<style scoped>
.navbar-nav .nav-item {
  margin-left: 15px;
}
</style>
