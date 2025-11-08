// resources/js/router/index.js
import {
  createRouter, createWebHistory 
}
from "vue-router";
  import Accueil from "../views/Accueil.vue";
  const routes = [
    {
  path: "/",
        name: "accueil",
        component: Accueil,
        meta: {
  title: "Accueil",
        
}
,
    
}
,
    {
  path: "/projets",
        name: "projets",
        component: () => import("../views/Projets.vue"),
        meta: {
  title: "Mes Projets",
        
}
,
    
}
,
    {
  path: "/projets/:slug",
        name: "projet-detail",
        component: () => import("../views/ProjetDetail.vue"),
        meta: {
  title: "Détail du Projet",
        
}
,
    
}
,
    {
  path: "/a-propos",
        name: "a-propos",
        component: () => import("../views/APropos.vue"),
        meta: {
  title: "À Propos",
        
}
,
    
}
,
    {
  path: "/blog",
        name: "blog",
        component: () => import("../views/Blog.vue"),
        meta: {
  title: "Blog",
        
}
,
    
}
,
    {
  path: "/blog/:slug",
        name: "article-detail",
        component: () => import("../views/ArticleDetail.vue"),
        meta: {
  title: "Article",
        
}
,
    
}
,
    {
  path: "/contact",
        name: "contact",
        component: () => import("../views/Contact.vue"),
        meta: {
  title: "Contact",
        
}
,
    
}
,
    {
  path: "/:pathMatch(.*)*",
        name: "not-found",
        component: () => import("../views/NotFound.vue"),
        meta: {
  title: "Page non trouvée",
        
}
,
    
}
,
];
  const router = createRouter({
  history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
  if (savedPosition) {
  return savedPosition;
  
}
if (to.hash) {
  return {
  el: to.hash,
                behavior: "smooth",
            
}
;
  
}
return {
  top: 0,
            behavior: "smooth",
        
}
;
  
}
,

}
);
  router.beforeEach((to, from, next) => {
  document.title =
        `${
  to.meta.title
}
| Portfolio` || "Portfolio";
  next();
  
}
);
  export default router;
  