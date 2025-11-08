<!-- views/Accueil.vue -->
<template>
  <div class="accueil">
    <!-- Hero Section -->
    <HeroSection 
      v-if="!chargement"
      :infos-personnelles="infosPersonnelles"
      :reseaux-sociaux="reseauxSociaux"
      @scroll-to-stats="scrollToStats"
    />

    <!-- Loading State -->
    <div v-else class="loading-page">
      <Loader message="Chargement..." />
    </div>

    <!-- Stats Section -->
    <StatsSection 
      ref="statsRef"
      :statistiques="statistiques"
    />

    <!-- Services Section -->
    <ServicesSection 
      v-if="services.length"
            :services="services.slice(0, 3)"  
      :show-view-all="true"
    />

    <!-- Projects Section -->
    <ProjectsSection 
      v-if="projetsMisEnAvant.length"
      :projets="projetsMisEnAvant"
      badge="Portfolio"
      title="Projets récents"
      description="Découvrez mes dernières réalisations"
      :show-view-all="true"
    />

    <!-- Skills Section -->
    <SkillsSection 
      v-if="competences.length"
      :competences="competences"
       :skills-per-category="3" 
    />

    <!-- Testimonials Section -->
    <TestimonialsSection 
      v-if="temoignages.length"
      :temoignages="temoignages"
    />

    <!-- CTA Section -->
    <CtaSection 
      :message="infosPersonnelles?.message_disponibilite"
    />

    <!-- Error State -->
    <ErrorSection 
      v-if="erreur" 
      :message="erreur"
      @retry="chargerDonnees"
    />
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import axios from 'axios'

// Composants
import HeroSection from '../components/sections/HeroSection.vue'
import StatsSection from '../components/sections/StatsSection.vue'
import ServicesSection from '../components/sections/ServicesSection.vue'
import ProjectsSection from '../components/sections/ProjectsSection.vue'
import SkillsSection from '../components/sections/SkillsSection.vue'
import TestimonialsSection from '../components/sections/TestimonialsSection.vue'
import CtaSection from '../components/sections/CtaSection.vue'
import ErrorSection from '../components/sections/ErrorSection.vue'
import Loader from '../components/ui/Loader.vue'

// État
const chargement = ref(true)
const erreur = ref(null)
const infosPersonnelles = ref(null)
const projetsMisEnAvant = ref([])
const competences = ref([])
const temoignages = ref([])
const services = ref([])
const donnees = ref(null)
const statsRef = ref(null)

// Statistiques computed
const statistiques = computed(() => [
  {
    icon: '📁',
    value: donnees.value?.statistiques?.total_projets || 0,
    label: 'Projets Réalisés'
  },
  {
    icon: '⏱️',
    value: donnees.value?.statistiques?.annees_experience || 0,
    label: 'Années d\'Expérience'
  },
  {
    icon: '😊',
    value: donnees.value?.statistiques?.clients_satisfaits || 0,
    label: 'Clients Satisfaits'
  },
  {
    icon: '☕',
    value: 1247,
    label: 'Cafés Bus'
  }
])

// Réseaux sociaux computed
const reseauxSociaux = computed(() => {
  if (!infosPersonnelles.value) return []
  
  const reseaux = []
  const mapping = {
    github: { nom: 'GitHub', icon: 'GithubIcon' },
    linkedin: { nom: 'LinkedIn', icon: 'LinkedinIcon' },
    twitter: { nom: 'Twitter', icon: 'TwitterIcon' },
    instagram: { nom: 'Instagram', icon: 'InstagramIcon' },
    dribbble: { nom: 'Dribbble', icon: 'DribbbleIcon' },
    behance: { nom: 'Behance', icon: 'BehanceIcon' },
  }

  Object.keys(mapping).forEach(key => {
    if (infosPersonnelles.value[key]) {
      reseaux.push({
        nom: mapping[key].nom,
        url: infosPersonnelles.value[key],
        icon: mapping[key].icon
      })
    }
  })

  return reseaux
})

// Méthodes
const chargerDonnees = async () => {
  try {
    chargement.value = true
    erreur.value = null

    const response = await axios.get('/api/accueil')
    donnees.value = response.data

    infosPersonnelles.value = response.data.informations_personnelles
    projetsMisEnAvant.value = response.data.projets_mis_en_avant || []
    competences.value = response.data.competences || []
    temoignages.value = response.data.temoignages || []
    services.value = response.data.services || []

  } catch (err) {
    erreur.value = err.response?.data?.message || 'Erreur lors du chargement des données'
    console.error('Erreur:', err)
  } finally {
    chargement.value = false
  }
}

const scrollToStats = () => {
  statsRef.value?.$el.scrollIntoView({ behavior: 'smooth' })
}

onMounted(() => {
  chargerDonnees()
})
</script>

<style scoped>
.accueil {
  min-height: 100vh;
  overflow-x: hidden;
}

.loading-page {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>