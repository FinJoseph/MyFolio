<!-- resources/js/components/ui/Loader.vue -->
<template>
  <div class="loader-container">
    <div class="loader"></div>
    <p v-if="message" class="loader-message">{{ message }}</p>
  </div>
</template>

<script setup>
defineProps({
  message: {
    type: String,
    default: 'Chargement...'
  }
})
</script>

<style scoped>
.loader-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 3rem;
}

.loader {
  width: 48px;
  height: 48px;
  border: 4px solid #f3f4f6;
  border-top-color: #3b82f6;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

.loader-message {
  margin-top: 1rem;
  color: #6b7280;
  font-size: 0.875rem;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

:global(.dark-mode) .loader {
  border-color: #374151;
  border-top-color: #3b82f6;
}

:global(.dark-mode) .loader-message {
  color: #9ca3af;
}
</style>