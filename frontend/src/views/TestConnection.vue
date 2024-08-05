<template>
  <div class="test-connection">
    <b-container>
      <b-row class="justify-content-md-center">
        <b-col md="6">
          <b-card title="Test Connection" class="mb-3">
            <b-button @click="testConnection" variant="info">Test Connection</b-button>
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
import axios from 'axios'

export default {
  data () {
    return {
      message: '',
      showAlert: false,
      alertVariant: 'success'
    }
  },
  methods: {
    async testConnection () {
      try {
        const response = await axios.get('/test-connection')
        this.message = response.data.message
        this.alertVariant = 'success'
      } catch (error) {
        this.message = 'Connection failed'
        this.alertVariant = 'danger'
      } finally {
        this.showAlert = true
      }
    }
  }
}
</script>

<style scoped>
.test-connection {
  margin-top: 50px;
}
</style>
