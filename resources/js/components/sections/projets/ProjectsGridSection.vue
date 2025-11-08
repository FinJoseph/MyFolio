<!-- components/sections/projets/ProjectsGridSection.vue -->
<template>
  <section class="projects-grid-section" ref="sectionRef">
    <div class="container">
      <!-- Filtres -->
      <div class="filters-section">
        <div class="filters-header">
          <h2 class="filters-title">Explorer les projets</h2>
          <p class="filters-subtitle">Filtrez par catégorie, technologie ou statut</p>
        </div>
        
        <div class="filters-container">
          <!-- Filtre Catégories -->
          <div class="filter-group">
            <label class="filter-label">Catégorie</label>
            <div class="filter-buttons">
              <button 
                v-for="category in categories" 
                :key="category.id"
                :class="['filter-btn', { active: activeFilters.categories.includes(category.id) }]"
                @click="toggleCategory(category.id)"
              >
                {{ category.nom || category.name }}
              </button>
            </div>
          </div>
          
          <!-- Filtre Technologies -->
          <div class="filter-group">
            <label class="filter-label">Technologies</label>
            <div class="filter-buttons">
              <button 
                v-for="tech in technologies" 
                :key="tech"
                :class="['filter-btn tech', { active: activeFilters.technologies.includes(tech) }]"
                @click="toggleTechnology(tech)"
              >
                {{ tech }}
              </button>
            </div>
          </div>
          
          <!-- Filtre Statuts -->
          <div class="filter-group">
            <label class="filter-label">Statut</label>
            <div class="filter-buttons">
              <button 
                v-for="status in statuts" 
                :key="status.id"
                :class="['filter-btn status', { active: activeFilters.statut === status.id }]"
                @click="toggleStatut(status.id)"
              >
                <span class="status-dot" :class="status.id"></span>
                {{ status.nom || status.name }}
              </button>
            </div>
          </div>
        </div>
        
        <div class="filters-actions">
          <button 
            v-if="hasActiveFilters" 
            class="clear-filters" 
            @click="clearFilters"
          >
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <line x1="18" y1="6" x2="6" y2="18"></line>
              <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
            Réinitialiser ({{ activeFiltersCount }})
          </button>
        </div>
      </div>

      <!-- En-tête résultats -->
      <div class="projects-header">
        <h3 class="projects-count">
          {{ filteredProjects.length }} projet{{ filteredProjects.length !== 1 ? 's' : '' }} trouvé{{ filteredProjects.length !== 1 ? 's' : '' }}
        </h3>
        <div class="sort-options">
          <select v-model="sortBy" class="sort-select">
            <option value="date_desc">Plus récent</option>
            <option value="date_asc">Plus ancien</option>
            <option value="name_asc">A-Z</option>
            <option value="name_desc">Z-A</option>
          </select>
        </div>
      </div>

      <!-- Grille de projets -->
      <div class="projects-grid">
        <ProjectCard 
          v-for="(projet, index) in sortedProjects" 
          :key="projet.id"
          :projet="projet"
          :index="index"
          :max-techs="4"
        />
      </div>

      <!-- Chargement supplémentaire -->
      <div v-if="loadingMore" class="loading-more">
        <Loader message="Chargement des projets..." />
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, computed, watch } from 'vue'
import ProjectCard from '../../cards/ProjectCard.vue'
import Loader from '../../ui/Loader.vue'

const props = defineProps({
  projets: {
    type: Array,
    default: () => []
  },
  categories: {
    type: Array,
    default: () => []
  },
  technologies: {
    type: Array,
    default: () => []
  },
  statuts: {
    type: Array,
    default: () => []
  }
})

const emit = defineEmits(['filter-change'])

// État local
const sectionRef = ref(null)
const activeFilters = ref({
  categories: [],
  technologies: [],
  statut: null
})
const sortBy = ref('date_desc')
const loadingMore = ref(false)

// Computed
const hasActiveFilters = computed(() => {
  return activeFilters.value.categories.length > 0 || 
         activeFilters.value.technologies.length > 0 || 
         activeFilters.value.statut !== null
})

const activeFiltersCount = computed(() => {
  let count = activeFilters.value.categories.length + activeFilters.value.technologies.length
  if (activeFilters.value.statut) count++
  return count
})

const filteredProjects = computed(() => {
  let filtered = [...props.projets]

  // Filtre par catégories
  if (activeFilters.value.categories.length > 0) {
    filtered = filtered.filter(projet => 
      activeFilters.value.categories.includes(projet.categorie)
    )
  }

  // Filtre par technologies
  if (activeFilters.value.technologies.length > 0) {
    filtered = filtered.filter(projet =>
      activeFilters.value.technologies.some(tech => 
        projet.technologies.includes(tech)
      )
    )
  }

  // Filtre par statut
  if (activeFilters.value.statut) {
    filtered = filtered.filter(projet => projet.statut === activeFilters.value.statut)
  }

  return filtered
})

const sortedProjects = computed(() => {
  const projects = [...filteredProjects.value]
  
  switch (sortBy.value) {
    case 'date_asc':
      return projects.sort((a, b) => new Date(a.date_creation || a.created_at) - new Date(b.date_creation || b.created_at))
    case 'name_asc':
      return projects.sort((a, b) => a.titre.localeCompare(b.titre))
    case 'name_desc':
      return projects.sort((a, b) => b.titre.localeCompare(a.titre))
    case 'date_desc':
    default:
      return projects.sort((a, b) => new Date(b.date_creation || b.created_at) - new Date(a.date_creation || a.created_at))
  }
})

