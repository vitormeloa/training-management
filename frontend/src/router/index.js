import { createRouter, createWebHistory } from "vue-router";
import Home from "../views/Home.vue";
import Login from "../views/Login.vue";
import Register from "../views/Register.vue";
import Trainings from "../views/Trainings.vue";
import UserTrainings from "../views/UserTrainings.vue";
import TestBackend from '../components/TestBackend.vue';

const routes = [
  { path: "/", name: "Home", component: Home },
  { path: "/login", name: "Login", component: Login },
  { path: "/register", name: "Register", component: Register },
  { path: "/trainings", name: "Trainings", component: Trainings },
  { path: "/user-trainings", name: "UserTrainings", component: UserTrainings },
  { path: '/test-backend', name: 'TestBackend', component: TestBackend },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
