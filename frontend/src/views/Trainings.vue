<template>
  <div>
    <Navbar />
    <TrainingForm @trainingAdded="fetchTrainings" />
    <TrainingList />
  </div>
</template>

<script>
import Navbar from "../components/Navbar.vue";
import TrainingForm from "../components/TrainingForm.vue";
import TrainingList from "../components/TrainingList.vue";
import { mapActions } from "vuex";

export default {
  components: {
    Navbar,
    TrainingForm,
    TrainingList,
  },
  methods: {
    ...mapActions(["fetchTrainings"]),
  },
  created() {
    this.fetchTrainings();
  },
};
</script>
