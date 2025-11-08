<!-- components/cards/ServiceCard.vue -->
<template>
  <div 
    class="service-card"
    :style="{ '--delay': (index * 0.1) + 's' }"
    @mouseenter="isHovered = true"
    @mouseleave="isHovered = false"
  >
    <div class="service-icon-wrapper">
      <div class="service-icon-background"></div>
      <component :is="getIconComponent(service.titre)" class="service-icon" />
      <div class="icon-glow" :class="{ 'icon-glow-active': isHovered }"></div>
    </div>
    
    <h3 class="service-title">{{ service.titre }}</h3>
    <p class="service-description">{{ service.description_courte || service.description }}</p>
    
    <div class="service-features" v-if="service.fonctionnalites && service.fonctionnalites.length > 0">
      <div 
        v-for="(feature, featureIndex) in service.fonctionnalites.slice(0, 3)" 
        :key="featureIndex"
        class="service-feature"
        :style="{ '--feature-delay': (featureIndex * 0.1) + 's' }"
      >
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <polyline points="20 6 9 17 4 12"></polyline>
        </svg>
        <span>{{ feature }}</span>
      </div>
    </div>
    
    <router-link 
      v-if="showLink"
      :to="`/services/${service.slug}`" 
      class="service-link"
    >
      {{ linkText }}
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <line x1="5" y1="12" x2="19" y2="12"></line>
        <polyline points="12 5 19 12 12 19"></polyline>
      </svg>
    </router-link>

    <div class="service-particles">
      <div v-for="i in 4" :key="i" class="service-particle" :style="getParticleStyle(i)"></div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

// Icônes SVG professionnelles
const WebDevIcon = {
  template: `
    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
      <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
      <path d="M2 17l10 5 10-5"></path>
      <path d="M2 12l10 5 10-5"></path>
    </svg>
  `
}

const MobileIcon = {
  template: `
    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
      <rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect>
      <line x1="12" y1="18" x2="12" y2="18"></line>
    </svg>
  `
}

const DesignIcon = {
  template: `
    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
      <polygon points="12 2 22 8.5 22 15.5 12 22 2 15.5 2 8.5 12 2"></polygon>
      <line x1="12" y1="22" x2="12" y2="15.5"></line>
      <polyline points="22 8.5 12 15.5 2 8.5"></polyline>
      <polyline points="2 15.5 12 8.5 22 15.5"></polyline>
      <line x1="12" y1="2" x2="12" y2="8.5"></line>
    </svg>
  `
}

const ConsultingIcon = {
  template: `
    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
      <circle cx="12" cy="12" r="10"></circle>
      <line x1="12" y1="16" x2="12" y2="12"></line>
      <line x1="12" y1="8" x2="12" y2="8"></line>
    </svg>
  `
}

const MaintenanceIcon = {
  template: `
    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
      <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
    </svg>
  `
}

const DefaultIcon = {
  template: `
    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
      <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
      <path d="M2 17l10 5 10-5"></path>
      <path d="M2 12l10 5 10-5"></path>
    </svg>
  `
}

const props = defineProps({
  service: {
    type: Object,
    required: true
  },
  index: {
    type: Number,
    default: 0
  },
  showLink: {
    type: Boolean,
    default: true
  },
  linkText: {
    type: String,
    default: 'En savoir plus'
  }
})

const isHovered = ref(false)

// Mapping des icônes basé sur le titre du service
const iconMapping = {
  'développement': WebDevIcon,
  'web': WebDevIcon,
  'site': WebDevIcon,
  'application': WebDevIcon,
  'mobile': MobileIcon,
  'app': MobileIcon,
  'design': DesignIcon,
  'ui': DesignIcon,
  'ux': DesignIcon,
  'consulting': ConsultingIcon,
  'conseil': ConsultingIcon,
  'maintenance': MaintenanceIcon,
  'support': MaintenanceIcon,
  'formation': ConsultingIcon
}

const getIconComponent = (titre) => {
  const titreLower = titre.toLowerCase()
  for (const [key, icon] of Object.entries(iconMapping)) {
    if (titreLower.includes(key)) {
      return icon
    }
  }
  return DefaultIcon
}

const getParticleStyle = (index) => {
  return {
    left: Math.random() * 80 + 10 + '%',
    top: Math.random() * 80 + 10 + '%',
    animationDelay: Math.random() * 2 + 's',
    animationDuration: Math.random() * 3 + 2 + 's'
  }
}
</script>

<style scoped>
.service-card {
  position: relative;
  padding: 2.5rem;
  background: rgba(255, 255, 255, 0.8);
  backdrop-filter: blur(15px);
  border: 1px solid rgba(255, 255, 255, 0.3);
  border-radius: 20px;
  transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
  overflow: hidden;
  opacity: 0;
  transform: translateY(30px) scale(0.95);
  animation: cardAppear 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
  animation-delay: var(--delay);
}

@keyframes cardAppear {
  to {
    opacity: 1;
    transform: translateY(0) scale(1);
  }
}

