<template>
  <div id="app" :class="{ 'dark-mode': isDarkMode }">
    <Header 
      :is-dark-mode="isDarkMode" 
      @toggle-dark-mode="toggleDarkMode" 
    />
    <main class="main-content">
      <router-view />
    </main>
    <Footer />
    <ScrollToTop />
    <Loader v-if="loadingStore.isLoading" :message="loadingStore.loadingMessage" />
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue'
import { useLoadingStore } from './stores/loading'
import Header from './components/layout/Header.vue'
import Footer from './components/layout/Footer.vue'
import ScrollToTop from './components/ui/ScrollToTop.vue'
import Loader from './components/ui/Loader.vue'

const isDarkMode = ref(false)
const loadingStore = useLoadingStore()

// Gestion du thème
const toggleDarkMode = () => {
  isDarkMode.value = !isDarkMode.value
  localStorage.setItem('darkMode', isDarkMode.value)
  updateThemeClass()
}

// Mettre à jour la classe sur le body
const updateThemeClass = () => {
  if (isDarkMode.value) {
    document.body.classList.add('dark-mode')
  } else {
    document.body.classList.remove('dark-mode')
  }
}

// Charger la préférence de thème
onMounted(() => {
  const savedTheme = localStorage.getItem('darkMode')
  if (savedTheme !== null) {
    isDarkMode.value = JSON.parse(savedTheme)
  } else {
    // Auto-détection de la préférence système
    isDarkMode.value = window.matchMedia('(prefers-color-scheme: dark)').matches
  }
  updateThemeClass()
})

// Surveiller les changements de thème
watch(isDarkMode, updateThemeClass)
</script>

<style scoped>
#app {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

.main-content {
  flex: 1;
  padding-top: 70px;
}
</style>