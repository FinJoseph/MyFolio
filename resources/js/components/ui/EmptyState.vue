<!-- components/ui/EmptyState.vue -->
<template>
  <div class="empty-state">
    <div class="empty-content">
      <div class="empty-icon">
        <slot name="icon">
          <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          </svg>
        </slot>
      </div>
      
      <h3 class="empty-title">{{ title }}</h3>
      <p class="empty-description">{{ description }}</p>
      
      <div class="empty-actions" v-if="actionText || $slots.actions">
        <slot name="actions">
          <Button 
            :variant="actionVariant" 
            :size="actionSize"
            @click="$emit('action')"
          >
            {{ actionText }}
          </Button>
        </slot>
      </div>
    </div>
  </div>
</template>

<script setup>
import Button from './Button.vue'

defineProps({
  title: {
    type: String,
    default: 'Aucun résultat'
  },
  description: {
    type: String,
    default: 'Aucun élément ne correspond à vos critères.'
  },
  actionText: {
    type: String,
    default: ''
  },
  actionVariant: {
    type: String,
    default: 'primary'
  },
  actionSize: {
    type: String,
    default: 'medium'
  }
})

defineEmits(['action'])
</script>

<style scoped>
.empty-state {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 4rem 2rem;
  text-align: center;
}

.empty-content {
  max-width: 400px;
  margin: 0 auto;
}

.empty-icon {
  margin-bottom: 1.5rem;
  color: #9ca3af;
}

.empty-title {
  font-size: 1.5rem;
  font-weight: 600;
  color: #374151;
  margin-bottom: 0.5rem;
}

.empty-description {
  color: #6b7280;
  margin-bottom: 2rem;
  line-height: 1.6;
}

.empty-actions {
  display: flex;
  gap: 1rem;
  justify-content: center;
  flex-wrap: wrap;
}

/* Dark mode */
.dark-mode .empty-title {
  color: #f9fafb;
}

.dark-mode .empty-description {
  color: #d1d5db;
}

.dark-mode .empty-icon {
  color: #6b7280;
}

/* Responsive */
@media (max-width: 768px) {
  .empty-state {
    padding: 3rem 1rem;
  }
  
  .empty-actions {
    flex-direction: column;
    align-items: center;
  }
  
  .empty-actions :deep(.btn) {
    width: 100%;
    max-width: 300px;
  }
}
</style>