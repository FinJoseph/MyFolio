<template>
  <section class="projects-hero" ref="heroRef">
    <div class="hero-background">
      <div class="gradient-overlay"></div>
      <div class="particles-hero" v-if="showParticles">
        <div v-for="i in particleCount" :key="i" class="particle" :style="getParticleStyle(i)"></div>
      </div>
    </div>

    <div class="container">
      <div class="hero-content">
        <!-- Illustration Portfolio - À GAUCHE -->
        <div class="portfolio-illustration" @mouseenter="isIllustrationHovered = true" @mouseleave="isIllustrationHovered = false">
          <div class="illustration-wrapper" :class="{ 'illustration-hover': isIllustrationHovered }">
            <div class="code-window">
              <div class="window-header">
                <div class="window-dots">
                  <span class="dot red"></span>
                  <span class="dot yellow"></span>
                  <span class="dot green"></span>
                </div>
                <span class="window-title">portfolio.js</span>
              </div>
              <div class="code-content">
                <div class="code-line">
                  <span class="code-keyword">const</span>
                  <span class="code-variable"> portfolio</span>
                  <span class="code-operator"> =</span>
                  <span class="code-bracket"> {</span>
                </div>
                <div class="code-line">
                  <span class="code-property">  projets:</span>
                  <span class="code-number"> {{ statistiques[0]?.value || 0 }}+</span>
                  <span class="code-comment">,</span>
                </div>
                <div class="code-line">
                  <span class="code-property">  technologies:</span>
                  <span class="code-number"> {{ statistiques[2]?.value || 0 }}+</span>
                  <span class="code-comment">,</span>
                </div>
                <div class="code-line">
                  <span class="code-property">  satisfaction:</span>
                  <span class="code-string"> "{{ statistiques[1]?.value || 0 }}%"</span>
                </div>
                <div class="code-line">
                  <span class="code-bracket">}</span>
                  <span class="code-comment">;</span>
                </div>
              </div>
            </div>
            <div class="floating-elements">
              <div class="floating-element element-1">🚀</div>
              <div class="floating-element element-2">💡</div>
              <div class="floating-element element-3">⚡</div>
              <div class="floating-element element-4">🎯</div>
            </div>
          </div>
        </div>

        <!-- Contenu texte - À DROITE -->
        <div class="hero-text">
          <!-- Badge Portfolio -->
          <div class="portfolio-badge">
            <span class="badge-icon">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
              </svg>
            </span>
            <span class="badge-text">Portfolio Professionnel</span>
          </div>
          
          <h1 class="hero-title">
            <span class="title-line">Mes</span>
            <span class="title-highlight">Réalisations</span>
          </h1>
          
          <div class="typing-container" v-if="showTyping">
            <h2 class="hero-subtitle">
              <span class="typing-text">{{ currentDescription }}</span>
              <span class="cursor">|</span>
            </h2>
          </div>
          
          <p class="hero-description">
            Découvrez une collection soigneusement sélectionnée de mes projets les plus innovants. 
            Chaque réalisation raconte une histoire d'expertise technique et de créativité.
          </p>

          <!-- Statistiques améliorées -->
          <div class="hero-stats">
            <div 
              v-for="(stat, index) in statistiques" 
              :key="stat.label"
              class="stat-card"
              :style="{ '--stat-delay': (index * 0.1) + 's' }"
            >
              <div class="stat-icon-wrapper">
                <span class="stat-icon">{{ stat.icon }}</span>
                <div class="stat-glow"></div>
              </div>
              <div class="stat-content">
                <span class="stat-number">{{ stat.value }}{{ stat.suffix || '' }}</span>
                <span class="stat-label">{{ stat.label }}</span>
              </div>
            </div>
          </div>

          <!-- Tags technologies DÉPLACÉS ICI, EN BAS DES STATISTIQUES -->
          <div class="tech-tags">
            <span class="tech-tag">Vue.js</span>
            <span class="tech-tag">Laravel</span>
            <span class="tech-tag">React</span>
            <span class="tech-tag">Node.js</span>
            <span class="tech-tag">TypeScript</span>
            <span class="tech-tag">Tailwind</span>
            <span class="tech-tag">+{{ (statistiques[2]?.value || 6) - 6 }} autres</span>
          </div>
        </div>
      </div>

      <!-- Scroll Indicator Professionnel -->
      <div class="scroll-indicator-pro" @click="scrollToProjects" v-if="showScrollIndicator">
        <div class="scroll-text">
          <span>Découvrir les projets</span>
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 5v14M5 12l7 7 7-7"/>
          </svg>
        </div>
        <div class="scroll-line"></div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const props = defineProps({
  statistiques: {
    type: Array,
    default: () => [
      { icon: '💼', value: 24, label: 'Projets Réalisés', suffix: '+' },
      { icon: '⭐', value: 18, label: 'Clients Satisfaits', suffix: '+' },
      { icon: '🌐', value: 12, label: 'Technologies', suffix: '+' },
      { icon: '🚀', value: 3, label: 'Années Expérience', suffix: '+' }
    ]
  },
  descriptions: {
    type: Array,
    default: () => [
      'Solutions web innovantes et performantes',
      'Design moderne et expérience utilisateur optimale',
      'Code robuste et architectures scalables'
    ]
  },
  showTyping: {
    type: Boolean,
    default: true
  },
  showParticles: {
    type: Boolean,
    default: true
  },
  particleCount: {
    type: Number,
    default: 25
  },
  showScrollIndicator: {
    type: Boolean,
    default: true
  }
})

