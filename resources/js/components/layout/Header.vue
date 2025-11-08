<template>
  <header :class="['header', { 'header-scrolled': scrolled }]">
    <!-- Fond animé flottant -->
    <div class="floating-background">
      <div class="floating-shape shape-1"></div>
      <div class="floating-shape shape-2"></div>
      <div class="floating-shape shape-3"></div>
      <div class="floating-shape shape-4"></div>
      <div class="floating-shape shape-5"></div>
    </div>
    
    <div class="container">
      <!-- Logo Cube -->
      <router-link to="/" class="logo">
        <div class="logo-cube">
          <div class="cube">
            <div class="face front">P</div>
            <div class="face back">F</div>
            <div class="face right">O</div>
            <div class="face left">R</div>
            <div class="face top">T</div>
            <div class="face bottom">.</div>
          </div>
        </div>
        <span class="logo-text">{{ nomSite }}</span>
      </router-link>

      <!-- Navigation Desktop -->
      <nav class="nav desktop-nav">
        <router-link
          v-for="lien in liens"
          :key="lien.path"
          :to="lien.path"
          class="nav-link"
        >
          {{ lien.nom }}
        </router-link>

        <button class="theme-toggle" @click="$emit('toggle-dark-mode')" aria-label="Changer de thème">
          <svg v-if="!isDarkMode" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
          </svg>
          <svg v-else xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="5"></circle>
            <line x1="12" y1="1" x2="12" y2="3"></line>
            <line x1="12" y1="21" x2="12" y2="23"></line>
            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
            <line x1="1" y1="12" x2="3" y2="12"></line>
            <line x1="21" y1="12" x2="23" y2="12"></line>
            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
          </svg>
        </button>
      </nav>

      <!-- Menu Toggle Mobile -->
      <button 
        class="menu-toggle" 
        @click="toggleMenu" 
        :class="{ 'menu-toggle-open': menuOuvert }" 
        aria-label="Menu"
      >
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>

    <!-- Navigation Mobile (en dehors du container pour éviter les problèmes de z-index) -->
    <nav :class="['mobile-nav', { 'mobile-nav-open': menuOuvert }]">
      <div class="mobile-nav-content">
        <router-link
          v-for="lien in liens"
          :key="lien.path"
          :to="lien.path"
          class="mobile-nav-link"
          @click="fermerMenu"
        >
          {{ lien.nom }}
        </router-link>

        <button class="mobile-theme-toggle" @click="toggleThemeMobile" aria-label="Changer de thème">
          <svg v-if="!isDarkMode" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
          </svg>
          <svg v-else xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="5"></circle>
            <line x1="12" y1="1" x2="12" y2="3"></line>
            <line x1="12" y1="21" x2="12" y2="23"></line>
            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
            <line x1="1" y1="12" x2="3" y2="12"></line>
            <line x1="21" y1="12" x2="23" y2="12"></line>
            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
          </svg>
          <span>{{ isDarkMode ? 'Mode clair' : 'Mode sombre' }}</span>
        </button>
      </div>
    </nav>

    <!-- Overlay pour mobile -->
    <div 
      class="mobile-overlay" 
      :class="{ 'mobile-overlay-open': menuOuvert }" 
      @click="fermerMenu"
    ></div>
  </header>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const props = defineProps({
  isDarkMode: {
    type: Boolean,
    required: true
  }
})

const emit = defineEmits(['toggle-dark-mode'])

const scrolled = ref(false)
const menuOuvert = ref(false)
const nomSite = ref('Portfolio')

const liens = [
  { nom: 'Accueil', path: '/' },
  { nom: 'Projets', path: '/projets' },
  { nom: 'À Propos', path: '/a-propos' },
  { nom: 'Blog', path: '/blog' },
  { nom: 'Contact', path: '/contact' }
]

const handleScroll = () => {
  scrolled.value = window.scrollY > 50
}

const toggleMenu = () => {
  menuOuvert.value = !menuOuvert.value
  // Bloquer le scroll du body quand le menu est ouvert
  if (menuOuvert.value) {
    document.body.style.overflow = 'hidden'
  } else {
    document.body.style.overflow = ''
  }
}

const fermerMenu = () => {
  menuOuvert.value = false
  document.body.style.overflow = ''
}

const toggleThemeMobile = () => {
  emit('toggle-dark-mode')
  fermerMenu()
}

// Fermer le menu avec la touche Echap
const handleEscape = (event) => {
  if (event.key === 'Escape' && menuOuvert.value) {
    fermerMenu()
  }
}

onMounted(() => {
  window.addEventListener('scroll', handleScroll)
  document.addEventListener('keydown', handleEscape)
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
  document.removeEventListener('keydown', handleEscape)
  document.body.style.overflow = ''
})
</script>

