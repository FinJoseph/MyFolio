<template>
  <footer class="footer">
    <div class="container">
      <!-- Section principale -->
      <div class="footer-content">
        <!-- À propos -->
        <div class="footer-section">
          <h3 class="footer-title">{{ infosPersonnelles?.prenom || nomSite }}</h3>
          <p class="footer-description">
            {{ infosPersonnelles?.bio_courte || descriptionSite }}
          </p>
          
          <!-- Stats rapides -->
          <div class="quick-stats" v-if="!chargement">
            <div class="stat-item">
              <strong>{{ statistiques.total_projets || 0 }}</strong>
              <span>Projets</span>
            </div>
            <div class="stat-item">
              <strong>{{ statistiques.annees_experience || 0 }}+</strong>
              <span>Ans</span>
            </div>
            <div class="stat-item">
              <strong>{{ statistiques.clients_satisfaits || 0 }}+</strong>
              <span>Clients</span>
            </div>
          </div>
        </div>

        <!-- Navigation -->
        <div class="footer-section">
          <h4 class="footer-subtitle">Navigation</h4>
          <div class="footer-links">
            <router-link 
              v-for="lien in liens" 
              :key="lien.path"
              :to="lien.path" 
              class="footer-link"
            >
              {{ lien.nom }}
            </router-link>
          </div>
        </div>

        <!-- Contact -->
        <div class="footer-section">
          <h4 class="footer-subtitle">Contact</h4>
          <div class="contact-info">
            <a 
              :href="`mailto:${infosPersonnelles?.email || email}`" 
              class="contact-item"
            >
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                <polyline points="22,6 12,13 2,6"></polyline>
              </svg>
              {{ infosPersonnelles?.email || email }}
            </a>
            
            <a 
              v-if="infosPersonnelles?.telephone || telephone"
              :href="`tel:${(infosPersonnelles?.telephone || telephone).replace(/\s/g, '')}`" 
              class="contact-item"
            >
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
              </svg>
              {{ infosPersonnelles?.telephone || telephone }}
            </a>
            
            <div 
              v-if="infosPersonnelles?.ville && infosPersonnelles?.pays"
              class="contact-item"
            >
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                <circle cx="12" cy="10" r="3"></circle>
              </svg>
              {{ infosPersonnelles.ville }}, {{ infosPersonnelles.pays }}
            </div>

            <!-- Badge disponibilité -->
            <div class="availability-badge" v-if="infosPersonnelles?.disponible_freelance">
              <span class="availability-dot"></span>
              Disponible pour freelance
            </div>
          </div>
        </div>

        <!-- Réseaux sociaux -->
        <div class="footer-section">
          <h4 class="footer-subtitle">Réseaux sociaux</h4>
          <div class="social-links" v-if="reseauxSociaux.length">
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
          <div v-else class="social-links">
            <a href="#" class="social-link" title="GitHub">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.17 6.839 9.49.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.463-1.11-1.463-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.831.092-.646.35-1.086.636-1.336-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.578 9.578 0 0112 6.836c.85.004 1.705.114 2.504.336 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C19.138 20.167 22 16.418 22 12c0-5.523-4.477-10-10-10z"/>
              </svg>
            </a>
            <a href="#" class="social-link" title="LinkedIn">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
              </svg>
            </a>
            <a href="#" class="social-link" title="Twitter">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
              </svg>
            </a>
          </div>
        </div>
      </div>

      <!-- Footer bottom -->
      <div class="footer-bottom">
        <p class="copyright">
          &copy; {{ currentYear }} <strong>{{ infosPersonnelles?.nom_complet || nomSite }}</strong>. Tous droits réservés.
        </p>
        <div class="made-with">
          Développé avec <span class="heart">❤️</span> et <span class="coffee">☕</span>
        </div>
        <div class="legal-links">
          <router-link to="/mentions-legales" class="legal-link">Mentions légales</router-link>
          <router-link to="/politique-confidentialite" class="legal-link">Confidentialité</router-link>
        </div>
      </div>
    </div>

    <!-- Loading -->
    <div v-if="chargement" class="footer-loading">
      <div class="spinner"></div>
    </div>
  </footer>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import axios from 'axios'

