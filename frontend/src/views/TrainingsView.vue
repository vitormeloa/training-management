<template>
  <div class="trainings">
    <b-container>
      <b-row class="justify-content-md-center">
        <b-col md="10">
          <b-card title="Treinamentos" class="mb-4">
            <b-button @click="showCreateModal" variant="info" class="mb-2">Criar Treinamento</b-button>
            <b-table :items="trainings" :fields="fields" striped hover @row-clicked="viewSubordinates"></b-table>
          </b-card>
        </b-col>
      </b-row>
    </b-container>

    <b-modal v-model="isCreateModalVisible" hide-footer>
      <template #modal-header>
        <div class="d-flex justify-content-between align-items-center w-100">
          <h5 class="modal-title">Criar Treinamento</h5>
          <b-button variant="outline-secondary" size="sm" class="close" @click="isCreateModalVisible = false">
            <span>&times;</span>
          </b-button>
        </div>
      </template>
      <b-form @submit.prevent="createTraining">
        <b-form-group label="Nome">
          <b-form-input v-model="training.name" required></b-form-input>
        </b-form-group>
        <b-form-group label="Descrição">
          <b-form-input v-model="training.description"></b-form-input>
        </b-form-group>
        <b-button class="mt-3" type="submit" variant="info">Salvar</b-button>
      </b-form>
    </b-modal>

    <b-modal v-model="isSubordinatesModalVisible" hide-footer>
      <template #modal-header>
        <div class="d-flex justify-content-between align-items-center w-100">
          <h5 class="modal-title">Subordinados no Treinamento</h5>
          <b-button variant="outline-secondary" size="sm" class="close" @click="isSubordinatesModalVisible = false">
            <span>&times;</span>
          </b-button>
        </div>
      </template>
      <div v-if="selectedTraining">
        <b-form @submit.prevent="addSubordinate">
          <b-form-group label="Selecionar Subordinado">
            <b-form-select v-model="newSubordinate.subordinate_id" :options="subordinatesOptions" required></b-form-select>
          </b-form-group>
          <b-form-group label="Concluiu o treinamento?">
            <b-form-checkbox v-model="newSubordinate.completed">Sim</b-form-checkbox>
          </b-form-group>
          <b-button type="submit" variant="info" class="my-3">Adicionar Subordinado</b-button>
        </b-form>

        <b-table :items="selectedTrainingSubordinates" :fields="subordinateFields" striped hover>
          <template #cell(completed)="data">
            <b-form-checkbox :checked="data.item.completed" @change="updateProgress(data.item)"></b-form-checkbox>
          </template>
        </b-table>
      </div>
    </b-modal>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data () {
    return {
      trainings: [],
      training: {
        name: '',
        description: ''
      },
      newSubordinate: {
        subordinate_id: null,
        completed: false
      },
      isCreateModalVisible: false,
      isSubordinatesModalVisible: false,
      fields: ['name', 'description'],
      subordinateFields: ['name', 'email', 'completed'],
      selectedTraining: null,
      selectedTrainingSubordinates: [],
      subordinatesOptions: []
    }
  },
  methods: {
    async fetchTrainings () {
      const response = await axios.get('/trainings')
      this.trainings = response.data
    },
    showCreateModal () {
      this.isCreateModalVisible = true
    },
    async createTraining () {
      try {
        await axios.post('/trainings', this.training)
        this.isCreateModalVisible = false
        this.fetchTrainings()
      } catch (error) {
        alert('Falha ao criar treinamento. Por favor, tente novamente.')
      }
    },
    async viewSubordinates (training) {
      this.selectedTraining = training
      await this.fetchSubordinatesInTraining(training.id)
      await this.fetchSubordinatesOptions()
      this.isSubordinatesModalVisible = true
    },
    async fetchSubordinatesInTraining (trainingId) {
      const response = await axios.get(`/subordinate-trainings?training_id=${trainingId}`)
      this.selectedTrainingSubordinates = response.data.filter(item => item.training_id === trainingId)
    },
    async fetchSubordinatesOptions () {
      const response = await axios.get('/subordinates')
      this.subordinatesOptions = response.data.map(subordinate => ({
        value: subordinate.id,
        text: subordinate.name
      }))
    },
    async addSubordinate () {
      try {
        await axios.post('/subordinate-trainings', {
          training_id: this.selectedTraining.id,
          ...this.newSubordinate
        })
        await this.fetchSubordinatesInTraining(this.selectedTraining.id)
        this.newSubordinate.subordinate_id = null
        this.newSubordinate.completed = false
      } catch (error) {
        alert('Falha ao adicionar subordinado ao treinamento. Por favor, tente novamente.')
      }
    },
    async updateProgress (subordinate) {
      try {
        await axios.put(`/subordinate-trainings/${subordinate.id}`, {
          training_id: this.selectedTraining.id,
          completed: !subordinate.completed
        })
        this.fetchSubordinatesInTraining(this.selectedTraining.id)
      } catch (error) {
        alert('Falha ao atualizar progresso. Por favor, tente novamente.')
      }
    }
  },
  mounted () {
    this.fetchTrainings()
  }
}
</script>

<style scoped>
.trainings {
  margin-top: 50px;
}

.close {
  border: none;
  background: none;
  font-size: 1.5rem;
  line-height: 1;
  color: #000;
  opacity: 0.5;
  cursor: pointer;
}

.close:hover {
  opacity: 1;
}
</style>
