<!-- resources/js/views/ArticleDetail.vue -->
<template>
  <div class="article-detail">
    <div class="container">
      <div v-if="chargement" class="loading-section">
        <Loader message="Chargement de l'article..." />
      </div>

      <div v-else-if="article" class="article-content">
        <Button tag="router-link" to="/blog" variant="ghost" class="back-button">
          ← Retour au blog
        </Button>

        <article class="article">
          <header class="article-header">
            <h1 class="article-title">{{ article.titre }}</h1>
            
            <div class="article-meta">
              <span class="article-date">{{ article.date_publication }}</span>
              <span class="article-reading-time">{{ article.temps_lecture }} min</span>
              <span class="article-categorie">{{ article.categorie }}</span>
            </div>

            <div class="article-tags">
              <span v-for="tag in article.tags" :key="tag" class="tag">
                {{ tag }}
              </span>
            </div>
          </header>

          <div class="article-image">
            <div class="image-placeholder">Image de l'article</div>
          </div>

          <div class="article-body">
            <div class="article-extrait">
              <p>{{ article.extrait }}</p>
            </div>

            <div class="article-contenu">
              <h2>Introduction</h2>
              <p>Ceci est un exemple de contenu d'article. Dans une application réelle, le contenu serait chargé depuis une base de données et pourrait inclure du HTML formaté.</p>
              
              <h3>Section détaillée</h3>
              <p>Contenu détaillé de l'article avec des explications techniques, des exemples de code, et des bonnes pratiques.</p>
              
              <h3>Conclusion</h3>
              <p>Résumé des points importants et perspectives futures sur le sujet traité.</p>
            </div>
          </div>

          <footer class="article-footer">
            <div class="article-actions">
              <Button variant="outline" @click="partagerArticle">
                Partager
              </Button>
            </div>
          </footer>
        </article>
      </div>

      <div v-else class="error-section">
        <h2>Article non trouvé</h2>
        <p>L'article que vous recherchez n'existe pas ou a été déplacé.</p>
        <Button tag="router-link" to="/blog" variant="primary">
          Voir tous les articles
        </Button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import Button from '../components/ui/Button.vue'
import Loader from '../components/ui/Loader.vue'

const route = useRoute()
const chargement = ref(true)
const article = ref(null)

const partagerArticle = () => {
  if (navigator.share) {
    navigator.share({
      title: article.value.titre,
      text: article.value.extrait,
      url: window.location.href
    })
  } else {
    // Fallback pour les navigateurs qui ne supportent pas l'API Share
    navigator.clipboard.writeText(window.location.href)
    alert('Lien copié dans le presse-papier !')
  }
}

onMounted(async () => {
  // Simulation de chargement
  setTimeout(() => {
    article.value = {
      id: 1,
      titre: 'Titre de l\'article exemple',
      extrait: 'Extrait de l\'article avec un contenu intéressant sur les technologies web modernes...',
      contenu: 'Contenu complet de l\'article...',
      date_publication: '15 Novembre 2024',
      temps_lecture: 5,
      categorie: 'Développement',
      tags: ['Vue.js', 'JavaScript', 'Frontend']
    }
    chargement.value = false
  }, 1000)
})
</script>

<style scoped>
.article-detail {
  padding: 2rem 0;
}

.back-button {
  margin-bottom: 2rem;
}

.article-header {
  text-align: center;
  margin-bottom: 3rem;
}

.article-title {
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 1rem;
  color: #1f2937;
  line-height: 1.2;
}

.article-meta {
  display: flex;
  gap: 1rem;
  justify-content: center;
  flex-wrap: wrap;
  margin-bottom: 1rem;
  color: #6b7280;
  font-size: 0.875rem;
}

.article-categorie {
  background: #10b981;
  color: white;
  padding: 0.25rem 0.75rem;
  border-radius: 0.5rem;
  font-weight: 500;
}

.article-tags {
  display: flex;
  gap: 0.5rem;
  justify-content: center;
  flex-wrap: wrap;
}

.tag {
  background: #e5e7eb;
  color: #4b5563;
  padding: 0.25rem 0.75rem;
  border-radius: 0.25rem;
  font-size: 0.75rem;
  font-weight: 500;
}

.article-image {
  width: 100%;
  height: 400px;
  background: linear-gradient(135deg, #10b981, #059669);
  border-radius: 1rem;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 1.5rem;
  font-weight: 600;
  margin-bottom: 3rem;
}

.article-body {
  max-width: 800px;
  margin: 0 auto;
}

.article-extrait {
  font-size: 1.125rem;
  color: #6b7280;
  line-height: 1.7;
  margin-bottom: 2rem;
  font-style: italic;
  border-left: 4px solid #3b82f6;
  padding-left: 1rem;
}

.article-contenu {
  line-height: 1.8;
  color: #374151;
}

.article-contenu h2 {
  font-size: 1.5rem;
  font-weight: 700;
  margin: 2rem 0 1rem;
  color: #1f2937;
}

.article-contenu h3 {
  font-size: 1.25rem;
  font-weight: 600;
  margin: 1.5rem 0 1rem;
  color: #374151;
}

.article-contenu p {
  margin-bottom: 1rem;
}

.article-footer {
  margin-top: 3rem;
  padding-top: 2rem;
  border-top: 1px solid #e5e7eb;
  text-align: center;
}

.article-actions {
  display: flex;
  gap: 1rem;
  justify-content: center;
}

.loading-section,
.error-section {
  text-align: center;
  padding: 4rem 0;
}

.error-section h2 {
  font-size: 2rem;
  margin-bottom: 1rem;
  color: #1f2937;
}

.error-section p {
  color: #6b7280;
  margin-bottom: 2rem;
}

/* Dark mode */
:global(.dark-mode) .article-title {
  color: #f1f5f9;
}

:global(.dark-mode) .article-meta {
  color: #94a3b8;
}

:global(.dark-mode) .tag {
  background: #374151;
  color: #cbd5e1;
}

:global(.dark-mode) .article-contenu {
  color: #cbd5e1;
}

:global(.dark-mode) .article-contenu h2 {
  color: #f1f5f9;
}

:global(.dark-mode) .article-contenu h3 {
  color: #e2e8f0;
}

:global(.dark-mode) .article-footer {
  border-top-color: #374151;
}

:global(.dark-mode) .error-section h2 {
  color: #f1f5f9;
}

:global(.dark-mode) .error-section p {
  color: #94a3b8;
}

@media (max-width: 768px) {
  .article-title {
    font-size: 2rem;
  }
  
  .article-image {
    height: 250px;
  }
  
  .article-meta {
    flex-direction: column;
    align-items: center;
  }
  
  .article-actions {
    flex-direction: column;
    align-items: center;
  }
}
</style>