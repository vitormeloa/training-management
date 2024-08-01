<template>
  <div>
    <Navbar />
    <UserTrainingList />
  </div>
</template>

<script>
import Navbar from '../components/Navbar.vue';
import UserTrainingList from '../components/UserTrainingList.vue';

export default {
  components: {
    Navbar,
    UserTrainingList,
  },
};
</script>
