// resources/js/app.js
import {
  createApp 
}
from "vue";
  import {
  createPinia 
}
from "pinia";
  // Correction de l'import
import App from "./App.vue";
  import router from "./router";
  import "./assets/css/main.css";
  const app = createApp(App);
  const pinia = createPinia();
  app.use(pinia);
  app.use(router);
  app.mount("#app");
  