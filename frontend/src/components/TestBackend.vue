<template>
  <div class="test-backend">
    <h2>Test Backend Communication</h2>
    <button @click="testBackend">Test Backend</button>
    <p v-if="message">{{ message }}</p>
  </div>
</template>

<script>
import apiClient from "../apiClient";

export default {
  data() {
    return {
      message: "",
    };
  },
  methods: {
    async testBackend() {
      try {
        const response = await apiClient.get("/test");
        this.message = response.data.message;
      } catch (error) {
        console.error("Error communicating with backend:", error);
        this.message = "Failed to communicate with backend";
      }
    },
  },
};
</script>

<style scoped>
.test-backend {
  max-width: 400px;
  margin: auto;
  padding: 1em;
  text-align: center;
}
button {
  padding: 0.7em;
  color: white;
  background-color: #007bff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
button:hover {
  background-color: #0056b3;
}
</style>
