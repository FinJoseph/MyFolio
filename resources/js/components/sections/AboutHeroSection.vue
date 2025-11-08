<!-- components/sections/AboutHeroSection.vue -->
<template>
  <section class="about-hero">
    <div class="hero-background">
      <div class="gradient-overlay"></div>
      <div class="particles-about">
        <div v-for="i in particleCount" :key="i" class="particle" :style="getParticleStyle(i)"></div>
      </div>
    </div>
    
    <div class="container">
      <div class="hero-content">
        <div class="hero-text">
          <!-- Badge avec titre du poste -->
          <div class="hero-badge">
            <span class="badge-dot"></span>
            <span class="badge-text">{{ infosPersonnelles.titre_poste || 'Développeur Full-Stack' }}</span>
          </div>
          
          <!-- Titre principal -->
          <h1 class="hero-title">À Propos de Moi</h1>
          
          <!-- Bio courte -->
          <p class="hero-description">
            {{ infosPersonnelles.bio_courte || 'Passionné par la création de solutions digitales innovantes, je mets mon expertise technique au service de vos projets.' }}
          </p>

          <!-- Informations supplémentaires -->
          <div class="additional-info" v-if="showAdditionalInfo">
            <!-- Localisation -->
            <div class="info-item" v-if="localisationComplete">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                <circle cx="12" cy="10" r="3"></circle>
              </svg>
              <span>{{ localisationComplete }}</span>
            </div>

            <!-- Expérience -->
            <div class="info-item" v-if="anneesExperience">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
              </svg>
              <span>{{ anneesExperience }}+ ans d'expérience</span>
            </div>

            <!-- Email -->
            <div class="info-item" v-if="infosPersonnelles.email">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                <polyline points="22,6 12,13 2,6"></polyline>
              </svg>
              <a :href="`mailto:${infosPersonnelles.email}`">{{ infosPersonnelles.email }}</a>
            </div>

            <!-- Téléphone -->
            <div class="info-item" v-if="infosPersonnelles.telephone">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
              </svg>
              <a :href="`tel:${infosPersonnelles.telephone}`">{{ formatTelephone(infosPersonnelles.telephone) }}</a>
            </div>
          </div>

          <!-- Statistiques rapides -->
          <div class="quick-stats" v-if="showQuickStats">
            <div class="stat" v-if="totalProjets > 0">
              <div class="stat-number">{{ totalProjets }}+</div>
              <div class="stat-label">Projets</div>
            </div>
            <div class="stat" v-if="clientsSatisfaits > 0">
              <div class="stat-number">{{ clientsSatisfaits }}%</div>
              <div class="stat-label">Satisfaction</div>
            </div>
            <div class="stat" v-if="technologiesCount > 0">
              <div class="stat-number">{{ technologiesCount }}+</div>
              <div class="stat-label">Technologies</div>
            </div>
          </div>
          
          <!-- Actions -->
          <div class="hero-actions">
            <Button 
              tag="router-link" 
              to="/contact" 
              variant="primary"
              size="medium"
            >
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
              </svg>
              Me contacter
            </Button>
            
            <Button 
              v-if="infosPersonnelles.cv_pdf"
              tag="a" 
              :href="infosPersonnelles.cv_pdf" 
              target="_blank" 
              variant="outline"
              size="medium"
            >
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                <polyline points="7 10 12 15 17 10"></polyline>
                <line x1="12" y1="15" x2="12" y2="3"></line>
              </svg>
              Télécharger mon CV
            </Button>

            <Button 
              tag="router-link" 
              to="/projets" 
              variant="ghost"
              size="medium"
            >
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
              </svg>
              Voir mes projets
            </Button>
          </div>

          <!-- Réseaux sociaux -->
          <div class="social-links" v-if="reseauxSociauxFiltres.length">
            <a 
              v-for="reseau in reseauxSociauxFiltres" 
              :key="reseau.nom"
              :href="reseau.url" 
              target="_blank"
              rel="noopener noreferrer"
              class="social-link"
              :aria-label="reseau.nom"
              :title="reseau.nom"
            >
              <svg v-if="reseau.nom === 'github'" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path>
              </svg>
              
              <svg v-else-if="reseau.nom === 'linkedin'" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                <rect x="2" y="9" width="4" height="12"></rect>
                <circle cx="4" cy="4" r="2"></circle>
              </svg>
              
              <svg v-else width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <path d="M12 16v-4m0-4h.01"></path>
              </svg>
            </a>
          </div>
        </div>
        
        <div class="hero-image">
          <div class="image-container">
            <img 
              v-if="infosPersonnelles.photo_profil" 
              :src="infosPersonnelles.photo_profil" 
              :alt="infosPersonnelles.nom_complet"
              class="profile-image"
            />
            <div v-else class="profile-placeholder">
              <div class="placeholder-content">
                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                  <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <span>Photo de profil</span>
              </div>
            </div>

            <!-- Badge de disponibilité sur l'image -->
            <div class="availability-badge" v-if="infosPersonnelles.disponible_freelance !== null">
              <span class="availability-dot" :class="infosPersonnelles.disponible_freelance ? 'available' : 'busy'"></span>
              <span class="availability-text">
                {{ infosPersonnelles.disponible_freelance ? 'Disponible' : 'Non disponible' }}
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { computed } from 'vue'
import Button from '../ui/Button.vue'

