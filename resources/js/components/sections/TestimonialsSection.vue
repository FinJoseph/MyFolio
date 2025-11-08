<!-- components/sections/TestimonialsSection.vue -->
<template>
  <section class="testimonials-section">
    <div class="container">
      <div class="section-header" v-if="showHeader">
        <span class="section-badge">{{ badge }}</span>
        <h2 class="section-title">{{ title }}</h2>
        <p class="section-description" v-if="description">{{ description }}</p>
      </div>

      <div class="testimonials-slider">
        <div class="testimonials-track" :style="{ transform: `translateX(-${currentIndex * 100}%)` }">
          <TestimonialCard 
            v-for="temoignage in temoignages" 
            :key="temoignage.id"
            :temoignage="temoignage"
          />
        </div>

        <div class="slider-controls" v-if="temoignages.length > 1 && showControls">
          <button @click="prev" class="slider-btn" aria-label="Précédent">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
          </button>
          <button @click="next" class="slider-btn" aria-label="Suivant">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
          </button>
        </div>

        <div class="slider-dots" v-if="temoignages.length > 1">
          <button 
            v-for="(_, index) in temoignages" 
            :key="index"
            @click="currentIndex = index"
            class="dot"
            :class="{ active: currentIndex === index }"
            :aria-label="`Témoignage ${index + 1}`"
          ></button>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import TestimonialCard from '../cards/TestimonialCard.vue'

const props = defineProps({
  temoignages: {
    type: Array,
    required: true
  },
  badge: {
    type: String,
    default: 'Témoignages'
  },
  title: {
    type: String,
    default: 'Ce qu\'ils disent'
  },
  description: {
    type: String,
    default: ''
  },
  showHeader: {
    type: Boolean,
    default: true
  },
  showControls: {
    type: Boolean,
    default: true
  },
  autoplay: {
    type: Boolean,
    default: true
  },
  autoplayDelay: {
    type: Number,
    default: 5000
  }
})

const currentIndex = ref(0)
let autoplayInterval = null

const next = () => {
  currentIndex.value = (currentIndex.value + 1) % props.temoignages.length
}

const prev = () => {
  currentIndex.value = currentIndex.value === 0 
    ? props.temoignages.length - 1 
    : currentIndex.value - 1
}

onMounted(() => {
  if (props.autoplay && props.temoignages.length > 1) {
    autoplayInterval = setInterval(next, props.autoplayDelay)
  }
})

onUnmounted(() => {
  if (autoplayInterval) {
    clearInterval(autoplayInterval)
  }
})
</script>

<style scoped>
.testimonials-section {
  padding: 5rem 0;
}

.container {
  max-width: 1400px;
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

.testimonials-slider {
  position: relative;
  max-width: 900px;
  margin: 0 auto;
  overflow: hidden;
}

.testimonials-track {
  display: flex;
  transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.slider-controls {
  position: absolute;
  top: 50%;
  width: 100%;
  display: flex;
  justify-content: space-between;
  transform: translateY(-50%);
  pointer-events: none;
  z-index: 10;
}

.slider-btn {
  pointer-events: all;
  width: 48px;
  height: 48px;
  border-radius: 50%;
  background: white;
  border: 1px solid #e5e7eb;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s;
  color: #1f2937;
}

.slider-btn:hover {
  background: #3b82f6;
  color: white;
  border-color: #3b82f6;
  transform: scale(1.1);
}

.slider-dots {
  display: flex;
  justify-content: center;
  gap: 0.75rem;
  margin-top: 2rem;
}

.dot {
  width: 10px;
  height: 10px;
  border-radius: 50%;
  background: #e5e7eb;
  border: none;
  cursor: pointer;
  transition: all 0.3s;
  padding: 0;
}

.dot:hover {
  background: #cbd5e1;
}

.dot.active {
  background: #3b82f6;
  width: 30px;
  border-radius: 5px;
}

/* Dark mode */
.dark-mode .section-title {
  color: #f9fafb;
}

.dark-mode .section-description {
  color: #d1d5db;
}

.dark-mode .slider-btn {
  background: #1f2937;
  border-color: #374151;
  color: #f9fafb;
}

.dark-mode .slider-btn:hover {
  background: #3b82f6;
  color: white;
}

.dark-mode .dot {
  background: #374151;
}

.dark-mode .dot.active {
  background: #60a5fa;
}

/* Responsive */
@media (max-width: 768px) {
  .testimonials-section {
    padding: 3rem 0;
  }

  .section-header {
    margin-bottom: 3rem;
  }

  .slider-controls {
    display: none;
  }
}
</style>

