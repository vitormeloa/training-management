import axios from "axios";

const apiClient = axios.create({
  baseURL: "http://backend:80/api",
});

export default apiClient;
