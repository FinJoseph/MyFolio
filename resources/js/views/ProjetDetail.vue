<template>
  <div class="projet-detail">
    <!-- Loading State -->
    <div v-if="chargement" class="loading-page">
      <Loader message="Chargement du projet..." />
    </div>

    <!-- Error State -->
    <div v-else-if="!projet" class="error-state">
      <div class="error-content">
        <h2>Projet non trouvé</h2>
        <p>Le projet que vous recherchez n'existe pas ou a été déplacé.</p>
        <Button @click="$router.push('/projets')" variant="primary">
          Retour aux projets
        </Button>
      </div>
    </div>

    <!-- Content -->
    <div v-else class="projet-content">
      <!-- Navigation -->
      <nav class="projet-nav">
        <div class="container">
          <Button 
            tag="router-link" 
            to="/projets" 
            variant="ghost" 
            class="back-button"
          >
            <span class="btn-icon">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
              </svg>
            </span>
            Retour
          </Button>
        </div>
      </nav>

      <!-- Hero Section -->
      <section class="projet-hero">
        <div class="container">
          <div class="hero-content">
            <!-- Image principale -->
            <div class="hero-image">
              <div class="image-container">
                <img 
                  v-if="projet.image" 
                  :src="projet.image" 
                  :alt="projet.titre"
                  class="project-image"
                  @click="openImageModal"
                />
                <div v-else class="image-placeholder">
                  <div class="placeholder-content">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                      <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                      <circle cx="8.5" cy="8.5" r="1.5"></circle>
                      <polyline points="21 15 16 10 5 21"></polyline>
                    </svg>
                  </div>
                </div>
              </div>
            </div>

            <!-- Informations du projet -->
            <div class="hero-info">
              <div class="project-header">
                <div class="project-badge">
                  <span class="badge-dot"></span>
                  <span class="badge-text">{{ projet.statut || 'Complété' }}</span>
                </div>
                <h1 class="project-title">{{ projet.titre }}</h1>
                <p class="project-description">{{ projet.description }}</p>
              </div>

              <!-- Métadonnées -->
              <div class="project-meta">
                <div class="meta-item">
                  <span class="meta-label">Catégorie</span>
                  <span class="meta-value">{{ projet.categorie }}</span>
                </div>
                <div class="meta-item">
                  <span class="meta-label">Date</span>
                  <span class="meta-value">{{ formatDate(projet.date_projet) }}</span>
                </div>
                <div class="meta-item" v-if="projet.duree">
                  <span class="meta-label">Durée</span>
                  <span class="meta-value">{{ projet.duree }}</span>
                </div>
                <div class="meta-item" v-if="projet.client">
                  <span class="meta-label">Client</span>
                  <span class="meta-value">{{ projet.client }}</span>
                </div>
              </div>

              <!-- Actions -->
              <div class="project-actions">
                <Button 
                  v-if="projet.url_projet" 
                  :href="projet.url_projet" 
                  target="_blank" 
                  variant="primary"
                  class="action-btn"
                >
                  <span class="btn-icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                      <polyline points="15 3 21 3 21 9"></polyline>
                      <line x1="10" y1="14" x2="21" y2="3"></line>
                    </svg>
                  </span>
                  Voir le projet
                </Button>
                
                <Button 
                  v-if="projet.url_github" 
                  :href="projet.url_github" 
                  target="_blank" 
                  variant="outline"
                  class="action-btn"
                >
                  <span class="btn-icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path>
                    </svg>
                  </span>
                  Code Source
                </Button>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Main Content -->
      <div class="projet-main">
        <div class="container">
          <!-- Technologies -->
          <section class="content-section" v-if="projet.technologies && projet.technologies.length">
            <h2 class="section-title">Technologies utilisées</h2>
            <div class="tech-list">
              <span 
                v-for="tech in projet.technologies" 
                :key="tech"
                class="tech-tag"
              >
                {{ tech }}
              </span>
            </div>
          </section>

          <!-- Fonctionnalités -->
          <section class="content-section" v-if="projet.fonctionnalites && projet.fonctionnalites.length">
            <h2 class="section-title">Fonctionnalités principales</h2>
            <div class="features-list">
              <div 
                v-for="(feature, index) in projet.fonctionnalites" 
                :key="index"
                class="feature-item"
              >
                <span class="feature-icon">✓</span>
                <span class="feature-text">{{ feature }}</span>
              </div>
            </div>
          </section>

          <!-- Contenu détaillé -->
          <section class="content-section" v-if="projet.contenu">
            <h2 class="section-title">À propos du projet</h2>
            <div class="content-text" v-html="projet.contenu"></div>
          </section>

          <!-- Galerie -->
          <section class="content-section" v-if="projet.galerie && projet.galerie.length">
            <h2 class="section-title">Galerie</h2>
            <div class="gallery-grid">
              <div 
                v-for="(image, index) in projet.galerie" 
                :key="index"
                class="gallery-item"
                @click="openGalleryModal(index)"
              >
                <img 
                  v-if="typeof image === 'string'" 
                  :src="image" 
                  :alt="`Image ${index + 1} du projet ${projet.titre}`"
                  class="gallery-image"
                />
              </div>
            </div>
          </section>

          <!-- Témoignages -->
          <section class="content-section" v-if="projet.temoignages && projet.temoignages.length">
            <h2 class="section-title">Témoignages</h2>
            <div class="testimonials-list">
              <div 
                v-for="temoignage in projet.temoignages" 
                :key="temoignage.id"
                class="testimonial-item"
              >
                <p class="testimonial-text">"{{ temoignage.contenu }}"</p>
                <div class="testimonial-author">
                  <strong>{{ temoignage.auteur }}</strong>
                  <span v-if="temoignage.role"> - {{ temoignage.role }}</span>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>

      <!-- Image Modal -->
      <div v-if="showImageModal" class="image-modal" @click="closeImageModal">
        <div class="modal-content" @click.stop>
          <button class="close-modal" @click="closeImageModal">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <line x1="18" y1="6" x2="6" y2="18"></line>
              <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
          </button>
          <img v-if="projet.image" :src="projet.image" :alt="projet.titre" class="modal-image" />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import axios from 'axios'
