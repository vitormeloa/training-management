import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import apiClient from "./apiClient";

const app = createApp(App);

app.config.globalProperties.$http = apiClient;

app.use(router);
app.use(store);
app.mount("#app");
