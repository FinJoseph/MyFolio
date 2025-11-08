<!-- resources/js/views/Contact.vue -->
<template>
  <div class="contact-page">
    <!-- Hero Section -->
    <section class="contact-hero">
      <div class="container">
        <div class="hero-content">
          <span class="hero-badge">Contact</span>
          <h1 class="hero-title">Discutons de votre projet</h1>
          <p class="hero-description">
            Une idée ? Un projet ? N'hésitez pas à me contacter. 
            Je serais ravi d'échanger avec vous et de donner vie à vos idées.
          </p>
        </div>
      </div>
    </section>

    <!-- Main Content -->
    <section class="contact-content">
      <div class="container">
        <div class="contact-grid">
          <!-- Informations de contact -->
          <div class="contact-info">
            <div class="info-header">
              <h2>Informations de contact</h2>
              <p>Plusieurs moyens de me joindre</p>
            </div>

            <div class="info-cards">
              <div class="info-card" v-for="info in contactInfos" :key="info.type">
                <div class="info-icon" :style="{ background: info.color }">
                  <component :is="info.icon" />
                </div>
                <div class="info-content">
                  <h3>{{ info.label }}</h3>
                  <a :href="info.link" class="info-value">{{ info.value }}</a>
                </div>
              </div>
            </div>

            <!-- Réseaux sociaux -->
            <div class="social-section" v-if="reseauxSociaux.length">
              <h3>Suivez-moi</h3>
              <div class="social-links">
                <a 
                  v-for="reseau in reseauxSociaux" 
                  :key="reseau.nom"
                  :href="reseau.url" 
                  target="_blank"
                  rel="noopener noreferrer"
                  class="social-link"
                  :title="reseau.nom"
                >
                  <component :is="reseau.icon" />
                </a>
              </div>
            </div>

            <!-- Badge disponibilité -->
            <div class="availability-card" v-if="infosPersonnelles?.disponible_freelance">
              <div class="availability-icon">✨</div>
              <div class="availability-content">
                <h3>Disponible pour freelance</h3>
                <p>{{ infosPersonnelles.message_disponibilite || 'Je suis actuellement disponible pour de nouveaux projets' }}</p>
              </div>
            </div>
          </div>

          <!-- Formulaire de contact -->
          <div class="contact-form-wrapper">
            <form @submit.prevent="envoyerMessage" class="contact-form">
              <div class="form-header">
                <h2>Envoyez-moi un message</h2>
                <p>Remplissez le formulaire ci-dessous</p>
              </div>

              <!-- Message de succès -->
              <div v-if="messageSucces" class="alert alert-success">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <div>
                  <strong>Message envoyé !</strong>
                  <p>{{ messageSucces }}</p>
                </div>
              </div>

              <!-- Message d'erreur -->
              <div v-if="messageErreur" class="alert alert-error">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="12" cy="12" r="10"></circle>
                  <line x1="12" y1="8" x2="12" y2="12"></line>
                  <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                <div>
                  <strong>Erreur</strong>
                  <p>{{ messageErreur }}</p>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group">
                  <label for="nom">
                    Nom complet <span class="required">*</span>
                  </label>
                  <input 
                    type="text" 
                    id="nom" 
                    v-model="form.nom" 
                    required 
                    placeholder="John Doe"
                    :disabled="envoiEnCours"
                    class="form-input"
                  >
                  <span v-if="erreurs.nom" class="error-message">{{ erreurs.nom }}</span>
                </div>

                <div class="form-group">
                  <label for="email">
                    Email <span class="required">*</span>
                  </label>
                  <input 
                    type="email" 
                    id="email" 
                    v-model="form.email" 
                    required 
                    placeholder="john@example.com"
                    :disabled="envoiEnCours"
                    class="form-input"
                  >
                  <span v-if="erreurs.email" class="error-message">{{ erreurs.email }}</span>
                </div>
              </div>

              <div class="form-group">
                <label for="sujet">
                  Sujet
                </label>
                <input 
                  type="text" 
                  id="sujet" 
                  v-model="form.sujet" 
                  placeholder="Développement d'une application web"
                  :disabled="envoiEnCours"
                  class="form-input"
                >
              </div>

              <div class="form-group">
                <label for="message">
                  Message <span class="required">*</span>
                </label>
                <textarea 
                  id="message" 
                  v-model="form.message" 
                  required 
                  rows="6" 
                  placeholder="Décrivez votre projet en détail..."
                  :disabled="envoiEnCours"
                  class="form-textarea"
                ></textarea>
                <span v-if="erreurs.message" class="error-message">{{ erreurs.message }}</span>
                <span class="char-count">{{ form.message.length }} / 1000 caractères</span>
              </div>

              <Button 
                type="submit" 
                variant="primary" 
                size="large"
                :disabled="envoiEnCours"
                class="submit-btn"
              >
                <svg v-if="!envoiEnCours" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <line x1="22" y1="2" x2="11" y2="13"></line>
                  <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                </svg>
                <span v-if="!envoiEnCours">Envoyer le message</span>
                <span v-else class="loading-text">
                  <span class="spinner"></span>
                  Envoi en cours...
                </span>
              </Button>

              <p class="form-note">
                * Champs obligatoires. Vos données sont protégées et ne seront jamais partagées.
              </p>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section" v-if="faqs.length">
      <div class="container">
        <div class="section-header">
          <span class="section-badge">FAQ</span>
          <h2 class="section-title">Questions fréquentes</h2>
        </div>

        <div class="faq-grid">
          <div v-for="(faq, index) in faqs" :key="index" class="faq-item">
            <h3>{{ faq.question }}</h3>
            <p>{{ faq.reponse }}</p>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import axios from 'axios'