const props = defineProps({
  infosPersonnelles: {
    type: Object,
    default: () => ({})
  },
  experiences: {
    type: Array,
    default: () => []
  },
  projets: {
    type: Array,
    default: () => []
  },
  competences: {
    type: Array,
    default: () => []
  },
  particleCount: {
    type: Number,
    default: 20
  },
  showAdditionalInfo: {
    type: Boolean,
    default: true
  },
  showQuickStats: {
    type: Boolean,
    default: true
  }
})

// Computed properties
const reseauxSociauxFiltres = computed(() => {
  const reseaux = [
    { nom: 'github', url: props.infosPersonnelles.github },
    { nom: 'linkedin', url: props.infosPersonnelles.linkedin },
    { nom: 'twitter', url: props.infosPersonnelles.twitter },
    { nom: 'instagram', url: props.infosPersonnelles.instagram }
  ]
  return reseaux.filter(reseau => reseau.url)
})

const localisationComplete = computed(() => {
  const { ville, pays, code_postal } = props.infosPersonnelles
  let localisation = ville || ''
  
  if (code_postal && ville) {
    localisation = `${code_postal} ${localisation}`
  }
  
  if (pays && localisation) {
    localisation += `, ${pays}`
  }
  
  return localisation
})

const anneesExperience = computed(() => {
  if (!props.experiences.length) return 5 // Valeur par défaut
  
  const totalAnnees = props.experiences.reduce((total, exp) => {
    try {
      const debut = new Date(exp.date_debut)
      const fin = exp.en_cours ? new Date() : new Date(exp.date_fin)
      const mois = (fin.getFullYear() - debut.getFullYear()) * 12 + (fin.getMonth() - debut.getMonth())
      return total + (mois / 12)
    } catch {
      return total
    }
  }, 0)
  
  return Math.round(totalAnnees)
})

const totalProjets = computed(() => {
  return props.projets.length > 0 ? props.projets.length + 47 : 50
})

const clientsSatisfaits = computed(() => {
  return 98 // Valeur par défaut, pourrait être dynamique
})

const technologiesCount = computed(() => {
  return props.competences.length > 0 ? new Set(props.competences.map(comp => comp.nom)).size : 25
})

// Méthodes
const getParticleStyle = (index) => {
  return {
    width: Math.random() * 3 + 1 + 'px',
    height: Math.random() * 3 + 1 + 'px',
    left: Math.random() * 100 + '%',
    top: Math.random() * 100 + '%',
    animationDelay: Math.random() * 5 + 's',
    animationDuration: Math.random() * 8 + 8 + 's'
  }
}

const formatTelephone = (telephone) => {
  // Format basique pour les numéros français
  if (telephone.startsWith('+33')) {
    return telephone.replace('+33', '0').replace(/(.{2})/g, '$1 ').trim()
  }
  return telephone
}
</script>

<style scoped>
.about-hero {
  position: relative;
  padding: 6rem 0 4rem;
  overflow: hidden;
}

.hero-background {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: -1;
}

.gradient-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, 
    rgba(59, 130, 246, 0.03) 0%,
    rgba(139, 92, 246, 0.03) 100%);
}

.particles-about {
  position: absolute;
  inset: 0;
  overflow: hidden;
}

.particle {
  position: absolute;
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  border-radius: 50%;
  opacity: 0.15;
  animation: float-particle linear infinite;
}

@keyframes float-particle {
  0% {
    transform: translateY(0) scale(1);
    opacity: 0;
  }
  10% {
    opacity: 0.15;
  }
  90% {
    opacity: 0.15;
  }
  100% {
    transform: translateY(-100vh) scale(0.5);
    opacity: 0;
  }
}

.container {
  max-width: 1400px;
  margin: 0 auto;
  padding: 0 clamp(1.5rem, 4vw, 3rem);
}

.hero-content {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 4rem;
  align-items: center;
}

.hero-text {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 1rem;
  background: rgba(34, 197, 94, 0.1);
  color: #16a34a;
  border-radius: 50px;
  font-size: 0.875rem;
  font-weight: 600;
  width: fit-content;
}

.badge-dot {
  width: 8px;
  height: 8px;
  background: #16a34a;
  border-radius: 50%;
  animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.5; }
}

