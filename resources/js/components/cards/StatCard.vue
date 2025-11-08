<!-- components/cards/StatCard.vue -->
<template>
  <div class="stat-card" :class="{ 'stat-card-animated': animated }">
    <div class="stat-icon">
      <component :is="getIconComponent(stat.icon)" />
    </div>
    <div class="stat-number" :data-target="stat.value">
      {{ animated ? 0 : stat.value }}
    </div>
    <div class="stat-label">{{ stat.label }}</div>
    <div class="stat-glow"></div>
    <div class="stat-particles">
      <div v-for="i in 3" :key="i" class="stat-particle" :style="getParticleStyle(i)"></div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

// Import des icônes SVG
const ProjectIcon = {
  template: `
    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
      <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
      <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
    </svg>
  `
}

const ExperienceIcon = {
  template: `
    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
      <circle cx="12" cy="12" r="10"></circle>
      <polyline points="12 6 12 12 16 14"></polyline>
    </svg>
  `
}

const ClientIcon = {
  template: `
    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
      <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
      <circle cx="12" cy="7" r="4"></circle>
    </svg>
  `
}

const CoffeeIcon = {
  template: `
    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
      <path d="M18 8h1a4 4 0 0 1 0 8h-1"></path>
      <path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path>
      <line x1="6" y1="1" x2="6" y2="4"></line>
      <line x1="10" y1="1" x2="10" y2="4"></line>
      <line x1="14" y1="1" x2="14" y2="4"></line>
    </svg>
  `
}

const props = defineProps({
  stat: {
    type: Object,
    required: true
  },
  animated: {
    type: Boolean,
    default: true
  }
})

const isVisible = ref(false)

// Mapping des icônes
const iconComponents = {
  '📁': ProjectIcon,
  '⏱️': ExperienceIcon,
  '😊': ClientIcon,
  '☕': CoffeeIcon
}

const getIconComponent = (iconKey) => {
  return iconComponents[iconKey] || ProjectIcon
}

const getParticleStyle = (index) => {
  return {
    width: Math.random() * 4 + 1 + 'px',
    height: Math.random() * 4 + 1 + 'px',
    left: Math.random() * 80 + 10 + '%',
    top: Math.random() * 80 + 10 + '%',
    animationDelay: Math.random() * 3 + 's',
    animationDuration: Math.random() * 4 + 3 + 's'
  }
}

onMounted(() => {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        isVisible.value = true
        observer.unobserve(entry.target)
      }
    })
  }, { threshold: 0.3 })

  observer.observe(document.querySelector('.stat-card'))
})
</script>

<style scoped>
.stat-card {
  position: relative;
  text-align: center;
  padding: 2rem 1.5rem;
  background: rgba(255, 255, 255, 0.8);
  backdrop-filter: blur(15px);
  border: 1px solid rgba(255, 255, 255, 0.3);
  border-radius: 16px;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  overflow: hidden;
  opacity: 0;
  transform: translateY(20px);
  animation: cardAppear 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
  min-height: 180px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.stat-card-animated {
  animation-delay: calc(var(--card-index, 0) * 0.1s);
}

@keyframes cardAppear {
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.stat-card::before {
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

.stat-card:hover {
  transform: translateY(-6px) scale(1.02);
  box-shadow: 
    0 15px 30px rgba(0, 0, 0, 0.12),
    0 0 0 1px rgba(59, 130, 246, 0.15);
  border-color: rgba(59, 130, 246, 0.3);
}

.stat-card:hover::before {
  left: 100%;
}

/* Particules animées dans le fond */
.stat-particles {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
  z-index: -1;
}

.stat-particle {
  position: absolute;
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  border-radius: 50%;
  opacity: 0;
  animation: particleFloat ease-in-out infinite;
}

@keyframes particleFloat {
  0%, 100% {
    transform: translateY(0) rotate(0deg) scale(1);
    opacity: 0;
  }
  20% {
    opacity: 0.3;
  }
  50% {
    transform: translateY(-15px) rotate(180deg) scale(1.1);
    opacity: 0.4;
  }
  80% {
    opacity: 0.3;
  }
}

.stat-glow {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(135deg, 
    rgba(59, 130, 246, 0.06), 
    rgba(139, 92, 246, 0.06));
  opacity: 0;
  transition: opacity 0.3s ease;
  border-radius: 16px;
}

.stat-card:hover .stat-glow {
  opacity: 1;
}

.stat-card:hover .stat-particle {
  animation-duration: calc(var(--animation-duration) * 0.7);
}

.stat-icon {
  margin-bottom: 1rem;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #3b82f6;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.stat-card:hover .stat-icon {
  transform: scale(1.05);
  color: #8b5cf6;
}

.stat-number {
  font-size: 2.5rem;
  font-weight: 800;
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  background-clip: text;
  -webkit-background-clip: text;
  color: transparent;
  margin-bottom: 0.5rem;
  line-height: 1;
  position: relative;
}

.stat-number::after {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 0;
  height: 2px;
  background: linear-gradient(90deg, #3b82f6, #8b5cf6);
  transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.stat-card:hover .stat-number::after {
  width: 100%;
}

.stat-label {
  font-size: 0.9rem;
  color: #6b7280;
  font-weight: 500;
  line-height: 1.3;
  transition: color 0.3s ease;
}

.stat-card:hover .stat-label {
  color: #3b82f6;
}

/* Dark mode */
.dark-mode .stat-card {
  background: rgba(15, 23, 42, 0.7);
  border: 1px solid rgba(255, 255, 255, 0.1);
}

.dark-mode .stat-card:hover {
  border-color: rgba(96, 165, 250, 0.3);
  box-shadow: 
    0 15px 30px rgba(0, 0, 0, 0.2),
    0 0 0 1px rgba(96, 165, 250, 0.15);
}

.dark-mode .stat-label {
  color: #d1d5db;
}

.dark-mode .stat-card:hover .stat-label {
  color: #60a5fa;
}

/* Animation du compteur */
@keyframes countUp {
  from {
    transform: scale(0.9);
    opacity: 0;
  }
  to {
    transform: scale(1);
    opacity: 1;
  }
}

.stat-number.animating {
  animation: countUp 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Responsive */
@media (max-width: 1024px) {
  .stat-card {
    padding: 1.75rem 1.25rem;
    min-height: 160px;
  }
}

@media (max-width: 768px) {
  .stat-card {
    padding: 1.5rem 1rem;
    min-height: 150px;
    animation-duration: 0.5s;
  }
  
  .stat-icon {
    margin-bottom: 0.75rem;
  }
  
  .stat-number {
    font-size: 2.25rem;
  }
  
  .stat-label {
    font-size: 0.85rem;
  }
  
  .stat-particles {
    display: none; /* Masquer les particules sur mobile pour la performance */
  }
}

@media (max-width: 480px) {
  .stat-card {
    padding: 1.25rem 0.75rem;
    min-height: 140px;
  }
  
  .stat-number {
    font-size: 2rem;
  }
  
  .stat-label {
    font-size: 0.8rem;
  }
}

/* Performance */
@media (prefers-reduced-motion: reduce) {
  .stat-card,
  .stat-icon,
  .stat-number::after,
  .stat-particle {
    animation: none !important;
    transition: none !important;
  }
  
  .stat-card {
    opacity: 1;
    transform: none;
  }
  
  .stat-card:hover {
    transform: none;
  }
  
  .stat-particles {
    display: none;
  }
}
</style>