import Button from '../components/ui/Button.vue'

// État
const envoiEnCours = ref(false)
const messageSucces = ref('')
const messageErreur = ref('')
const infosPersonnelles = ref(null)

const form = ref({
  nom: '',
  email: '',
  sujet: '',
  message: ''
})

const erreurs = ref({
  nom: '',
  email: '',
  message: ''
})

// Infos de contact (seront chargées depuis l'API)
const contactInfos = computed(() => {
  if (!infosPersonnelles.value) {
    return [
      {
        type: 'email',
        label: 'Email',
        value: 'contact@portfolio.com',
        link: 'mailto:contact@portfolio.com',
        icon: 'EmailIcon',
        color: 'linear-gradient(135deg, #3b82f6, #2563eb)'
      },
      {
        type: 'phone',
        label: 'Téléphone',
        value: '+33 6 12 34 56 78',
        link: 'tel:+33612345678',
        icon: 'PhoneIcon',
        color: 'linear-gradient(135deg, #10b981, #059669)'
      },
      {
        type: 'location',
        label: 'Localisation',
        value: 'Paris, France',
        link: '#',
        icon: 'LocationIcon',
        color: 'linear-gradient(135deg, #8b5cf6, #7c3aed)'
      }
    ]
  }

  return [
    {
      type: 'email',
      label: 'Email',
      value: infosPersonnelles.value.email,
      link: `mailto:${infosPersonnelles.value.email}`,
      icon: 'EmailIcon',
      color: 'linear-gradient(135deg, #3b82f6, #2563eb)'
    },
    ...(infosPersonnelles.value.telephone ? [{
      type: 'phone',
      label: 'Téléphone',
      value: infosPersonnelles.value.telephone,
      link: `tel:${infosPersonnelles.value.telephone.replace(/\s/g, '')}`,
      icon: 'PhoneIcon',
      color: 'linear-gradient(135deg, #10b981, #059669)'
    }] : []),
    ...(infosPersonnelles.value.ville && infosPersonnelles.value.pays ? [{
      type: 'location',
      label: 'Localisation',
      value: `${infosPersonnelles.value.ville}, ${infosPersonnelles.value.pays}`,
      link: '#',
      icon: 'LocationIcon',
      color: 'linear-gradient(135deg, #8b5cf6, #7c3aed)'
    }] : [])
  ]
})

// Réseaux sociaux
const reseauxSociaux = computed(() => {
  if (!infosPersonnelles.value) return []
  
  const reseaux = []
  const mapping = {
    github: { nom: 'GitHub', icon: 'GithubIcon' },
    linkedin: { nom: 'LinkedIn', icon: 'LinkedinIcon' },
    twitter: { nom: 'Twitter', icon: 'TwitterIcon' },
    instagram: { nom: 'Instagram', icon: 'InstagramIcon' },
    dribbble: { nom: 'Dribbble', icon: 'DribbbleIcon' },
    behance: { nom: 'Behance', icon: 'BehanceIcon' }
  }

  Object.keys(mapping).forEach(key => {
    if (infosPersonnelles.value[key]) {
      reseaux.push({
        nom: mapping[key].nom,
        url: infosPersonnelles.value[key],
        icon: mapping[key].icon
      })
    }
  })

  return reseaux
})

