<template>
  <section class="skills-section">
    <div class="container">
      <div class="section-header">
        <span class="section-badge">{{ badge }}</span>
        <h2 class="section-title">{{ title }}</h2>
        <p class="section-description" v-if="description">{{ description }}</p>
      </div>

      <div class="skills-grid">
        <div 
          v-for="categorie in topCategories" 
          :key="categorie.nom" 
          class="category-card"
        >
          <div class="category-header">
            <h3 class="category-title">{{ categorie.nom }}</h3>
          </div>
          
          <div class="skills-list">
            <SkillCard 
              v-for="competence in getTopSkills(categorie.competences)" 
              :key="competence.id"
              :competence="competence"
            />
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { computed } from 'vue'
import SkillCard from '../cards/SkillCard.vue'

const props = defineProps({
  competences: {
    type: Array,
    required: true
  },
  badge: {
    type: String,
    default: 'Compétences'
  },
  title: {
    type: String,
    default: 'Technologies & Outils'
  },
  description: {
    type: String,
    default: 'Mes compétences principales'
  },
  maxCategories: {
    type: Number,
    default: 3
  },
  skillsPerCategory: {
    type: Number,
    default: 3
  }
})

// Grouper les compétences par catégorie
const competencesParCategorie = computed(() => {
  const categories = {}
  
  props.competences.forEach(comp => {
    const categorie = comp.categorie || 'Autres'
    
    if (!categories[categorie]) {
      categories[categorie] = {
        nom: categorie,
        competences: []
      }
    }
    categories[categorie].competences.push(comp)
  })
  
  return Object.values(categories)
})

// Obtenir les 3 premières catégories (les plus importantes)
const topCategories = computed(() => {
  return competencesParCategorie.value
    .slice(0, props.maxCategories)
})

// Obtenir les compétences principales (les mieux notées)
const getTopSkills = (skills) => {
  return skills
    .sort((a, b) => b.niveau - a.niveau)
    .slice(0, props.skillsPerCategory)
}
</script>

<style scoped>
.skills-section {
  padding: 4rem 0;
  background: linear-gradient(135deg, 
    rgba(59, 130, 246, 0.02) 0%,
    rgba(139, 92, 246, 0.02) 100%);
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 1.5rem;
}

.section-header {
  text-align: center;
  margin-bottom: 3rem;
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
  font-size: 2.5rem;
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

.skills-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
  gap: 2rem;
}

.category-card {
  background: white;
  border-radius: 16px;
  padding: 2rem;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  border: 1px solid #e5e7eb;
}

.category-header {
  margin-bottom: 1.5rem;
  padding-bottom: 1rem;
  border-bottom: 2px solid #e5e7eb;
}

.category-title {
  font-size: 1.25rem;
  font-weight: 700;
  color: #1f2937;
  margin: 0;
}

.skills-list {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

/* Dark mode */
.dark-mode .skills-section {
  background: linear-gradient(135deg, 
    rgba(59, 130, 246, 0.03) 0%,
    rgba(139, 92, 246, 0.03) 100%);
}

.dark-mode .section-title {
  color: #f9fafb;
}

.dark-mode .section-description {
  color: #d1d5db;
}

.dark-mode .category-card {
  background: #1f2937;
  border-color: #374151;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
}

.dark-mode .category-header {
  border-bottom-color: #374151;
}

.dark-mode .category-title {
  color: #f9fafb;
}

/* Responsive */
@media (max-width: 768px) {
  .skills-section {
    padding: 3rem 0;
  }
  
  .section-title {
    font-size: 2rem;
  }
  
  .skills-grid {
    grid-template-columns: 1fr;
    gap: 1.5rem;
  }
  
  .category-card {
    padding: 1.5rem;
  }
}
</style>