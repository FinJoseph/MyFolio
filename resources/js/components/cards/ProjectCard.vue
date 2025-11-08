<template>
  <div 
    class="project-card"
    :style="{ '--delay': (index * 0.1) + 's' }"
    @mouseenter="isHovered = true"
    @mouseleave="isHovered = false"
  >
    <router-link :to="`/projets/${projet.slug}`" class="project-link">
      <div class="project-image-wrapper">
        <img :src="projet.image" :alt="projet.titre" class="project-image" />
        <div class="project-overlay">
          <div class="overlay-content">
            <span class="project-view">Voir le projet</span>
            <div class="project-arrow">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
              </svg>
            </div>
          </div>
        </div>
        <div class="project-glow" :class="{ 'project-glow-active': isHovered }"></div>
      </div>
      
      <div class="project-content">
        <div class="project-header">
          <span class="project-category">{{ projet.categorie }}</span>
          <div class="project-status" v-if="projet.statut">
            <span class="status-badge" :class="projet.statut.toLowerCase()">
              {{ projet.statut }}
            </span>
          </div>
        </div>
        
        <h3 class="project-title">{{ projet.titre }}</h3>
        <p class="project-description">{{ projet.description }}</p>
        
        <div class="project-tech">
          <span 
            v-for="(tech, techIndex) in getTechs(projet.technologies)" 
            :key="tech"
            class="tech-badge"
            :style="{ '--tech-delay': (techIndex * 0.05) + 's' }"
          >
            {{ tech }}
          </span>
          <span v-if="projet.technologies && getTechs(projet.technologies).length > maxTechs" class="tech-more">
            +{{ getTechs(projet.technologies).length - maxTechs }}
          </span>
        </div>
        
        <div class="project-footer">
          <div class="project-meta" v-if="projet.date_creation">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="10"></circle>
              <polyline points="12 6 12 12 16 14"></polyline>
            </svg>
            <span>{{ formatDate(projet.date_creation) }}</span>
          </div>
          <div class="project-link-arrow">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <line x1="5" y1="12" x2="19" y2="12"></line>
              <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
          </div>
        </div>
      </div>
    </router-link>

    <div class="project-particles">
      <div v-for="i in 3" :key="i" class="project-particle" :style="getParticleStyle(i)"></div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const props = defineProps({
  projet: {
    type: Object,
    required: true
  },
  maxTechs: {
    type: Number,
    default: 3
  },
  index: {
    type: Number,
    default: 0
  }
})

const isHovered = ref(false)

const getTechs = (technologies) => {
  if (Array.isArray(technologies)) return technologies.slice(0, props.maxTechs)
  if (typeof technologies === 'string') {
    return technologies.split(',').map(t => t.trim()).slice(0, props.maxTechs)
  }
  return []
}