// État
const chargement = ref(true)
const infosPersonnelles = ref(null)
const statistiques = ref({
  total_projets: 0,
  annees_experience: 0,
  clients_satisfaits: 0
})

// Données par défaut
const nomSite = ref('Portfolio')
const descriptionSite = ref('Développeur full-stack passionné créant des expériences web modernes.')
const currentYear = ref(new Date().getFullYear())
const email = ref('contact@portfolio.com')
const telephone = ref('+33 6 12 34 56 78')

const liens = [
  { nom: 'Accueil', path: '/' },
  { nom: 'Projets', path: '/projets' },
  { nom: 'À Propos', path: '/a-propos' },
  { nom: 'Blog', path: '/blog' },
  { nom: 'Contact', path: '/contact' }
]

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

// Charger les données
const chargerDonnees = async () => {
  try {
    chargement.value = true
    const response = await axios.get('/api/accueil')
    
    infosPersonnelles.value = response.data.informations_personnelles
    statistiques.value = response.data.statistiques || statistiques.value
    
  } catch (err) {
    console.error('Erreur chargement footer:', err)
  } finally {
    chargement.value = false
  }
}

onMounted(() => {
  chargerDonnees()
})
</script>

<style scoped>
/* Base */
.footer {
  background: #f8fafc;
  color: #334155;
  padding: 3rem 0 1.5rem;
  margin-top: 4rem;
  border-top: 1px solid #e2e8f0;
  position: relative;
}

.container {
  max-width: 1400px;
  margin: 0 auto;
  padding: 0 2rem;
}

/* Grid principal */
.footer-content {
  display: grid;
  grid-template-columns: 1.5fr 1fr 1fr 1fr;
  gap: 3rem;
  margin-bottom: 3rem;
}

/* Section */
.footer-section {
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
}

.footer-title {
  font-size: 1.5rem;
  font-weight: 800;
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  background-clip: text;
  -webkit-background-clip: text;
  color: transparent;
  margin-bottom: 0.5rem;
}

.footer-subtitle {
  font-size: 1rem;
  font-weight: 700;
  color: #1e293b;
  margin-bottom: 0.5rem;
}

.footer-description {
  line-height: 1.7;
  color: #64748b;
  font-size: 0.9375rem;
}

/* Stats rapides */
.quick-stats {
  display: flex;
  gap: 1.5rem;
  padding-top: 1rem;
  border-top: 1px solid #e2e8f0;
}

.stat-item {
  display: flex;
  flex-direction: column;
  gap: 0.25rem;
}

.stat-item strong {
  font-size: 1.5rem;
  font-weight: 800;
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  background-clip: text;
  -webkit-background-clip: text;
  color: transparent;
}

