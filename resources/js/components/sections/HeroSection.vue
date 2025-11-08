<!-- components/sections/HeroSection.vue -->
<template>
  <section class="hero-section" ref="heroRef">
    <div class="hero-background">
      <div class="gradient-overlay"></div>
      <div class="particles-hero" v-if="showParticles">
        <div v-for="i in particleCount" :key="i" class="particle" :style="getParticleStyle(i)"></div>
      </div>
    </div>

    <div class="container">
      <div class="hero-content">
        <!-- Avatar 3D - À GAUCHE -->
        <div class="avatar-3d" @mouseenter="isAvatarHovered = true" @mouseleave="isAvatarHovered = false">
          <div class="avatar-wrapper" :class="{ 'avatar-hover': isAvatarHovered }">
            <img 
              v-if="infosPersonnelles?.photo_profil" 
              :src="infosPersonnelles.photo_profil" 
              :alt="infosPersonnelles.nom_complet"
              class="avatar-image"
            />
            <div v-else class="avatar-placeholder">
              <svg width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
              </svg>
            </div>
            <div class="avatar-ring"></div>
            <div class="avatar-pulse"></div>
          </div>
          
          <!-- Badge de disponibilité dynamique -->
          <div class="status-badge" v-if="infosPersonnelles?.disponible_freelance !== null">
            <span class="status-dot" :class="infosPersonnelles.disponible_freelance ? 'status-available' : 'status-busy'"></span>
            <span class="status-text">
              {{ infosPersonnelles.disponible_freelance ? 'Disponible' : 'Non disponible' }}
            </span>
          </div>
        </div>

        <!-- Intro animée - À DROITE -->
        <div class="hero-text">
          <!-- Salutation -->
          <div class="greeting">
            <span class="greeting-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
              </svg>
            </span>
            <span class="greeting-text">{{ greeting }}</span>
          </div>
          
          <!-- Nom et prénom -->
          <h1 class="hero-title">
            <span class="name-highlight">{{ infosPersonnelles?.prenom || 'Votre' }}</span>
            <span class="name-highlight">{{ infosPersonnelles?.nom || 'Nom' }}</span>
          </h1>
          
          <!-- Titre du poste avec animation typing -->
          <div class="typing-container" v-if="showTyping && infosPersonnelles?.titre_poste">
            <h2 class="hero-subtitle">
              <span class="typing-text">{{ currentRole }}</span>
              <span class="cursor">|</span>
            </h2>
          </div>

          <!-- Bio courte -->
          <p class="hero-description" v-if="infosPersonnelles?.bio_courte">
            {{ infosPersonnelles.bio_courte }}
          </p>

          <!-- Actions principales -->
          <div class="hero-actions">
            <Button 
              tag="router-link" 
              to="/projets" 
              variant="primary"
            >
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
              </svg>
              Voir mes projets
            </Button>
            
            <Button 
              v-if="infosPersonnelles?.cv_pdf"
              tag="a" 
              :href="infosPersonnelles.cv_pdf" 
              download
              variant="outline"
            >
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                <polyline points="7 10 12 15 17 10"></polyline>
                <line x1="12" y1="15" x2="12" y2="3"></line>
              </svg>
              Télécharger CV
            </Button>

            <Button 
              tag="router-link" 
              to="/contact" 
              variant="ghost"
              v-if="infosPersonnelles?.disponible_freelance"
            >
              Me contacter
            </Button>
          </div>

          <!-- Réseaux sociaux seulement -->
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
              <!-- Icônes spécifiques pour chaque réseau -->
              <svg v-if="reseau.nom === 'github'" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path>
              </svg>
              
              <svg v-else-if="reseau.nom === 'linkedin'" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                <rect x="2" y="9" width="4" height="12"></rect>
                <circle cx="4" cy="4" r="2"></circle>
              </svg>
              
              <svg v-else-if="reseau.nom === 'twitter'" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
              </svg>

              <svg v-else-if="reseau.nom === 'instagram'" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
              </svg>

              <svg v-else width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <path d="M12 16v-4m0-4h.01"></path>
              </svg>
            </a>
          </div>
        </div>
      </div>

      <!-- Scroll Indicator -->
      <div class="scroll-indicator-pro" @click="$emit('scroll-to-stats')" v-if="showScrollIndicator">
        <div class="scroll-text">
          <span>Explorer</span>
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 5v14M5 12l7 7 7-7"/>
          </svg>
        </div>
        <div class="scroll-line"></div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import Button from '../ui/Button.vue'

const props = defineProps({
  infosPersonnelles: {
    type: Object,
    default: () => ({})
  },
  greeting: {
    type: String,
    default: 'Bonjour, je suis'
  },
  showTyping: {
    type: Boolean,
    default: true
  },
  showParticles: {
    type: Boolean,
    default: true
  },
  particleCount: {
    type: Number,
    default: 30
  },
  showScrollIndicator: {
    type: Boolean,
    default: true
  }
})