// FAQ
const faqs = ref([
  {
    question: 'Quel est votre délai de réponse ?',
    reponse: 'Je réponds généralement dans les 24 heures ouvrables.'
  },
  {
    question: 'Quels types de projets acceptez-vous ?',
    reponse: 'Je travaille sur des projets web variés : sites vitrine, applications, e-commerce, etc.'
  },
  {
    question: 'Proposez-vous des devis gratuits ?',
    reponse: 'Oui, je propose des devis détaillés et gratuits après étude de votre projet.'
  },
  {
    question: 'Travaillez-vous à distance ?',
    reponse: 'Oui, je travaille principalement à distance avec des outils de collaboration modernes.'
  }
])

// Validation
const validerFormulaire = () => {
  let valide = true
  erreurs.value = { nom: '', email: '', message: '' }

  if (!form.value.nom || form.value.nom.length < 2) {
    erreurs.value.nom = 'Le nom doit contenir au moins 2 caractères'
    valide = false
  }

  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
  if (!emailRegex.test(form.value.email)) {
    erreurs.value.email = 'Email invalide'
    valide = false
  }

  if (!form.value.message || form.value.message.length < 10) {
    erreurs.value.message = 'Le message doit contenir au moins 10 caractères'
    valide = false
  }

  if (form.value.message.length > 1000) {
    erreurs.value.message = 'Le message ne peut pas dépasser 1000 caractères'
    valide = false
  }

  return valide
}

// Envoyer le message
const envoyerMessage = async () => {
  // Reset messages
  messageSucces.value = ''
  messageErreur.value = ''

  // Validation
  if (!validerFormulaire()) {
    return
  }

  try {
    envoiEnCours.value = true

    const response = await axios.post('/api/contact', {
      nom: form.value.nom,
      email: form.value.email,
      sujet: form.value.sujet || 'Demande de contact',
      message: form.value.message
    })

    // Succès
    messageSucces.value = response.data.message || 'Message envoyé avec succès ! Je vous répondrai dans les plus brefs délais.'
    
    // Reset du formulaire
    form.value = {
      nom: '',
      email: '',
      sujet: '',
      message: ''
    }

    // Scroll vers le haut
    window.scrollTo({ top: 0, behavior: 'smooth' })

  } catch (error) {
    console.error('Erreur:', error)
    
    if (error.response?.data?.errors) {
      // Erreurs de validation Laravel
      const validationErrors = error.response.data.errors
      erreurs.value = {
        nom: validationErrors.nom?.[0] || '',
        email: validationErrors.email?.[0] || '',
        message: validationErrors.message?.[0] || ''
      }
      messageErreur.value = 'Veuillez corriger les erreurs dans le formulaire.'
    } else {
      messageErreur.value = error.response?.data?.message || 'Une erreur est survenue. Veuillez réessayer.'
    }
  } finally {
    envoiEnCours.value = false
  }
}

// Charger les infos personnelles
const chargerInfos = async () => {
  try {
    const response = await axios.get('/api/accueil')
    infosPersonnelles.value = response.data.informations_personnelles
  } catch (error) {
    console.error('Erreur chargement infos:', error)
  }
}

onMounted(() => {
  chargerInfos()
})
</script>

<style scoped>
.contact-page {
  min-height: 100vh;
}

/* Hero Section */
.contact-hero {
  padding: 8rem 0 4rem;
  background: linear-gradient(180deg, 
    rgba(59, 130, 246, 0.03) 0%,
    transparent 100%);
}

.container {
  max-width: 1400px;
  margin: 0 auto;
  padding: 0 clamp(1.5rem, 4vw, 3rem);
}

.hero-content {
  text-align: center;
  max-width: 700px;
  margin: 0 auto;
}

.hero-badge {
  display: inline-block;
  padding: 0.5rem 1rem;
  background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(139, 92, 246, 0.1));
  color: #3b82f6;
  border-radius: 50px;
  font-size: 0.875rem;
  font-weight: 600;
  margin-bottom: 1.5rem;
}

.hero-title {
  font-size: clamp(2.5rem, 5vw, 3.5rem);
  font-weight: 800;
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  background-clip: text;
  -webkit-background-clip: text;
  color: transparent;
  margin-bottom: 1.5rem;
}

