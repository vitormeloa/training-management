<template>
  <div class="register">
    <b-container>
      <b-row class="justify-content-md-center">
        <b-col md="6">
          <b-card title="Cadastro" class="mb-3">
            <b-form @submit.prevent="handleRegister">
              <b-form-group label="Nome">
                <b-form-input v-model="name" required></b-form-input>
              </b-form-group>
              <b-form-group class="mt-3" label="Email">
                <b-form-input v-model="email" type="email" required></b-form-input>
              </b-form-group>
              <b-form-group class="mt-3" label="Senha">
                <b-form-input v-model="password" type="password" required></b-form-input>
              </b-form-group>
              <b-button class="mt-3" type="submit" variant="info">Cadastrar</b-button>
            </b-form>
            <b-alert :show="showAlert" :variant="alertVariant" dismissible>
              {{ message }}
            </b-alert>
          </b-card>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
import { mapActions } from 'vuex'

export default {
  data () {
    return {
      name: '',
      email: '',
      password: '',
      message: '',
      showAlert: false,
      alertVariant: 'danger'
    }
  },
  methods: {
    ...mapActions(['register']),
    handleRegister () {
      this.register({ name: this.name, email: this.email, password: this.password })
        .then(() => {
          this.$router.push('/login')
        })
        .catch(() => {
          this.message = 'Falha no cadastro. Tente novamente.'
          this.showAlert = true
        })
    }
  }
}
</script>

<style scoped>
.register {
  margin-top: 50px;
}
</style>