.stat-item span {
  font-size: 0.75rem;
  color: #64748b;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

/* Links */
.footer-links {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.footer-link {
  color: #64748b;
  text-decoration: none;
  font-size: 0.9375rem;
  transition: all 0.3s;
  width: fit-content;
}

.footer-link:hover {
  color: #3b82f6;
  padding-left: 0.5rem;
}

/* Contact */
.contact-info {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.contact-item {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  color: #64748b;
  text-decoration: none;
  font-size: 0.9375rem;
  transition: color 0.3s;
}

.contact-item:hover {
  color: #3b82f6;
}

.contact-item svg {
  flex-shrink: 0;
}

.availability-badge {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 1rem;
  background: rgba(16, 185, 129, 0.1);
  border: 1px solid rgba(16, 185, 129, 0.2);
  border-radius: 50px;
  font-size: 0.875rem;
  font-weight: 600;
  color: #10b981;
  width: fit-content;
  margin-top: 0.5rem;
}

.availability-dot {
  width: 8px;
  height: 8px;
  background: #10b981;
  border-radius: 50%;
  animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
  0%, 100% {
    opacity: 1;
    transform: scale(1);
  }
  50% {
    opacity: 0.5;
    transform: scale(1.2);
  }
}

/* Social links */
.social-links {
  display: flex;
  flex-wrap: wrap;
  gap: 0.75rem;
}

.social-link {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 44px;
  height: 44px;
  background: #e2e8f0;
  border-radius: 50%;
  color: #475569;
  text-decoration: none;
  transition: all 0.3s;
}

.social-link:hover {
  background: #3b82f6;
  color: white;
  transform: translateY(-3px);
}

/* Footer bottom */
.footer-bottom {
  border-top: 1px solid #e2e8f0;
  padding-top: 2rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 2rem;
  flex-wrap: wrap;
}

.copyright {
  color: #64748b;
  font-size: 0.875rem;
}

.copyright strong {
  color: #1e293b;
}

.made-with {
  display: flex;
  align-items: center;
  gap: 0.375rem;
  color: #64748b;
  font-size: 0.875rem;
}

.heart {
  color: #ef4444;
  animation: beat 1.5s ease-in-out infinite;
}

@keyframes beat {
  0%, 100% { transform: scale(1); }
  25% { transform: scale(1.2); }
}

.coffee {
  animation: steam 2s ease-in-out infinite;
}

@keyframes steam {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-3px); }
}

.legal-links {
  display: flex;
  gap: 1.5rem;
  font-size: 0.875rem;
}

.legal-link {
  color: #64748b;
  text-decoration: none;
  transition: color 0.3s;
}

.legal-link:hover {
  color: #3b82f6;
}

/* Loading */
.footer-loading {
  position: absolute;
  inset: 0;
  background: rgba(248, 250, 252, 0.95);
  backdrop-filter: blur(5px);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 10;
}

.spinner {
  width: 40px;
  height: 40px;
  border: 3px solid #e2e8f0;
  border-top-color: #3b82f6;
  border-radius: 50%;
  animation: spin 0.8s linear infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

/* ===== DARK MODE ===== */
.dark-mode .footer {
  background: #0f172a;
  color: #cbd5e1;
  border-top-color: #1e293b;
}

.dark-mode .footer-subtitle {
  color: #f1f5f9;
}

.dark-mode .footer-description,
.dark-mode .footer-link,
.dark-mode .contact-item,
.dark-mode .copyright,
.dark-mode .made-with,
.dark-mode .legal-link {
  color: #94a3b8;
}

.dark-mode .footer-link:hover,
.dark-mode .contact-item:hover,
.dark-mode .legal-link:hover {
  color: #60a5fa;
}

.dark-mode .copyright strong {
  color: #f1f5f9;
}

.dark-mode .quick-stats,
.dark-mode .footer-bottom {
  border-top-color: #1e293b;
}

.dark-mode .social-link {
  background: #1e293b;
  color: #94a3b8;
}

.dark-mode .social-link:hover {
  background: #3b82f6;
  color: white;
}

.dark-mode .footer-loading {
  background: rgba(15, 23, 42, 0.95);
}

.dark-mode .spinner {
  border-color: #1e293b;
  border-top-color: #60a5fa;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 1024px) {
  .footer-content {
    grid-template-columns: repeat(2, 1fr);
    gap: 2.5rem;
  }
}

@media (max-width: 768px) {
  .container {
    padding: 0 1.5rem;
  }

  .footer {
    padding: 2.5rem 0 1.5rem;
    margin-top: 3rem;
  }

  .footer-content {
    grid-template-columns: 1fr;
    gap: 2rem;
  }

  .quick-stats {
    justify-content: space-between;
  }

  .footer-bottom {
    flex-direction: column;
    text-align: center;
    gap: 1rem;
  }

  .legal-links {
    flex-direction: column;
    gap: 0.75rem;
  }

  .social-links {
    justify-content: center;
  }
}

@media (max-width: 480px) {
  .container {
    padding: 0 1.25rem;
  }

  .footer-title {
    font-size: 1.25rem;
  }

  .quick-stats {
    gap: 1rem;
  }

  .stat-item strong {
    font-size: 1.25rem;
  }

  .stat-item span {
    font-size: 0.625rem;
  }
}

/* Accessibilité */
.footer-link:focus-visible,
.social-link:focus-visible,
.legal-link:focus-visible,
.contact-item:focus-visible {
  outline: 2px solid #3b82f6;
  outline-offset: 3px;
  border-radius: 4px;
}

/* Performance */
@media (prefers-reduced-motion: reduce) {
  *,
  *::before,
  *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}
</style>