.hero-description {
  font-size: 1.125rem;
  line-height: 1.8;
  color: #6b7280;
}

/* Contact Content */
.contact-content {
  padding: 4rem 0;
}

.contact-grid {
  display: grid;
  grid-template-columns: 1fr 1.5fr;
  gap: 4rem;
  align-items: start;
}

/* Contact Info */
.contact-info {
  display: flex;
  flex-direction: column;
  gap: 2rem;
  position: sticky;
  top: 6rem;
}

.info-header h2 {
  font-size: 1.75rem;
  font-weight: 700;
  color: #1f2937;
  margin-bottom: 0.5rem;
}

.info-header p {
  color: #6b7280;
}

.info-cards {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.info-card {
  display: flex;
  align-items: center;
  gap: 1.25rem;
  padding: 1.5rem;
  background: white;
  border: 1px solid #e5e7eb;
  border-radius: 12px;
  transition: all 0.3s;
}

.info-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
}

.info-icon {
  width: 56px;
  height: 56px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 12px;
  color: white;
  flex-shrink: 0;
}

.info-content h3 {
  font-size: 0.875rem;
  font-weight: 600;
  color: #6b7280;
  margin-bottom: 0.25rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.info-value {
  font-size: 1rem;
  font-weight: 600;
  color: #1f2937;
  text-decoration: none;
  transition: color 0.3s;
}

.info-value:hover {
  color: #3b82f6;
}

/* Social Section */
.social-section {
  padding: 1.5rem;
  background: white;
  border: 1px solid #e5e7eb;
  border-radius: 12px;
}

.social-section h3 {
  font-size: 1rem;
  font-weight: 700;
  color: #1f2937;
  margin-bottom: 1rem;
}

.social-links {
  display: flex;
  flex-wrap: wrap;
  gap: 0.75rem;
}

.social-link {
  width: 44px;
  height: 44px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #f3f4f6;
  border-radius: 50%;
  color: #6b7280;
  text-decoration: none;
  transition: all 0.3s;
}

.social-link:hover {
  background: #3b82f6;
  color: white;
  transform: translateY(-2px);
}

/* Availability Card */
.availability-card {
  display: flex;
  gap: 1rem;
  padding: 1.5rem;
  background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(5, 150, 105, 0.05));
  border: 1px solid rgba(16, 185, 129, 0.2);
  border-radius: 12px;
}

.availability-icon {
  font-size: 2rem;
  flex-shrink: 0;
}

.availability-content h3 {
  font-size: 1rem;
  font-weight: 700;
  color: #047857;
  margin-bottom: 0.5rem;
}

.availability-content p {
  font-size: 0.875rem;
  color: #065f46;
  line-height: 1.6;
}

/* Contact Form */
.contact-form-wrapper {
  background: white;
  border: 1px solid #e5e7eb;
  border-radius: 16px;
  padding: 2.5rem;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}

.form-header {
  margin-bottom: 2rem;
}

.form-header h2 {
  font-size: 1.75rem;
  font-weight: 700;
  color: #1f2937;
  margin-bottom: 0.5rem;
}

.form-header p {
  color: #6b7280;
}

