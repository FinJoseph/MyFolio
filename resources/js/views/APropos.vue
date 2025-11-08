<template>
  <div class="a-propos">
    <!-- Loading State -->
    <div v-if="chargement" class="loading-page">
      <Loader message="Chargement..." />
    </div>

    <!-- Error State -->
    <div v-else-if="erreur" class="error-state">
      <div class="error-content">
        <h2>Erreur de chargement</h2>
        <p>{{ erreur }}</p>
        <Button @click="chargerDonnees" variant="primary" size="medium">
          Réessayer
        </Button>
      </div>
    </div>

    <!-- Content -->
    <div v-else class="about-content">

      <!-- Stats Section -->
      <StatsSection 
        v-if="statistiques.length"
        :statistiques="statistiques"
      />

      <!-- Formations Section -->
      <FormationsSection 
        v-if="formationsValides.length"
        :formations="formationsValides"
      />

      <!-- Compétences Section -->
      <SkillsSection 
        v-if="competencesValides.length"
        :competences="competencesValides"
        badge="Expertise"
        title="Mes Compétences Techniques"
        description="Un panorama complet de mes compétences et technologies maîtrisées"
        :max-categories="6"
        :skills-per-category="8"
      />

      <!-- CTA Section -->
      <CtaSection 
        :title="infosPersonnelles.message_disponibilite || 'Prêt à concrétiser votre projet ?'"
        :description="'Travaillons ensemble pour donner vie à vos idées les plus ambitieuses'"
        primary-text="Démarrer un projet"
        secondary-text="Voir mon portfolio"
        secondary-link="/projets"
        :show-secondary="true"
      />
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import axios from 'axios'

// Composants
import StatsSection from '../components/sections/StatsSection.vue'
import SkillsSection from '../components/sections/SkillsSection.vue'
import CtaSection from '../components/sections/CtaSection.vue'
import FormationsSection from '../components/sections/FormationsSection.vue'
import Button from '../components/ui/Button.vue'
import Loader from '../components/ui/Loader.vue'

// État
const chargement = ref(true)
const erreur = ref(null)
const infosPersonnelles = ref({})
const competences = ref([])
const services = ref([])
const projetsRecents = ref([])
const temoignages = ref([])
const experiences = ref([])
const formations = ref([])

// Computed pour valider les données
const experiencesValides = computed(() => {
  return Array.isArray(experiences.value) ? experiences.value.filter(exp => exp && typeof exp === 'object') : []
})

const formationsValides = computed(() => {
  return Array.isArray(formations.value) ? formations.value.filter(formation => formation && typeof formation === 'object') : []
})

const competencesValides = computed(() => {
  return Array.isArray(competences.value) ? competences.value.filter(comp => comp && typeof comp === 'object') : []
})

const servicesValides = computed(() => {
  return Array.isArray(services.value) ? services.value.filter(service => service && typeof service === 'object') : []
})

const projetsValides = computed(() => {
  return Array.isArray(projetsRecents.value) ? projetsRecents.value.filter(projet => projet && typeof projet === 'object') : []
})

const temoignagesValides = computed(() => {
  return Array.isArray(temoignages.value) ? temoignages.value.filter(temoignage => temoignage && typeof temoignage === 'object') : []
})

// Computed pour les statistiques
const statistiques = computed(() => {
  const totalProjets = projetsValides.value.length > 0 ? projetsValides.value.length + 47 : 50
  
  let anneesExperience = 0
  if (experiencesValides.value.length > 0) {
    anneesExperience = experiencesValides.value.reduce((total, exp) => {
      try {
        const debut = new Date(exp.date_debut)
        const fin = exp.en_cours ? new Date() : new Date(exp.date_fin)
        const mois = (fin.getFullYear() - debut.getFullYear()) * 12 + (fin.getMonth() - debut.getMonth())
        return total + (mois / 12)
      } catch (error) {
        console.warn('Erreur dans le calcul de l\'expérience:', error)
        return total
      }
    }, 0)
  } else {
    anneesExperience = 5
  }
  
  const clientsSatisfaits = 100
  const technologiesCount = competencesValides.value.length > 0 
    ? new Set(competencesValides.value.map(comp => comp.nom)).size 
    : 0

  return [
    {
      icon: '📁',
      value: totalProjets + '+',
      label: 'Projets Réalisés'
    },
    {
      icon: '⏱️',
      value: Math.round(anneesExperience) + '+',
      label: "Années d'Expérience"
    },
    {
      icon: '😊',
      value: clientsSatisfaits + '%',
      label: 'Clients Satisfaits'
    },
    {
      icon: '🌐',
      value: technologiesCount + '+',
      label: 'Technologies Maîtrisées'
    }
  ]
})

