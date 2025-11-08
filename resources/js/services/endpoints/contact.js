// resources/js/services/endpoints/contact.js
import api from "../api";

export const contactService = {
    /**
     * Envoyer un message de contact
     * @param {Object} data - Données du message
     * @param {string} data.nom - Nom de l'expéditeur
     * @param {string} data.email - Email de l'expéditeur
     * @param {string} data.sujet - Sujet du message
     * @param {string} data.message - Contenu du message
     * @returns {Promise}
     */
    async envoyerMessage(data) {
        try {
            const response = await api.post("/contact", data);
            return response.data;
        } catch (error) {
            console.error("Erreur lors de l'envoi du message:", error);

            // Gestion spécifique des erreurs de validation
            if (error.response?.status === 422) {
                throw new Error(
                    "Erreur de validation: " +
                        JSON.stringify(error.response.data.errors)
                );
            }

            throw error;
        }
    },

    /**
     * Valider les données du formulaire de contact côté client
     * @param {Object} data - Données à valider
     * @returns {Object} - Objet avec erreurs et isValid
     */
    validerFormulaire(data) {
        const erreurs = {};

        // Validation du nom
        if (!data.nom || data.nom.trim().length < 2) {
            erreurs.nom = "Le nom doit contenir au moins 2 caractères";
        }

        // Validation de l'email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!data.email || !emailRegex.test(data.email)) {
            erreurs.email = "Veuillez entrer un email valide";
        }

        // Validation du message
        if (!data.message || data.message.trim().length < 10) {
            erreurs.message = "Le message doit contenir au moins 10 caractères";
        }

        // Validation du sujet (optionnel mais limité s'il est présent)
        if (data.sujet && data.sujet.length > 255) {
            erreurs.sujet = "Le sujet ne doit pas dépasser 255 caractères";
        }

        return {
            erreurs,
            isValid: Object.keys(erreurs).length === 0,
        };
    },

    /**
     * Préparer les données pour l'envoi
     * @param {Object} data - Données brutes du formulaire
     * @returns {Object} - Données nettoyées
     */
    preparerDonnees(data) {
        return {
            nom: data.nom?.trim() || "",
            email: data.email?.trim() || "",
            sujet: data.sujet?.trim() || "",
            message: data.message?.trim() || "",
        };
    },

    /**
     * Envoyer un message avec validation préalable
     * @param {Object} data - Données du formulaire
     * @returns {Promise}
     */
    async envoyerMessageAvecValidation(data) {
        // Préparer les données
        const donneesNettoyees = this.preparerDonnees(data);

        // Valider les données
        const validation = this.validerFormulaire(donneesNettoyees);

        if (!validation.isValid) {
            throw new Error(
                "Données invalides: " + JSON.stringify(validation.erreurs)
            );
        }

        // Envoyer le message
        return await this.envoyerMessage(donneesNettoyees);
    },

    /**
     * Obtenir les informations de contact (pour pré-remplissage)
     * @returns {Promise}
     */
    async obtenirInformationsContact() {
        try {
            const response = await api.get("/contact/infos");
            return response.data;
        } catch (error) {
            console.error(
                "Erreur lors de la récupération des informations de contact:",
                error
            );
            // Retourner des valeurs par défaut en cas d'erreur
            return {
                email: "contact@portfolio.com",
                telephone: "+33 6 12 34 56 78",
                adresse: "Paris, France",
                horaires: "Lun - Ven: 9h - 18h",
            };
        }
    },

    /**
     * Tester la connexion au service de contact
     * @returns {Promise<boolean>}
     */
    async testerConnexion() {
        try {
            await api.get("/contact/ping");
            return true;
        } catch (error) {
            console.warn("Service contact non disponible:", error);
            return false;
        }
    },
};

export default contactService;
