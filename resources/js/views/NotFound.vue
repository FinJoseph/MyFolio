<!-- resources/js/views/NotFound.vue -->
<template>
  <div class="not-found">
    <div class="container">
      <div class="error-content">
        <h1 class="error-code">404</h1>
        <h2 class="error-title">Page non trouvée</h2>
        <p class="error-message">
          La page que vous recherchez n'existe pas ou a été déplacée.
        </p>
        <Button tag="router-link" to="/" variant="primary">
          Retour à l'accueil
        </Button>
      </div>
    </div>
  </div>
</template>

<script setup>
import Button from '../components/ui/Button.vue'
</script>

<style scoped>
.not-found {
  min-height: 80vh;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
}

.error-content {
  max-width: 500px;
  margin: 0 auto;
}

.error-code {
  font-size: 8rem;
  font-weight: 800;
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
background-clip: text; /* Propriété standard */
  color: transparent; /* Fallback pour les autres navigateurs */
  line-height: 1;
  margin-bottom: 1rem;
}

.error-title {
  font-size: 2rem;
  font-weight: 700;
  margin-bottom: 1rem;
  color: #1f2937;
}

.error-message {
  font-size: 1.125rem;
  color: #6b7280;
  margin-bottom: 2rem;
  line-height: 1.6;
}

/* Dark mode */
:global(.dark-mode) .error-title {
  color: #f1f5f9;
}

:global(.dark-mode) .error-message {
  color: #94a3b8;
}

@media (max-width: 768px) {
  .error-code {
    font-size: 6rem;
  }
  
  .error-title {
    font-size: 1.5rem;
  }
}
</style>