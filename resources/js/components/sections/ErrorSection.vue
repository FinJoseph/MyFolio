<!-- components/sections/ErrorSection.vue -->
<template>
  <section class="error-section">
    <div class="container">
      <div class="error-content">
        <span class="error-icon">{{ icon }}</span>
        <h3 class="error-title">{{ title }}</h3>
        <p class="error-message">{{ message }}</p>
        <div class="error-actions">
          <Button @click="$emit('retry')" variant="primary">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <polyline points="23 4 23 10 17 10"></polyline>
              <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path>
            </svg>
            {{ retryText }}
          </Button>
          <Button 
            v-if="showHome"
            tag="router-link" 
            to="/" 
            variant="outline"
          >
            {{ homeText }}
          </Button>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import Button from '../ui/Button.vue'

defineProps({
  icon: {
    type: String,
    default: '⚠️'
  },
  title: {
    type: String,
    default: 'Erreur de chargement'
  },
  message: {
    type: String,
    required: true
  },
  retryText: {
    type: String,
    default: 'Réessayer'
  },
  homeText: {
    type: String,
    default: 'Retour à l\'accueil'
  },
  showHome: {
    type: Boolean,
    default: false
  }
})

defineEmits(['retry'])
</script>

<style scoped>
.error-section {
  padding: 4rem 0;
  min-height: 50vh;
  display: flex;
  align-items: center;
  justify-content: center;
}

.container {
  max-width: 600px;
  margin: 0 auto;
  padding: 0 clamp(1.5rem, 4vw, 3rem);
}

.error-content {
  text-align: center;
  padding: 3rem;
  background: white;
  border-radius: 16px;
  border: 1px solid #e5e7eb;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
}

.error-icon {
  font-size: 4rem;
  margin-bottom: 1.5rem;
  display: block;
  animation: bounce 2s ease-in-out infinite;
}

@keyframes bounce {
  0%, 100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-10px);
  }
}

.error-title {
  font-size: 1.5rem;
  font-weight: 700;
  color: #1f2937;
  margin-bottom: 1rem;
}

.error-message {
  color: #6b7280;
  line-height: 1.7;
  margin-bottom: 2rem;
  font-size: 1rem;
}

.error-actions {
  display: flex;
  justify-content: center;
  gap: 1rem;
  flex-wrap: wrap;
}

/* Dark mode */
.dark-mode .error-content {
  background: #1f2937;
  border-color: #374151;
}

.dark-mode .error-title {
  color: #f9fafb;
}

.dark-mode .error-message {
  color: #d1d5db;
}

/* Responsive */
@media (max-width: 768px) {
  .error-section {
    padding: 3rem 0;
  }

  .error-content {
    padding: 2rem;
  }

  .error-icon {
    font-size: 3rem;
  }

  .error-title {
    font-size: 1.25rem;
  }

  .error-actions {
    flex-direction: column;
    width: 100%;
  }
}

@media (max-width: 480px) {
  .error-content {
    padding: 1.5rem;
  }
}

/* Performance */
@media (prefers-reduced-motion: reduce) {
  .error-icon {
    animation: none;
  }
}
</style>