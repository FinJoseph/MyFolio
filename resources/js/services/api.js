// resources/js/services/api.js
import axios from "axios";
  const api = axios.create({
  baseURL: "/api",
    headers: {
  "Content-Type": "application/json",
        Accept: "application/json",
    
}
,
    timeout: 10000,

}
);
  // Intercepteur pour les requêtes
api.interceptors.request.use(
    (config) => {
  // Ajouter un token d'authentification si disponible
        const token = localStorage.getItem("auth_token");
  if (token) {
  config.headers.Authorization = `Bearer ${
  token
}
`;
  
}
return config;
  
}
,
    (error) => {
  return Promise.reject(error);
  
}
);
  // Intercepteur pour les réponses
api.interceptors.response.use(
    (response) => response,
    (error) => {
  console.error("Erreur API:", error);
  // Gestion centralisée des erreurs
        if (error.response?.status === 401) {
  // Rediriger vers la page de login
            window.location.href = "/login";
  
}
else if (error.response?.status === 404) {
  // Gérer les 404
            console.log("Ressource non trouvée");
  
}
else if (error.response?.status >= 500) {
  // Gérer les erreurs serveur
            console.log("Erreur serveur");
  
}
return Promise.reject(error);
  
}
);
  export default api;
  