// Définition des emits
const emit = defineEmits(['scroll-to-projects'])

// État local
const heroRef = ref(null)
const isIllustrationHovered = ref(false)
const currentDescription = ref('')

// Animation typing
let descIndex = 0
let charIndex = 0
let isDeleting = false
let typingTimeout = null

const typeDescription = () => {
  if (!props.showTyping || props.descriptions.length === 0) return
  
  const current = props.descriptions[descIndex]
  
  if (isDeleting) {
    charIndex--
    currentDescription.value = current.substring(0, charIndex)
    
    if (charIndex === 0) {
      isDeleting = false
      descIndex = (descIndex + 1) % props.descriptions.length
      typingTimeout = setTimeout(typeDescription, 1000)
      return
    }
  } else {
    charIndex++
    currentDescription.value = current.substring(0, charIndex)
    
    if (charIndex === current.length) {
      isDeleting = true
      typingTimeout = setTimeout(typeDescription, 3000)
      return
    }
  }
  
  typingTimeout = setTimeout(typeDescription, isDeleting ? 40 : 80)
}

const scrollToProjects = () => {
  emit('scroll-to-projects')
}

const getParticleStyle = (index) => {
  return {
    width: Math.random() * 4 + 2 + 'px',
    height: Math.random() * 4 + 2 + 'px',
    left: Math.random() * 100 + '%',
    top: Math.random() * 100 + '%',
    animationDelay: Math.random() * 5 + 's',
    animationDuration: Math.random() * 10 + 10 + 's'
  }
}

onMounted(() => {
  if (props.showTyping) {
    typeDescription()
  }
})

onUnmounted(() => {
  if (typingTimeout) {
    clearTimeout(typingTimeout)
  }
})
</script>

<style scoped>
.projects-hero {
  position: relative;
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 2rem 0;
  overflow: hidden;
}

.hero-background {
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
    rgba(139, 92, 246, 0.03) 50%,
    rgba(236, 72, 153, 0.02) 100%);
}

