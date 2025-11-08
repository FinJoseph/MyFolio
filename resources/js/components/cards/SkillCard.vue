<template>
  <div class="skill-card" :style="{ '--skill-color': competence.couleur || '#3b82f6' }">
    <div class="skill-content">
      <div class="skill-header">
        <span class="skill-icon" v-html="competence.icone"></span>
        <span class="skill-name">{{ competence.nom }}</span>
        <span class="skill-level">{{ competence.niveau }}%</span>
      </div>
      
      <div class="skill-bar">
        <div 
          class="skill-progress" 
          :style="{ width: (animated ? competence.niveau : 0) + '%' }"
        ></div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const props = defineProps({
  competence: {
    type: Object,
    required: true
  }
})

const animated = ref(false)

onMounted(() => {
  setTimeout(() => {
    animated.value = true
  }, 100)
})
</script>

<style scoped>
.skill-card {
  --skill-color: #3b82f6;
  background: rgba(255, 255, 255, 0.8);
  backdrop-filter: blur(15px);
  border: 1px solid rgba(255, 255, 255, 0.3);
  border-radius: 12px;
  padding: 1.25rem;
  transition: all 0.3s ease;
}

.skill-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.skill-header {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin-bottom: 1rem;
}

.skill-icon {
  font-size: 1.5rem;
  display: flex;
  align-items: center;
}

.skill-name {
  font-weight: 600;
  color: #1f2937;
  flex: 1;
  font-size: 0.95rem;
}

.skill-level {
  font-weight: 700;
  color: var(--skill-color);
  font-size: 0.875rem;
}

.skill-bar {
  height: 6px;
  background: #f3f4f6;
  border-radius: 50px;
  overflow: hidden;
}

.skill-progress {
  height: 100%;
  background: linear-gradient(90deg, var(--skill-color), #8b5cf6);
  border-radius: 50px;
  transition: width 1s ease;
}

/* Dark mode */
.dark-mode .skill-card {
  background: rgba(15, 23, 42, 0.8);
  border-color: rgba(255, 255, 255, 0.1);
}

.dark-mode .skill-name {
  color: #f9fafb;
}

.dark-mode .skill-bar {
  background: #374151;
}

/* Responsive */
@media (max-width: 768px) {
  .skill-card {
    padding: 1rem;
  }
  
  .skill-header {
    gap: 0.75rem;
  }
  
  .skill-icon {
    font-size: 1.25rem;
  }
}

/* Performance */
@media (prefers-reduced-motion: reduce) {
  .skill-progress {
    transition: none;
  }
}
</style>