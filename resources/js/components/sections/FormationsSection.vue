<template>
  <section class="formations-section">
    <div class="container">
      <div class="section-header">
        <span class="section-badge">Formation</span>
        <h2 class="section-title">Parcours Académique</h2>
        <p class="section-description">Mon apprentissage et développement continu</p>
      </div>

      <div class="formations-grid">
        <FormationCard 
          v-for="formation in formations" 
          :key="formation.id"
          :formation="formation"
        />
      </div>
    </div>
  </section>
</template>

<script setup>
import FormationCard from '../cards/FormationCard.vue'

defineProps({
  formations: {
    type: Array,
    required: true
  }
})
</script>

<style scoped>
.formations-section {
  padding: 5rem 0;
}

.container {
  max-width: 1200px;
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

.formations-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
  gap: 2rem;
  max-width: 1000px;
  margin: 0 auto;
}

/* Dark mode */
.dark-mode .section-title {
  color: #f9fafb;
}

.dark-mode .section-description {
  color: #d1d5db;
}

/* Responsive */
@media (max-width: 768px) {
  .formations-section {
    padding: 4rem 0;
  }

  .formations-grid {
    grid-template-columns: 1fr;
    gap: 1.5rem;
  }
}

@media (max-width: 480px) {
  .formations-section {
    padding: 3rem 0;
  }

  .formations-grid {
    gap: 1.25rem;
  }
}
</style>