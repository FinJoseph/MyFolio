// resources/js/services/endpoints/accueil.js
import api from "../api";
  export const accueilService = {
  async obtenirDonneesAccueil() {
  const response = await api.get("/accueil");
  return response.data;
  
}
,

}
;
  // resources/js/services/endpoints/projets.js
import api from "../api";
  export const projetsService = {
  async obtenirTous(params = {
  
}
) {
  const response = await api.get("/projets", {
  params 
}
);
  return response.data;
  
}
,

    async obtenirParSlug(slug) {
  const response = await api.get(`/projets/${
  slug
}
`);
  return response.data;
  
}
,

    async obtenirCategories() {
  const response = await api.get("/projets/categories");
  return response.data;
  
}
,

}
;
  // resources/js/services/endpoints/contact.js
import api from "../api";
  export const contactService = {
  async envoyerMessage(data) {
  const response = await api.post("/contact", data);
  return response.data;
  
}
,

}
;
  