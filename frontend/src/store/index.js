import { createStore } from "vuex";
import auth from "./modules/auth";
import training from "./modules/training";

const store = createStore({
  modules: {
    auth,
    training,
  },
});

export default store;
