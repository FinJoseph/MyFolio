// resources/js/services/endpoints/projets.js
import api from "../api";

export const projetsService = {
    /**
     * Obtenir tous les projets avec filtres optionnels
     * @param {Object} params - Paramètres de filtrage
     * @param {string} params.categorie - Filtrer par catégorie
     * @param {string} params.recherche - Recherche textuelle
     * @param {number} params.limit - Limite de résultats
     * @returns {Promise}
     */
    async obtenirTous(params = {}) {
        try {
            const response = await api.get("/projets", { params });
            return response.data;
        } catch (error) {
            console.error("Erreur lors de la récupération des projets:", error);
            throw error;
        }
    },

    /**
     * Obtenir un projet spécifique par son slug
     * @param {string} slug - Slug du projet
     * @returns {Promise}
     */
    async obtenirParSlug(slug) {
        try {
            const response = await api.get(`/projets/${slug}`);
            return response.data;
        } catch (error) {
            console.error(
                `Erreur lors de la récupération du projet ${slug}:`,
                error
            );
            throw error;
        }
    },

    /**
     * Obtenir les projets mis en avant
     * @param {number} limit - Nombre maximum de projets
     * @returns {Promise}
     */
    async obtenirProjetsMisEnAvant(limit = 3) {
        try {
            const response = await api.get("/projets", {
                params: {
                    mis_en_avant: true,
                    limit: limit,
                },
            });
            return response.data;
        } catch (error) {
            console.error(
                "Erreur lors de la récupération des projets mis en avant:",
                error
            );
            throw error;
        }
    },

    /**
     * Obtenir toutes les catégories de projets disponibles
     * @returns {Promise}
     */
    async obtenirCategories() {
        try {
            const response = await api.get("/projets/categories");
            return response.data;
        } catch (error) {
            console.error(
                "Erreur lors de la récupération des catégories:",
                error
            );
            throw error;
        }
    },

    /**
     * Obtenir les projets par catégorie
     * @param {string} categorie - Catégorie souhaitée
     * @returns {Promise}
     */
    async obtenirParCategorie(categorie) {
        try {
            const response = await api.get("/projets", {
                params: { categorie },
            });
            return response.data;
        } catch (error) {
            console.error(
                `Erreur lors de la récupération des projets de la catégorie ${categorie}:`,
                error
            );
            throw error;
        }
    },

    /**
     * Obtenir les projets similaires (même catégorie ou technologies)
     * @param {string} projetSlug - Slug du projet actuel
     * @param {number} limit - Nombre maximum de projets similaires
     * @returns {Promise}
     */
    async obtenirProjetsSimilaires(projetSlug, limit = 3) {
        try {
            const response = await api.get(
                `/projets/${projetSlug}/similaires`,
                {
                    params: { limit },
                }
            );
            return response.data;
        } catch (error) {
            console.error(
                `Erreur lors de la récupération des projets similaires à ${projetSlug}:`,
                error
            );
            throw error;
        }
    },

    /**
     * Rechercher des projets par terme
     * @param {string} terme - Terme de recherche
     * @returns {Promise}
     */
    async rechercherProjets(terme) {
        try {
            const response = await api.get("/projets", {
                params: { recherche: terme },
            });
            return response.data;
        } catch (error) {
            console.error(
                `Erreur lors de la recherche de projets avec le terme "${terme}":`,
                error
            );
            throw error;
        }
    },

    /**
     * Obtenir les statistiques des projets
     * @returns {Promise}
     */
    async obtenirStatistiques() {
        try {
            const response = await api.get("/projets/statistiques");
            return response.data;
        } catch (error) {
            console.error(
                "Erreur lors de la récupération des statistiques projets:",
                error
            );
            throw error;
        }
    },
};

export default projetsService;