.particles-hero {
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

.hero-content {
  display: grid;
  grid-template-columns: 1fr 1.2fr; /* Illustration à gauche, texte à droite */
  gap: 6rem;
  align-items: center;
  width: 100%;
}

/* Illustration Portfolio - À GAUCHE */
.portfolio-illustration {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
}

.illustration-wrapper {
  position: relative;
  perspective: 1000px;
  transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.illustration-hover {
  transform: scale(1.02) rotateY(-5deg);
}

.code-window {
  background: white;
  border-radius: 16px;
  padding: 1.5rem;
  box-shadow: 
    0 20px 60px rgba(0, 0, 0, 0.1),
    0 0 0 1px rgba(255, 255, 255, 0.8);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.3);
  min-width: 320px;
}

.window-header {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  margin-bottom: 1.5rem;
  padding-bottom: 0.75rem;
  border-bottom: 1px solid #f1f5f9;
}

.window-dots {
  display: flex;
  gap: 0.5rem;
}

.dot {
  width: 12px;
  height: 12px;
  border-radius: 50%;
}

.dot.red { background: #ef4444; }
.dot.yellow { background: #f59e0b; }
.dot.green { background: #10b981; }

.window-title {
  font-size: 0.875rem;
  font-weight: 600;
  color: #64748b;
}

.code-content {
  font-family: 'Monaco', 'Consolas', monospace;
  font-size: 0.875rem;
  line-height: 1.6;
}

.code-line {
  margin-bottom: 0.5rem;
}

.code-keyword { color: #dc2626; font-weight: 600; }
.code-variable { color: #2563eb; }
.code-operator { color: #64748b; }
.code-bracket { color: #059669; }
.code-property { color: #7c3aed; }
.code-number { color: #dc2626; }
.code-string { color: #059669; }
.code-comment { color: #94a3b8; }

.floating-elements {
  position: absolute;
  inset: 0;
  pointer-events: none;
}

.floating-element {
  position: absolute;
  font-size: 1.5rem;
  animation: float-element 6s ease-in-out infinite;
}

.element-1 { top: -20px; left: -20px; animation-delay: 0s; }
.element-2 { top: -10px; right: -30px; animation-delay: 1.5s; }
.element-3 { bottom: -20px; left: 40px; animation-delay: 3s; }
.element-4 { bottom: -10px; right: -10px; animation-delay: 4.5s; }

@keyframes float-element {
  0%, 100% { transform: translateY(0px) rotate(0deg); }
  50% { transform: translateY(-15px) rotate(5deg); }
}

/* Hero Text - À DROITE */
.hero-text {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.portfolio-badge {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 1rem;
  background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(139, 92, 246, 0.1));
  color: #3b82f6;
  border-radius: 50px;
  font-size: 0.875rem;
  font-weight: 600;
  width: fit-content;
}

.badge-icon {
  display: flex;
  align-items: center;
}

.hero-title {
  font-size: clamp(2.5rem, 6vw, 4rem);
  font-weight: 800;
  line-height: 1.1;
  color: #1f2937;
  display: flex;
  flex-direction: column;
  gap: 0.25rem;
}

.title-line {
  display: block;
}

.title-highlight {
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  background-clip: text;
  -webkit-background-clip: text;
  color: transparent;
  display: inline-block;
}

.typing-container {
  min-height: 2.5rem;
  margin-top: -0.5rem;
}

.hero-subtitle {
  font-size: clamp(1.25rem, 3vw, 1.75rem);
  font-weight: 600;
  color: #6b7280;
  display: flex;
  align-items: center;
  gap: 4px;
}

.typing-text {
  display: inline-block;
  min-width: 300px;
}

.cursor {
  color: #3b82f6;
  animation: blink 1s step-end infinite;
}

@keyframes blink {
  50% { opacity: 0; }
}

.hero-description {
  font-size: 1.125rem;
  line-height: 1.7;
  color: #6b7280;
  max-width: 500px;
}

/* Statistiques améliorées */
.hero-stats {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 1.5rem;
  margin: 1rem 0;
}

.stat-card {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding: 1.25rem;
  background: rgba(255, 255, 255, 0.8);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.3);
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
  opacity: 0;
  transform: translateY(20px);
  animation: statAppear 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
  animation-delay: var(--stat-delay);
}

@keyframes statAppear {
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.stat-icon-wrapper {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
}

.stat-icon {
  font-size: 1.75rem;
  z-index: 2;
  position: relative;
}

.stat-glow {
  position: absolute;
  width: 40px;
  height: 40px;
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  border-radius: 50%;
  opacity: 0.1;
  animation: pulse-glow 2s ease-in-out infinite;
}

@keyframes pulse-glow {
  0%, 100% { transform: scale(1); opacity: 0.1; }
  50% { transform: scale(1.2); opacity: 0.2; }
}

.stat-content {
  display: flex;
  flex-direction: column;
}

.stat-number {
  font-size: 1.5rem;
  font-weight: 800;
  color: #1f2937;
  line-height: 1;
}

.stat-label {
  font-size: 0.875rem;
  color: #6b7280;
  font-weight: 500;
}

/* Tags technologies - EN BAS DES STATISTIQUES */
.tech-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 0.75rem;
  margin-top: 1rem;
}

.tech-tag {
  padding: 0.75rem 1.25rem;
  background: rgba(59, 130, 246, 0.1);
  color: #3b82f6;
  border-radius: 12px;
  font-size: 0.875rem;
  font-weight: 600;
  border: 1px solid rgba(59, 130, 246, 0.2);
  transition: all 0.3s ease;
}

.tech-tag:hover {
  background: rgba(59, 130, 246, 0.15);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
}

/* Scroll Indicator Professionnel */
.scroll-indicator-pro {
  position: absolute;
  bottom: 2rem;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.5rem;
  cursor: pointer;
  transition: all 0.3s ease;
}

.scroll-indicator-pro:hover {
  transform: translateX(-50%) translateY(-5px);
}

.scroll-text {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.75rem;
  font-weight: 600;
  color: #6b7280;
  text-transform: uppercase;
  letter-spacing: 0.1em;
  transition: color 0.3s ease;
}

.scroll-indicator-pro:hover .scroll-text {
  color: #3b82f6;
}

.scroll-text svg {
  transition: transform 0.3s ease;
}

.scroll-indicator-pro:hover .scroll-text svg {
  transform: translateY(3px);
}

.scroll-line {
  width: 1px;
  height: 40px;
  background: linear-gradient(to bottom, #3b82f6, transparent);
  animation: scroll-line 2s ease-in-out infinite;
}

@keyframes scroll-line {
  0%, 100% {
    height: 40px;
    opacity: 1;
  }
  50% {
    height: 60px;
    opacity: 0.7;
  }
}

/* Dark mode */
.dark-mode .code-window {
  background: #1f2937;
  border-color: #374151;
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
}

.dark-mode .window-header {
  border-bottom-color: #374151;
}

.dark-mode .window-title {
  color: #94a3b8;
}

.dark-mode .hero-title {
  color: #f9fafb;
}

.dark-mode .hero-subtitle,
.dark-mode .hero-description,
.dark-mode .scroll-text {
  color: #d1d5db;
}

.dark-mode .stat-card {
  background: rgba(30, 41, 59, 0.8);
  border-color: #374151;
}

.dark-mode .stat-number {
  color: #f9fafb;
}

.dark-mode .stat-label {
  color: #94a3b8;
}

.dark-mode .tech-tag {
  background: rgba(59, 130, 246, 0.15);
  border-color: rgba(59, 130, 246, 0.3);
}

.dark-mode .scroll-line {
  background: linear-gradient(to bottom, #60a5fa, transparent);
}

/* Responsive */
@media (max-width: 968px) {
  .hero-content {
    grid-template-columns: 1fr;
    gap: 4rem;
    text-align: center;
  }

  .portfolio-illustration {
    order: -1;
  }

  .hero-text {
    order: 1;
    align-items: center;
  }

  .portfolio-badge {
    align-self: center;
  }

  .hero-stats {
    grid-template-columns: repeat(2, 1fr);
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
  }

  .code-window {
    min-width: 280px;
  }
}

@media (max-width: 768px) {
  .projects-hero {
    padding: 1rem 0;
    min-height: 95vh;
  }

  .scroll-indicator-pro {
    bottom: 1rem;
  }

  .hero-stats {
    grid-template-columns: 1fr;
    gap: 1rem;
  }

  .floating-elements {
    display: none;
  }

  .tech-tags {
    justify-content: center;
  }
}

@media (max-width: 480px) {
  .code-window {
    min-width: 250px;
    padding: 1rem;
  }

  .typing-text {
    min-width: 250px;
  }

  .hero-title {
    font-size: clamp(2rem, 8vw, 3rem);
  }

  .stat-card {
    padding: 1rem;
  }

  .tech-tags {
    gap: 0.5rem;
  }

  .tech-tag {
    padding: 0.5rem 1rem;
    font-size: 0.8rem;
  }
}

/* Performance */
@media (prefers-reduced-motion: reduce) {
  .particle,
  .cursor,
  .scroll-line,
  .stat-glow,
  .floating-element,
  .illustration-wrapper {
    animation: none !important;
  }

  .stat-card {
    animation: none;
    opacity: 1;
    transform: none;
  }
}
</style>