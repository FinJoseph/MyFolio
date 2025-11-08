<template>
  <section class="cta-section">
    <div class="cta-background">
      <div class="gradient-overlay"></div>
      <div class="particles-cta" v-if="showParticles">
        <div v-for="i in particleCount" :key="i" class="particle" :style="getParticleStyle(i)"></div>
      </div>
    </div>
    
    <div class="container">
      <div class="cta-content">
        <h2 class="cta-title">{{ title }}</h2>
        <p class="cta-description">
          {{ message || description }}
        </p>
        <div class="cta-actions">
          <Button 
            tag="router-link" 
            :to="primaryLink" 
            variant="primary" 
            size="large"
            class="cta-btn primary"
          >
            <span class="btn-content">
              <span class="btn-text">{{ primaryText }}</span>
              <span class="btn-arrow">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                  <line x1="5" y1="12" x2="19" y2="12"></line>
                  <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
              </span>
            </span>
          </Button>

          <Button 
            v-if="showSecondary"
            tag="router-link" 
            :to="secondaryLink" 
            variant="outline-white" 
            size="large"
            class="cta-btn secondary"
          >
            {{ secondaryText }}
          </Button>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import Button from '../ui/Button.vue'

defineProps({
  title: {
    type: String,
    default: 'Un projet en tête ?'
  },
  description: {
    type: String,
    default: 'Discutons de votre projet et transformons vos idées en réalité'
  },
  message: {
    type: String,
    default: null
  },
  primaryText: {
    type: String,
    default: 'Démarrer un projet'
  },
  primaryLink: {
    type: String,
    default: '/contact'
  },
  secondaryText: {
    type: String,
    default: 'En savoir plus'
  },
  secondaryLink: {
    type: String,
    default: '/a-propos'
  },
  showSecondary: {
    type: Boolean,
    default: false
  },
  showParticles: {
    type: Boolean,
    default: true
  },
  particleCount: {
    type: Number,
    default: 15
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
.cta-section {
  position: relative;
  padding: 6rem 0;
  overflow: hidden;
}

.cta-background {
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
    rgba(139, 92, 246, 0.05) 50%,
    rgba(236, 72, 153, 0.03) 100%);
}

.particles-cta {
  position: absolute;
  inset: 0;
  overflow: hidden;
}

.particle {
  position: absolute;
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  border-radius: 50%;
  opacity: 0.1;
  animation: float-particle linear infinite;
}

@keyframes float-particle {
  0% {
    transform: translateY(0) scale(1);
    opacity: 0;
  }
  10% {
    opacity: 0.1;
  }
  90% {
    opacity: 0.1;
  }
  100% {
    transform: translateY(-100vh) scale(0.5);
    opacity: 0;
  }
}

.container {
  max-width: 900px;
  margin: 0 auto;
  padding: 0 clamp(1.5rem, 4vw, 3rem);
}

.cta-content {
  text-align: center;
  position: relative;
  z-index: 2;
}

.cta-title {
  font-size: clamp(2.5rem, 5vw, 3.5rem);
  font-weight: 800;
  color: #1f2937;
  margin-bottom: 1.5rem;
  line-height: 1.1;
  background: linear-gradient(135deg, #1f2937, #3b82f6);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
}

.cta-description {
  font-size: 1.25rem;
  color: #6b7280;
  margin-bottom: 3rem;
  line-height: 1.7;
  max-width: 600px;
  margin-left: auto;
  margin-right: auto;
}

.cta-actions {
  display: flex;
  justify-content: center;
  gap: 1.5rem;
  flex-wrap: wrap;
}

/* Styles pour les boutons CTA */
.cta-btn {
  position: relative;
  overflow: hidden;
  border-radius: 12px;
  font-weight: 600;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-width: 180px;
}

.cta-btn.primary {
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  color: white;
  border: none;
  padding: 1rem 2.5rem;
  box-shadow: 
    0 8px 30px rgba(59, 130, 246, 0.25),
    0 4px 12px rgba(59, 130, 246, 0.15);
}

.cta-btn.primary:hover {
  transform: translateY(-3px);
  box-shadow: 
    0 15px 40px rgba(59, 130, 246, 0.35),
    0 6px 20px rgba(59, 130, 246, 0.2);
}

.cta-btn.secondary {
  background: transparent;
  color: #3b82f6;
  border: 2px solid #3b82f6;
  padding: calc(1rem - 2px) 2.5rem;
}

.cta-btn.secondary:hover {
  background: #3b82f6;
  color: white;
  transform: translateY(-3px);
  box-shadow: 0 8px 25px rgba(59, 130, 246, 0.2);
}

.btn-content {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  position: relative;
  z-index: 2;
}

.btn-text {
  font-size: 1rem;
  font-weight: 600;
  letter-spacing: 0.025em;
}

.btn-arrow {
  display: flex;
  align-items: center;
  transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.cta-btn.primary:hover .btn-arrow {
  transform: translateX(3px);
}

/* Effet de hover pour le bouton primaire */
.cta-btn.primary::before {
  content: '';
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

.cta-btn.primary:hover::before {
  left: 100%;
}

/* Animation d'apparition */
.cta-content {
  opacity: 0;
  transform: translateY(30px);
  animation: ctaAppear 0.8s ease forwards;
}

@keyframes ctaAppear {
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Dark mode */
.dark-mode .cta-title {
  background: linear-gradient(135deg, #f9fafb, #60a5fa);
  -webkit-background-clip: text;
  background-clip: text;
}

.dark-mode .cta-description {
  color: #d1d5db;
}

.dark-mode .gradient-overlay {
  background: linear-gradient(135deg, 
    rgba(59, 130, 246, 0.08) 0%,
    rgba(139, 92, 246, 0.08) 50%,
    rgba(236, 72, 153, 0.05) 100%);
}

.dark-mode .cta-btn.secondary {
  color: #60a5fa;
  border-color: #60a5fa;
}

.dark-mode .cta-btn.secondary:hover {
  background: #60a5fa;
  color: #0f172a;
}

/* Responsive */
@media (max-width: 768px) {
  .cta-section {
    padding: 4rem 0;
  }

  .cta-actions {
    flex-direction: column;
    align-items: center;
    gap: 1rem;
  }

  .cta-btn {
    width: 100%;
    max-width: 280px;
  }

  .cta-description {
    font-size: 1.125rem;
    margin-bottom: 2.5rem;
  }
}

@media (max-width: 480px) {
  .cta-section {
    padding: 3rem 0;
  }

  .cta-title {
    font-size: 2rem;
  }

  .cta-description {
    font-size: 1rem;
  }
}

/* Performance */
@media (prefers-reduced-motion: reduce) {
  .particle,
  .cta-content,
  .cta-btn,
  .btn-arrow {
    animation: none !important;
    transition: none !important;
  }
  
  .cta-content {
    opacity: 1;
    transform: none;
  }
}
</style>