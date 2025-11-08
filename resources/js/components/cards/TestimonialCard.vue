<!-- ========================================= -->
<!-- components/cards/TestimonialCard.vue -->
<!-- ========================================= -->

<template>
  <div class="testimonial-card">
    <div class="testimonial-content">
      <div class="quote-icon">❝</div>
      <p class="testimonial-text">{{ temoignage.contenu }}</p>
    </div>
    <div class="testimonial-author">
      <div class="author-info">
        <h4 class="author-name">{{ temoignage.nom_client }}</h4>
        <p class="author-position">{{ temoignage.poste_client }}</p>
        <p class="author-company" v-if="temoignage.entreprise">{{ temoignage.entreprise }}</p>
      </div>
      <div class="testimonial-rating" v-if="temoignage.note">
        <span v-for="i in 5" :key="i" class="star" :class="{ filled: i <= temoignage.note }">⭐</span>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  temoignage: {
    type: Object,
    required: true
  }
})
</script>

<style scoped>
.testimonial-card {
  min-width: 100%;
  padding: 3rem;
  background: white;
  border-radius: 16px;
  border: 1px solid #e5e7eb;
  box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
}

.testimonial-content {
  margin-bottom: 2rem;
}

.quote-icon {
  font-size: 4rem;
  color: #3b82f6;
  opacity: 0.2;
  margin-bottom: 1rem;
  line-height: 1;
}

.testimonial-text {
  font-size: 1.125rem;
  line-height: 1.8;
  color: #1f2937;
  font-style: italic;
}

.testimonial-author {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-top: 2rem;
  border-top: 1px solid #e5e7eb;
  gap: 2rem;
}

.author-info {
  flex: 1;
}

.author-name {
  font-size: 1.125rem;
  font-weight: 700;
  color: #1f2937;
  margin-bottom: 0.25rem;
}

.author-position {
  color: #6b7280;
  font-size: 0.875rem;
}

.author-company {
  color: #3b82f6;
  font-size: 0.875rem;
  font-weight: 600;
  margin-top: 0.25rem;
}

.testimonial-rating {
  display: flex;
  gap: 0.25rem;
}

.star {
  font-size: 1.25rem;
  opacity: 0.3;
}

.star.filled {
  opacity: 1;
}

/* Dark mode */
.dark-mode .testimonial-card {
  background: #1f2937;
  border-color: #374151;
}

.dark-mode .testimonial-text,
.dark-mode .author-name {
  color: #f9fafb;
}

.dark-mode .author-position {
  color: #d1d5db;
}

.dark-mode .author-company {
  color: #60a5fa;
}

.dark-mode .testimonial-author {
  border-top-color: #374151;
}

/* Responsive */
@media (max-width: 768px) {
  .testimonial-card {
    padding: 2rem;
  }

  .testimonial-author {
    flex-direction: column;
    align-items: flex-start;
    gap: 1rem;
  }

  .quote-icon {
    font-size: 3rem;
  }

  .testimonial-text {
    font-size: 1rem;
  }
}
</style>