<style scoped>
.header {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 1000;
  background: rgba(255, 255, 255, 0.8);
  backdrop-filter: blur(10px);
  border-bottom: 1px solid rgba(0, 0, 0, 0.05);
  transition: all 0.3s;
  overflow: visible;
}

.header-scrolled {
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

/* Fond animé flottant */
.floating-background {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: -1;
  pointer-events: none;
}

.floating-shape {
  position: absolute;
  border-radius: 50%;
  background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(139, 92, 246, 0.1));
  filter: blur(20px);
  animation: float 6s ease-in-out infinite;
}

.shape-1 {
  width: 80px;
  height: 80px;
  top: 20%;
  left: 10%;
  animation-delay: 0s;
}

.shape-2 {
  width: 120px;
  height: 120px;
  top: 60%;
  right: 15%;
  animation-delay: 1s;
}

.shape-3 {
  width: 60px;
  height: 60px;
  bottom: 30%;
  left: 20%;
  animation-delay: 2s;
}

.shape-4 {
  width: 100px;
  height: 100px;
  top: 40%;
  right: 25%;
  animation-delay: 3s;
}

.shape-5 {
  width: 70px;
  height: 70px;
  bottom: 20%;
  right: 10%;
  animation-delay: 4s;
}

@keyframes float {
  0%, 100% {
    transform: translateY(0px) rotate(0deg) scale(1);
  }
  33% {
    transform: translateY(-20px) rotate(120deg) scale(1.1);
  }
  66% {
    transform: translateY(10px) rotate(240deg) scale(0.9);
  }
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 1rem 1.5rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
  position: relative;
  z-index: 1002;
}

/* Logo avec Cube */
.logo {
  display: flex;
  align-items: center;
  gap: 12px;
  font-size: 1.5rem;
  font-weight: 700;
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  background-clip: text;
  color: transparent;
  text-decoration: none;
  transition: all 0.3s;
  position: relative;
  z-index: 1003;
}

.logo:hover {
  opacity: 0.8;
  transform: scale(1.05);
}

/* Container du cube */
.logo-cube {
  display: flex;
  align-items: center;
  justify-content: center;
}

/* Cube 3D */
.cube {
  width: 35px;
  height: 35px;
  position: relative;
  transform-style: preserve-3d;
  transform: rotateX(25deg) rotateY(-25deg);
  transition: all 0.6s ease;
  animation: cube-rotate 8s infinite linear;
}

.logo:hover .cube {
  animation-play-state: paused;
  transform: rotateX(0deg) rotateY(0deg) scale(1.1);
}

.face {
  position: absolute;
  width: 100%;
  height: 100%;
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  border: 2px solid rgba(255, 255, 255, 0.2);
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
  color: white;
  font-size: 0.8rem;
  border-radius: 4px;
}

.front  { transform: rotateY(0deg) translateZ(17.5px); }
.back   { transform: rotateY(180deg) translateZ(17.5px); }
.right  { transform: rotateY(90deg) translateZ(17.5px); }
.left   { transform: rotateY(-90deg) translateZ(17.5px); }
.top    { transform: rotateX(90deg) translateZ(17.5px); }
.bottom { transform: rotateX(-90deg) translateZ(17.5px); }

@keyframes cube-rotate {
  0% { transform: rotateX(25deg) rotateY(-25deg); }
  100% { transform: rotateX(25deg) rotateY(335deg); }
}

.logo-text {
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  background-clip: text;
  color: transparent;
}

/* ==================== */
/* NAVIGATION DESKTOP */
/* ==================== */
.desktop-nav {
  display: flex;
  align-items: center;
  gap: 2rem;
}

.nav-link {
  color: #4b5563;
  text-decoration: none;
  font-weight: 500;
  position: relative;
  transition: color 0.3s;
}

.nav-link::after {
  content: '';
  position: absolute;
  bottom: -4px;
  left: 0;
  width: 0;
  height: 2px;
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  transition: width 0.3s;
}

.nav-link:hover {
  color: #3b82f6;
}

.nav-link:hover::after,
.nav-link.router-link-active::after {
  width: 100%;
}

.theme-toggle {
  background: #f3f4f6;
  border: none;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s;
}

.theme-toggle:hover {
  background: #e5e7eb;
  transform: rotate(20deg);
}

/* ==================== */
/* MENU TOGGLE MOBILE */
/* ==================== */
.menu-toggle {
  display: none;
  flex-direction: column;
  gap: 4px;
  background: none;
  border: none;
  cursor: pointer;
  padding: 0.5rem;
  position: relative;
  z-index: 1003;
  transition: all 0.3s ease;
}

.menu-toggle span {
  width: 24px;
  height: 2px;
  background: #4b5563;
  transition: all 0.3s ease;
  transform-origin: center;
}

.menu-toggle-open span:nth-child(1) {
  transform: rotate(45deg) translate(6px, 6px);
}