import Button from '../components/ui/Button.vue'
import Loader from '../components/ui/Loader.vue'

const route = useRoute()
const chargement = ref(true)
const projet = ref(null)
const showImageModal = ref(false)

const formatDate = (dateString) => {
  if (!dateString) return 'Non spécifiée'
  const date = new Date(dateString)
  return date.toLocaleDateString('fr-FR', {
    year: 'numeric',
    month: 'long'
  })
}

const openImageModal = () => {
  if (projet.value?.image) {
    showImageModal.value = true
  }
}

const closeImageModal = () => {
  showImageModal.value = false
}

const openGalleryModal = (index) => {
  // Implémentation basique - à étendre selon les besoins
  console.log('Ouvrir image galerie:', index)
}

// Charger les données du projet
const chargerProjet = async () => {
  try {
    chargement.value = true
    const slug = route.params.slug
    const response = await axios.get(`/api/projets/${slug}`)
    projet.value = response.data
  } catch (err) {
    console.error('Erreur lors du chargement du projet:', err)
    projet.value = null
  } finally {
    chargement.value = false
  }
}

onMounted(() => {
  chargerProjet()
})
</script>

<style scoped>
.projet-detail {
  min-height: 100vh;
  overflow-x: hidden;
}

.loading-page {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 clamp(1.5rem, 4vw, 3rem);
}

/* Navigation */
.projet-nav {
  background: rgba(255, 255, 255, 0.8);
  backdrop-filter: blur(10px);
  border-bottom: 1px solid rgba(255, 255, 255, 0.3);
  position: sticky;
  top: 0;
  z-index: 100;
  padding: 1rem 0;
}

.back-button {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
}

.btn-icon {
  display: flex;
  align-items: center;
}

/* Hero Section */
.projet-hero {
  padding: 3rem 0;
  position: relative;
}