// Méthodes
const toggleCategory = (categoryId) => {
  const index = activeFilters.value.categories.indexOf(categoryId)
  if (index > -1) {
    activeFilters.value.categories.splice(index, 1)
  } else {
    activeFilters.value.categories.push(categoryId)
  }
  emitFilters()
}

const toggleTechnology = (tech) => {
  const index = activeFilters.value.technologies.indexOf(tech)
  if (index > -1) {
    activeFilters.value.technologies.splice(index, 1)
  } else {
    activeFilters.value.technologies.push(tech)
  }
  emitFilters()
}

const toggleStatut = (statutId) => {
  activeFilters.value.statut = activeFilters.value.statut === statutId ? null : statutId
  emitFilters()
}

const clearFilters = () => {
  activeFilters.value = {
    categories: [],
    technologies: [],
    statut: null
  }
  emitFilters()
}

const emitFilters = () => {
  emit('filter-change', { ...activeFilters.value })
}

// Watchers
watch(activeFilters, () => {
  // Scroll vers la section quand les filtres changent
  if (sectionRef.value && hasActiveFilters.value) {
    sectionRef.value.scrollIntoView({ behavior: 'smooth', block: 'start' })
  }
}, { deep: true })
</script>

<style scoped>
.projects-grid-section {
  padding: 4rem 0;
}

.container {
  max-width: 1400px;
  margin: 0 auto;
  padding: 0 clamp(1.5rem, 4vw, 3rem);
}

/* Filters Section */
.filters-section {
  background: rgba(255, 255, 255, 0.8);
  backdrop-filter: blur(15px);
  border: 1px solid rgba(255, 255, 255, 0.3);
  border-radius: 20px;
  padding: 2.5rem;
  margin-bottom: 3rem;
}

.filters-header {
  text-align: center;
  margin-bottom: 2rem;
}

.filters-title {
  font-size: 1.75rem;
  font-weight: 700;
  color: #1f2937;
  margin-bottom: 0.5rem;
}

.filters-subtitle {
  color: #6b7280;
}

.filters-container {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.filter-group {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.filter-label {
  font-weight: 600;
  color: #374151;
  font-size: 0.875rem;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

.filter-buttons {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
}

.filter-btn {
  padding: 0.5rem 1rem;
  border: 1px solid #e5e7eb;
  background: white;
  border-radius: 8px;
  font-size: 0.875rem;
  font-weight: 500;
  color: #6b7280;
  transition: all 0.3s ease;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.filter-btn:hover {
  border-color: #3b82f6;
  color: #3b82f6;
}

.filter-btn.active {
  background: #3b82f6;
  border-color: #3b82f6;
  color: white;
}

.status-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
}

.status-dot.complet { background: #10b981; }
.status-dot.encours { background: #f59e0b; }
.status-dot.preview { background: #3b82f6; }

.filters-actions {
  text-align: center;
  margin-top: 1rem;
}

.clear-filters {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 1rem;
  background: transparent;
  border: 1px solid #e5e7eb;
  border-radius: 8px;
  color: #6b7280;
  font-size: 0.875rem;
  cursor: pointer;
  transition: all 0.3s ease;
}

.clear-filters:hover {
  border-color: #ef4444;
  color: #ef4444;
}

/* Projects Header */
.projects-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
}

.projects-count {
  font-size: 1.25rem;
  font-weight: 600;
  color: #1f2937;
}

.sort-select {
  padding: 0.5rem 1rem;
  border: 1px solid #e5e7eb;
  border-radius: 8px;
  background: white;
  color: #374151;
  font-size: 0.875rem;
}

/* Projects Grid */
.projects-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
  gap: 2rem;
}

.loading-more {
  display: flex;
  justify-content: center;
  padding: 2rem;
}

/* Dark Mode */
.dark-mode .filters-section {
  background: rgba(15, 23, 42, 0.8);
  border-color: rgba(255, 255, 255, 0.1);
}

.dark-mode .filters-title {
  color: #f9fafb;
}

.dark-mode .filters-subtitle {
  color: #d1d5db;
}

.dark-mode .filter-label {
  color: #e5e7eb;
}

.dark-mode .filter-btn {
  background: #1f2937;
  border-color: #374151;
  color: #d1d5db;
}

.dark-mode .filter-btn:hover {
  border-color: #3b82f6;
  color: #3b82f6;
}

.dark-mode .filter-btn.active {
  background: #3b82f6;
  border-color: #3b82f6;
  color: white;
}

.dark-mode .clear-filters {
  background: #1f2937;
  border-color: #374151;
  color: #d1d5db;
}

.dark-mode .sort-select {
  background: #1f2937;
  border-color: #374151;
  color: #d1d5db;
}

.dark-mode .projects-count {
  color: #f9fafb;
}

/* Responsive */
@media (max-width: 1024px) {
  .projects-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 768px) {
  .filters-section {
    padding: 2rem;
  }
  
  .projects-grid {
    grid-template-columns: 1fr;
  }
  
  .projects-header {
    flex-direction: column;
    gap: 1rem;
    align-items: flex-start;
  }
  
  .filter-buttons {
    justify-content: center;
  }
}

@media (max-width: 480px) {
  .filters-section {
    padding: 1.5rem;
  }
  
  .projects-grid-section {
    padding: 3rem 0;
  }
}
</style>