.menu-toggle-open span:nth-child(2) {
  opacity: 0;
}

.menu-toggle-open span:nth-child(3) {
  transform: rotate(-45deg) translate(6px, -6px);
}

/* ==================== */
/* NAVIGATION MOBILE */
/* ==================== */
.mobile-nav {
  position: fixed;
  top: 0;
  left: -100%;
  width: 80%;
  max-width: 300px;
  height: 100vh;
  background: white;
  z-index: 1001;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 2px 0 20px rgba(0, 0, 0, 0.1);
  overflow-y: auto;
}

.mobile-nav-open {
  left: 0;
}

.mobile-nav-content {
  padding: 6rem 2rem 2rem;
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.mobile-nav-link {
  display: block;
  padding: 1rem 1.5rem;
  color: #4b5563;
  text-decoration: none;
  font-size: 1.1rem;
  font-weight: 500;
  border-radius: 12px;
  transition: all 0.3s ease;
  text-align: center;
}

.mobile-nav-link:hover {
  background: rgba(59, 130, 246, 0.1);
  color: #3b82f6;
  transform: translateX(10px);
}

.mobile-nav-link.router-link-active {
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  color: white;
}

.mobile-theme-toggle {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding: 1rem 1.5rem;
  background: #f3f4f6;
  border: none;
  border-radius: 12px;
  font-size: 1rem;
  font-weight: 500;
  color: #4b5563;
  cursor: pointer;
  transition: all 0.3s ease;
  margin-top: 2rem;
}

.mobile-theme-toggle:hover {
  background: #e5e7eb;
  transform: translateX(10px);
}

/* ==================== */
/* OVERLAY MOBILE */
/* ==================== */
.mobile-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  opacity: 0;
  visibility: hidden;
  transition: all 0.3s ease;
  z-index: 1000;
}

.mobile-overlay-open {
  opacity: 1;
  visibility: visible;
}

/* ==================== */
/* DARK MODE */
/* ==================== */
.dark-mode .header {
  background: rgba(15, 23, 42, 0.8);
  border-bottom-color: rgba(255, 255, 255, 0.05);
}

.dark-mode .nav-link {
  color: #cbd5e1;
}

.dark-mode .nav-link:hover {
  color: #60a5fa;
}

.dark-mode .theme-toggle {
  background: #1e293b;
  color: #cbd5e1;
}

.dark-mode .theme-toggle:hover {
  background: #334155;
}

.dark-mode .mobile-nav {
  background: #0f172a;
}

.dark-mode .mobile-nav-link {
  color: #cbd5e1;
}

.dark-mode .mobile-nav-link:hover {
  background: rgba(96, 165, 250, 0.1);
  color: #60a5fa;
}

.dark-mode .mobile-theme-toggle {
  background: #1e293b;
  color: #cbd5e1;
}

.dark-mode .mobile-theme-toggle:hover {
  background: #334155;
}

/* Adaptation des formes pour le dark mode */
.dark-mode .floating-shape {
  background: linear-gradient(135deg, rgba(96, 165, 250, 0.15), rgba(139, 92, 246, 0.1));
}

/* ==================== */
/* RESPONSIVE MOBILE */
/* ==================== */
@media (max-width: 768px) {
  .desktop-nav {
    display: none;
  }

  .menu-toggle {
    display: flex;
  }

  /* Ajustements du cube sur mobile */
  .cube {
    width: 30px;
    height: 30px;
  }

  .face {
    font-size: 0.7rem;
  }

  .front  { transform: rotateY(0deg) translateZ(15px); }
  .back   { transform: rotateY(180deg) translateZ(15px); }
  .right  { transform: rotateY(90deg) translateZ(15px); }
  .left   { transform: rotateY(-90deg) translateZ(15px); }
  .top    { transform: rotateX(90deg) translateZ(15px); }
  .bottom { transform: rotateX(-90deg) translateZ(15px); }

  /* Réduire l'animation sur mobile pour les performances */
  .floating-shape {
    animation-duration: 8s;
  }
  
  .shape-1, .shape-2, .shape-3, .shape-4, .shape-5 {
    width: 60px;
    height: 60px;
  }

  /* Cacher le texte du logo sur très petits écrans */
  @media (max-width: 480px) {
    .logo-text {
      display: none;
    }
    
    .logo {
      gap: 8px;
    }

    .mobile-nav {
      width: 85%;
    }

    .mobile-nav-content {
      padding: 5rem 1.5rem 1.5rem;
    }

    .mobile-nav-link {
      padding: 0.875rem 1.25rem;
      font-size: 1rem;
    }
  }
}

/* Performance optimizations */
@media (prefers-reduced-motion: reduce) {
  .cube,
  .floating-shape,
  .nav-link,
  .theme-toggle {
    animation: none;
    transition: none;
  }
  
  .logo:hover .cube {
    transform: none;
  }
}
</style>