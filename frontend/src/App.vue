<template>
  <div id="app">
    <Header />
    <router-view />
  </div>
</template>

<script>
import Header from './components/HeaderComponent.vue'
import { mapActions, mapGetters } from 'vuex'

export default {
  components: {
    Header
  },
  computed: {
    ...mapGetters(['isAuthenticated'])
  },
  methods: {
    ...mapActions(['fetchUser'])
  },
  created () {
    if (this.isAuthenticated) {
      this.fetchUser()
    }
  }
}
</script>

<style>
@import './styles/global.scss';
</style>
