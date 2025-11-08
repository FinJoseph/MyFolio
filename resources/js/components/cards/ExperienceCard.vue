<template>
  <div class="timeline-item">
    <div class="timeline-marker" :class="{ 'current': experience.en_cours }"></div>
    <div class="timeline-content">
      <div class="timeline-header">
        <div class="timeline-period">
          {{ experience.periode_formatee }}
          <span class="timeline-duree">• {{ experience.duree }}</span>
        </div>
        <div class="timeline-type" :class="experience.type_emploi.toLowerCase()">
          {{ experience.type_emploi_formate }}
        </div>
      </div>
      
      <h3 class="timeline-title">{{ experience.poste }}</h3>
      
      <div class="timeline-company">
        <span v-if="experience.url_entreprise">
          <a :href="experience.url_entreprise" target="_blank" class="company-link">
            {{ experience.entreprise }}
          </a>
        </span>
        <span v-else>{{ experience.entreprise }}</span>
        <span v-if="experience.lieu" class="timeline-lieu">• {{ experience.lieu }}</span>
      </div>
      
      <p class="timeline-description">{{ experience.description }}</p>
      
      <div v-if="experience.realisations && experience.realisations.length" class="timeline-realisations">
        <h4>Réalisations :</h4>
        <ul>
          <li v-for="(realisation, idx) in experience.realisations" :key="idx">
            {{ realisation }}
          </li>
        </ul>
      </div>
      
      <div v-if="experience.technologies && experience.technologies.length" class="timeline-techs">
        <span v-for="tech in experience.technologies" :key="tech" class="tech-tag">
          {{ tech }}
        </span>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  experience: {
    type: Object,
    required: true
  }
})
</script>

<style scoped>
.timeline-item {
  position: relative;
  margin-bottom: 3rem;
  padding-left: 80px;
}

.timeline-marker {
  position: absolute;
  left: 22px;
  top: 0;
  width: 16px;
  height: 16px;
  background: #3b82f6;
  border: 4px solid white;
  border-radius: 50%;
  box-shadow: 0 0 0 3px #3b82f6;
  z-index: 2;
}

.timeline-marker.current {
  background: #10b981;
  box-shadow: 0 0 0 3px #10b981;
  animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.7; }
}

.timeline-content {
  background: white;
  padding: 2.5rem;
  border-radius: 16px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  border: 1px solid #e5e7eb;
  transition: all 0.3s ease;
}

.timeline-content:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
}

.timeline-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 1rem;
  flex-wrap: wrap;
  gap: 0.5rem;
}

.timeline-period {
  font-size: 0.875rem;
  font-weight: 600;
  color: #3b82f6;
}

.timeline-duree {
  color: #6b7280;
  font-weight: 400;
}

.timeline-type {
  padding: 0.25rem 0.75rem;
  background: rgba(59, 130, 246, 0.1);
  color: #3b82f6;
  border-radius: 20px;
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
}

.timeline-type.freelance {
  background: rgba(139, 92, 246, 0.1);
  color: #8b5cf6;
}

.timeline-type.stage {
  background: rgba(34, 197, 94, 0.1);
  color: #16a34a;
}

.timeline-type.alternance {
  background: rgba(245, 158, 11, 0.1);
  color: #d97706;
}

.timeline-title {
  font-size: 1.25rem;
  font-weight: 700;
  color: #1f2937;
  margin-bottom: 0.5rem;
}

.timeline-company {
  font-size: 1rem;
  color: #6b7280;
  margin-bottom: 1rem;
  font-weight: 500;
}

.company-link {
  color: inherit;
  text-decoration: none;
  transition: color 0.3s ease;
}

.company-link:hover {
  color: #3b82f6;
}

.timeline-lieu {
  color: #9ca3af;
}

.timeline-description {
  color: #6b7280;
  line-height: 1.6;
  margin-bottom: 1.5rem;
}

.timeline-realisations {
  margin-bottom: 1.5rem;
}

.timeline-realisations h4 {
  font-size: 0.875rem;
  font-weight: 600;
  color: #374151;
  margin-bottom: 0.5rem;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

.timeline-realisations ul {
  list-style: none;
  padding: 0;
}

.timeline-realisations li {
  position: relative;
  padding-left: 1rem;
  color: #6b7280;
  line-height: 1.5;
  margin-bottom: 0.25rem;
}

.timeline-realisations li::before {
  content: '•';
  position: absolute;
  left: 0;
  color: #3b82f6;
  font-weight: bold;
}

.timeline-techs {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
}

.tech-tag {
  padding: 0.25rem 0.75rem;
  background: rgba(59, 130, 246, 0.1);
  color: #3b82f6;
  border-radius: 20px;
  font-size: 0.75rem;
  font-weight: 500;
}

/* Dark mode */
.dark-mode .timeline-content {
  background: #1f2937;
  border-color: #374151;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
}

.dark-mode .timeline-marker {
  border-color: #1f2937;
}

.dark-mode .timeline-title {
  color: #f9fafb;
}

.dark-mode .timeline-company {
  color: #d1d5db;
}

.dark-mode .timeline-description {
  color: #94a3b8;
}

.dark-mode .timeline-realisations h4 {
  color: #e5e7eb;
}

.dark-mode .timeline-realisations li {
  color: #94a3b8;
}

/* Responsive */
@media (max-width: 768px) {
  .timeline-item {
    padding-left: 60px;
  }
  
  .timeline-marker {
    left: 12px;
    width: 14px;
    height: 14px;
  }
  
  .timeline-content {
    padding: 1.5rem;
  }
  
  .timeline-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 0.5rem;
  }
}

@media (max-width: 480px) {
  .timeline-item {
    padding-left: 50px;
  }
  
  .timeline-content {
    padding: 1.25rem;
  }
}
</style>