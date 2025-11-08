<!-- components/sections/ServicesSection.vue -->
<template>
  <section class="services-section">
    <div class="services-background">
      <div class="gradient-overlay"></div>
      <div class="particles-services" v-if="showParticles">
        <div v-for="i in particleCount" :key="i" class="particle" :style="getParticleStyle(i)"></div>
      </div>
    </div>
    
    <div class="container">
      <div class="section-header" v-if="showHeader">
        <span class="section-badge">{{ badge }}</span>
        <h2 class="section-title">{{ title }}</h2>
        <p class="section-description" v-if="description">{{ description }}</p>
      </div>

      <div class="services-grid">
        <ServiceCard 
          v-for="(service, index) in services" 
          :key="service.id"
          :service="service"
          :index="index"
        />
      </div>

     <div class="section-footer" v-if="showViewAll">
  <Button 
    tag="router-link" 
    to="/services" 
    variant="outline" 
    size="large"
    class="view-all-btn"
  >
    <span class="btn-content">
      <span class="btn-text">{{ viewAllText }}</span>
      <span class="btn-arrow">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <line x1="5" y1="12" x2="19" y2="12"></line>
          <polyline points="12 5 19 12 12 19"></polyline>
        </svg>
      </span>
    </span>
    <span class="btn-hover-bg"></span>
  </Button>
</div>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue'
import ServiceCard from '../cards/ServiceCard.vue'
import Button from '../ui/Button.vue'

defineProps({
  services: {
    type: Array,
    required: true
  },
  badge: {
    type: String,
    default: 'Services'
  },
  title: {
    type: String,
    default: 'Ce que je propose'
  },
  description: {
    type: String,
    default: 'Des solutions sur mesure pour vos projets digitaux'
  },
  showHeader: {
    type: Boolean,
    default: true
  },
  showViewAll: {
    type: Boolean,
    default: false
  },
  viewAllText: {
    type: String,
    default: 'Voir tous les services'
  },
  showParticles: {
    type: Boolean,
    default: true
  },
  particleCount: {
    type: Number,
    default: 25
  }
})

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
</script>

<style scoped>
.services-section {
  position: relative;
  padding: 5rem 0;
  overflow: hidden;
}

.services-background {
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

.particles-services {
  position: absolute;
  inset: 0;
  overflow: hidden;
}

.particle {
  position: absolute;
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  border-radius: 50%;
  opacity: 0.2;
  animation: float-particle linear infinite;
}

@keyframes float-particle {
  0% {
    transform: translateY(0) scale(1);
    opacity: 0;
  }
  10% {
    opacity: 0.2;
  }
  90% {
    opacity: 0.2;
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
  margin-bottom: 1rem;
}

.section-description {
  font-size: 1.125rem;
  color: #6b7280;
  max-width: 600px;
  margin: 0 auto;
}

.services-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
  gap: 2.5rem;
}

.section-footer {
  text-align: center;
  margin-top: 4rem;
}

/* Dark mode */
.dark-mode .services-section {
  background: transparent;
}

.dark-mode .section-title {
  color: #f9fafb;
}

.dark-mode .section-description {
  color: #d1d5db;
}

.dark-mode .gradient-overlay {
  background: linear-gradient(135deg, 
    rgba(59, 130, 246, 0.02) 0%,
    rgba(139, 92, 246, 0.02) 100%);
}

/* Responsive */
@media (max-width: 1024px) {
  .services-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 2rem;
  }
}

@media (max-width: 768px) {
  .services-section {
    padding: 4rem 0;
  }

  .section-header {
    margin-bottom: 3rem;
  }

  .services-grid {
    grid-template-columns: 1fr;
    gap: 1.5rem;
  }

  .section-footer {
    margin-top: 3rem;
  }
}

@media (max-width: 480px) {
  .services-section {
    padding: 3rem 0;
  }

  .services-grid {
    gap: 1.25rem;
  }
}

/* Performance */
@media (prefers-reduced-motion: reduce) {
  .particle {
    animation: none !important;
  }
}

/* Styles pour le bouton professionnel */
.view-all-btn {
  position: relative;
  overflow: hidden;
  border: 2px solid #3b82f6;
  background: transparent;
  color: #3b82f6;
  padding: 1rem 2.5rem;
  font-weight: 600;
  border-radius: 12px;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-width: 200px;
}

.view-all-btn:hover {
  background: #3b82f6;
  color: white;
  transform: translateY(-3px);
  box-shadow: 
    0 12px 40px rgba(59, 130, 246, 0.25),
    0 4px 12px rgba(59, 130, 246, 0.15);
  border-color: #3b82f6;
}

.btn-content {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  position: relative;
  z-index: 2;
  transition: transform 0.3s ease;
}

.view-all-btn:hover .btn-content {
  transform: translateX(2px);
}

.btn-text {
  font-size: 1rem;
  font-weight: 600;
  letter-spacing: 0.025em;
  white-space: nowrap;
}

.btn-arrow {
  display: flex;
  align-items: center;
  transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.view-all-btn:hover .btn-arrow {
  transform: translateX(3px);
}

.btn-hover-bg {
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, 
    transparent, 
    rgba(255, 255, 255, 0.2), 
    transparent);
  transition: left 0.6s ease;
  z-index: 1;
}

.view-all-btn:hover .btn-hover-bg {
  left: 100%;
}

/* Effet de pulse subtil */
.view-all-btn::before {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  width: 0;
  height: 0;
  background: radial-gradient(circle, rgba(59, 130, 246, 0.15) 0%, transparent 70%);
  border-radius: 50%;
  transform: translate(-50%, -50%);
  transition: all 0.5s ease;
  opacity: 0;
}

.view-all-btn:hover::before {
  width: 120px;
  height: 120px;
  opacity: 1;
}

/* Dark mode */
.dark-mode .view-all-btn {
  border-color: #60a5fa;
  color: #60a5fa;
}

.dark-mode .view-all-btn:hover {
  background: #60a5fa;
  color: #0f172a;
  box-shadow: 
    0 12px 40px rgba(96, 165, 250, 0.25),
    0 4px 12px rgba(96, 165, 250, 0.15);
  border-color: #60a5fa;
}

.dark-mode .btn-hover-bg {
  background: linear-gradient(90deg, 
    transparent, 
    rgba(255, 255, 255, 0.1), 
    transparent);
}

/* Animation d'apparition */
.view-all-btn {
  animation: btnAppear 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
  animation-delay: 0.3s;
  opacity: 0;
  transform: translateY(10px);
}

@keyframes btnAppear {
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Responsive */
@media (max-width: 768px) {
  .view-all-btn {
    padding: 0.875rem 2rem;
    min-width: 180px;
  }
  
  .btn-text {
    font-size: 0.9rem;
  }
  
  .btn-arrow svg {
    width: 16px;
    height: 16px;
  }
}

@media (max-width: 480px) {
  .view-all-btn {
    padding: 0.75rem 1.5rem;
    min-width: 160px;
    width: 100%;
    max-width: 280px;
  }
}

/* Performance */
@media (prefers-reduced-motion: reduce) {
  .view-all-btn,
  .btn-content,
  .btn-arrow,
  .btn-hover-bg {
    animation: none !important;
    transition: none !important;
  }
  
  .view-all-btn {
    opacity: 1;
    transform: none;
  }
}
</style>