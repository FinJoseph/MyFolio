<template>
  <div class="formation-card" :class="{ 'diplome': formation.est_diplome, 'en-cours': formation.en_cours }">
    <div class="formation-header">
      <div class="formation-period">
        {{ formation.periode_formatee }}
        <span class="formation-duree">• {{ formation.duree }}</span>
      </div>
      <div class="formation-badge" v-if="formation.est_diplome">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M12 15l8-8-8-8-8 8 8 8z"></path>
          <path d="M2 12l8 8 8-8"></path>
        </svg>
        Diplôme
      </div>
    </div>
    
    <h3 class="formation-title">{{ formation.diplome }}</h3>
    <div class="formation-school">{{ formation.ecole }}</div>
    <div class="formation-domain" v-if="formation.domaine">{{ formation.domaine_formate }}</div>
    
    <p class="formation-description" v-if="formation.description">{{ formation.description }}</p>
    
    <div class="formation-status" :class="{ 'en-cours': formation.en_cours }">
      <span class="status-dot"></span>
      {{ formation.en_cours ? 'En cours' : 'Terminé' }}
    </div>
  </div>
</template>

<script setup>
defineProps({
  formation: {
    type: Object,
    required: true
  }
})
</script>

<style scoped>
.formation-card {
  background: white;
  padding: 2rem;
  border-radius: 16px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  border: 1px solid #e5e7eb;
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
}

.formation-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
}

.formation-card.diplome {
  border-left: 4px solid #3b82f6;
}

.formation-card.en-cours {
  border-top: 3px solid #10b981;
}

.formation-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 1rem;
  flex-wrap: wrap;
  gap: 0.5rem;
}

.formation-period {
  font-size: 0.875rem;
  font-weight: 600;
  color: #3b82f6;
}

.formation-duree {
  color: #6b7280;
  font-weight: 400;
}

.formation-badge {
  display: inline-flex;
  align-items: center;
  gap: 0.375rem;
  padding: 0.25rem 0.75rem;
  background: rgba(59, 130, 246, 0.1);
  color: #3b82f6;
  border-radius: 20px;
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
}

.formation-title {
  font-size: 1.25rem;
  font-weight: 700;
  color: #1f2937;
  margin-bottom: 0.5rem;
  line-height: 1.3;
}

.formation-school {
  font-size: 1rem;
  color: #3b82f6;
  font-weight: 600;
  margin-bottom: 0.25rem;
}

.formation-domain {
  font-size: 0.875rem;
  color: #6b7280;
  margin-bottom: 1rem;
  font-style: italic;
}

.formation-description {
  color: #6b7280;
  line-height: 1.6;
  margin-bottom: 1.5rem;
}

.formation-status {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.375rem 0.75rem;
  background: rgba(34, 197, 94, 0.1);
  color: #16a34a;
  border-radius: 20px;
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
}

.formation-status.en-cours {
  background: rgba(59, 130, 246, 0.1);
  color: #3b82f6;
}

.status-dot {
  width: 6px;
  height: 6px;
  background: currentColor;
  border-radius: 50%;
  animation: pulse 2s ease-in-out infinite;
}

/* Dark mode */
.dark-mode .formation-card {
  background: #1f2937;
  border-color: #374151;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
}

.dark-mode .formation-title {
  color: #f9fafb;
}

.dark-mode .formation-school {
  color: #60a5fa;
}

.dark-mode .formation-domain {
  color: #94a3b8;
}

.dark-mode .formation-description {
  color: #94a3b8;
}

/* Responsive */
@media (max-width: 768px) {
  .formation-card {
    padding: 1.5rem;
  }
  
  .formation-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 0.5rem;
  }
}

@media (max-width: 480px) {
  .formation-card {
    padding: 1.25rem;
  }
  
  .formation-title {
    font-size: 1.125rem;
  }
}
</style>