const formatDate = (dateString) => {
  const date = new Date(dateString)
  return date.toLocaleDateString('fr-FR', { 
    year: 'numeric', 
    month: 'short'
  })
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
.project-card {
  position: relative;
  background: rgba(255, 255, 255, 0.8);
  backdrop-filter: blur(15px);
  border: 1px solid rgba(255, 255, 255, 0.3);
  border-radius: 20px;
  overflow: hidden;
  transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
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

.project-card::before {
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
  z-index: 2;
}

.project-card:hover {
  transform: translateY(-10px) scale(1.02);
  box-shadow: 
    0 25px 50px rgba(0, 0, 0, 0.15),
    0 0 0 1px rgba(59, 130, 246, 0.2);
  border-color: rgba(59, 130, 246, 0.4);
}

.project-card:hover::before {
  left: 100%;
}

.project-link {
  text-decoration: none;
  color: inherit;
  display: block;
  position: relative;
}

/* Image Section */
.project-image-wrapper {
  position: relative;
  aspect-ratio: 16 / 10;
  overflow: hidden;
}

.project-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.project-card:hover .project-image {
  transform: scale(1.1);
}

.project-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(59, 130, 246, 0.95), rgba(139, 92, 246, 0.95));
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.project-card:hover .project-overlay {
  opacity: 1;
}

.overlay-content {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  color: white;
  font-weight: 600;
  font-size: 1.125rem;
  transform: translateY(20px);
  transition: transform 0.4s ease;
}

.project-card:hover .overlay-content {
  transform: translateY(0);
}

.project-arrow {
  transition: transform 0.3s ease;
}

.project-card:hover .project-arrow {
  transform: translateX(5px);
}

.project-glow {
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

.project-glow-active {
  width: 150px;
  height: 150px;
  opacity: 0.6;
}

/* Content Section */
.project-content {
  padding: 2rem;
  position: relative;
  z-index: 2;
}

.project-header {
  display: flex;
  justify-content: between;
  align-items: flex-start;
  margin-bottom: 1rem;
  gap: 1rem;
}

.project-category {
  display: inline-block;
  padding: 0.375rem 0.875rem;
  background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(139, 92, 246, 0.1));
  color: #3b82f6;
  border-radius: 50px;
  font-size: 0.75rem;
  font-weight: 600;
}

.status-badge {
  padding: 0.25rem 0.75rem;
  border-radius: 50px;
  font-size: 0.7rem;
  font-weight: 600;
}

.status-badge.complété {
  background: rgba(34, 197, 94, 0.1);
  color: #16a34a;
}

.status-badge.en-cours {
  background: rgba(59, 130, 246, 0.1);
  color: #3b82f6;
}

.status-badge.preview {
  background: rgba(245, 158, 11, 0.1);
  color: #d97706;
}

.project-title {
  font-size: 1.5rem;
  font-weight: 700;
  color: #1f2937;
  margin-bottom: 0.75rem;
  transition: color 0.3s ease;
  line-height: 1.3;
}

.project-card:hover .project-title {
  color: #3b82f6;
}

.project-description {
  color: #6b7280;
  line-height: 1.7;
  margin-bottom: 1.5rem;
  transition: color 0.3s ease;
}

.project-card:hover .project-description {
  color: #4b5563;
}

/* Technologies */
.project-tech {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
  margin-bottom: 1.5rem;
}

.tech-badge {
  padding: 0.375rem 0.875rem;
  background: rgba(59, 130, 246, 0.1);
  border: 1px solid rgba(59, 130, 246, 0.2);
  border-radius: 8px;
  font-size: 0.75rem;
  font-weight: 600;
  color: #3b82f6;
  opacity: 0;
  transform: translateY(10px);
  animation: techAppear 0.5s ease forwards;
  animation-delay: var(--tech-delay);
}

@keyframes techAppear {
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.tech-more {
  padding: 0.375rem 0.75rem;
  background: #f3f4f6;
  border-radius: 8px;
  font-size: 0.75rem;
  font-weight: 600;
  color: #6b7280;
}

/* Footer */
.project-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-top: 1rem;
  border-top: 1px solid #f3f4f6;
}

.project-meta {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.875rem;
  color: #6b7280;
}

.project-link-arrow {
  color: #3b82f6;
  transition: transform 0.3s ease;
}

.project-card:hover .project-link-arrow {
  transform: translateX(3px);
}

/* Particles */
.project-particles {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
  z-index: -1;
}

.project-particle {
  position: absolute;
  width: 3px;
  height: 3px;
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
.dark-mode .project-card {
  background: rgba(15, 23, 42, 0.8);
  border: 1px solid rgba(255, 255, 255, 0.1);
}

.dark-mode .project-title {
  color: #f9fafb;
}

.dark-mode .project-description {
  color: #d1d5db;
}

.dark-mode .tech-badge {
  background: rgba(59, 130, 246, 0.15);
  border-color: rgba(59, 130, 246, 0.3);
  color: #93c5fd;
}

.dark-mode .tech-more {
  background: #374151;
  color: #d1d5db;
}

.dark-mode .project-footer {
  border-top-color: #374151;
}

.dark-mode .project-meta {
  color: #9ca3af;
}

.dark-mode .project-card:hover .project-title {
  color: #60a5fa;
}

.dark-mode .project-card:hover .project-description {
  color: #cbd5e1;
}

/* Responsive */
@media (max-width: 768px) {
  .project-content {
    padding: 1.5rem;
  }
  
  .project-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 0.5rem;
  }
  
  .project-title {
    font-size: 1.25rem;
  }
}

@media (max-width: 480px) {
  .project-content {
    padding: 1.25rem;
  }
  
  .overlay-content {
    font-size: 1rem;
  }
}

/* Performance */
@media (prefers-reduced-motion: reduce) {
  .project-card,
  .project-image,
  .overlay-content,
  .tech-badge,
  .project-particle {
    animation: none !important;
    transition: none !important;
  }
  
  .project-card {
    opacity: 1;
    transform: none;
  }
  
  .project-card:hover {
    transform: none;
  }
  
  .tech-badge {
    opacity: 1;
    transform: none;
  }
}
</style>