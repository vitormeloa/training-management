<template>
  <div class="subordinates">
    <b-container>
      <b-row class="justify-content-md-center">
        <b-col md="10">
          <b-card title="Subordinados" class="mb-4">
            <b-button @click="showCreateModal" variant="info" class="mb-2">Criar Subordinado</b-button>
            <b-table :items="subordinates" :fields="fields" striped hover @row-clicked="viewSubordinate"></b-table>
          </b-card>
        </b-col>
      </b-row>
    </b-container>

    <b-modal v-model="isCreateModalVisible" hide-footer>
      <template #modal-header>
        <h5 class="modal-title">Criar Subordinado</h5>
        <b-button variant="outline-secondary" size="sm" class="close" @click="isCreateModalVisible = false">
          <span>&times;</span>
        </b-button>
      </template>
      <b-form @submit.prevent="createSubordinate">
        <b-form-group label="Nome">
          <b-form-input v-model="subordinate.name" required></b-form-input>
        </b-form-group>
        <b-form-group label="Email">
          <b-form-input v-model="subordinate.email" type="email" required></b-form-input>
        </b-form-group>
        <b-button class="mt-3" type="submit" variant="info">Salvar</b-button>
      </b-form>
    </b-modal>

    <b-modal v-model="isViewModalVisible" hide-footer>
      <template #modal-header>
        <h5 class="modal-title">Visualizar Subordinado</h5>
        <b-button variant="outline-secondary" size="sm" class="close" @click="isViewModalVisible = false">
          <span>&times;</span>
        </b-button>
      </template>
      <div v-if="selectedSubordinate">
        <p><strong>Nome:</strong> {{ selectedSubordinate.name }}</p>
        <p><strong>Email:</strong> {{ selectedSubordinate.email }}</p>
        <p><strong>Treinamentos:</strong></p>
        <ul>
          <li v-for="training in selectedSubordinate.trainings" :key="training.id">{{ training.name }} ({{ training.pivot.completed ? 'Concluído' : 'Em Andamento' }})</li>
        </ul>
      </div>
    </b-modal>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data () {
    return {
      subordinates: [],
      subordinate: {
        name: '',
        email: ''
      },
      isCreateModalVisible: false,
      isViewModalVisible: false,
      fields: ['name', 'email'],
      selectedSubordinate: null
    }
  },
  methods: {
    async fetchSubordinates () {
      const response = await axios.get('/subordinates')
      this.subordinates = response.data
    },
    showCreateModal () {
      this.isCreateModalVisible = true
    },
    async createSubordinate () {
      try {
        await axios.post('/subordinates', this.subordinate)
        this.isCreateModalVisible = false
        this.fetchSubordinates()
      } catch (error) {
        alert('Falha ao criar subordinado. Por favor, tente novamente.')
      }
    },
    async viewSubordinate (subordinate) {
      this.selectedSubordinate = subordinate
      this.isViewModalVisible = true
    }
  },
  mounted () {
    this.fetchSubordinates()
  }
}
</script>

<style scoped>
.subordinates {
  margin-top: 50px;
}
.close {
  border: none;
  background: none;
  font-size: 1.5rem;
  line-height: 1;
  color: #000;
  opacity: 0.5;
  position: absolute;
  right: 1rem;
  top: 0.5rem;
}
</style>
