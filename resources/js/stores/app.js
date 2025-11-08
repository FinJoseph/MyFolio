// resources/js/stores/app.js
import {
  defineStore 
}
from "pinia";
  export const useAppStore = defineStore("app", {
  state: () => ({
  darkMode: false,
        isLoading: false,
        notifications: [],
    
}
),

    actions: {
  toggleDarkMode() {
  this.darkMode = !this.darkMode;
  localStorage.setItem("darkMode", this.darkMode);
  
}
,
        setLoading(loading) {
  this.isLoading = loading;
  
}
,
        addNotification(notification) {
  this.notifications.push({
  id: Date.now(),
                ...notification,
            
}
);
  
}
,
        removeNotification(id) {
  this.notifications = this.notifications.filter((n) => n.id !== id);
  
}
,
    
}
,
    getters: {
  isDarkMode: (state) => state.darkMode,
    
}
,

}
);
  