defineEmits(['scroll-to-stats'])

// État local
const heroRef = ref(null)
const isAvatarHovered = ref(false)
const currentRole = ref('')

// Computed properties pour les données dynamiques
const reseauxSociauxFiltres = computed(() => {
  if (!props.infosPersonnelles) return []
  
  const reseaux = [
    { nom: 'github', url: props.infosPersonnelles.github },
    { nom: 'linkedin', url: props.infosPersonnelles.linkedin },
    { nom: 'twitter', url: props.infosPersonnelles.twitter },
    { nom: 'instagram', url: props.infosPersonnelles.instagram },
    { nom: 'facebook', url: props.infosPersonnelles.facebook },
    { nom: 'dribbble', url: props.infosPersonnelles.dribbble },
    { nom: 'behance', url: props.infosPersonnelles.behance },
    { nom: 'youtube', url: props.infosPersonnelles.youtube }
  ]
  
  return reseaux.filter(reseau => reseau.url)
})

// Animation typing pour le titre du poste
let roleIndex = 0
let charIndex = 0
let isDeleting = false
let typingTimeout = null

const typeRole = () => {
  const titrePoste = props.infosPersonnelles?.titre_poste
  if (!props.showTyping || !titrePoste) return
  
  if (isDeleting) {
    charIndex--
    currentRole.value = titrePoste.substring(0, charIndex)
    
    if (charIndex === 0) {
      isDeleting = false
      typingTimeout = setTimeout(typeRole, 1000)
      return
    }
  } else {
    charIndex++
    currentRole.value = titrePoste.substring(0, charIndex)
    
    if (charIndex === titrePoste.length) {
      isDeleting = true
      typingTimeout = setTimeout(typeRole, 2000)
      return
    }
  }
  
  typingTimeout = setTimeout(typeRole, isDeleting ? 50 : 100)
}

const getParticleStyle = (index) => {
  return {
    width: Math.random() * 4 + 2 + 'px',
    height: Math.random() * 4 + 2 + 'px',
    left: Math.random() * 100 + '%',
    top: Math.random() * 100 + '%',
    animationDelay: Math.random() * 5 + 's',
    animationDuration: Math.random() * 10 + 10 + 's'
  }
}

onMounted(() => {
  if (props.showTyping && props.infosPersonnelles?.titre_poste) {
    typeRole()
  }
})

onUnmounted(() => {
  if (typingTimeout) {
    clearTimeout(typingTimeout)
  }
})
</script>

<style scoped>
.hero-section {
  position: relative;
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 2rem 0 1rem;
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
    rgba(59, 130, 246, 0.05) 0%,
    rgba(139, 92, 246, 0.05) 100%);
}

.particles-hero {
  position: absolute;
  inset: 0;
  overflow: hidden;
}

.particle {
  position: absolute;
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  border-radius: 50%;
  opacity: 0.3;
  animation: float-particle linear infinite;
}