.projet-hero::before {
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

.hero-content {
  display: grid;
  grid-template-columns: 1fr;
  gap: 3rem;
}

.hero-image {
  order: 1;
}

.image-container {
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
  background: white;
  cursor: pointer;
  transition: transform 0.3s ease;
}

.image-container:hover {
  transform: translateY(-4px);
}

.project-image {
  width: 100%;
  height: 300px;
  object-fit: cover;
}

.image-placeholder {
  width: 100%;
  height: 300px;
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
}

.hero-info {
  order: 2;
  display: flex;
  flex-direction: column;
  gap: 2rem;
}

.project-header {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.project-badge {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 1rem;
  background: rgba(34, 197, 94, 0.1);
  color: #16a34a;
  border-radius: 50px;
  font-size: 0.875rem;
  font-weight: 600;
  width: fit-content;
}

.badge-dot {
  width: 8px;
  height: 8px;
  background: #16a34a;
  border-radius: 50%;
  animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.5; }
}

.project-title {
  font-size: 2.5rem;
  font-weight: 800;
  line-height: 1.2;
  color: #1f2937;
  margin: 0;
}

.project-description {
  font-size: 1.25rem;
  line-height: 1.6;
  color: #6b7280;
  margin: 0;
}

.project-meta {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 1.5rem;
  padding: 1.5rem;
  background: rgba(255, 255, 255, 0.8);
  backdrop-filter: blur(15px);
  border: 1px solid rgba(255, 255, 255, 0.3);
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}

.meta-item {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.meta-label {
  font-size: 0.875rem;
  font-weight: 600;
  color: #6b7280;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

.meta-value {
  font-size: 1.125rem;
  font-weight: 700;
  color: #1f2937;
}

.project-actions {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
}

.action-btn {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
}

/* Main Content */
.projet-main {
  padding: 3rem 0;
}

.content-section {
  margin-bottom: 4rem;
}

.section-title {
  font-size: 1.75rem;
  font-weight: 700;
  color: #1f2937;
  margin-bottom: 1.5rem;
  padding-bottom: 0.5rem;
  border-bottom: 2px solid #e5e7eb;
}

/* Technologies */
.tech-list {
  display: flex;
  flex-wrap: wrap;
  gap: 0.75rem;
}

.tech-tag {
  padding: 0.5rem 1rem;
  background: rgba(255, 255, 255, 0.8);
  backdrop-filter: blur(15px);
  color: #1f2937;
  border: 1px solid rgba(255, 255, 255, 0.3);
  border-radius: 50px;
  font-size: 0.875rem;
  font-weight: 500;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

/* Features */
.features-list {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.feature-item {
  display: flex;
  align-items: flex-start;
  gap: 1rem;
  padding: 1rem;
  background: rgba(255, 255, 255, 0.8);
  backdrop-filter: blur(15px);
  border: 1px solid rgba(255, 255, 255, 0.3);
  border-radius: 8px;
  border-left: 4px solid #16a34a;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.feature-icon {
  color: #16a34a;
  font-weight: bold;
  flex-shrink: 0;
  margin-top: 0.125rem;
}

.feature-text {
  color: #4b5563;
  line-height: 1.6;
}

/* Content */
.content-text {
  line-height: 1.8;
  color: #4b5563;
}

.content-text :deep(h3) {
  color: #1f2937;
  margin: 2rem 0 1rem;
  font-size: 1.25rem;
  font-weight: 600;
}

.content-text :deep(p) {
  margin-bottom: 1.5rem;
}

.content-text :deep(ul), 
.content-text :deep(ol) {
  margin-bottom: 1.5rem;
  padding-left: 1.5rem;
}

.content-text :deep(li) {
  margin-bottom: 0.5rem;
}

/* Gallery */
.gallery-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 1rem;
}

.gallery-item {
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  cursor: pointer;
  transition: transform 0.3s ease;
  background: white;
}

.gallery-item:hover {
  transform: translateY(-4px);
}

.gallery-image {
  width: 100%;
  height: 200px;
  object-fit: cover;
}

/* Testimonials */
.testimonials-list {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.testimonial-item {
  padding: 1.5rem;
  background: rgba(255, 255, 255, 0.8);
  backdrop-filter: blur(15px);
  border: 1px solid rgba(255, 255, 255, 0.3);
  border-radius: 12px;
  border-left: 4px solid #3b82f6;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}

.testimonial-text {
  font-style: italic;
  line-height: 1.6;
  color: #4b5563;
  margin-bottom: 1rem;
}

.testimonial-author {
  color: #6b7280;
  font-size: 0.875rem;
}

/* Error State */
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
  background: #fef2f2;
  border-radius: 12px;
  margin: 2rem auto;
}

.error-content h2 {
  color: #dc2626;
  margin-bottom: 1rem;
}

.error-content p {
  color: #6b7280;
  margin-bottom: 2rem;
}

/* Image Modal */
.image-modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.8);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
  padding: 1rem;
}

.modal-content {
  position: relative;
  max-width: 90%;
  max-height: 90%;
}

.close-modal {
  position: absolute;
  top: -50px;
  right: 0;
  background: white;
  border: none;
  border-radius: 50%;
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  color: #000;
}

.modal-image {
  max-width: 100%;
  max-height: 80vh;
  object-fit: contain;
  border-radius: 8px;
}

/* Responsive */
@media (min-width: 768px) {
  .container {
    padding: 0 2rem;
  }

  .hero-content {
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: start;
  }

  .hero-image {
    order: 2;
  }

  .hero-info {
    order: 1;
  }

  .project-title {
    font-size: 3rem;
  }

  .gallery-grid {
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
  }
}

@media (min-width: 1024px) {
  .projet-hero {
    padding: 4rem 0;
  }

  .projet-main {
    padding: 4rem 0;
  }

  .project-meta {
    grid-template-columns: repeat(2, 1fr);
  }
}

/* Dark mode */
.dark-mode .projet-nav {
  background: rgba(15, 23, 42, 0.8);
  border-bottom-color: rgba(255, 255, 255, 0.1);
}

.dark-mode .projet-hero::before {
  background: linear-gradient(135deg, 
    rgba(59, 130, 246, 0.03) 0%,
    rgba(139, 92, 246, 0.03) 100%);
}

.dark-mode .image-container {
  background: #1e293b;
}

.dark-mode .project-title {
  color: #f9fafb;
}

.dark-mode .project-description {
  color: #d1d5db;
}

.dark-mode .project-meta {
  background: rgba(15, 23, 42, 0.8);
  border-color: rgba(255, 255, 255, 0.1);
}

.dark-mode .meta-value {
  color: #f9fafb;
}

.dark-mode .section-title {
  color: #f9fafb;
  border-bottom-color: #374151;
}

.dark-mode .tech-tag {
  background: rgba(15, 23, 42, 0.8);
  border-color: rgba(255, 255, 255, 0.1);
  color: #f9fafb;
}

.dark-mode .feature-item {
  background: rgba(15, 23, 42, 0.8);
  border-color: rgba(255, 255, 255, 0.1);
}

.dark-mode .feature-text {
  color: #d1d5db;
}

.dark-mode .content-text {
  color: #d1d5db;
}

.dark-mode .content-text :deep(h3) {
  color: #f9fafb;
}

.dark-mode .gallery-item {
  background: #1e293b;
}

.dark-mode .testimonial-item {
  background: rgba(15, 23, 42, 0.8);
  border-color: rgba(255, 255, 255, 0.1);
}

.dark-mode .testimonial-text {
  color: #d1d5db;
}

.dark-mode .testimonial-author {
  color: #9ca3af;
}

.dark-mode .error-content {
  background: #1f2937;
  border: 1px solid #374151;
}

.dark-mode .error-content h2 {
  color: #fca5a5;
}

.dark-mode .error-content p {
  color: #d1d5db;
}

/* Animations */
.projet-main {
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
  .projet-main {
    animation: none;
  }
  
  .badge-dot {
    animation: none;
  }
  
  .image-container,
  .gallery-item {
    transition: none;
  }
}
</style>