.hero-title {
  font-size: clamp(2.5rem, 5vw, 3.5rem);
  font-weight: 800;
  line-height: 1.1;
  color: #1f2937;
  background: linear-gradient(135deg, #1f2937, #3b82f6);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
}

.hero-description {
  font-size: 1.25rem;
  line-height: 1.7;
  color: #6b7280;
}

/* Informations supplémentaires */
.additional-info {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
  margin-top: 0.5rem;
}

.info-item {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  font-size: 0.95rem;
  color: #6b7280;
}

.info-item a {
  color: inherit;
  text-decoration: none;
  transition: color 0.3s ease;
}

.info-item a:hover {
  color: #3b82f6;
}

.info-item svg {
  flex-shrink: 0;
  color: #9ca3af;
}

/* Statistiques rapides */
.quick-stats {
  display: flex;
  gap: 2rem;
  margin-top: 1rem;
  padding: 1.5rem;
  background: rgba(255, 255, 255, 0.8);
  border-radius: 12px;
  backdrop-filter: blur(10px);
  border: 1px solid rgba(229, 231, 235, 0.8);
}

.stat {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.25rem;
}

.stat-number {
  font-size: 1.5rem;
  font-weight: 700;
  color: #3b82f6;
}

.stat-label {
  font-size: 0.875rem;
  color: #6b7280;
  font-weight: 500;
}

.hero-actions {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
  margin-top: 0.5rem;
}

.social-links {
  display: flex;
  gap: 1rem;
  margin-top: 1rem;
}

.social-link {
  width: 44px;
  height: 44px;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 2px solid #e5e7eb;
  border-radius: 50%;
  color: #6b7280;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  text-decoration: none;
}

.social-link:hover {
  border-color: #3b82f6;
  color: #3b82f6;
  transform: translateY(-3px);
  box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
}

/* Image section */
.hero-image {
  display: flex;
  justify-content: center;
}

.image-container {
  position: relative;
  width: 100%;
  max-width: 400px;
}

.profile-image {
  width: 100%;
  height: 400px;
  object-fit: cover;
  border-radius: 20px;
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
}

.profile-placeholder {
  width: 100%;
  height: 400px;
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  border-radius: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
}

.placeholder-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 1rem;
  text-align: center;
}

/* Badge de disponibilité sur l'image */
.availability-badge {
  position: absolute;
  bottom: 1rem;
  left: 50%;
  transform: translateX(-50%);
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 1rem;
  background: white;
  border-radius: 50px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  font-size: 0.875rem;
  font-weight: 600;
  color: #1f2937;
}

.availability-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  animation: pulse 2s ease-in-out infinite;
}

.availability-dot.available {
  background: #10b981;
}

.availability-dot.busy {
  background: #ef4444;
}

/* Dark mode */
.dark-mode .about-hero .gradient-overlay {
  background: linear-gradient(135deg, 
    rgba(59, 130, 246, 0.05) 0%,
    rgba(139, 92, 246, 0.05) 100%);
}

.dark-mode .hero-title {
  background: linear-gradient(135deg, #f9fafb, #60a5fa);
  -webkit-background-clip: text;
  background-clip: text;
}

.dark-mode .hero-description,
.dark-mode .info-item {
  color: #d1d5db;
}

.dark-mode .quick-stats {
  background: rgba(31, 41, 55, 0.8);
  border-color: rgba(55, 65, 81, 0.8);
}

.dark-mode .stat-label {
  color: #d1d5db;
}

.dark-mode .social-link {
  border-color: #374151;
  color: #94a3b8;
}

.dark-mode .social-link:hover {
  border-color: #60a5fa;
  color: #60a5fa;
}

.dark-mode .availability-badge {
  background: #1f2937;
  color: #f9fafb;
}

/* Responsive */
@media (max-width: 1024px) {
  .hero-content {
    grid-template-columns: 1fr;
    gap: 3rem;
  }
  
  .hero-image {
    order: -1;
  }
  
  .image-container {
    max-width: 300px;
  }
  
  .profile-image,
  .profile-placeholder {
    height: 300px;
  }

  .quick-stats {
    justify-content: center;
  }
}

@media (max-width: 768px) {
  .about-hero {
    padding: 4rem 0 3rem;
  }
  
  .hero-actions {
    flex-direction: column;
  }
  
  .quick-stats {
    flex-direction: column;
    gap: 1rem;
    text-align: center;
  }

  .additional-info {
    align-items: center;
    text-align: center;
  }
}

@media (max-width: 480px) {
  .about-hero {
    padding: 3rem 0 2rem;
  }
  
  .hero-title {
    font-size: 2rem;
  }
  
  .hero-description {
    font-size: 1.125rem;
  }
  
  .profile-image,
  .profile-placeholder {
    height: 250px;
  }
}

/* Performance */
@media (prefers-reduced-motion: reduce) {
  .particle,
  .badge-dot,
  .availability-dot {
    animation: none;
  }
}
</style>