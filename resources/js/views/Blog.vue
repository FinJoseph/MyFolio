<!-- resources/js/views/Blog.vue -->
<template>
  <div class="blog">
    <div class="container">
      <div class="section-header">
        <h1 class="section-title">Blog</h1>
        <p class="section-subtitle">Articles sur le développement web, les bonnes pratiques et les nouvelles technologies</p>
      </div>

      <div class="articles-grid">
        <article 
          v-for="n in 6" 
          :key="n" 
          class="article-card"
          @click="$router.push(`/blog/article-${n}`)"
        >
          <div class="article-image">
            <div class="image-placeholder">Article {{ n }}</div>
          </div>
          <div class="article-content">
            <div class="article-meta">
              <span class="article-date">15 Nov 2024</span>
              <span class="article-reading-time">5 min</span>
            </div>
            <h3 class="article-title">Titre de l'article exemple {{ n }}</h3>
            <p class="article-excerpt">
              Extrait de l'article avec un contenu intéressant sur les technologies web modernes...
            </p>
            <div class="article-tags">
              <span class="tag">Vue.js</span>
              <span class="tag">JavaScript</span>
            </div>
          </div>
        </article>
      </div>
    </div>
  </div>
</template>

<script setup>
// À implémenter plus tard
</script>

<style scoped>
.blog {
  padding: 2rem 0;
}

.section-header {
  text-align: center;
  margin-bottom: 3rem;
}

.section-title {
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 1rem;
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
 background-clip: text; /* Propriété standard */
  color: transparent; /* Fallback pour les autres navigateurs */
}

.section-subtitle {
  font-size: 1.125rem;
  color: #6b7280;
  max-width: 600px;
  margin: 0 auto;
}

.articles-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
  gap: 2rem;
}

.article-card {
  background: white;
  border-radius: 1rem;
  overflow: hidden;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
  transition: all 0.3s;
  cursor: pointer;
}

.article-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

.article-image {
  width: 100%;
  height: 200px;
  background: linear-gradient(135deg, #10b981, #059669);
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 1.5rem;
  font-weight: 600;
}

.article-content {
  padding: 1.5rem;
}

.article-meta {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
  font-size: 0.875rem;
  color: #6b7280;
}

.article-title {
  font-size: 1.25rem;
  font-weight: 700;
  margin-bottom: 0.75rem;
  color: #1f2937;
  line-height: 1.4;
}

.article-excerpt {
  color: #6b7280;
  line-height: 1.6;
  margin-bottom: 1rem;
}

.article-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
}

.tag {
  padding: 0.25rem 0.75rem;
  background: #e5e7eb;
  border-radius: 0.25rem;
  font-size: 0.75rem;
  font-weight: 500;
  color: #4b5563;
}

/* Dark mode */
:global(.dark-mode) .article-card {
  background: #1e293b;
}

:global(.dark-mode) .article-title {
  color: #f1f5f9;
}

:global(.dark-mode) .article-excerpt {
  color: #94a3b8;
}

:global(.dark-mode) .tag {
  background: #334155;
  color: #cbd5e1;
}

@media (max-width: 768px) {
  .articles-grid {
    grid-template-columns: 1fr;
  }
  
  .section-title {
    font-size: 2rem;
  }
}
</style>