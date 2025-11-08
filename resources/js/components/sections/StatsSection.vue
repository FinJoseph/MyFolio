<!-- components/sections/StatsSection.vue -->
<template>
  <section class="stats-section" ref="statsRef">
    <div class="stats-background">
      <div class="gradient-overlay"></div>
      <div class="particles-stats" v-if="showParticles">
        <div v-for="i in particleCount" :key="i" class="particle" :style="getParticleStyle(i)"></div>
      </div>
    </div>
    
    <div class="container">
      <div class="stats-grid">
        <StatCard 
          v-for="stat in statistiques" 
          :key="stat.label"
          :stat="stat"
          :animated="animated"
        />
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import StatCard from '../cards/StatCard.vue'

const props = defineProps({
  statistiques: {
    type: Array,
    required: true
  },
  animated: {
    type: Boolean,
    default: true
  },
  showParticles: {
    type: Boolean,
    default: true
  },
  particleCount: {
    type: Number,
    default: 20
  }
})

const statsRef = ref(null)
let observer = null

const getParticleStyle = (index) => {
  return {
    width: Math.random() * 3 + 1 + 'px',
    height: Math.random() * 3 + 1 + 'px',
    left: Math.random() * 100 + '%',
    top: Math.random() * 100 + '%',
    animationDelay: Math.random() * 5 + 's',
    animationDuration: Math.random() * 8 + 8 + 's'
  }
}

onMounted(() => {
  if (!props.animated) return

  // Intersection Observer pour déclencher l'animation
  observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const counters = entry.target.querySelectorAll('.stat-number')
        counters.forEach(counter => {
          animateCounter(counter)
        })
        observer.unobserve(entry.target)
      }
    })
  }, { threshold: 0.5 })

  if (statsRef.value) {
    observer.observe(statsRef.value)
  }
})

const animateCounter = (element) => {
  const target = parseInt(element.dataset.target)
  const duration = 2000
  const increment = target / (duration / 16)
  let current = 0

  const updateCounter = () => {
    current += increment
    if (current < target) {
      element.textContent = Math.floor(current)
      requestAnimationFrame(updateCounter)
    } else {
      element.textContent = target
    }
  }

  updateCounter()
}

onUnmounted(() => {
  if (observer) {
    observer.disconnect()
  }
})
</script>

<style scoped>
.stats-section {
  position: relative;
  padding: 5rem 0;
  overflow: hidden;
}

.stats-background {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: -1;
}

.gradient-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, 
    rgba(59, 130, 246, 0.03) 0%,
    rgba(139, 92, 246, 0.03) 100%);
}

.particles-stats {
  position: absolute;
  inset: 0;
  overflow: hidden;
}

.particle {
  position: absolute;
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  border-radius: 50%;
  opacity: 0.2;
  animation: float-particle linear infinite;
}

@keyframes float-particle {
  0% {
    transform: translateY(0) scale(1);
    opacity: 0;
  }
  10% {
    opacity: 0.2;
  }
  90% {
    opacity: 0.2;
  }
  100% {
    transform: translateY(-100vh) scale(0.5);
    opacity: 0;
  }
}

.container {
  max-width: 1400px;
  margin: 0 auto;
  padding: 0 clamp(1.5rem, 4vw, 3rem);
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 2.5rem;
}

/* Dark mode */
.dark-mode .gradient-overlay {
  background: linear-gradient(135deg, 
    rgba(59, 130, 246, 0.02) 0%,
    rgba(139, 92, 246, 0.02) 100%);
}

/* Responsive */
@media (max-width: 1024px) {
  .stats-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 2rem;
  }
}

@media (max-width: 768px) {
  .stats-section {
    padding: 4rem 0;
  }

  .stats-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
  }
}

@media (max-width: 480px) {
  .stats-grid {
    grid-template-columns: 1fr;
    gap: 1.5rem;
  }
  
  .stats-section {
    padding: 3rem 0;
  }
}

/* Performance */
@media (prefers-reduced-motion: reduce) {
  .particle {
    animation: none !important;
  }
}
</style>