.contact-form {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1.5rem;
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.form-group label {
  font-weight: 600;
  color: #374151;
  font-size: 0.875rem;
}

.required {
  color: #ef4444;
}

.form-input,
.form-textarea {
  padding: 0.875rem 1rem;
  border: 2px solid #e5e7eb;
  border-radius: 8px;
  font-size: 1rem;
  transition: all 0.3s;
  font-family: inherit;
}

.form-input:focus,
.form-textarea:focus {
  outline: none;
  border-color: #3b82f6;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.form-input:disabled,
.form-textarea:disabled {
  background: #f9fafb;
  cursor: not-allowed;
  opacity: 0.6;
}

.form-textarea {
  resize: vertical;
  min-height: 150px;
}

.error-message {
  color: #ef4444;
  font-size: 0.875rem;
}

.char-count {
  font-size: 0.75rem;
  color: #9ca3af;
  text-align: right;
}

.submit-btn {
  margin-top: 0.5rem;
}

.loading-text {
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.spinner {
  width: 18px;
  height: 18px;
  border: 2px solid rgba(255, 255, 255, 0.3);
  border-top-color: white;
  border-radius: 50%;
  animation: spin 0.8s linear infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

.form-note {
  font-size: 0.875rem;
  color: #6b7280;
  text-align: center;
  margin-top: 0.5rem;
}

/* Alerts */
.alert {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding: 1rem;
  border-radius: 8px;
  font-size: 0.875rem;
  font-weight: 500;
}

.alert svg {
  flex-shrink: 0;
}

.alert-success {
  background: rgba(16, 185, 129, 0.1);
  color: #047857;
  border: 1px solid rgba(16, 185, 129, 0.2);
}

.alert-error {
  background: rgba(239, 68, 68, 0.1);
  color: #b91c1c;
  border: 1px solid rgba(239, 68, 68, 0.2);
}

/* FAQ Section */
.faq-section {
  padding: 5rem 0;
  background: linear-gradient(180deg, 
    transparent 0%,
    rgba(59, 130, 246, 0.02) 100%);
}

.section-header {
  text-align: center;
  margin-bottom: 4rem;
}

.section-badge {
  display: inline-block;
  padding: 0.5rem 1rem;
  background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(139, 92, 246, 0.1));
  color: #3b82f6;
  border-radius: 50px;
  font-size: 0.875rem;
  font-weight: 600;
  margin-bottom: 1rem;
}

.section-title {
  font-size: clamp(2rem, 4vw, 3rem);
  font-weight: 800;
  color: #1f2937;
}

.faq-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 2rem;
}

.faq-item {
  padding: 2rem;
  background: white;
  border: 1px solid #e5e7eb;
  border-radius: 12px;
  transition: all 0.3s;
}

.faq-item:hover {
  transform: translateY(-4px);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
}

.faq-item h3 {
  font-size: 1.125rem;
  font-weight: 700;
  color: #1f2937;
  margin-bottom: 0.75rem;
}

.faq-item p {
  color: #6b7280;
  line-height: 1.7;
}

/* Dark mode */
.dark-mode .contact-hero {
  background: linear-gradient(180deg, 
    rgba(59, 130, 246, 0.02) 0%,
    transparent 100%);
}

.dark-mode .hero-description {
  color: #d1d5db;
}

.dark-mode .info-header h2,
.dark-mode .form-header h2,
.dark-mode .social-section h3,
.dark-mode .section-title,
.dark-mode .faq-item h3,
.dark-mode .info-value {
  color: #f9fafb;
}

.dark-mode .info-header p,
.dark-mode .form-header p,
.dark-mode .faq-item p,
.dark-mode .form-note,
.dark-mode .char-count {
  color: #d1d5db;
}

.dark-mode .info-card,
.dark-mode .social-section,
.dark-mode .contact-form-wrapper,
.dark-mode .faq-item {
  background: #1f2937;
  border-color: #374151;
}

.dark-mode .form-group label {
  color: #f3f4f6;
}

.dark-mode .form-input,
.dark-mode .form-textarea {
  background: #111827;
  border-color: #374151;
  color: #f9fafb;
}

.dark-mode .form-input:focus,
.dark-mode .form-textarea:focus {
  border-color: #60a5fa;
  box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.1);
}

.dark-mode .form-input:disabled,
.dark-mode .form-textarea:disabled {
  background: #0f172a;
}

.dark-mode .social-link {
  background: #111827;
  color: #94a3b8;
}

.dark-mode .social-link:hover {
  background: #3b82f6;
  color: white;
}

/* Responsive */
@media (max-width: 1024px) {
  .contact-grid {
    grid-template-columns: 1fr;
    gap: 3rem;
  }

  .contact-info {
    position: static;
  }
}

@media (max-width: 768px) {
  .contact-hero {
    padding: 6rem 0 3rem;
  }

  .contact-content {
    padding: 3rem 0;
  }

  .contact-form-wrapper {
    padding: 2rem;
  }

  .form-row {
    grid-template-columns: 1fr;
    gap: 1.5rem;
  }

  .faq-grid {
    grid-template-columns: 1fr;
  }

  .faq-section {
    padding: 3rem 0;
  }
}

@media (max-width: 480px) {
  .hero-title {
    font-size: 2rem;
  }

  .contact-form-wrapper {
    padding: 1.5rem;
  }

  .info-card {
    padding: 1.25rem;
  }

  .faq-item {
    padding: 1.5rem;
  }
}

/* Performance */
@media (prefers-reduced-motion: reduce) {
  *,
  *::before,
  *::after {
    animation-duration: 0.01ms !important;
    transition-duration: 0.01ms !important;
  }
}
</style>