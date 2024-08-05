<template>
  <div class="home">
    <b-container>
      <b-row class="justify-content-md-center">
        <b-col md="8">
          <b-card class="mb-4">
            <b-card-title>
              Bem-vindo, {{ user.name }}!
            </b-card-title>
            <b-card-text>
              Email: {{ user.email }}
            </b-card-text>
            <b-button variant="info" href="/trainings" class="me-2">Gerenciar Treinamentos</b-button>
            <b-button variant="info" href="/subordinates">Gerenciar Subordinados</b-button>
          </b-card>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  computed: {
    ...mapGetters(['user'])
  }
}
</script>

<style scoped>
.home {
  margin-top: 50px;
}
</style>