// Méthodes
const formatBio = (bio) => {
  if (!bio) return ''
  return bio.split('\n').filter(line => line.trim()).map(line => {
    if (line.trim().startsWith('#')) {
      const level = line.match(/^#+/)[0].length
      const title = line.replace(/^#+\s*/, '')
      return `<h${level} class="bio-heading">${title}</h${level}>`
    }
    return `<p class="bio-paragraph">${line}</p>`
  }).join('')
}

const chargerDonnees = async () => {
  try {
    chargement.value = true
    erreur.value = null

    // Charger les données avec timeout
    const controller = new AbortController()
    const timeoutId = setTimeout(() => controller.abort(), 10000)

    const [accueilResponse, competencesResponse, experiencesResponse, formationsResponse] = await Promise.all([
      axios.get('/api/accueil', { signal: controller.signal }),
      axios.get('/api/competences', { signal: controller.signal }),
      axios.get('/api/experiences', { signal: controller.signal }), // AJOUT: Chargement des expériences
      axios.get('/api/formations', { signal: controller.signal })
    ])

    clearTimeout(timeoutId)

    // Valider et assigner les données
    infosPersonnelles.value = accueilResponse.data?.informations_personnelles || {}
    
    competences.value = Array.isArray(competencesResponse.data) ? competencesResponse.data : []
    
    services.value = Array.isArray(accueilResponse.data?.services) ? accueilResponse.data.services : []
    
    projetsRecents.value = Array.isArray(accueilResponse.data?.projets_mis_en_avant) ? accueilResponse.data.projets_mis_en_avant : []
    
    temoignages.value = Array.isArray(accueilResponse.data?.temoignages) ? accueilResponse.data.temoignages : []
    
    experiences.value = Array.isArray(experiencesResponse.data) ? experiencesResponse.data : [] // AJOUT: Assignation des expériences
    
    formations.value = Array.isArray(formationsResponse.data) ? formationsResponse.data : []

  } catch (err) {
    console.error('Erreur lors du chargement des données:', err)
    if (err.name === 'AbortError') {
      erreur.value = 'Le chargement a pris trop de temps. Veuillez réessayer.'
    } else {
      erreur.value = err.response?.data?.message || 'Erreur lors du chargement des données'
    }
  } finally {
    chargement.value = false
  }
}

onMounted(() => {
  chargerDonnees()
})
</script>

<style scoped>
.a-propos {
  min-height: 100vh;
  overflow-x: hidden;
}

.loading-page {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
}

.error-state {
  min-height: 60vh;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
}

.error-content {
  max-width: 400px;
  padding: 2rem;
}

.error-content h2 {
  color: #dc2626;
  margin-bottom: 1rem;
}

.error-content p {
  color: #6b7280;
  margin-bottom: 2rem;
}

/* Bio Section */
.bio-section {
  padding: 5rem 0;
  background: linear-gradient(135deg, 
    rgba(59, 130, 246, 0.02) 0%,
    rgba(139, 92, 246, 0.02) 100%);
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

.bio-content {
  max-width: 800px;
  margin: 0 auto;
}

.bio-text {
  font-size: 1.125rem;
  line-height: 1.8;
  color: #4b5563;
}

.bio-text :deep(.bio-heading) {
  color: #1f2937;
  margin: 2rem 0 1rem;
  font-weight: 700;
}

.bio-text :deep(.bio-heading:first-child) {
  margin-top: 0;
}

.bio-text :deep(.bio-paragraph) {
  margin-bottom: 1.5rem;
}

.bio-text :deep(ul), 
.bio-text :deep(ol) {
  margin-bottom: 1.5rem;
  padding-left: 1.5rem;
}

.bio-text :deep(li) {
  margin-bottom: 0.5rem;
}

/* Dark mode */
.dark-mode .bio-section {
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

.dark-mode .bio-text {
  color: #d1d5db;
}

.dark-mode .bio-text :deep(.bio-heading) {
  color: #f9fafb;
}

/* Responsive */
@media (max-width: 768px) {
  .bio-text {
    font-size: 1rem;
  }
}
</style>