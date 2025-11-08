<template>
  <div class="projets">
    <!-- Loading State -->
    <div v-if="chargement" class="loading-page">
      <Loader message="Chargement des projets..." />
    </div>

    <!-- Contenu principal -->
    <div v-else class="projets-content">
      <!-- Hero Section améliorée -->
      <ProjectsHeroSection 
        :statistiques="statistiques"
        @scroll-to-projects="scrollToProjects"
      />

      <!-- Grille de projets -->
      <section class="projects-grid-section" ref="projectsGridRef">
        <div class="container">
          <div class="projects-grid">
            <ProjectCard 
              v-for="(projet, index) in projets" 
              :key="projet.id"
              :projet="projet"
              :index="index"
            />
          </div>

          <!-- État vide -->
          <div v-if="projets.length === 0" class="empty-state">
            <div class="empty-icon">
              <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
              </svg>
            </div>
            <h3 class="empty-title">Aucun projet disponible</h3>
            <p class="empty-description">
              Mes projets seront bientôt publiés. Revenez plus tard !
            </p>
          </div>
        </div>
      </section>
    </div>

    <!-- Error State -->
    <div v-if="erreur" class="error-state">
      <p>{{ erreur }}</p>
      <button @click="chargerProjets" class="retry-btn">Réessayer</button>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import axios from 'axios'

// Composants
import ProjectsHeroSection from '../components/sections/projets/ProjectsHeroSection.vue'
import ProjectCard from '../components/cards/ProjectCard.vue'
import Loader from '../components/ui/Loader.vue'

// État
const chargement = ref(true)
const erreur = ref(null)
const projets = ref([])
const projectsGridRef = ref(null)

// Computed pour les statistiques du hero
const statistiques = computed(() => [
  {
    icon: '📁',
    value: projets.value.length,
    label: 'Projets Totaux'
  },
  {
    icon: '🚀',
    value: projets.value.filter(p => p.statut === 'complet').length,
    label: 'Projets Livrés'
  },
  {
    icon: '⚡',
    value: projets.value.filter(p => p.statut === 'encours').length,
    label: 'En Cours'
  },
  {
    icon: '🌐',
    value: new Set(projets.value.flatMap(p => p.technologies)).size,
    label: 'Technologies'
  }
])

// Méthodes
const chargerProjets = async () => {
  try {
    chargement.value = true
    erreur.value = null
    const response = await axios.get('/api/projets')
    projets.value = response.data
  } catch (err) {
    erreur.value = err.response?.data?.message || 'Erreur lors du chargement des projets'
    console.error('Erreur:', err)
  } finally {
    chargement.value = false
  }
}

const scrollToProjects = () => {
  if (projectsGridRef.value) {
    projectsGridRef.value.scrollIntoView({ 
      behavior: 'smooth',
      block: 'start'
    })
  }
}

onMounted(() => {
  chargerProjets()
})
</script>

<style scoped>
.projets {
  min-height: 100vh;
  overflow-x: hidden;
}

.loading-page {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
}

.projets-content {
  padding-bottom: 4rem;
}

/* Projects Grid Section */
.projects-grid-section {
  padding: 4rem 0;
  position: relative;
}

.projects-grid-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(135deg, 
    rgba(59, 130, 246, 0.02) 0%,
    rgba(139, 92, 246, 0.02) 100%);
  z-index: -1;
}

.container {
  max-width: 1400px;
  margin: 0 auto;
  padding: 0 clamp(1.5rem, 4vw, 3rem);
}

.projects-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
  gap: 2.5rem;
}

/* Empty State amélioré */
.empty-state {
  text-align: center;
  padding: 4rem 2rem;
  max-width: 500px;
  margin: 0 auto;
}

.empty-icon {
  margin-bottom: 1.5rem;
  color: #9ca3af;
}

.empty-title {
  font-size: 1.5rem;
  font-weight: 600;
  color: #374151;
  margin-bottom: 0.5rem;
}

.empty-description {
  color: #6b7280;
  line-height: 1.6;
}

/* Error State amélioré */
.error-state {
  text-align: center;
  padding: 4rem 2rem;
  background: #fef2f2;
  border-radius: 12px;
  margin: 2rem auto;
  max-width: 500px;
}

.error-state p {
  color: #dc2626;
  margin-bottom: 1.5rem;
  font-size: 1.125rem;
}

.retry-btn {
  padding: 0.75rem 1.5rem;
  background: #3b82f6;
  color: white;
  border: none;
  border-radius: 8px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
}

.retry-btn:hover {
  background: #2563eb;
  transform: translateY(-2px);
}

/* Dark mode */
.dark-mode .projects-grid-section::before {
  background: linear-gradient(135deg, 
    rgba(59, 130, 246, 0.03) 0%,
    rgba(139, 92, 246, 0.03) 100%);
}

.dark-mode .empty-title {
  color: #f9fafb;
}

.dark-mode .empty-description {
  color: #d1d5db;
}

.dark-mode .empty-icon {
  color: #6b7280;
}

.dark-mode .error-state {
  background: #1f2937;
  border: 1px solid #374151;
}

.dark-mode .error-state p {
  color: #fca5a5;
}

/* Responsive */
@media (max-width: 1024px) {
  .projects-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 2rem;
  }
}

@media (max-width: 768px) {
  .projects-grid-section {
    padding: 3rem 0;
  }
  
  .projects-grid {
    grid-template-columns: 1fr;
    gap: 1.5rem;
  }
  
  .empty-state {
    padding: 3rem 1rem;
  }
  
  .error-state {
    padding: 3rem 1.5rem;
    margin: 1rem;
  }
}

@media (max-width: 480px) {
  .container {
    padding: 0 1rem;
  }
  
  .projects-grid {
    gap: 1.25rem;
  }
}

/* Animations */
.projects-grid-section {
  animation: fadeInUp 0.8s ease-out;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Performance */
@media (prefers-reduced-motion: reduce) {
  .projects-grid-section {
    animation: none;
  }
}
</style>