@keyframes float-particle {
  0% {
    transform: translateY(0) scale(1);
    opacity: 0;
  }
  10% {
    opacity: 0.3;
  }
  90% {
    opacity: 0.3;
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
  grid-template-columns: 1fr 1.5fr;
  gap: 10rem;
  align-items: center;
  width: 100%;
}

/* Avatar 3D - À GAUCHE */
.avatar-3d {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 1.5rem;
  justify-self: start;
}

.avatar-wrapper {
  position: relative;
  width: 380px;
  height: 380px;
  perspective: 1000px;
  transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.avatar-hover {
  transform: scale(1.05) rotateY(10deg);
}

.avatar-image,
.avatar-placeholder {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 50%;
  border: 6px solid white;
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
  position: relative;
  z-index: 2;
}

.avatar-placeholder {
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
}

.avatar-ring {
  position: absolute;
  inset: -12px;
  border-radius: 50%;
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  opacity: 0.15;
  animation: rotate 10s linear infinite;
}

.avatar-pulse {
  position: absolute;
  inset: -24px;
  border-radius: 50%;
  border: 2px solid #3b82f6;
  opacity: 0.2;
  animation: pulse 2s ease-in-out infinite;
}

@keyframes rotate {
  100% { transform: rotate(360deg); }
}

@keyframes pulse {
  0%, 100% {
    transform: scale(1);
    opacity: 0.2;
  }
  50% {
    transform: scale(1.1);
    opacity: 0.4;
  }
}

.status-badge {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.625rem 1.25rem;
  background: white;
  border-radius: 50px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  font-size: 0.875rem;
  font-weight: 600;
  color: #1f2937;
}

.status-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  animation: pulse-dot 2s ease-in-out infinite;
}

.status-available {
  background: #10b981;
}

.status-busy {
  background: #ef4444;
}

@keyframes pulse-dot {
  0%, 100% {
    transform: scale(1);
    opacity: 1;
  }
  50% {
    transform: scale(1.2);
    opacity: 0.7;
  }
}

/* Hero Text - À DROITE */
.hero-text {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
  justify-self: end;
}

.greeting {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.875rem;
  color: #6b7280;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  margin-bottom: -0.5rem;
}

.greeting-icon {
  display: flex;
  align-items: center;
  color: #3b82f6;
}

.greeting-text {
  font-size: inherit;
}

.hero-title {
  font-size: clamp(2.5rem, 6vw, 4.5rem);
  font-weight: 800;
  line-height: 1.1;
  color: #1f2937;
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
  margin-top: 0;
}

.name-highlight {
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  background-clip: text;
  -webkit-background-clip: text;
  color: transparent;
  display: inline-block;
}

.typing-container {
  min-height: 2.5rem;
  margin-top: -0.5rem;
}

.hero-subtitle {
  font-size: clamp(1.25rem, 3vw, 1.75rem);
  font-weight: 600;
  color: #6b7280;
  display: flex;
  align-items: center;
  gap: 4px;
}

.typing-text {
  display: inline-block;
  min-width: 250px;
}

.cursor {
  color: #3b82f6;
  animation: blink 1s step-end infinite;
}

@keyframes blink {
  50% { opacity: 0; }
}

.hero-description {
  font-size: 1.125rem;
  line-height: 1.7;
  color: #6b7280;
  max-width: 500px;
  margin-top: -0.5rem;
}

.hero-actions {
  display: flex;
  flex-wrap: wrap;
  gap: 1rem;
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

/* Scroll Indicator */
.scroll-indicator-pro {
  position: absolute;
  bottom: 2rem;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.5rem;
  cursor: pointer;
  transition: all 0.3s ease;
}

.scroll-indicator-pro:hover {
  transform: translateX(-50%) translateY(-5px);
}

.scroll-text {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.75rem;
  font-weight: 600;
  color: #6b7280;
  text-transform: uppercase;
  letter-spacing: 0.1em;
  transition: color 0.3s ease;
}

.scroll-indicator-pro:hover .scroll-text {
  color: #3b82f6;
}

.scroll-text svg {
  transition: transform 0.3s ease;
}

.scroll-indicator-pro:hover .scroll-text svg {
  transform: translateY(3px);
}

.scroll-line {
  width: 1px;
  height: 40px;
  background: linear-gradient(to bottom, #3b82f6, transparent);
  animation: scroll-line 2s ease-in-out infinite;
}

@keyframes scroll-line {
  0%, 100% {
    height: 40px;
    opacity: 1;
  }
  50% {
    height: 60px;
    opacity: 0.7;
  }
}

/* Dark mode */
.dark-mode .hero-title,
.dark-mode .status-badge {
  color: #f9fafb;
}

.dark-mode .greeting,
.dark-mode .hero-subtitle,
.dark-mode .hero-description,
.dark-mode .scroll-text {
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

.dark-mode .status-badge {
  background: #1f2937;
}

.dark-mode .avatar-image,
.dark-mode .avatar-placeholder {
  border-color: #1f2937;
}

.dark-mode .scroll-line {
  background: linear-gradient(to bottom, #60a5fa, transparent);
}

/* Responsive */
@media (max-width: 968px) {
  .hero-content {
    grid-template-columns: 1fr;
    gap: 3rem;
    text-align: center;
  }

  .avatar-3d {
    order: -1;
    justify-self: center;
  }

  .hero-text {
    order: 1;
    justify-self: center;
    align-items: center;
  }

  .avatar-wrapper {
    width: 280px;
    height: 280px;
  }

  .hero-actions,
  .social-links {
    justify-content: center;
  }
}

@media (max-width: 768px) {
  .hero-section {
    padding: 1rem 0 0.5rem;
    min-height: 95vh;
  }

  .scroll-indicator-pro {
    bottom: 1rem;
  }

  .hero-actions {
    flex-direction: column;
    width: 100%;
  }

  .greeting {
    font-size: 0.8rem;
  }

  .avatar-wrapper {
    width: 240px;
    height: 240px;
  }
}

@media (max-width: 480px) {
  .avatar-wrapper {
    width: 200px;
    height: 200px;
  }

  .typing-text {
    min-width: 200px;
  }

  .hero-title {
    font-size: clamp(2rem, 8vw, 3rem);
  }
}

/* Performance */
@media (prefers-reduced-motion: reduce) {
  .particle,
  .cursor,
  .scroll-line,
  .status-dot,
  .avatar-ring,
  .avatar-pulse {
    animation: none !important;
  }
}
</style>