.service-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, 
    transparent, 
    rgba(59, 130, 246, 0.1), 
    transparent);
  transition: left 0.6s ease;
}

.service-card:hover {
  transform: translateY(-10px) scale(1.02);
  box-shadow: 
    0 25px 50px rgba(0, 0, 0, 0.15),
    0 0 0 1px rgba(59, 130, 246, 0.2);
  border-color: rgba(59, 130, 246, 0.4);
}

.service-card:hover::before {
  left: 100%;
}

/* Icon Wrapper */
.service-icon-wrapper {
  position: relative;
  margin-bottom: 1.5rem;
  display: inline-flex;
  align-items: center;
  justify-content: center;
}

.service-icon-background {
  position: absolute;
  width: 80px;
  height: 80px;
  background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(139, 92, 246, 0.1));
  border-radius: 20px;
  transition: all 0.4s ease;
}

.service-card:hover .service-icon-background {
  transform: scale(1.1) rotate(5deg);
}

.service-icon {
  position: relative;
  z-index: 2;
  color: #3b82f6;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.service-card:hover .service-icon {
  color: #8b5cf6;
  transform: scale(1.1);
}

.icon-glow {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 0;
  height: 0;
  background: radial-gradient(circle, rgba(59, 130, 246, 0.3) 0%, transparent 70%);
  border-radius: 50%;
  transform: translate(-50%, -50%);
  transition: all 0.5s ease;
  opacity: 0;
}

.icon-glow-active {
  width: 100px;
  height: 100px;
  opacity: 1;
}

.service-title {
  font-size: 1.5rem;
  font-weight: 700;
  color: #1f2937;
  margin-bottom: 1rem;
  transition: color 0.3s ease;
}

.service-card:hover .service-title {
  color: #3b82f6;
}

.service-description {
  color: #6b7280;
  line-height: 1.7;
  margin-bottom: 1.5rem;
  transition: color 0.3s ease;
}

.service-card:hover .service-description {
  color: #4b5563;
}

/* Features */
.service-features {
  margin-bottom: 2rem;
}

.service-feature {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  margin-bottom: 0.5rem;
  font-size: 0.9rem;
  color: #6b7280;
  opacity: 0;
  transform: translateX(-10px);
  animation: featureAppear 0.5s ease forwards;
  animation-delay: calc(var(--feature-delay, 0) + 0.5s);
}

@keyframes featureAppear {
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

.service-feature svg {
  color: #10b981;
  flex-shrink: 0;
}

.service-link {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  color: #3b82f6;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
  padding: 0.5rem 0;
}

.service-link::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 0;
  height: 2px;
  background: linear-gradient(90deg, #3b82f6, #8b5cf6);
  transition: width 0.3s ease;
}

.service-link:hover {
  gap: 0.75rem;
  color: #8b5cf6;
}

.service-link:hover::after {
  width: 100%;
}

/* Particles */
.service-particles {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
  z-index: -1;
}

.service-particle {
  position: absolute;
  width: 4px;
  height: 4px;
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  border-radius: 50%;
  opacity: 0;
  animation: particleFloat ease-in-out infinite;
}

@keyframes particleFloat {
  0%, 100% {
    transform: translateY(0) rotate(0deg);
    opacity: 0;
  }
  20% {
    opacity: 0.3;
  }
  50% {
    transform: translateY(-15px) rotate(180deg);
    opacity: 0.4;
  }
  80% {
    opacity: 0.3;
  }
}

/* Dark mode */
.dark-mode .service-card {
  background: rgba(15, 23, 42, 0.8);
  border: 1px solid rgba(255, 255, 255, 0.1);
}

.dark-mode .service-title {
  color: #f9fafb;
}

.dark-mode .service-description {
  color: #d1d5db;
}

.dark-mode .service-feature {
  color: #9ca3af;
}

.dark-mode .service-card:hover .service-title {
  color: #60a5fa;
}

.dark-mode .service-card:hover .service-description {
  color: #cbd5e1;
}

.dark-mode .service-link {
  color: #60a5fa;
}

.dark-mode .service-link:hover {
  color: #93c5fd;
}

/* Responsive */
@media (max-width: 768px) {
  .service-card {
    padding: 2rem;
    animation-duration: 0.6s;
  }
  
  .service-icon-background {
    width: 70px;
    height: 70px;
  }
  
  .service-features {
    margin-bottom: 1.5rem;
  }
}

@media (max-width: 480px) {
  .service-card {
    padding: 1.5rem;
  }
  
  .service-icon-background {
    width: 60px;
    height: 60px;
  }
  
  .service-title {
    font-size: 1.25rem;
  }
}

/* Performance */
@media (prefers-reduced-motion: reduce) {
  .service-card,
  .service-icon,
  .service-icon-background,
  .service-feature,
  .service-particle {
    animation: none !important;
    transition: none !important;
  }
  
  .service-card {
    opacity: 1;
    transform: none;
  }
  
  .service-card:hover {
    transform: none;
  }
  
  .service-feature {
    opacity: 1;
    transform: none;
  }
}
</style>