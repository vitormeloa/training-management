<template>
  <div class="login">
    <b-container>
      <b-row class="justify-content-md-center">
        <b-col md="6">
          <b-card title="Login" class="mb-3">
            <b-form @submit.prevent="handleLogin">
              <b-form-group label="Email">
                <b-form-input v-model="email" type="email" required></b-form-input>
              </b-form-group>
              <b-form-group class="mt-3" label="Senha">
                <b-form-input v-model="password" type="password" required></b-form-input>
              </b-form-group>
              <b-button class="mt-3" type="submit" variant="info">Entrar</b-button>
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
      email: '',
      password: '',
      message: '',
      showAlert: false,
      alertVariant: 'danger'
    }
  },
  methods: {
    ...mapActions(['login']),
    handleLogin () {
      this.login({ email: this.email, password: this.password })
        .then(() => {
          this.$router.push('/')
        })
        .catch(() => {
          this.message = 'Failed to login. Please check your credentials and try again.'
          this.showAlert = true
        })
    }
  }
}
</script>

<style scoped>
.login {
  margin-top: 50px;
}
</style>
