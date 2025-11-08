// resources/js/stores/loading.js
import {
  defineStore 
}
from "pinia";
  export const useLoadingStore = defineStore("loading", {
  state: () => ({
  isLoading: false,
        loadingMessage: "Chargement...",
    
}
),

    actions: {
  setLoading(loading, message = "Chargement...") {
  this.isLoading = loading;
  this.loadingMessage = message;
  
}
,

        startLoading(message = "Chargement...") {
  this.isLoading = true;
  this.loadingMessage = message;
  
}
,

        stopLoading() {
  this.isLoading = false;
  this.loadingMessage = "Chargement...";
  
}
,
    
}
,

    getters: {
  getLoadingState: (state) => state.isLoading,
        getLoadingMessage: (state) => state.loadingMessage,
    
}
,

}
);
  